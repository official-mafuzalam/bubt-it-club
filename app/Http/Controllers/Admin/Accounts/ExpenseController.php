<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        return view('admin.accounts.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ExpenseCategory::all();
        return view('admin.accounts.expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $user_id = auth()->id();

        Expense::create(array_merge($request->all(), ['inserted_by' => $user_id]));

        return redirect()->route('admin.expenses.index')->with('success', 'Expense created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = ExpenseCategory::all();
        $expense = Expense::findOrFail($id);
        return view('admin.accounts.expenses.create', compact('categories', 'expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|exists:expense_categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $user_id = auth()->id();

        Expense::where('id', $id)->update(array_merge($validatedData, [
            'inserted_by' => $user_id,
        ]));

        return redirect()->route('admin.expenses.index')->with('success', 'Expense updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
