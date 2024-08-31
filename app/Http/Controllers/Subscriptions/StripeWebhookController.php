<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request) {
        $payload = $request->getContent();
        $event = json_decode($payload, true);
        $this->handleSubscriptionEvent($event);
    }

    public function handleSubscriptionEvent(array $event) {
        switch ($event['type']) {
            case 'customer.subscription.updated':
                $this->updateSubscriptionInLaravel($event['data']['object']);
                break;
            default:
                break;
        }
    }

    public function updateSubscriptionInLaravel(array $subscriptionData) {
        $user = User::where('stripe_id', $subscriptionData['customer'])->first();
        if ($user) {
            $user->subscription()->update([
                'stripe_status' => $subscriptionData['status'],
            ]);
        }
    }

}
