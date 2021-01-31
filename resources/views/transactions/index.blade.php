@extends('layouts.main')

@section('title') Transaksi @endsection

@section('css-library')
<link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
@endsection

@section('css-page')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
    <h1>Trasaction Page</h1>
    </div>
    
    <div class="section-body">
      <div class="card card-primary">
        <div class="card-header with-border">
          <h4 class="card-title">data transaksi</h4>
        </div>
        <div class="card-body">
          <table class="table table-striped table-borderd">
            <thead>
              <tr>
                <td>Tanggal</td>
                <td>Kredit</td>
                <td>Debit</td>
                <td>Aksi</td>
              </tr>
            </thead>
            <tbody>
              @foreach($transactions as $transaction)
                @php
                $credit = $transaction->details->where('type', 'credit')->sum('nominal');
                $debit = $transaction->details->where('type', 'debit')->sum('nominal');
                @endphp
                <tr>
                  <td>{{ date("d-m-Y", strtotime($transaction->date)) }}</td>
                  <td align="right">{{ number_format($credit, 2, '.', ',') }}</td>    
                  <td align="right">{{ number_format($debit, 2, '.', ',') }}</td>    
                  <td align="right"><a href="{{ route('transaction.show', ['transaction' => $transaction->id]) }}" class="btn btn-primary">lihat</a></td>    
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <x-add-float-button to="{{ route('transaction.create') }}"/>
</section>
@endsection

@section('js-library')
<script src="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('js-page')
@endsection