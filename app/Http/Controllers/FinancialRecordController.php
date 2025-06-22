<?php

namespace App\Http\Controllers;

use App\Models\FinancialRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FinancialRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = FinancialRecord::query();

        $recordType = $request->input('record_type');
        if ($recordType === 'income') {
            $query->where('type', 'income');
        } elseif ($recordType === 'expense') {
            $query->where('type', 'expense');
        }

        $financialRecords = $query->get();

        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
            ]);
        }
        return view('financial_records.index', compact('financialRecords', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
            ]);
        }
        return view('financial_records.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('financial_images', 'public');
        }

        FinancialRecord::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
            'date' => $request->date,
            'image' => $imagePath,
        ]);

        return redirect()->route('financial-records.index')->with('success', 'Financial record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialRecord $financialRecord)
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
            ]);
        }
        return view('financial_records.show', compact('financialRecord', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialRecord $financialRecord)
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
            ]);
        }
        return view('financial_records.edit', compact('financialRecord', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialRecord $financialRecord)
    {
        $request->validate([
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
            'date' => $request->date,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($financialRecord->image) {
                Storage::disk('public')->delete($financialRecord->image);
            }
            $data['image'] = $request->file('image')->store('financial_images', 'public');
        }

        $financialRecord->update($data);

        return redirect()->route('financial-records.index')->with('success', 'Financial record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialRecord $financialRecord)
    {
        $financialRecord->delete();

        return redirect()->route('financial-records.index')->with('success', 'Financial record deleted successfully.');
    }
}
