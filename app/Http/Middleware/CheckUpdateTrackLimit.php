<?php

namespace App\Http\Middleware;

use App\Models\Plans;
use App\Models\Tracks;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUpdateTrackLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $subscription = $user->subscription('default');
        if ($subscription) {
            $totalTracks = Tracks::where('user_id', $user->id)->where('status', 1)->get()->count();
            $currentSubscribedPlanPriceId = $subscription->stripe_price;
            $currentPlan = Plans::where('stripe_id', $currentSubscribedPlanPriceId)->first();
            if ($currentPlan) {
                $trackLimitByPlan = [
                    'free' => 1,
                    'basic' => 5,
                    'premium' => 10,
                ];
                $currentPlanName = $currentPlan->identifier;
                if (array_key_exists($currentPlanName, $trackLimitByPlan)) {
                    $trackLimit = $trackLimitByPlan[$currentPlanName];
                    if ($totalTracks >= $trackLimit && $request->status == 1) {
                        return redirect()->route('track')->with('unable', 'According to your plan, u are unable to modify tracks more than ' . $trackLimit);
                    }
                }
            }
        }

        return $next($request);
    }
}
