<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesOrderController extends PermissionedController
{
    protected string $resourceName = 'sales';

    


    public function index()
    {
        $salesOrders = SalesOrder::with('user')->latest()->paginate(10);
        return view('sales_orders.index', compact('salesOrders'));
    }

    public function create()
    {
        return view('sales_orders.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string|max:255|unique:sales_orders,order_number',
            'customer_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,processed,shipped,cancelled',
            'notes' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        SalesOrder::create($data);

        return redirect()->route('sales-orders.index')
            ->with('success', 'Sales Order berhasil dibuat.');
    }


    public function show(SalesOrder $salesOrder)
    {
        return view('sales_orders.show', compact('salesOrder'));
    }


    public function edit(SalesOrder $salesOrder)
    {
        return view('sales_orders.edit', compact('salesOrder'));
    }


    public function update(Request $request, SalesOrder $salesOrder)
    {
        $request->validate([
            'order_number' => 'required|string|max:255|unique:sales_orders,order_number,' . $salesOrder->id,
            'customer_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,processed,shipped,cancelled',
            'notes' => 'nullable|string',
        ]);

        $salesOrder->update($request->all());

        return redirect()->route('sales-orders.index')
            ->with('success', 'Sales Order berhasil diperbarui.');
    }


    public function destroy(SalesOrder $salesOrder)
    {
        $salesOrder->delete();

        return redirect()->route('sales-orders.index')
            ->with('success', 'Sales Order berhasil dihapus.');
    }
}
