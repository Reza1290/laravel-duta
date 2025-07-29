@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Daftar Purchase Order</h1>
    <a href="{{ route('purchase-orders.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        Buat Purchase Order
    </a>
</div>
@include('partials.alerts')
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">No. Order</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Supplier</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Dibuat Oleh</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($purchaseOrders as $order)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $order->order_number }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $order->supplier_name }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">Rp {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                        @if($order->status == 'approved') bg-blue-100 text-blue-800 @endif
                        @if($order->status == 'received') bg-green-100 text-green-800 @endif
                        @if($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $order->user->cName ?? 'N/A' }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('purchase-orders.show', $order->id) }}" class="text-gray-600 hover:text-gray-900">Lihat</a>
                        <a href="{{ route('purchase-orders.edit', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('purchase-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-10 text-gray-500">Tidak ada data purchase order.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-5 bg-white border-t">
        {{ $purchaseOrders->links() }}
    </div>
</div>
@endsection