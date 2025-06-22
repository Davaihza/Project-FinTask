<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\FinancialRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get or create demo user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Get task statistics
        $totalTasksCount = Task::count();
        $completedTasksCount = Task::where('is_completed', true)->count();
        $pendingTasksCount = Task::where('is_completed', false)->count();
        $overdueTasksCount = Task::where('is_completed', false)
                                ->where('due_date', '<=', Carbon::today())
                                ->count();

        // Get latest tasks with filter
        $taskStatus = $request->input('task_status');
        $latestTasksQuery = Task::latest()->take(5);

        if ($taskStatus === 'completed') {
            $latestTasksQuery->where('is_completed', true);
        } elseif ($taskStatus === 'pending') {
            $latestTasksQuery->where('is_completed', false);
        }
        $latestTasks = $latestTasksQuery->get();

        // Get tasks for notifications
        $pendingTasksForNotification = Task::where('is_completed', false)->latest()->first();
        $completedTasksForNotification = Task::where('is_completed', true)->latest()->first();
        $overdueTasksForNotification = Task::where('is_completed', false)
                                            ->where('due_date', '<=', Carbon::today())
                                            ->latest()->first();

        // Get financial statistics
        $totalIncome = FinancialRecord::where('type', 'income')->sum('amount');
        $totalExpense = FinancialRecord::where('type', 'expense')->sum('amount');
        $netBalance = $totalIncome - $totalExpense;

        // Get latest financial records with filter
        $recordType = $request->input('record_type');
        $latestFinancialRecordsQuery = FinancialRecord::latest()->take(5);

        if ($recordType === 'income') {
            $latestFinancialRecordsQuery->where('type', 'income');
        } elseif ($recordType === 'expense') {
            $latestFinancialRecordsQuery->where('type', 'expense');
        }
        $latestFinancialRecords = $latestFinancialRecordsQuery->get();

        return view('dashboard', compact(
            'user',
            'totalTasksCount',
            'completedTasksCount',
            'pendingTasksCount',
            'overdueTasksCount',
            'totalIncome',
            'totalExpense',
            'netBalance',
            'latestTasks',
            'latestFinancialRecords',
            'pendingTasksForNotification',
            'completedTasksForNotification',
            'overdueTasksForNotification'
        ));
    }
}
