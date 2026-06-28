<?php

namespace App\Exports;

use App\Models\BillCollection;
use App\Models\Payment;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBillCollection implements \Maatwebsite\Excel\Concerns\FromQuery, \Maatwebsite\Excel\Concerns\WithHeadings
{
    protected $employeeId;
    protected $month;
    protected $year;

    public function __construct($employeeId = null, $month = null, $year = null)
    {
        $this->employeeId = $employeeId;
        $this->month = $month;
        $this->year = $year;
    }

    public function query()
    {
        $query = BillCollection::query();

        if ($this->employeeId) {
            $query->where('employee_id', $this->employeeId);
        }

        if ($this->month) {
            $query->whereMonth('created_at', $this->month);
        }

        if ($this->year) {
            $query->whereYear('created_at', $this->year);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Employee ID',
            'Customer ID',
            'Order ID',
            'Amount',
            'Payment Type',
            'Status',
            'Collection Date',
            'Disburse Date',
            'Narration',
            'Transaction ID',
            'Receipt File',
            'Updated By',
            'Reference Name',
            'Created At',
            'Updated At',
        ];
    }
}

