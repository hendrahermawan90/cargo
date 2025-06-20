<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    protected $fillable = [
        'shipment_id',
        'payment_method',
        'amount',
        'status',
        'paid_at',          // tambah paid_at di sini
        'CompanyCode',
        'IsDeleted',
        'CreatedBy',
        'CreatedDate',
        'LastUpdatedBy',
        'LastUpdatedDate',
    ];

    public $timestamps = false; // karena menggunakan field CreatedDate custom

    protected $dates = [
        'paid_at',
        'CreatedDate',
        'LastUpdatedDate',
    ];

    protected static function booted()
    {
        static::addGlobalScope('not_deleted', function (Builder $builder) {
            $builder->where('IsDeleted', 0);
        });
    }

    // Override delete untuk soft delete dengan kolom IsDeleted
    public function delete()
    {
        $this->IsDeleted = 1;
        return $this->save();
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
