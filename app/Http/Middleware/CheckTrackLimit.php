<?php

namespace App\Http\Middleware;

use App\Models\Plans;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTrackLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('home');
        }

        $user = Auth::user();
        $subscription = $user->subscription('default');

        if ($subscription) {

            $currentSubscribedPlanPriceId = $subscription->stripe_price;

            $currentPlan = Plans::where('stripe_id', $currentSubscribedPlanPriceId)->first();
            //print_r($currentPlan->title); die;

            if ($currentPlan) {
                $trackLimitByPlan = [
                    'free' => 1,
                    'basic' => 5,
                    'premium' => 20000,
                ];

                $currentPlanName = $currentPlan->identifier;

                if (array_key_exists($currentPlanName, $trackLimitByPlan)) {
                    $trackLimit = $trackLimitByPlan[$currentPlanName];

                    if ($user->tracks()->count() >= $trackLimit) {
                        return redirect()->route('track')->with('plan_error', 'You have set your maximum number of alerts. Please visit your My Account page to edit or remove current alerts, or UPGRADE YOUR PLAN')->with('current_plan',$currentPlan->title);
                    }
                }
            }
        } else {
            return redirect()->route('track')->with('no_plan_error', 'To have access all features, Please buy a plan first');
        }

        return $next($request);
    }
}
