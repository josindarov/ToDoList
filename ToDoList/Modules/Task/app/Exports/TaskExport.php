<?php

namespace Modules\Task\app\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Task\app\Models\Task;

class TaskExport implements FromCollection, WithBatchInserts, WithHeadings
{

    public function collection()
    {
        return Task::select(
            'id',
            'user_id',
            'title',
            'description',
            'deadline',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'UserId',
            'Title',
            'Description',
            'Deadline',
            'Status'
        ];
    }

    public function batchSize(): int
    {
        return 5;
    }
}
