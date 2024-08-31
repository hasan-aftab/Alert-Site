<?php

namespace App\Jobs;

use App\Mail\TracksMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userEmail, $userName, $storeName, $discountType, $amount, $shoppingUrl, $operator;

    public function __construct($userEmail, $userName, $storeName, $discountType, $amount, $shoppingUrl, $operator) {
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->storeName = $storeName;
        $this->discountType = $discountType;
        $this->amount = $amount;
        $this->shoppingUrl = $shoppingUrl;
        $this->operator = $operator;
    }

    public function handle() {
        Mail::to($this->userEmail)->send(new TracksMail(
            $this->userName,
            $this->storeName,
            $this->discountType,
            $this->amount,
            $this->shoppingUrl,
            $this->operator
        ));
    }

}
