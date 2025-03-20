<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tentukan kolom-kolom yang dapat diisi (fillable)
    protected $fillable = [
        'customer_id',
        'tracking_number',
        'origin',
        'destination',
        'weight',
        'price',
        'order_status',
        'CompanyCode',   // Tambahkan CompanyCode
        'Status',         // Tambahkan Status
        'IsDeleted',      // Tambahkan IsDeleted
        'CreatedBy',
        'CreatedDate',
        'LastUpdatedBy',
        'LastUpdatedDate',
    ];

    // Relasi dengan Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Menggunakan properti timestamps jika kamu ingin menggunakan created_at dan updated_at
    public $timestamps = false; // Menggunakan Custom DateTime Fields
}
