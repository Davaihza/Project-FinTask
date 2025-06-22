<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\FinancialRecord;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search.index', [
                'tasks' => collect(),
                'financialRecords' => collect(),
                'user' => User::first() ?: User::create([
                    'name' => 'Demo User',
                    'email' => 'demo@example.com',
                    'password' => bcrypt('password'),
                ])
            ]);
        }

        // Search in tasks
        $tasks = Task::where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->get();

        // Search in financial records
        $financialRecords = FinancialRecord::where('description', 'like', "%{$query}%")
                                          ->get();

        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        return view('search.index', compact('tasks', 'financialRecords', 'user', 'query'));
    }
}
