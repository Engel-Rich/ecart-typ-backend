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

class ReceivableController extends Controller
{
    public function __construct(
        private Transaction $transaction,
        private Account $account,
    ){}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function add(Request $request): View|Factory|Application
    {
        $accounts = $this->account->orderBy('id')->get();
        $search = $request['search'];
        $from = $request->from;
        $to = $request->to;
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $query = $this->transaction->where('tran_type','Receivable')->
                    where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('description', 'like', "%{$value}%");
                        }
                });
            $queryParam = ['search' => $request['search']];
        }else
         {
            $query = $this->transaction->where('tran_type','Receivable')
                                ->when($from!=null, function($q) use ($request){
                                     return $q->whereBetween('date', [$request['from'], $request['to']]);
            });

         }
        $receivables = $query->latest()->paginate(Helpers::pagination_limit());
        return view('admin-views.account-receivable.add',compact('accounts','receivables','search','from','to'));
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
            'date' =>'required',
        ]);

        $account = $this->account->find($request->account_id);

        $transaction = $this->transaction;
        $transaction->tran_type = 'Receivable';
        $transaction->account_id = $request->account_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->debit = 0;
        $transaction->credit = 1;
        $transaction->balance =  $account->balance + $request->amount;
        $transaction->date = $request->date;
        $transaction->save();

        $account->total_in = $account->total_in + $request->amount;
        $account->balance = $account->balance + $request->amount;
        $account->save();

        Toastr::success(translate('Receivable Balance Added successfully'));
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function transfer(Request $request): RedirectResponse
    {
        $receivableAccount = $this->account->find($request->account_id);
        $receivableTransaction = $this->transaction->find($request->transaction_id);
        $balance = $receivableTransaction->amount - $request->amount;
        if($balance < 0){

            Toastr::warning(translate('You have not sufficient balance for this transaction'));
            return back();
        }

        $receivableTransaction->amount = $balance;
        $receivableTransaction->balance = $receivableTransaction->balance - $request->amount;
        $receivableTransaction->save();

        $receivableAccount->total_out = $receivableAccount->total_out + $request->amount;
        $receivableAccount->balance = $receivableAccount->balance - $request->amount;
        $receivableAccount->save();

        $receiveAccount = $this->account->find($request->receive_account_id);

        $transaction = $this->transaction;
        $transaction->tran_type = 'Income';
        $transaction->account_id = $request->receive_account_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->debit = 0;
        $transaction->credit = 1;
        $transaction->balance =  $receiveAccount->balance + $request->amount;
        $transaction->date = $request->date;
        $transaction->save();

        $receiveAccount->total_in = $receiveAccount->total_in + $request->amount;
        $receiveAccount->balance = $receiveAccount->balance + $request->amount;
        $receiveAccount->save();

        Toastr::success(translate('Payable Balance pay successfully'));
        return back();

    }
}
