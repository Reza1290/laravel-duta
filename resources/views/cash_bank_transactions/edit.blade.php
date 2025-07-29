@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Transaksi</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('cash-bank-transactions.update', $cashBankTransaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('cash_bank_transactions._form', ['transaction' => $cashBankTransaction])
    </form>
</div>
@endsection