<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionDetail;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('details')
            ->orderBy('date', 'desc')->paginate(10);

        return view('transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        /**
         * rule dari validasi ada di App\Http\Requests\TransactionRequest
         * gunakan perintah php artisan make:request untuk membuat validasinya
         */
        $request->validated();
        
        // cek apakah sudah ada header hari ini
        $transaction = Transaction::where('date', date("Y-m-d", strtotime($request->get('date'))))->first();
        if(!$transaction){
            $this->createHeaderTransaction($request->get('date'));
        }

        $transactionDetail = new TransactionDetail;
        $transactionDetail->transaction_id = $transaction->id;
        $transactionDetail->info = $request->get('note');
        $transactionDetail->type = $request->get('type');
        $transactionDetail->nominal = $request->get('amount');
        $transactionDetail->save();
        
        return redirect()->back()->with('success-message', "berhasil menambahkan transaksi baru")->with('date', $request->get('date'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with('details')->findOrFail($id);

        return view('transactions.show', ['transaction'=> $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transactionDetail = TransactionDetail::with('transaction')->findOrFail($id);
        
        return view('transactions.edit', ['transactionDetail' => $transactionDetail]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        /**
         * rule dari validasi ada di App\Http\Requests\TransactionRequest
         * gunakan perintah php artisan make:request untuk membuat validasinya
         */
        $request->validated();
            
        $transactionDetail = TransactionDetail::findOrFail($id);
        
        // cek apakah sudah ada header hari ini
        $transaction = Transaction::where('date', date("Y-m-d", strtotime($request->get('date'))))->first();

        if(!$transaction){
            $this->createHeaderTransaction($request->get('date'));
        }

        $transactionDetail->transaction_id = $transaction->id;
        $transactionDetail->info = $request->get('note');
        $transactionDetail->type = $request->get('type');
        $transactionDetail->nominal = $request->get('amount');
        $transactionDetail->save();

        return redirect()->back()->with('success-message', "berhasil merubah detail transaksi");
    }
    
    /**
     * this function for create Transaction Model
     * @param string $date => d-m-Y
     * 
     * @return Transaction
     */
    private function createHeaderTransaction($date)
    {

        $transaction = new Transaction;
        $transaction->date = date("Y-m-d", strtotime($request->get('date')));
        $transaction->user_id = 1; // nnti di ganti jadi \Auth::user()->id;
        $transaction->save();

        return $transaction;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactionDetail = TransactionDetail::findOrFail($id);
        $transactionDetail->delete();

        return redirect()->back()->with('success-message', "berhasil menghapus detail transaksi");
    }
}
