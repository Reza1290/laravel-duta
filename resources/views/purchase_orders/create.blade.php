@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Buat Purchase Order Baru</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('purchase-orders.store') }}" method="POST">
        @csrf
        @include('purchase_orders._form')
    </form>
</div>
@endsection