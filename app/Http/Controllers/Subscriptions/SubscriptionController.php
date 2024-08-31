<?php

namespace App\Http\Controllers\Subscriptions;

use App\Models\Plans;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
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

        return view('subscriptions.plans', compact('plansArray', 'currentPlanName', 'user', 'userSubscribed'))->with('page',array());

    }
}
