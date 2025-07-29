@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Catat Transaksi Baru</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('cash-bank-transactions.store') }}" method="POST">
        @csrf
        @include('cash_bank_transactions._form')
    </form>
</div>
@endsection