<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'address',
        'CompanyCode', 
        'Status', 
        'IsDeleted', 
        'CreatedBy', 
        'CreatedDate', 
        'LastUpdatedBy', 
        'LastUpdatedDate'
    ];

     // Menggunakan properti timestamps jika kamu ingin menggunakan created_at dan updated_at
     public $timestamps = false; // Menggunakan Custom DateTime Fields
}
