<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Jobs\SendSMSJob;
use App\Jobs\UpdateStoresJob;
use App\Models\Tracks;
use App\Models\Pages;
use App\Models\Plans;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('frontend.dashboard.profile');
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