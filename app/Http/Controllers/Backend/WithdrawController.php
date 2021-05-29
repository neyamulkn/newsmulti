<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\SiteSetting;
use App\Models\Transaction;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class WithdrawController extends Controller
{
    //user wallet withdraw configuration
    public function userWithdrawConfigure(){
        $withdraw = SiteSetting::where('type', 'withdraw_configure')->first();
        return view('backend.wallet.withdraw-configure')->with(compact('withdraw'));
    }

    // change withdraw Status function
    public function changeWithdrawStatus(Request $request){
        $withdraw = Transaction::where('id', $request->withdraw_id)->first();
        if($withdraw && $withdraw->status != 'cancel' && $withdraw->status != 'paid'){
            $withdraw->update(['status' => $request->status]);

            if($request->status == 'cancel') {
                //Returned seller balance
                if ($withdraw->user_id && $withdraw->seller){
                    $seller = $withdraw->seller;
                    $seller->balance = $seller->balance + $withdraw->amount;
                    $seller->save();
                }
                //Returned user balance
                if ($withdraw->id && $withdraw->user){
                    $user = $withdraw->user;
                    $user->wallet_balance = $user->wallet_balance + $withdraw->amount;
                    $user->save();
                }
            }

            //insert notification in database
            Notification::create([
                'type' => 'withdraw',
                'fromUser' => null,
                'toUser' => ($withdraw->user_id) ? $withdraw->user_id : $withdraw->id,
                'item_id' => $withdraw->id,
                'notify' => $request->status.' withdraw request',
            ]);

            $output = array( 'status' => true,  'message'  => 'Withdraw status '.str_replace( '-', ' ', $request->status).' successful.');
        }else{
            $output = array( 'status' => false,  'message'  => 'Withdraw status update failed.!');
        }
        return response()->json($output);
    }

    //admin view user withdraw request list
    public function withdrawRequest(Request $request){
        $withdraws = Transaction::join('users', 'transactions.user_id', 'users.id')
            ->with('paymentGateway')->where('type', 'withdraw')->select('transactions.*');
        //all withdrawal
        $data['withdraw_status'] = $withdraws->get();

        if($request->name){
            $user = $request->user;
            $withdraws->where(function ($query) use ($user) {
                $query->orWhere('name', 'LIKE', '%'. $user .'%');
                $query->orWhere('mobile', 'LIKE', '%'. $user .'%');
                $query->orWhere('email', 'LIKE', '%'. $user .'%');
            });
        }
        if($request->from_date){
            $from_date = Carbon::parse($request->from_date)->format('Y-m-d')." 00:00:00";
            $withdraws->where('transactions.created_at', '>=', $from_date);
        }if($request->end_date){
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59";
            $withdraws->where('transactions.created_at', '<=', $request->end_date);
        }
        if($request->status && $request->status != 'all'){
            $withdraws->where('transactions.status',$request->status);
        }
        //all withdraw lists
        $data['allwithdraws'] =  $withdraws->orderBy('transactions.id', 'desc')->paginate(15);
        $data['totalWithdraw'] = Transaction::where('type', 'withdraw')->where('status', 'paid')->sum('amount');
        $data['availableBalance'] = User::where('wallet_balance', '>', 0)->sum('wallet_balance');
        return view('backend.wallet.withdraw-request')->with($data);
    }

    //get withdraw History
    public function getWithdrawHistory(Request $request, $user_id){

        $withdraws = Transaction::with('paymentGateway')->where('type', 'withdraw')
            ->orderBy('id', 'desc')
            ->where('user_id', $user_id)->get();
        return view('backend.wallet.withdraw-history')->with(compact('withdraws'));
    }

        //wallet transactions history
    public function wallet_transactions(){
        $data['totalBalance'] = User::where('wallet_balance', '>', 0)->sum('wallet_balance');
        $data['totalWithdraw'] = Transaction::where('type', 'withdraw')->where('status', 'paid')->sum('amount');
        $data['allWallets'] = Transaction::with(['user:id,name,username,mobile', 'addedBy'])
            ->whereIn('type', ['wallet', 'withdraw'])
            ->orderBy('id', 'desc')->paginate(15);
        return view('backend.wallet.transactions')->with($data);
    }

    //recharge user wallet
    public function walletRecharge(Request $request){
        $request->validate([
            'amount' => 'required',
            'transaction_details' => 'required',
        ]);

        $user = User::find($request->user_id);
        if($user) {
            $old_balance = $user->wallet_balance;
            if ($request->wallet_type == 'add') {
                $amount =  '+'.$request->amount;
                $total_amount =  $old_balance + $request->amount;
                $rechargeType = 'Add wallet balance';
            }
            if ($request->wallet_type == 'minus') {
                $amount =  '-'.$request->amount;
                $total_amount =  $old_balance - $request->amount;
                $rechargeType = 'Minus wallet balance';
            }
            $user->wallet_balance = $total_amount;
            $user->save();

            //insert transaction
            $transaction = new Transaction();
            $transaction->type = 'wallet';
            $transaction->notes = $request->notes;
            $transaction->item_id = $user->id;
            $transaction->payment_method = ($request->payment_method) ? $request->payment_method : $rechargeType;
            $transaction->transaction_details = $request->transaction_details;
            $transaction->amount = $amount;
            $transaction->total_amount = $total_amount;
            $transaction->user_id = $user->id;
            $transaction->created_by = Auth::guard('admin')->id();
            $transaction->status = 'paid';
            $transaction->save();
            Toastr::success($user->name.'\'s wallet recharge success.');
        }else{
            Toastr::error('Wallet recharge failed user not found.');
        }
        return back();
    }


    //get user wallet info
    public function getWalletInfo(Request $request){
        $user = User::where('name', $request->user)->orWhere('mobile', $request->user)->orWhere('email', $request->user)->first();
        if($user) {
            return view('backend.wallet.userWalletInfo')->with(compact('user'));
        }
        return false;
    }




}
