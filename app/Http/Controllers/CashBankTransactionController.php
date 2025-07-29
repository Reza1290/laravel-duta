<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CashBankTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashBankTransactionController extends PermissionedController
{
    protected string $resourceName = 'cash/bank';

    public function index()
    {
        $transactions = CashBankTransaction::with('user')->latest()->paginate(15);
        return view('cash_bank_transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('cash_bank_transactions.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|string|max:255|unique:cash_bank_transactions,transaction_code',
            'transaction_date' => 'required|date',
            'type' => 'required|string|in:in,out',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'related_account' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        CashBankTransaction::create($data);

        return redirect()->route('cash-bank-transactions.index')
            ->with('success', 'Transaksi berhasil dicatat.');
    }


    public function show(CashBankTransaction $cashBankTransaction)
    {
        return view('cash_bank_transactions.show', compact('cashBankTransaction'));
    }


    public function edit(CashBankTransaction $cashBankTransaction)
    {
        return view('cash_bank_transactions.edit', compact('cashBankTransaction'));
    }


    public function update(Request $request, CashBankTransaction $cashBankTransaction)
    {
        $request->validate([
            'transaction_code' => 'required|string|max:255|unique:cash_bank_transactions,transaction_code,' . $cashBankTransaction->id,
            'transaction_date' => 'required|date',
            'type' => 'required|string|in:in,out',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'related_account' => 'nullable|string|max:255',
        ]);

        $cashBankTransaction->update($request->all());

        return redirect()->route('cash-bank-transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }


    public function destroy(CashBankTransaction $cashBankTransaction)
    {
        $cashBankTransaction->delete();

        return redirect()->route('cash-bank-transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}
