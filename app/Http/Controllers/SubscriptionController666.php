<?php
namespace App\Http\Controllers\Subscriptions;
use App\Plans;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class SubscriptionController extends Controller
{
    public function index() {
        $plans = Plans::get();
        return view('subscriptions.plans', compact('plans'));
    }
}
