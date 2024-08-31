<?php

namespace App\Http\Controllers;

use App\Models\PrintfulOrder;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function register(Request $request) {

        // Validate the incoming request with proper rules
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|unique:users|regex:/^\+?1?\d{10}$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:8',
            'agree_terms_and_condition' => 'required'
        ]);

        $phoneNumber = $request->phone_number;
        $formattedPhoneNumber = $this->formatUSPhoneNumber($phoneNumber);

        // Create a new user instance
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $formattedPhoneNumber,
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        

        auth()->login($user);
        return redirect()->route('plans')->with('success', 'Registration successful.');
    }

    public function formatUSPhoneNumber($phoneNumber)
    {
        // Remove all non-numeric characters from the phone number
        $numericPhoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Check if the phone number starts with "1" or "+1"
        if (!\Str::startsWith($numericPhoneNumber, '1') && !\Str::startsWith($numericPhoneNumber, '+1')) {
            // Add "1" to the beginning of the phone number
            $numericPhoneNumber = '1' . $numericPhoneNumber;
        }

        // Add "+" sign if missing
        if (!\Str::startsWith($numericPhoneNumber, '+')) {
            $numericPhoneNumber = '+' . $numericPhoneNumber;
        }

        return $numericPhoneNumber;
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 1) {
                return redirect('admin')->with('success', 'Login successful.');
            } else {
                return redirect()->route('track')->with('success', '');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect to home or login page after logout
        return redirect()->route('home');
    }

    public function product_slug() {
        // Retrieve all products
        $products = Products::all();

        // Array to keep track of existing slugs
        $existingSlugs = [];

        // Iterate through products
        foreach ($products as $product) {
            $originalSlug = $product->product_slug;
            $newSlug = $originalSlug;

            // Ensure uniqueness by appending a number if needed
            $counter = 1;
            while (in_array($newSlug, $existingSlugs)) {
                $newSlug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Update the product's slug and save changes
            $product->product_slug = $newSlug;
            $product->save();

            // Add the new slug to the existing slugs array
            $existingSlugs[] = $newSlug;

            // You might want to avoid duplicate slugs in the same batch:
            // $existingSlugs[] = $product->product_slug;

            // Or consider validating uniqueness of $existingSlugs before adding
            // $existingSlugs[] = $newSlug;
        }

        // Display the updated products
        foreach ($products as $product) {
            echo "Product Name: {$product->name} - Updated Slug: {$product->product_slug}\n";
        }
    }

    public function storeOrder(Request $request) {

        try {
            $_request = json_decode($request->getContent());
            $order = new PrintfulOrder();
            $order->printful_order_data = $_request->printful_order_data;
            $order->product_id = $_request->product_id;
            $order->payment_id = $request->payment_id;
            $order->printful_order_id = json_decode($_request->printful_order_data, true)['id'];
            $order->customer_email = json_decode($_request->printful_order_data, true)['recipient']['email'];

            if (auth()->check()) {
                $order->user_id = auth()->user()->id;
            }

            $order->save();
            return response($order)
                ->header('Content-Type', 'text/json');
        } catch (\Exception $e) {
            // Handling the exception
            return response()->json([
                'error' => [
                    'message' => $e->getMessage(), // Retrieve the error message
                    'code' => $e->getCode(), // Retrieve the error code
                ]
            ], 500); // Internal Server Error status code
        }
    }
}
