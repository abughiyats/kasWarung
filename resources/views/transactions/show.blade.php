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
                    <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i> | edit</a>
                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> | hapus</a>
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