@extends('layouts.app')
@section('content')
<div class="bg-white shadow-md rounded-lg p-8">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Purchase Order</h1>
            <p class="text-gray-600">#{{ $purchaseOrder->order_number }}</p>
        </div>
        <a href="{{ route('purchase-orders.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Kembali ke Daftar</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div><strong class="text-gray-600">Supplier:</strong>
            <p class="text-gray-800">{{ $purchaseOrder->supplier_name }}</p>
        </div>
        <div><strong class="text-gray-600">Tanggal Order:</strong>
            <p class="text-gray-800">{{ \Carbon\Carbon::parse($purchaseOrder->order_date)->format('d F Y') }}</p>
        </div>
        <div><strong class="text-gray-600">Total:</strong>
            <p class="text-gray-800">Rp {{ number_format($purchaseOrder->total_amount, 2, ',', '.') }}</p>
        </div>
        <div><strong class="text-gray-600">Status:</strong>
            <p class="text-gray-800">{{ ucfirst($purchaseOrder->status) }}</p>
        </div>
        <div><strong class="text-gray-600">Dibuat Oleh:</strong>
            <p class="text-gray-800">{{ $purchaseOrder->user->cName ?? 'N/A' }}</p>
        </div>
        <div><strong class="text-gray-600">Dibuat Pada:</strong>
            <p class="text-gray-800">{{ $purchaseOrder->created_at->format('d M Y, H:i') }}</p>
        </div>
        <div class="md:col-span-2"><strong class="text-gray-600">Catatan:</strong>
            <p class="text-gray-800 mt-1">{{ $purchaseOrder->notes ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection