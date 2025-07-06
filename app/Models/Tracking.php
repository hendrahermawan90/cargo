<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Tracking extends Model
{
    protected $fillable = [
        'shipment_id',
        'status',
        'location',
        'notes',
        'proof_image',
        'CompanyCode',
        'IsDeleted',
        'CreatedBy',
        'CreatedDate',
        'LastUpdatedBy',
        'LastUpdatedDate',
    ];

    public $timestamps = false;

    protected $dates = ['CreatedDate', 'LastUpdatedDate'];

    protected static function booted()
    {
        static::addGlobalScope('not_deleted', function (Builder $builder) {
            $builder->where('IsDeleted', 0);
        });
    }

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function delete()
    {
        $this->IsDeleted = 1;
        return $this->save();
    }
}
