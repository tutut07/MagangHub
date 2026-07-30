<?php

namespace App\Exports;

use App\Models\Todo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TodoExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Todo::query();

        // filter judul
        if ($this->request->filled('title')) {
            $query->where('title', 'like', '%' . $this->request->title . '%');
        }

        // Filter asign
        if ($this->request->filled('assignee')) {
            $assignees = explode(',', $this->request->assignee);
            $query->whereIn('assignee', $assignees);
        }

        // Filter trakhir
        if ($this->request->filled('start') && $this->request->filled('end')) {
            $query->whereBetween('due_date', [
                $this->request->start,
                $this->request->end
            ]);
        }

        // Filter waktu
        if ($this->request->filled('min') && $this->request->filled('max')) {
            $query->whereBetween('time_tracked', [
                $this->request->min,
                $this->request->max
            ]);
        }

        // Filter buat status
        if ($this->request->filled('status')) {
            $status = explode(',', $this->request->status);
            $query->whereIn('status', $status);
        }

        // Filter prioritas
        if ($this->request->filled('priority')) {
            $priority = explode(',', $this->request->priority);
            $query->whereIn('priority', $priority);
        }

        $todos = $query->get([
            'title',
            'assignee',
            'due_date',
            'time_tracked',
            'status',
            'priority'
        ]);

        // buat summary
        $todos->push([
            'title' => '',
            'assignee' => '',
            'due_date' => '',
            'time_tracked' => '',
            'status' => '',
            'priority' => '',
        ]);

        $todos->push([
            'title' => 'Total Todos',
            'assignee' => $todos->count() - 1,
            'due_date' => '',
            'time_tracked' => '',
            'status' => '',
            'priority' => '',
        ]);

        $todos->push([
            'title' => 'Total Time Tracked',
            'assignee' => '',
            'due_date' => '',
            'time_tracked' => $query->sum('time_tracked'),
            'status' => '',
            'priority' => '',
        ]);

        return $todos;
    }

    public function headings(): array
    {
        return [
            'Title',
            'Assignee',
            'Due Date',
            'Time Tracked',
            'Status',
            'Priority'
        ];
    }
}