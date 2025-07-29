@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label for="order_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Order:</label>
        <input type="text" name="order_number" id="order_number" value="{{ old('order_number', $purchaseOrder->order_number ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div>
        <label for="supplier_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Supplier:</label>
        <input type="text" name="supplier_name" id="supplier_name" value="{{ old('supplier_name', $purchaseOrder->supplier_name ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div>
        <label for="order_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Order:</label>
        <input type="date" name="order_date" id="order_date" value="{{ old('order_date', isset($purchaseOrder) ? \Carbon\Carbon::parse($purchaseOrder->order_date)->format('Y-m-d') : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div>
        <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Total (Rp):</label>
        <input type="number" name="total_amount" id="total_amount" step="0.01" value="{{ old('total_amount', $purchaseOrder->total_amount ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="md:col-span-2">
        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
        <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            <option value="pending" {{ (old('status', $purchaseOrder->status ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ (old('status', $purchaseOrder->status ?? '') == 'approved') ? 'selected' : '' }}>Approved</option>
            <option value="received" {{ (old('status', $purchaseOrder->status ?? '') == 'received') ? 'selected' : '' }}>Received</option>
            <option value="cancelled" {{ (old('status', $purchaseOrder->status ?? '') == 'cancelled') ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
    <div class="md:col-span-2">
        <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Catatan:</label>
        <textarea name="notes" id="notes" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">{{ old('notes', $purchaseOrder->notes ?? '') }}</textarea>
    </div>
</div>
<div class="flex items-center justify-end mt-6">
    <a href="{{ route('purchase-orders.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        {{ isset($purchaseOrder) ? 'Perbarui' : 'Simpan' }}
    </button>
</div>
