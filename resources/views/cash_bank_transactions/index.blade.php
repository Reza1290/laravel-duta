@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Daftar Transaksi Kas & Bank</h1>
    <a href="{{ route('cash-bank-transactions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        Catat Transaksi Baru
    </a>
</div>
@include('partials.alerts')
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Kode</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Deskripsi</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Tipe</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Jumlah</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $transaction->transaction_code }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $transaction->description }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($transaction->type == 'in') bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                        {{ $transaction->type == 'in' ? 'Uang Masuk' : 'Uang Keluar' }}
                    </span>
                </td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm font-semibold {{ $transaction->type == 'in' ? 'text-green-600' : 'text-red-600' }}">
                    Rp {{ number_format($transaction->amount, 2, ',', '.') }}
                </td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('cash-bank-transactions.show', $transaction->id) }}" class="text-gray-600 hover:text-gray-900">Lihat</a>
                        <a href="{{ route('cash-bank-transactions.edit', $transaction->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('cash-bank-transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-10 text-gray-500">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-5 bg-white border-t">
        {{ $transactions->links() }}
    </div>
</div>
@endsection