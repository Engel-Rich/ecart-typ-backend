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

class TransferController extends Controller
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
        $accounts = $this->account->orderBy('id','desc')->get();
        $search = $request['search'];
        $from = $request->from;
        $to = $request->to;
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $query = $this->transaction->where('tran_type','Transfer')->
                    where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('description', 'like', "%{$value}%");
                        }
                });
            $queryParam = ['search' => $request['search']];
        }else
         {
            $query = $this->transaction->where('tran_type','Transfer')
                ->when($from!=null, function($q) use ($request){
                    return $q->whereBetween('date', [$request['from'], $request['to']]);
            });

         }

        $transfers = $query->latest()->paginate(Helpers::pagination_limit())->appends(['search' => $request['search'],'from'=>$request['from'],'to'=>$request['to']]);
        return view('admin-views.transfer.add',compact('accounts','transfers','search','from','to'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'account_from_id' => 'required',
            'account_to_id' => 'required',
            'description'=> 'required',
            'amount' => 'required|min:1',
        ]);

        $accFrom = $this->account->find($request->account_from_id);
        if($accFrom->balance < $request->amount)
        {
            Toastr::warning(\App\Utils\translate('you_have_not_sufficient_balance'));
            return back();
        }

        $transaction = $this->transaction;
        $transaction->tran_type = 'Transfer';
        $transaction->account_id = $request->account_from_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->debit = 1;
        $transaction->credit = 0;
        $transaction->balance =  $accFrom->balance - $request->amount;
        $transaction->date = $request->date;
        $transaction->save();


        $accFrom->total_out = $accFrom->total_out + $request->amount;
        $accFrom->balance = $accFrom->balance - $request->amount;
        $accFrom->save();

        $accTo = $this->account->find($request->account_to_id);
        $transaction = new Transaction();
        $transaction->tran_type = 'Transfer';
        $transaction->account_id = $request->account_to_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->debit = 0;
        $transaction->credit = 1;
        $transaction->balance =  $accTo->balance + $request->amount;
        $transaction->date = $request->date;
        $transaction->save();

        $accTo->total_in = $accTo->total_in + $request->amount;
        $accTo->balance = $accTo->balance + $request->amount;
        $accTo->save();

        Toastr::success(translate('New Deposit Added successfully'));
        return back();
    }
}
