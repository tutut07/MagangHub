<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TodoExport;
class TodoController extends Controller
{
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required|string',
            'assignee' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
            'time_tracked' => 'nullable|numeric',
            'status' => 'nullable|in:pending,open,in_progress,completed',
            'priority' => 'required|in:low,medium,high',
        ]);

        // Simpan ke database
        $todo = Todo::create([
            'title' => $request->title,
            'assignee' => $request->assignee,
            'due_date' => $request->due_date,
            'time_tracked' => $request->time_tracked ?? 0,
            'status' => $request->status ?? 'pending',
            'priority' => $request->priority,
        ]);

        return response()->json([
            'message' => 'Todo berhasil dibuat',
            'data' => $todo
        ], 201);
    }
    public function export(Request $request)
{
    return Excel::download(
        new TodoExport($request),
        'todo.xlsx'
    );
}

}