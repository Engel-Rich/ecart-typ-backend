<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use App\Utils\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use function App\Utils\translate;

class PayableController extends Controller
{
    public function __construct(
        private Transaction $transaction,
        private Account $account,
    ){}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function add(Request $request): Factory|View|Application
    {
        $accounts = $this->account->orderBy('id')->get();
        $search = $request['search'];
        $from = $request->from;
        $to = $request->to;
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $query = $this->transaction->where('tran_type','Payable')->
                    where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('description', 'like', "%{$value}%");
                        }
                });
            $queryParam = ['search' => $request['search']];
        }else
         {
            $query = $this->transaction->where('tran_type','Payable')
                                ->when($from!=null, function($q) use ($request){
                                     return $q->whereBetween('date', [$request['from'], $request['to']]);
            });

         }

        $payables = $query->latest()->paginate(Helpers::pagination_limit());
        return view('admin-views.account-payable.add',compact('accounts','payables','search','from','to'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'account_id' => 'required',
            'description'=> 'required',
            'amount' => 'required',
        ]);

        $account = $this->account->find($request->account_id);

        $transaction = $this->transaction;
        $transaction->tran_type = 'Payable';
        $transaction->account_id = $request->account_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->debit = 1;
        $transaction->credit = 0;
        $transaction->balance =  $account->balance + $request->amount;
        $transaction->date = $request->date;
        $transaction->save();

        $account->total_in = $account->total_in + $request->amount;
        $account->balance = $account->balance + $request->amount;
        $account->save();

        Toastr::success(translate('Payable Balance Added successfully'));
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function transfer(Request $request): RedirectResponse
    {
        $paymentAccount = $this->account->find($request->payment_account_id);
        $remainBalance = $paymentAccount->balance - $request->amount;
        if($remainBalance < 0)
        {
            Toastr::warning(translate('Your payment account has not sufficent balance for this transaction'));
            return back();
        }

        $payableAccount = $this->account->find($request->account_id);
        $payableTransaction = $this->transaction->find($request->transaction_id);
        $balance = $payableTransaction->amount - $request->amount;
        if($balance < 0){
            Toastr::warning(translate('You have not sufficient balance for this transaction'));
            return back();
        }

        $payableTransaction->amount = $balance;
        $payableTransaction->balance = $payableTransaction->balance - $request->amount;
        $payableTransaction->save();

        $payableAccount->total_out = $payableAccount->total_out + $request->amount;
        $payableAccount->balance = $payableAccount->balance - $request->amount;
        $payableAccount->save();

        $transaction = $this->transaction;
        $transaction->tran_type = 'Expense';
        $transaction->account_id = $request->payment_account_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->debit = 1;
        $transaction->credit = 0;
        $transaction->balance =  $paymentAccount->balance - $request->amount;
        $transaction->date = $request->date;
        $transaction->save();

        $paymentAccount->total_out = $paymentAccount->total_out + $request->amount;
        $paymentAccount->balance = $paymentAccount->balance - $request->amount;
        $paymentAccount->save();

        Toastr::success(translate('Payable Balance pay successfully'));
        return back();
    }
}
