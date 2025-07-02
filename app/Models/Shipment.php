<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'customer_id',
        'sender_name',
        'sender_address',
        'receiver_name',
        'receiver_address',
        'receiver_phone', // ini
        'weight',
        'distance_km',
        'price',
        'status',
        'CompanyCode',
        'IsDeleted',
        'CreatedBy',
        'CreatedDate',
        'LastUpdatedBy',
        'LastUpdatedDate',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('not_deleted', function (Builder $builder) {
            $builder->where('IsDeleted', 0);
        });
    }

    // Override delete untuk soft delete custom dengan kolom IsDeleted
    public function delete()
    {
        $this->IsDeleted = 1;
        return $this->save();
    }

    // Relasi payments
    public function payments()
    {
        // Mengambil hanya pembayaran yang tidak dihapus (IsDeleted = 0)
        return $this->hasMany(Payment::class, 'shipment_id', 'id')->where('IsDeleted', 0);
    }
}
