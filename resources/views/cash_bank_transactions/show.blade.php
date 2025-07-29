@extends('layouts.app')
@section('content')
<div class="bg-white shadow-md rounded-lg p-8">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi</h1>
            <p class="text-gray-600">#{{ $cashBankTransaction->transaction_code }}</p>
        </div>
        <a href="{{ route('cash-bank-transactions.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Kembali ke Daftar</a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div><strong class="text-gray-600">Tanggal Transaksi:</strong>
            <p class="text-gray-800">{{ \Carbon\Carbon::parse($cashBankTransaction->transaction_date)->format('d F Y') }}</p>
        </div>
        <div><strong class="text-gray-600">Tipe:</strong>
            <p class="font-semibold {{ $cashBankTransaction->type == 'in' ? 'text-green-600' : 'text-red-600' }}">{{ $cashBankTransaction->type == 'in' ? 'Uang Masuk' : 'Uang Keluar' }}</p>
        </div>
        <div class="md:col-span-2"><strong class="text-gray-600">Deskripsi:</strong>
            <p class="text-gray-800">{{ $cashBankTransaction->description }}</p>
        </div>
        <div><strong class="text-gray-600">Jumlah:</strong>
            <p class="text-gray-800">Rp {{ number_format($cashBankTransaction->amount, 2, ',', '.') }}</p>
        </div>
        <div><strong class="text-gray-600">Akun Terkait:</strong>
            <p class="text-gray-800">{{ $cashBankTransaction->related_account ?? '-' }}</p>
        </div>
        <div><strong class="text-gray-600">Dicatat Oleh:</strong>
            <p class="text-gray-800">{{ $cashBankTransaction->user->cName ?? 'N/A' }}</p>
        </div>
        <div><strong class="text-gray-600">Dicatat Pada:</strong>
            <p class="text-gray-800">{{ $cashBankTransaction->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
</div>
@endsection