<?php

namespace App\Exports;

use App\Models\OnlinePayout;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportRetailerXl implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;

    public function __construct($id)
    {
        $this->data =  $id;
    }


    public function headings(): array
    {
        return ["Retailer's Name", "Transaction ID", "Payment Date ", "Total Amount", "Commision"];
    }

    public function collection()
    {
        $file = OnlinePayout::select('retailer_id', 'payment_date', 'trx_id', 'total_amount', 'commision')->with('retailer')->where('retailer_id', $this->data)->get();
        return $file;
    }

    public function map($file): array
    {
        return [
            $file->retailer->business_name,
            $file->trx_id,
            $file->payment_date,
            $file->total_amount,
            $file->commision,
 
        ];
    }
}
