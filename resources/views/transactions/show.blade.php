@extends('layouts.main')

@section('title')Detail Transaksi @endsection

@section('css-library')

@endsection

@section('css-page')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
    <h1>Detail Transaksi, {{ date('d-m-Y', strtotime($transaction->date)) }}</h1>
    </div>

    <div class="section-body">
      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">Details</h4>
        </div>
        <div class="card-body">
          @if (session('success-message'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ session('success-message') }}</strong>
            </div>
          @endif
          <table class="table table-striped table-borderd">
            <thead>
              <tr>
                <td>Note</td>
                <td>Debit</td>
                <td>Kredit</td>
                <td>Aksi</td>
              </tr>
            </thead>
            <tbody>
              @php $totalDebit =0; $totalCredit=0; @endphp
              @foreach($transaction->details as $detail)
              @php
                $debit = ($detail->type == 'debit') ? $detail->nominal : 0;
                $credit = ($detail->type == 'credit' ) ? $detail->nominal : 0;

                $totalDebit += $debit;
                $totalCredit += $credit;
              @endphp
              <tr>
                <td>{{ $detail->info }}</td>
                <td align="right">{{ number_format($debit, 2, ',', '.') }}</td>
                <td align="right">{{ number_format($credit, 2, ',', '.') }}</td>
                <td align="right">
                  <div class="btn-group">
                    <!-- 
                      * route name = transaction.edit, akan menghasilkan
                      * url = transaction/{transaction}/edit
                      * untuk mengganti nilai dinamis yang add pada url, pakai array di parameter ke dua ['transaction' => {nilai}]
                      * jika ada lebih dari 1 nilai dinamis tinggal tambahkan nilainya pada array. 
                     -->
                    <a href="{{ route('transaction.edit',['transaction' => $detail->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> | edit</a>
                    <!-- 
                      *  route name = trasaction.delete, akan menghasilkan
                      * url = transaction/{id_transaction}
                      * method = DELETE
                      * karena itu pakai form dengan method POST, dan method field berisi delete agar laravel tau route yang di maksud
                     -->
                    <form action="{{ route('transaction.destroy', ['transaction' => $detail->id]) }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button type="submit" onclick="confirm('Yakin nih mau di hapus?')" class="btn btn-danger"><i class="fa fa-trash"></i> | hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td><b>Grand Total</b></td>
                <td align="right"><b>{{ number_format($totalDebit, 2, ',', '.') }}</b></td>
                <td align="right"><b>{{ number_format($totalCredit, 2, ',', '.') }}</b></td>
                <td align="right"><b>{{ number_format($totalDebit - $totalCredit, 2, ',', '.') }}</b></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</section>
@endsection

@section('js-library')

@endsection

@section('js-page')

@endsection