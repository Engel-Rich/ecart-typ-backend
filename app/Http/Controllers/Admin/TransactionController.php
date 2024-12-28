<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use App\Utils\Helpers;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TransactionController extends Controller
{
    public function __construct(
        private Transaction $transaction,
        private Account $account,
    ){}

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function list(Request $request): View|Factory|Application
    {
        $accounts = $this->account->orderBy('id','desc')->get();
        $accId = $request['account_id'];
        $tranType = $request['tran_type'];
        $from = $request['from'];
        $to = $request['to'];

        $query = $this->transaction->
            when($accId!=null, function($q) use ($request){
                return $q->where('account_id',$request['account_id']);
            })
            ->when($tranType!=null, function($q) use ($request){
                return $q->where('tran_type',$request['tran_type']);
            })
            ->when($from!=null, function($q) use ($request){
                return $q->whereBetween('date', [$request['from'], $request['to']]);
            });

        $transactions = $query->orderBy('id','desc')->paginate(Helpers::pagination_limit())->appends(['account_id' => $request['account_id'],'tran_type'=>$request['tran_type'],'from'=>$request['from'],'to'=>$request['to']]);

        return view('admin-views.transaction.list',compact('accounts','transactions','accId','tranType','from','to'));
    }

    /**
     * @param Request $request
     * @return string|StreamedResponse
     * @throws IOException
     * @throws InvalidArgumentException
     * @throws UnsupportedTypeException
     * @throws WriterNotOpenedException
     */
    public function export(Request $request): StreamedResponse|string
    {
        $accId = $request['account_id'];
        $tranType = $request['tran_type'];
        $from = $request['from'];
        $to = $request['to'];
        if($accId==null && $tranType==null && $to==null && $from !=null)
        {
            $transactions = $this->transaction->whereMonth('date',Carbon::now()->month)->get();

        }else{
            $transactions = $this->transaction->
                when($accId!=null, function($q) use ($request){
                    return $q->where('account_id',$request['account_id']);
                })
                ->when($tranType!=null, function($q) use ($request){
                    return $q->where('tran_type',$request['tran_type']);
                })
                ->when($from!=null, function($q) use ($request){
                    return $q->whereBetween('date', [$request['from'], $request['to']]);
                })->get();
        }

        $storage = [];
        foreach($transactions as $transaction)
        {
            $storage[] = [
                'transaction_type' => $transaction->tran_type,
                'account' => $transaction->account ?  $transaction->account->account : '',
                'amount' => $transaction->amount,
                'description' => $transaction->description,
                'debit' => $transaction->debit == 1 ? $transaction->amount : 0,
                'credit' => $transaction->credit == 1 ? $transaction->amount : 0,
                'balance' => $transaction->balance,
                'date' => $transaction->date,
            ];
        }
        return (new FastExcel($storage))->download('transaction_history.xlsx');
    }
}
