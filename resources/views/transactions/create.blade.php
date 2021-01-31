@extends('layouts.main')

@section('title') Blank @endsection

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
      @if (session('success-message'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ session('success-message') }}</strong>
        </div>
      @endif
      <!-- card form input -->
      <div class="card card-primary">
        <div class="card-header">
          <h4 class="card-title">Form Input</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('transaction.store') }}" method="POST" class="form-horizontal" id="form-transaction">
            {{ csrf_field() }}
            <!-- date picker -->
            <div class="form-group row">
              <label for="tanggal" class="col-md-3">Tanggal</label>
              <div class="col-md-7">
                <input type="text" class="form-control singledate-picker" name="date" value="{{ (session('success-message')) ? session('date') : date('d-m-Y') }}">
              </div>
              @error('date')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- type -->
            <div class="form-group row">
              <label for="type" class="col-md-3">Tipe</label>
              <div class="col-md-7">
                <select name="type" id="type" class="form-control">
                  <option value="credit">Kredit</option>
                  <option value="debit">Debit</option>
                </select>
              </div>
              @error('type')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- number -->
            <div class="form-group row">
              <label for="nominal" class="col-md-3">nominal</label>
              <div class="col-md-7">
                <input type="number" class="form-control" name="amount" value=0 autocomplete="off">
              </div>
              @error('amount')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- note -->
            <div class="form-group row">
              <label for="note" class="col-md-3">Keterangan</label>
              <div class="col-md-7">
                <textarea name="note" id="note" cols="30" rows="10" class="form-control"></textarea>
              </div>
              @error('note')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- button subit -->
            <div class="form-group row">
              <div class="col-md-10 text-right">
                <button class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</section>
@endsection

@section('js-library')
<script src="{{ asset('stisla/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection

@section('js-page')
@endsection