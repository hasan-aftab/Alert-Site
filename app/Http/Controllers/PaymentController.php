<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;
use Stripe\Coupon;
use Stripe\Subscription;
use Auth;
use App\Models\Plans;
class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->total,
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            // Save payment data to your database
            $payment = new Payment();
            
            // Check if the user is authenticated
            if (Auth::check()) {
                // User is logged in, set the user_id
                $payment->user_id = auth()->user()->id;
            } else {
                // User is not logged in, set user_id to null
                $payment->user_id = null;
            }

            $payment->amount = $request->total / 100;
            $payment->payment_intent_id = $paymentIntent->id;
            // Add more fields or manipulate data as needed
            $payment->save();

            // Retrieve subscription ID from payment intent
            $subscriptionId = $paymentIntent->charges->data[0]->payment_intent->subscription;

            // Apply coupon code to subscription if provided
            if ($request->has('coupon')) {
                $coupon = Coupon::retrieve($request->coupon);
                $subscription = Subscription::retrieve($subscriptionId);
                $subscription->coupon = $request->coupon;
                $subscription->save();

                //echo "<pre>"; print_r($subscription); die;
            }

            // Handle successful payment - send a success response
            return response()->json(['success' => true, 'message' => 'Payment successful', 'payment_id' => $payment->id, 'subscription_id' => $subscriptionId]);
        } catch (\Exception $e) {
            // Handle payment failure - send an error response
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function check_coupon_old(Request $request){
        try {
            // Perform coupon validation logic here
            // For example, using Stripe
            Stripe::setApiKey(config('services.stripe.secret'));
            $coupon = Coupon::retrieve($request->coupon);
    
            // Determine the discount amount and type
            if (!empty($coupon->amount_off)) {
                // Coupon provides a fixed amount discount
                $discountAmount = $coupon->amount_off;
                $discountType = 'fixed_amount';
            } elseif (!empty($coupon->percent_off)) {
                // Coupon provides a percentage discount
                $discountAmount = $coupon->percent_off;
                $discountType = 'percentage';
            } else {
                // Coupon does not specify a discount
                throw new \Exception('Invalid coupon: No discount amount specified.');
            }
            
            $plan = Plans::find($request->plan);
            $discount_fixed_amount = '';
            
            if($plan->identifier=='basic'){
                $discount_fixed_amount = '$1.99';
            }

            if($plan->identifier=='premium'){
                $discount_fixed_amount = '$4.99';
            }

            // Build the response data
            $responseData = [
                'valid' => true,
                'discount' => $discountAmount,
                'discount_type' => $discountType,
                'message_old' => 'Coupon is valid. Discount: ' . ($discountType === 'fixed_amount' ? ($discountAmount / 100) . ' USD' : $discountAmount . '%'),
                'message' => 'Coupon is valid.'
            ];
            
    
            // Return success response with coupon details
            return response()->json($responseData);
        } catch (\Exception $e) {
            // If coupon is not valid, return error response
            return response()->json(['valid' => false, 'message' => $e->getMessage()]);
        }
    }
    
    public function check_coupon(Request $request)
    {
        try {
            // Set the Stripe API key
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            // Retrieve the coupon from Stripe
            // Retrieve the coupon from Stripe, expanding the applies_to field
            $coupon = \Stripe\Coupon::retrieve([
                'id' => $request->coupon,
                'expand' => ['applies_to']
            ]);

            // Validate the plan associated with the coupon
            $plan = Plans::find($request->plan);
            //echo "<pre>"; print_r($plan); die;

            // Check if the coupon is valid and applies to the specified product
            if ($coupon->valid) {
                $appliesToProducts = $coupon->applies_to['products'] ?? [];
                //echo "<pre>"; print_r($appliesToProducts); die;

                if (!empty($appliesToProducts) && !in_array($plan->product_id, $appliesToProducts)) {
                    // Return an error message if the coupon does not apply to the selected product
                    return response()->json(['valid' => false, 'message' => 'This coupon does not apply to the selected product.']);
                }

                // Determine the discount amount and type
                $discountAmount = null;
                $discountType = null;

                if (!empty($coupon->amount_off)) {
                    // Coupon provides a fixed amount discount
                    $discountAmount = $coupon->amount_off;
                    $discountType = 'fixed_amount';
                } elseif (!empty($coupon->percent_off)) {
                    // Coupon provides a percentage discount
                    $discountAmount = $coupon->percent_off;
                    $discountType = 'percentage';
                } else {
                    // Invalid coupon with no discount amount specified
                    return response()->json(['valid' => false, 'message' => 'Invalid coupon: No discount amount specified.']);
                }

                // Build the response data
                $responseData = [
                    'valid' => true,
                    'discount' => $discountAmount,
                    'discount_type' => $discountType,
                    'message' => 'Coupon is valid.'
                ];

                return response()->json($responseData);
            } else {
                // Return an error message if the coupon is not valid
                return response()->json(['valid' => false, 'message' => 'Coupon is not valid.']);
            }
        } catch (\Exception $e) {
            // If coupon is not valid, return error response
            return response()->json(['valid' => false, 'message' => $e->getMessage()]);
        }
    }
}
