<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tracks;
use App\Models\Setting;
use App\Models\Payment;
use App\Models\Contacts;
use PhpParser\Node\Stmt\If_;
use Stripe\Stripe;
use Stripe\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionCancelled;

class AdminController extends Controller{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role == 1) {
                return $next($request);
            }

            abort(403, 'Unauthorized');
        });
    }

    public function cancelSubscription(User $id){
        if ($id && $id->subscribed('default')) {
            $id->subscription('default')->cancelNow();
        }
        return response()->json(['status' => 'cancelled']);
    }

    public function index(Request $request){
        return view('admin.pages.dashboard')->with('activeLink','dashboard');
    }

    public function setting(Request $request){
        $rec = Setting::first();
        return view('admin.pages.setting')->with('activeLink','setting')->with('rec',$rec);
    }

    public function store(Request $request){
        $rec = \DB::table('stores')
            ->orderByRaw("CASE WHEN store_name REGEXP '^[A-Za-z]' THEN 0 ELSE 1 END")
            ->orderBy('store_name', 'asc')
            ->where('store_name', '!=', '')
            ->get();
        return view('admin.pages.stores')->with('activeLink','store')->with('rec',$rec);
    }

    public function contacts(Request $request){
        $rec = \DB::table('contacts')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.pages.contacts')->with('activeLink','contacts')->with('rec',$rec);
    }

    public function setting_save(Request $request){
        //echo "<pre>"; print_r($request->all()); die();
        $rec = Setting::count();
        if($rec){
            $rec = Setting::first();
            $rec->email = $request->email;
            $rec->phone = $request->phone;
            $rec->email_content = $request->email_content;
            $rec->sms_content = $request->sms_content;
            $rec->background_color = $request->background_color;
            $rec->save();
        }else{
            $setting = new Setting();
            $setting->email = $request->email;
            $setting->phone = $request->phone;
            $setting->email_content = $request->email_content;
            $setting->sms_content = $request->sms_content;
            $rec->background_color = $request->background_color;
            $setting->save();
        }

        return redirect('/admin/setting')->with('success');
    }

    public function order(){
        $orders = Payment::join('users','users.id','=','payments.user_id')->select('payments.*','users.name')->paginate(5);
        return view('admin.pages.order.index')->with('orders',$orders)->with('activeLink','order');
    }

    public function customer(){
        $customers = User::where('role', 2)->orderBy('id','desc')->paginate(50);
        return view('admin.pages.user.index')->with('customers',$customers)->with('activeLink','customer');
    }

    public function customer_delete($id){
        // Set the Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        // Retrieve the authenticated user
        $user = User::find($id);

        // Update the status of all tracks associated with the user
        $tracks = Tracks::where('user_id', $user->id)->delete();
    
        // Retrieve the user's subscription
        $subscription = $user->subscription('default');
        if ($subscription) {
            // Cancel the Stripe subscription
            try {
                $sub = Subscription::retrieve($subscription->stripe_id);
                $sub->cancel();
            } catch (\Exception $e) {
                //session()->flash('error', 'Failed to cancel Stripe subscription.');
                //return to_route('plans');
            }
        }
    
        // Delete subscription items in your database
        if ($subscription && $subscription->count() > 0) {
            $subscriptionItems = $subscription->items();
            foreach ($subscriptionItems as $item) {
                $item->delete();
            }

            // Delete the subscription in your database
            $subscription->delete();
        }
    
        // Delete tracks associated with the user
        Tracks::where('user_id', $user->id)->delete();
    
        // Send cancellation email
        try {
            Mail::to($user->email)->send(new SubscriptionCancelled());
        } catch (\Exception $e) {
            // Log the error or handle the exception as needed
            session()->flash('error', 'Failed to send cancellation email.');
        }
    
        $user->delete();
        return redirect('/admin/customer')->with('status','Customer deleted successfully');
    }

    public function contact_delete($id){
        Contacts::where('id', $id)->delete();
        return redirect('/admin/contacts')->with('status','Contact deleted successfully.');
    }
}
