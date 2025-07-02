<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;


class PaymentsExport implements FromCollection
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Payment::where('IsDeleted', 0);

        if ($this->request->start_date) {
            $query->whereDate('created_at', '>=', $this->request->start_date);
        }

        if ($this->request->end_date) {
            $query->whereDate('created_at', '<=', $this->request->end_date);
        }

        return $query->get();
    }
}
