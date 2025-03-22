<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['tracking_number', 'order_id', 'status'];

    // Relasi ke TrackingHistory (jika ada riwayat status)
    public function history()
    {
        return $this->hasMany(TrackingHistory::class);
    }

    // Relasi ke User (jika tracking terkait dengan user tertentu)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
