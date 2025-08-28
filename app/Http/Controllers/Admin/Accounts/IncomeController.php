<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $incomes = auth()->user()->incomes;

        $incomes = Income::all();

        return view('admin.accounts.incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = IncomeCategory::all();
        return view('admin.accounts.incomes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|exists:income_categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $user_id = auth()->id();

        Income::create(array_merge($request->all(), ['inserted_by' => $user_id]));

        return redirect()->route('admin.incomes.index')->with('success', 'Income created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $income = Income::findOrFail($id);
        return view('admin.accounts.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $income = Income::findOrFail($id);
        $categories = IncomeCategory::all();
        return view('admin.accounts.incomes.create', compact('categories', 'income'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $income = Income::findOrFail($id);

        $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|exists:income_categories,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $income->update($request->all());

        return redirect()->route('admin.incomes.index')->with('success', 'Income updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
