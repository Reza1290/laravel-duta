@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Purchase Order</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('purchase-orders.update', $purchaseOrder->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('purchase_orders._form', ['purchaseOrder' => $purchaseOrder])
    </form>
</div>
@endsection