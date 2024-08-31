<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Jobs\SendSMSJob;
use App\Jobs\UpdateStoresJob;
use App\Models\Tracks;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackController extends Controller
{
    public function track_list() {
        $id = auth()->user()->id;
        $tracks = Tracks::join('users', 'users.id', '=', 'tracks.user_id')->join('stores', 'stores.store_id', '=', 'tracks.store_id')->where('tracks.user_id', $id)->select('tracks.*', 'stores.store_name')->paginate(10);
        return view('frontend.track.index')->with('activeLink', 'track')->with('tracks', $tracks);
    }

    public function add(Request $request) {
        $stores = DB::table('stores')
            ->orderByRaw("CASE WHEN store_name REGEXP '^[A-Za-z]' THEN 0 ELSE 1 END")
            ->orderBy('store_name', 'asc')
            ->where('store_name', '!=', '')
            ->get();
        return view('frontend.track.add')->with('activeLink', 'track')->with('stores', $stores);
    }

    public function edit(Request $request, $id) {
        $track = Tracks::find($id);
        $stores = DB::table('stores')->get();
        return view('frontend.track.edit')->with('activeLink', 'track')->with('track', $track)->with('stores', $stores);
    }

    public function destroy(Request $request, $id) {
        try {
            Tracks::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Alert deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', $e->getMessage());
        }
    }

    public function update(Request $request, $id) {
        //echo "<pre>"; print_r($request->all()); die;
        //try {
            $alert = Tracks::find($id);
        if(!$alert){
            return redirect()->route('track')->with('error', 'Alert not found!');
        }
            
            $customMessages = [
                'discount_type.required' => 'The amount field is required.',
                'price.required' => 'The amount field is required.',
            ];

            $this->validate($request, [
                'store' => 'required',
                'discount_type' => 'required',
                'operator' => 'required',
                'price' => 'required',
                'status' => 'required'
            ], $customMessages);

            $price = $request->price; 
            $priceDecimal = number_format((float)$price, 2, '.', '');

            $oldtrack = Tracks::where(['user_id'=>Auth::id(),'store_id'=>$request->store,'discount_type'=>$request->discount_type,'price'=>$priceDecimal])->where('id','!=',$id)->count();

            if($oldtrack > 0){
                return redirect()->back()->with('error', 'You already have this alert set. Please change your parameters.');
            }

            $rec = \DB::table('stores')->where('store_id', $request->store)->first();
            $track = Tracks::find($id);
            $track->user_id = \Auth::id();
            $track->store_id = $request->store;
            $track->store_name = $rec->store_name;
            $track->discount_type = $request->discount_type;
            $track->operator = $request->operator;
            $track->price = $request->price;
            
            $track->alert_email = $request->alert_type=='email' ? 'email':'';
            $track->alert_text = $request->alert_type=='text' ? 'text':'';

            if($request->alert_type=='both'){
                $track->alert_email = 'email';
                $track->alert_text = 'text';
            }

            $track->status = $request->status;
            $track->save();
            return redirect()->route('track')->with('success', 'Alert updated successfully.');
        //} catch (\Exception $e) {
            //return redirect()->back()->with('error', $e->getMessage());
        //}
        //echo "<pre>"; print_r($request->all()); die;
    }

    public function save(Request $request) {
        // Custom error messages
        $customMessages = [
            'discount_type.required' => 'The amount field is required.',
            'price.required' => 'The amount field is required.',
        ];

        $this->validate($request, [
            'store' => 'required',
            'discount_type' => 'required',
            'operator' => 'required',
            'price' => 'required',
            'alert_type' => 'required',
        ], $customMessages);

        $price = $request->price; 
        $priceDecimal = number_format((float)$price, 2, '.', '');

        $oldtrack = Tracks::where(['user_id'=>Auth::id(),'store_id'=>$request->store,'discount_type'=>$request->discount_type,'price'=>$priceDecimal])->count();

        if($oldtrack > 0){
            return redirect()->back()->with('error', 'You already have this alert set. Please change your parameters.');
        }

        $rec = \DB::table('stores')->where('store_id', $request->store)->first();
        $status = $request->has('status') ? 1 : 0;
        $track = new Tracks;
        $track->user_id = Auth::id();
        $track->store_id = $request->store;
        $track->store_name = $rec->store_name;
        $track->discount_type = $request->discount_type;
        $track->operator = $request->operator;
        $track->price = $request->price;
        
        if($request->has('track_page')){
            if($request->alert_type=='text'){
                $track->alert_text =$request->alert_type;
            }

            if($request->alert_type=='email'){
                $track->alert_email = $request->alert_type;
            }

            if($request->alert_type=='both'){
                $track->alert_email = 'email';
                $track->alert_text = 'text';
            }
        }else{
            $track->alert_email = $request->alert_email;
            $track->alert_text = $request->alert_text;
        }

        $track->status = $status;
        $track->save();
        return redirect()->route('track')->with('success', 'Alert saved successfully.');
    }

    public function sendSMSToUsers() {

        $usersWithSpecificTracks = User::whereHas('tracks', function ($query) {
            $query->where('status', 1)
                ->where('alert_text', 'text')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        })->with(['tracks' => function ($query) {
            $query->where('status', 1)
                ->where('alert_text', 'text')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        }])->get();

        $usersWithSpecificTracks2 = User::whereHas('tracks', function ($query) {
            $query->where('status', 1)
                ->where('alert_text', 'text')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator2 = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator2 = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator2 = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        })->with(['tracks' => function ($query) {
            $query->where('status', 1)
                ->where('alert_text', 'text')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator2 = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator2 = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator2 = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        }])->get();

        //dd($usersWithSpecificTracks);

        $smsData = [];

        foreach ($usersWithSpecificTracks as $user) {
            foreach ($user->tracks as $track) {
                $store = $track->store;
                if ($store && $store->amount!=$track->last_amount_sms) {
                    
                    \DB::table('tracks')->where('id',$track->id)->update(['last_amount_sms'=>$store->amount]);
                    //\DB::table('tracks')->where('id',$track->id)->update(['last_amount_email'=>$store->amount]);

                    //$amt = $store->amount.'%';
                    $amt = $track->price.'%';
                    
                    if($track->discount_type=='Fixed'){
                        //$amt = '$'.$store->amount;
                        $amt = '$'.$track->price;
                    }

                    $smsData[] = [
                        'name' => $track->user->first_name .' '. $track->user->last_name,
                        'phone_number' => $track->user->phone_number,
                        'storeName' => $store->store_name,
                        'discountType' => $track->discount_type,
                        'amount' => $amt,
                        'shoppingUrl' => $store->shopping_url,
                        'operator' => $track->operator
                    ];
                }
            }
        }

        foreach ($usersWithSpecificTracks2 as $user) {
            foreach ($user->tracks as $track) {
                $store = $track->store;
                if ($store && $store->amount!=$track->last_amount_sms) {
                    
                    \DB::table('tracks')->where('id',$track->id)->update(['last_amount_sms'=>$store->amount]);
                    //\DB::table('tracks')->where('id',$track->id)->update(['last_amount_email'=>$store->amount]);

                    //$amt = $store->amount.'%';
                    $amt = $track->price.'%';
                    
                    if($track->discount_type=='Fixed'){
                        //$amt = '$'.$store->amount;
                        $amt = '$'.$track->price;
                    }

                    $smsData[] = [
                        'name' => $track->user->first_name .' '. $track->user->last_name,
                        'phone_number' => $track->user->phone_number,
                        'storeName' => $store->store_name,
                        'discountType' => $track->discount_type,
                        'amount' => $amt,
                        'shoppingUrl' => $store->shopping_url,
                        'operator' => $track->operator
                    ];
                }
            }
        }

        //echo "<pre>"; print_r($smsData); die;

        foreach (array_chunk($smsData, 50) as $batch) {
            foreach ($batch as $data) {
                SendSMSJob::dispatch(
                    $data['name'],
                    $data['phone_number'],
                    $data['storeName'],
                    $data['discountType'],
                    $data['amount'],
                    $data['shoppingUrl'],
                    $data['operator']
                );
            }
        }


    }

    public function sendEmailToUsersWithTracks() {

        $usersWithSpecificTracks = User::whereHas('tracks', function ($query) {
            $query->where('status', 1)
                ->where('alert_email', 'email')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        })->with(['tracks' => function ($query) {
            $query->where('status', 1)
                ->where('alert_email', 'email')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        }])->get();

        $usersWithSpecificTracks2 = User::whereHas('tracks', function ($query) {
            $query->where('status', 1)
                ->where('alert_email', 'email')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator2 = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator2 = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator2 = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        })->with(['tracks' => function ($query) {
            $query->where('status', 1)
                ->where('alert_email', 'email')
                ->whereHas('store', function ($storeQuery) {
                    $storeQuery->whereRaw('tracks.discount_type = stores.display')
                        ->whereRaw('(
                        (tracks.operator2 = "==" AND tracks.price = stores.amount)
                        OR
                        (tracks.operator2 = ">" AND stores.amount > tracks.price)
                        OR
                        (tracks.operator2 = ">=" AND stores.amount >= tracks.price)
                    )');
                });
        }])->get();

        //echo "<pre>"; print_r($usersWithSpecificTracks2); die;

        $emailData = [];

        foreach ($usersWithSpecificTracks as $user) {
            foreach ($user->tracks as $track) {
                
                $store = $track->store;

                if ($store && $store->amount!=$track->last_amount_email) {
                    
                    \DB::table('tracks')->where('id',$track->id)->update(['last_amount_email'=>$store->amount]);
                    //\DB::table('tracks')->where('id',$track->id)->update(['last_amount_sms'=>$store->amount]);

                    $amt = $track->price.'%';
                    //$amt = $store->amount.'%';                    

                    if($track->discount_type=='Fixed'){
                        $amt = '$'.$track->price;
                        //$amt = '$'.$store->amount;
                    }
                    

                    $emailData[] = [
                        'email' => $track->user->email,
                        'name' => $track->user->first_name .' '. $track->user->last_name,
                        'storeName' => $store->store_name,
                        'discountType' => $track->discount_type,
                        'amount' => $amt,
                        'shoppingUrl' => $store->shopping_url,
                        'operator' => $track->operator
                    ];
                }
            }
        }

        foreach ($usersWithSpecificTracks2 as $user) {
            foreach ($user->tracks as $track) {
                
                $store = $track->store;

                if ($store && $store->amount!=$track->last_amount_email) {
                    
                    \DB::table('tracks')->where('id',$track->id)->update(['last_amount_email'=>$store->amount]);
                    //\DB::table('tracks')->where('id',$track->id)->update(['last_amount_sms'=>$store->amount]);

                    $amt = $track->price.'%';
                    //$amt = $store->amount.'%';                    

                    if($track->discount_type=='Fixed'){
                        $amt = '$'.$track->price;
                        //$amt = '$'.$store->amount;
                    }
                    

                    $emailData[] = [
                        'email' => $track->user->email,
                        'name' => $track->user->first_name .' '. $track->user->last_name,
                        'storeName' => $store->store_name,
                        'discountType' => $track->discount_type,
                        'amount' => $amt,
                        'shoppingUrl' => $store->shopping_url,
                        'operator' => $track->operator
                    ];
                }
            }
        }

        //echo "<pre>"; print_r($emailData); die;

        foreach (array_chunk($emailData, 50) as $batch) {
            foreach ($batch as $data) {
                SendEmailJob::dispatch(
                    $data['email'],
                    $data['name'],
                    $data['storeName'],
                    $data['discountType'],
                    $data['amount'],
                    $data['shoppingUrl'],
                    $data['operator']
                );
            }
        }

    }

    public function getallstore() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.engager.ecbsn.com/datagrid/rest/v1/data?name=button_reward_v1&variables=%7B%22storeIds%22%3A%5B%22all%22%5D%7D',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Client-Agent: button',
                'Cookie: AWSALB=BQuQp35zF6Z4088PbnOs0/uN+fhXh+64uiTH7TcdcYEV1IeGuTekWe6BwxSwigER03VWiuPmmUyIygS6j/vYJ48KgaB8X6aUgsfg/oBnr3tJlsXuk1GpGvQSLANK; AWSALBCORS=BQuQp35zF6Z4088PbnOs0/uN+fhXh+64uiTH7TcdcYEV1IeGuTekWe6BwxSwigER03VWiuPmmUyIygS6j/vYJ48KgaB8X6aUgsfg/oBnr3tJlsXuk1GpGvQSLANK'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        //echo count($data['data']['stores']);
        //echo $response;

        foreach ($data['data']['stores'] as $row) {
            $count = \DB::table('stores')->where('store_id', $row['id'])->count();

            $price = $row['reward']['amount'];
            if($row['id']==8333 && $price==3.0){
                $price = 15;
            }

            if ($count) {
                \DB::table('stores')->where('store_id', $row['id'])->update(['amount' => $price, 'display' => $row['reward']['display']]);
            } else {
                \DB::table('stores')->insert(['store_id' => $row['id'], 'amount' => $price, 'display' => $row['reward']['display']]);
            }
        }
    }

    public function getstorewithname()
    {
        $url = "https://api.engager.ecbsn.com/datagrid/rest/v1/data";
        $name = "button_domain_batch_v1";

        // Get the total number of records in the 'stores' table
        $totalRecords = \DB::table('stores')->count();

        // Calculate the total number of iterations needed
        $batchSize = 100;
        $totalIterations = ceil($totalRecords / $batchSize);
        //echo $totalIterations; die;

        for ($i = 0; $i < $totalIterations; $i++) {
            // Fetch a batch of store IDs
            $data = \DB::table('stores')->offset($i * $batchSize)->limit($batchSize)->pluck('store_id')->toArray();
            $variables = json_encode(["storeIds" => $data]);

            $queryParams = http_build_query([
                "name" => $name,
                "variables" => $variables
            ]);

            $requestUrl = "$url?$queryParams";
            $headers = array(
                'Client-Agent: button',
                'Cookie: AWSALB=gQohOefAFs4jwe/MaeO8F1XYpacK1MPTm9aNk0uHr8q8dFr8XLRDOXocDDuapu7sdDGDIdujWLDCo5Xdzw8fdT15rCscBiG09lnBLjEezyJOYsjt1MihuE3jt2nw; AWSALBCORS=gQohOefAFs4jwe/MaeO8F1XYpacK1MPTm9aNk0uHr8q8dFr8XLRDOXocDDuapu7sdDGDIdujWLDCo5Xdzw8fdT15rCscBiG09lnBLjEezyJOYsjt1MihuE3jt2nw'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $requestUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                // Handle the error
            } else {
                $data = json_decode($response, true);

                // Update the store information in the database
                foreach ($data['data']['stores'] as $row) {
                    \DB::table('stores')->where('store_id', $row['storeId'])->update([
                        'store_name' => $row['storeName'],
                        'site_url' => $row['siteUrl'],
                        'shopping_url' => $row['shoppingURL']
                    ]);
                }
            }

            curl_close($ch);
        }
    }

    public function check_store(Request $request, $store){
        $curl = curl_init();
        $id = $request->id;
    
        // Check if $id is null
        if (is_null($id)) {
            return response()->json(['message' => 'Store ID is required'], 400);
        }    

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.engager.ecbsn.com/datagrid/rest/v1/data?name=button_reward_v1&variables=%7B%22storeIds%22%3A%5B%22' . $id . '%22%5D%7D',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Client-Agent: button',
            'Cookie: AWSALB=VFVkjfGCmntUcIztMNqomhcFXFb7s2Lsdji5JNT4ATBhplgZ2+j3t25N3KA4SNxKODUdX0pvUUKI1IR0Pg/Y6p/3Av3aYK4oA+fgKdIzLA/bhzdX/8SwU1qJljBK; AWSALBCORS=VFVkjfGCmntUcIztMNqomhcFXFb7s2Lsdji5JNT4ATBhplgZ2+j3t25N3KA4SNxKODUdX0pvUUKI1IR0Pg/Y6p/3Av3aYK4oA+fgKdIzLA/bhzdX/8SwU1qJljBK'
        ),
        ));
    
        $response = curl_exec($curl);

        curl_close($curl);

        // Check if response is valid JSON
        $response_array = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['message' => 'Invalid response from server']);
        }

        // Check if response contains any data
        //print_r($response_array); die;
        if (isset($response_array['data']['stores'])) {
            $stores = $response_array['data']['stores'];
            return response()->json(['message' => 'Store exists', 'data' => $stores,'exist'=>true]);
        } else {
            return response()->json(['message' => 'Store does not exist','exist'=>false]);
        }
    }    
}