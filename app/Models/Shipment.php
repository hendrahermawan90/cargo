<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Shipment extends Model
{
    // === ENUM STATUS PENGIRIMAN ===
    public const STATUS_PENDING = 'pending';
    public const STATUS_DIKEMAS = 'dikemas';
    public const STATUS_DIKIRIM = 'dikirim';
    public const STATUS_IN_TRANSIT = 'in_transit';
    public const STATUS_TIBA_DI_KOTA_TUJUAN = 'tiba_di_kota_tujuan';
    public const STATUS_DIKIRIM_KE_ALAMAT = 'dikirim_ke_alamat';
    public const STATUS_DITERIMA = 'diterima';
    public const STATUS_GAGAL_DIKIRIM = 'gagal_dikirim';
    public const STATUS_DIKEMBALIKAN = 'dikembalikan';

    public static function statusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_DIKEMAS => 'Dikemas',
            self::STATUS_DIKIRIM => 'Dikirim dari Gudang',
            self::STATUS_IN_TRANSIT => 'Dalam Perjalanan (In Transit)',
            self::STATUS_TIBA_DI_KOTA_TUJUAN => 'Tiba di Kota Tujuan',
            self::STATUS_DIKIRIM_KE_ALAMAT => 'Sedang Dikirim ke Alamat Tujuan',
            self::STATUS_DITERIMA => 'Diterima',
            self::STATUS_GAGAL_DIKIRIM => 'Gagal Dikirim',
            self::STATUS_DIKEMBALIKAN => 'Dikembalikan',
        ];
    }

    protected $fillable = [
        'tracking_number',
        'customer_id',
        'sender_name',
        'sender_address',
        'receiver_name',
        'receiver_address',
        'receiver_phone',
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

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'shipment_id', 'id')->where('IsDeleted', 0);
    }


}