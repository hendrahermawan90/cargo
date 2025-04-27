<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    // Kolom yang dapat diisi melalui mass-assignment
    protected $fillable = [
        'name',
        'contact',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'email',
        'website',
        'description',
        'status'
    ];

    // Jika tidak ada kolom created_at dan updated_at
    // protected $timestamps = false;

    // Relasi jika vendor memiliki banyak shipment
    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
