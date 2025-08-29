<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:income')->only(['index',]);
        $this->middleware('can:income_create')->only(['create', 'store']);
        $this->middleware('can:income_edit')->only(['edit', 'update']);
        $this->middleware('can:income_delete')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomeCategories = IncomeCategory::active()->get();
        return view('admin.accounts.incomes.categories.index', compact('incomeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accounts.incomes.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:income_categories,name',
        ]);

        IncomeCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.income-categories.index')->with('success', 'Income category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incomeCategory = IncomeCategory::findOrFail($id);
        return view('admin.accounts.incomes.categories.show', compact('incomeCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = IncomeCategory::findOrFail($id);
        return view('admin.accounts.incomes.categories.create', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incomeCategory = IncomeCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:income_categories,name,' . $incomeCategory->id,
        ]);

        $incomeCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.income-categories.index')->with('success', 'Income category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $incomeCategory = IncomeCategory::findOrFail($id);
        $incomeCategory->delete();

        return redirect()->route('admin.income-categories.index')->with('success', 'Income category deleted successfully.');
    }
}
