@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Sales Order</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('sales-orders.update', $salesOrder->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('sales_orders._form', ['salesOrder' => $salesOrder])
    </form>
</div>
@endsection