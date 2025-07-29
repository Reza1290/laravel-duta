@if ($errors->any())
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="transaction_code" class="block text-gray-700 text-sm font-bold mb-2">Kode Transaksi:</label>
        <input type="text" name="transaction_code" id="transaction_code" value="{{ old('transaction_code', $transaction->transaction_code ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div>
        <label for="transaction_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transaksi:</label>
        <input type="date" name="transaction_date" id="transaction_date" value="{{ old('transaction_date', isset($transaction) ? \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="md:col-span-2">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
        <textarea name="description" id="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('description', $transaction->description ?? '') }}</textarea>
    </div>
    <div>
        <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Tipe Transaksi:</label>
        <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            <option value="in" {{ (old('type', $transaction->type ?? '') == 'in') ? 'selected' : '' }}>Uang Masuk</option>
            <option value="out" {{ (old('type', $transaction->type ?? '') == 'out') ? 'selected' : '' }}>Uang Keluar</option>
        </select>
    </div>
    <div>
        <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Jumlah (Rp):</label>
        <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount', $transaction->amount ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="md:col-span-2">
        <label for="related_account" class="block text-gray-700 text-sm font-bold mb-2">Akun Terkait (Opsional):</label>
        <input type="text" name="related_account" id="related_account" value="{{ old('related_account', $transaction->related_account ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>
</div>
<div class="flex items-center justify-end mt-6">
    <a href="{{ route('cash-bank-transactions.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        {{ isset($transaction) ? 'Perbarui' : 'Simpan' }}
    </button>
</div>