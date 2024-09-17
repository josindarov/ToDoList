<?php

namespace Modules\Task\app\Imports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Task\app\Models\Task;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TasksImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection): void
    {
        $userId = Auth::id();

        foreach ($this->taskGenerator($collection) as $taskData)
        {
            $excelDate = $taskData['deadline'];

            // Check if the value is numeric (Excel serial date)
            if (is_numeric($excelDate))
            {
                $deadline = Date::excelToDateTimeObject($excelDate)
                    ->setTimezone(new \DateTimeZone('UTC'))
                    ->format('Y-m-d H:i:s');
            }
            else
            {
                try
                {
                    $deadline = Carbon::parse($excelDate)
                        ->setTimezone('UTC')
                        ->format('Y-m-d H:i:s');
                }
                catch (\Exception $e)
                {

                    $deadline = null;
                }
            }
            Task::create([
                'user_id' => $userId,
                'title' => $taskData['title'],
                'description' => $taskData['description'],
                'deadline' => $deadline,
                'status' => $taskData['status'],
            ]);
        }
    }


    private function taskGenerator(Collection $rows): \Generator
    {
        foreach ($rows as $row)
        {
            yield [
                'title' => $row['title'],
                'description' => $row['description'],
                'deadline' => $row['deadline'],
                'status' => $row['status']
            ];
        }
    }

}
