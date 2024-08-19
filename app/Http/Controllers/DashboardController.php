<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Jobs\SendSMSJob;
use App\Jobs\UpdateStoresJob;
use App\Models\Tracks;
use App\Models\Pages;
use App\Models\Plans;
use App\Models\User;
use App\Models\Store;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $plans = Plans::get();

        $plansArray = [];
        foreach ($plans as $plan) {
            $plansArray[$plan->identifier] = $plan;
        }

        $currentPlanName = '';
        $user = auth()->user();
        $userSubscribed = $user->subscribed();
        if ($user){
            $subscription = $user->subscription('default');
            if ($subscription) {
                $currentSubscribedPlanPriceId = $subscription->stripe_price;

                $currentPlan = \App\Models\Plans::where('stripe_id', $currentSubscribedPlanPriceId)->first();
                if($currentPlan){
                    $currentPlanName = @$currentPlan->identifier;
                }
            }
        }

        return view('frontend.dashboard.profile', compact('currentPlanName'));
    }

    public function editalert($id) {
        $alert = Tracks::find($id);
        if(!$alert){
            return redirect()->route('track')->with('error', 'Alert not found!');
        }

        $user = Auth::user();
        $all_tracks = $user->tracks()->get();

        return view('frontend.dashboard.editalert')->with('alert', $alert)->with('all_tracks',$all_tracks);
    }

    public function top_deals(){
        $plans = Plans::get();

        $plansArray = [];
        foreach ($plans as $plan) {
            $plansArray[$plan->identifier] = $plan;
        }

        $currentPlanName = '';
        $user = auth()->user();
        $userSubscribed = $user->subscribed();
        if ($user){
            $subscription = $user->subscription('default');
            if ($subscription) {
                $currentSubscribedPlanPriceId = $subscription->stripe_price;

                $currentPlan = \App\Models\Plans::where('stripe_id', $currentSubscribedPlanPriceId)->first();
                if($currentPlan){
                    $currentPlanName = @$currentPlan->identifier;
                }
            }
        }

        if($currentPlanName!='premium'){
            return redirect()->route('home'); 
        }

        $cashback = Store::where('display', 'Fixed')
            ->where('store_name','!=', '')
            ->orderBy('amount', 'desc')
            ->take(20)
            ->get();

        $percent = Store::where('display', 'Percentage')
            ->orderBy('amount', 'desc')
            ->where('store_name','!=', '')
            ->take(20)
            ->get();

        return view('frontend.dashboard.top_deals', compact('cashback', 'percent','currentPlanName'));
    }

    public function myalerts(){
        $track = Pages::where('slug', 'track')->first();
        $stores = DB::table('stores')
            ->orderByRaw("CASE WHEN store_name REGEXP '^[A-Za-z]' THEN 0 ELSE 1 END")
            ->orderBy('store_name', 'asc')
            ->where('store_name', '!=', '')
            ->get();

        $user = Auth::user();
        //echo "<pre>"; print_r($user->tracks()->get()); die;
        $all_tracks = $user->tracks()->get();


        $plans = Plans::get();

        $plansArray = [];
        foreach ($plans as $plan) {
            $plansArray[$plan->identifier] = $plan;
        }

        $currentPlanName = '';

        $user = auth()->user();
        $userSubscribed = $user->subscribed();
        if ($user){
            $subscription = $user->subscription('default');
            if ($subscription) {
                $currentSubscribedPlanPriceId = $subscription->stripe_price;

                $currentPlan = \App\Models\Plans::where('stripe_id', $currentSubscribedPlanPriceId)->first();
                if($currentPlan){
                    $currentPlanName = @$currentPlan->identifier;
                }
            }
        }

        return view('frontend.dashboard.myalerts')->with('page', $track)->with('stores', $stores)->with('all_tracks',$all_tracks)->with('currentPlanName',$currentPlanName);
    }
}