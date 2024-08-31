<?php

namespace App\Jobs;

use Aloha\Twilio\Support\Laravel\Facade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name, $phone_number, $storeName, $discountType, $amount, $shoppingUrl, $operator;

    public function __construct($name, $phone_number, $storeName, $discountType, $amount, $shoppingUrl, $operator) {
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->storeName = $storeName;
        $this->discountType = $discountType;
        $this->amount = $amount;
        $this->shoppingUrl = $shoppingUrl;
        $this->operator = $operator;
    }

    public function handle(): void {
        $rec = Setting::first();
        if($rec){
            $message = $rec->sms_content;
            $message = preg_replace("/<[^>]+>(?!,)|(?<=,)<[^>]+>/", "", $message);
            $message = str_replace('&nbsp;', ' ', $message);
            $message = str_replace('{{new_line}}', "\n", $message);

            $placeholders = [
                '{{customer_name}}' => $this->name,
                '{{store_name}}' => $this->storeName,
                '{{operator}}' => $this->operator,
                '{{discount_type}}' => $this->discountType,
                '{{amount}}' => $this->amount,
                '{{shopping_url}}' => $this->shoppingUrl
            ];

            foreach ($placeholders as $placeholder => $value) {
                $message = str_replace($placeholder, $value, $message);
            }

            // Replace specific symbols with names
            $symbols = [
                '==' => 'equal to',                
                '>' => 'greater than',
            ];

            foreach ($symbols as $symbol => $name) {
                $message = str_replace($symbol, $name, $message);
            }

        }else{
            $message =
                "
                TrackRak Alert
                Hello [$this->name],
                [$this->storeName] is [$this->operator] [$this->discountType/$ $this->amount]
                Store link : [$this->shoppingUrl]
                TrackRak & Get More Money Back!
                Don't want these alerts?
                Login to your TrackRak account and update your alert settings.
            ";
        }

        /*
        try {
            Facade::message($this->phone_number, $message);
            Log::info("Message sent successfully to {$this->phone_number}");
        } catch (\Exception $e) {
            Log::error("Error: " . $e->getMessage());
        }
        */

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('TELNYX_API_KEY')
            ])->post('https://api.telnyx.com/v2/messages', [
                'from' => env('TELNYX_FROM_NUMBER'),
                'to' => $this->phone_number,
                'text' => $message
            ]);
        
            // Check if the request was successful (status code 2xx)
            if ($response->successful()) {
                Log::info("Message sent successfully to " . $this->phone_number);
                Log::info("Message" .$message);
            } else {
                Log::error("Error: " . $response->status());
                Log::info("Message" .$message);
            }
        } catch (\Exception $e) {
            Log::error("Error: " . $e->getMessage());
            Log::info("Message" .$message);
        }
    }
}
