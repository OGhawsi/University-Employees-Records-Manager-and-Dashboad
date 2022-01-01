<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements FromView, WithStyles, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $employee = Employee::query();
        return view('export', [
            'employees' => $employee->with(['degrees', 'employments', 'addresses', 'ranks', 'workingDepartment.faculty'])
                                    ->withFilters($employee)
                                    ->get()
        ]);
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
   
}