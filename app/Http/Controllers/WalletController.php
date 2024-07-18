<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use App\Models\Wallet;
use Stripe;
use Session;
use Helper;

class WalletController extends Controller
{
    public function showWalletData()
    {
        $start = $_POST['start'];
        $length = $_POST['length'];
        $search = $_POST['search']["value"];

        $client_id_fk = Session::get('loggedUser');

        $showWallet = DB::select("SELECT `id`, `client_id_fk`, `transaction_id`, `amount`, `type`, `date`, `created_at`, `details`, `expiry_date` FROM `tbl_wallet` WHERE client_id_fk=" . $client_id_fk . " limit " . $start . "," . $length);

        $arrayOfWallet = array();

        foreach ($showWallet as $key => $value) {

            if ($value->created_at == "") {
                $value->created_at = "";
            } else {
                $value->created_at = Helper::getFormatedDateTimeForSelectedSlots($value->created_at);
            }

            $arrayOfWallet[] = $value;
        }

        $tableData['data'] = $arrayOfWallet;
        $tableData['recordsTotal'] = count($arrayOfWallet);

        $WalletData = DB::select("SELECT `id`, `client_id_fk`, `transaction_id`, `amount`, `type`, `date`, `created_at`, `details`, `expiry_date` FROM `tbl_wallet` WHERE client_id_fk=" . $client_id_fk);

        $tableData['recordsFiltered'] = count($WalletData);

        return response()->json($tableData);
    }

    public function viewWalletPage()
    {
        return view('Website/User/Wallet/myWallet');
    }

    public function insertIntoWallet(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'amount' => 'required',
                'full_name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'token' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
        }

        $userId = $request->session()->get('loggedUser');

        $token = $request->input('token');
        $full_name = $request->input('full_name');
        $email = $request->input('email');
        $address = $request->input('address');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = \Stripe\Customer::create(array(
            'name' => $full_name,
            'email' => $email,
            'description' => 'test description',
            'source' => $token,
            "address" => ["city" => "hyd", "country" => "india", "line1" => "adsafd werew", "postal_code" => "500090", "state" => "telangana"],
        ));

        $respose = Stripe\Charge::create([
            "amount" => $request->input('amount') * 100,
            'customer' => $customer->id,
            // 'customer' => "cus_KW4n5npYwcZQaC",
            "currency" => "inr",
            "description" => "This payment is tested purpose phpcodingstuff.com",
        ]);

        $transaction_Id = $respose->balance_transaction;

        $wallet = new Wallet();
        $wallet->client_id_fk = $userId;
        $wallet->transaction_id = $transaction_Id;
        $wallet->amount = $request->input('amount');
        $wallet->type = 'Credit';
        $wallet->details = 'Top Up';
        //$wallet->date = $request->input('date');
        $wallet->save();

        return response()->json([
            'status' => true,
            'message' => "Money added successfully added to wallet.",
        ], );
    }

    public function stripePost(Request $request)
    {
        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function getWalletLedger(Request $request)
    {
        $data = view('Website/User/Wallet/wallet_ledger')->render();

        return response()->json([
            'status' => true,
            'data' => $data,
        ], );
    }

    public function getWithdrawForm(Request $request)
    {
        $data = view('Website/User/Wallet/Withdraw')->render();

        return response()->json([
            'status' => true,
            'data' => $data,
        ], );
    }

    public function insertToWallet(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'amount' => 'required',
                'email' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 200);
        }

        $client_id_fk = $request->session()->get('loggedUser');
        $email = $request->input('email');
        $amount = $request->input('amount');
        
        $getUserDetail = DB::select("SELECT id FROM `users` WHERE usertype = 3 AND email= '" . $email . "' ");

        if (count($getUserDetail) > 0)
        {
            $userId = $getUserDetail[0]->id;
        
            if ($userId != null && $userId != "") {
                
                $wallet = new Wallet();
                $wallet->client_id_fk = $userId;
                $wallet->amount = $amount;
                $wallet->type = "Credit";
                $wallet->details = "Received By " . $client_id_fk;
                $wallet->save();

                $wallet = new Wallet();
                $wallet->client_id_fk = $client_id_fk;
                $wallet->amount = $amount;
                $wallet->type = "Debit";
                $wallet->details = "Transfer To " . $userId;
                $wallet->save();

                return response()->json([
                    'status' => true,
                    'message' => "Balance transfer successfully.",
                ], );
            }
        }
        else{
            return response()->json([
                'status' => false,
                'message' => "User not found.",
            ], );
        }
    }
}
