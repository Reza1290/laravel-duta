<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends PermissionedController
{
    protected string $resourceName = 'purchasing';
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('user')->latest()->paginate(10);
        return view('purchase_orders.index', compact('purchaseOrders'));
    }


    public function create()
    {
        return view('purchase_orders.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:255|unique:purchase_orders,order_number',
            'supplier_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,approved,received,cancelled',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        PurchaseOrder::create($data);

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order berhasil dibuat.');
    }


    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.show', compact('purchaseOrder'));
    }


    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('purchase_orders.edit', compact('purchaseOrder'));
    }


    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $request->validate([
            'order_number' => 'required|string|max:255|unique:purchase_orders,order_number,' . $purchaseOrder->id,
            'supplier_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,approved,received,cancelled',
            'notes' => 'nullable|string',
        ]);

        $purchaseOrder->update($request->all());

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order berhasil diperbarui.');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        return redirect()->route('purchase-orders.index')
            ->with('success', 'Purchase Order berhasil dihapus.');
    }
}
