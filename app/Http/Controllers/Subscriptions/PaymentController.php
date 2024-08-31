<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionSuccessful;
use App\Mail\SubscriptionCancelled;
use App\Models\Plans;
use App\Models\Tracks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Stripe;
use Stripe\Subscription;
class PaymentController extends Controller
{
    public function index() {
        $data = [
            'intent' => auth()->user()->createSetupIntent()
        ];

        return view('subscriptions.payment')->with($data);
    }
    public function store(Request $request) {
        try {
            // Set the Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));
    
            // Retrieve the authenticated user
            $user = auth()->user();
    
            if (!$user) {
                return redirect()->back()->with('error', 'User not authenticated.');
            }
    
            // Check if the user has an existing subscription and cancel it
            $subscription = $user->subscription('default');
    
            if ($subscription) {
                try {
                    $sub = Subscription::retrieve($subscription->stripe_id);
                    $sub->cancel();
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Failed to cancel existing subscription.');
                }
    
                // Delete subscription items in your database
                $subscriptionItems = $subscription->items();
                if ($subscriptionItems->count() > 0) {
                    foreach ($subscriptionItems as $item) {
                        $item->delete();
                    }
                }
    
                // Delete the subscription in your database
                $subscription->delete();
            }
    
            // Retrieve the new plan
            $plan = Plans::find($request->plan);
            $planId = $plan->stripe_id;
    
            // Set up the payment method and create a new subscription
            $paymentMethod = $request->get('payment_method');
            $user->createOrGetStripeCustomer();
            $user->addPaymentMethod($paymentMethod);
    
            $subscription = $user->newSubscription('default', $planId);
    
            // Apply coupon code if provided
            if ($request->has('coupon')) {
                $subscription->withCoupon($request->coupon);
            }
    
            $subscription->create($paymentMethod, [
                'email' => $user->email,
            ]);
    
            // Delete all tracks associated with the user
            Tracks::where('user_id', $user->id)->delete();
    
            // Send subscription success email
            Mail::to($user->email)->send(new SubscriptionSuccessful($plan));
    
            // Flash a success message and redirect to plans page
            session()->flash('success', 'Subscription successful! You are now signed up. <a href="'.route('track').'">START TRACKING HERE</a>.');
            return redirect()->route('plans');
    
        } catch (IncompletePayment $exception) {
            // Handle incomplete payment
            return redirect()->back()->with('error', 'Incomplete payment: ' . $exception->getMessage());
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }   

    public function subscriptionCancel() {
        // Set the Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        // Retrieve the authenticated user
        $user = auth()->user();
    
        if (!$user) {
            session()->flash('error', 'User not authenticated.');
            return to_route('login'); // Redirect to login if user is not authenticated
        }
    
        // Update the status of all tracks associated with the user
        $tracks = Tracks::where('user_id', $user->id)->get();
    
        foreach ($tracks as $track) {
            $track->update(['status' => 0]);
        }
    
        // Retrieve the user's subscription
        $subscription = $user->subscription('default');
    
        if (!$subscription) {
            session()->flash('error', 'No active subscription found.');
            return to_route('plans'); // Redirect if no active subscription
        }
    
        // Cancel the Stripe subscription
        try {
            $sub = Subscription::retrieve($subscription->stripe_id);
            $sub->cancel();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to cancel Stripe subscription.');
            return to_route('plans');
        }
    
        // Delete subscription items in your database
        $subscriptionItems = $subscription->items();
        if ($subscriptionItems->count() > 0) {
            foreach ($subscriptionItems as $item) {
                $item->delete();
            }
        }
    
        // Delete the subscription in your database
        $subscription->delete();
    
        // Delete tracks associated with the user
        Tracks::where('user_id', $user->id)->delete();
    
        // Send cancellation email
        try {
            Mail::to($user->email)->send(new SubscriptionCancelled());
        } catch (\Exception $e) {
            // Log the error or handle the exception as needed
            session()->flash('error', 'Failed to send cancellation email.');
        }
    
        // Flash a success message and redirect to plans page
        session()->flash('cancel', 'Subscription canceled successfully.');
        return to_route('plans');
    }
}
