<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'weight', 'finish', 'discount', 'tax', 'total', 'payment_status', 'working_status', 'customer_id', 'packet_id'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function packet()
    {
    	return $this->belongsTo(Packet::class);
    }

    public function getPaymentStatusBadgeAttribute(): String
    {
    	$status = $this->payment_status ? ['primary', 'Sudah Bayar'] : ['danger', 'Belum Bayar'];

    	return badge($status);
    }

    public function getWorkingStatusBadgeAttribute(): String
    {
    	$status = $this->working_status ? ['primary', 'Sudah Selesai'] : ['danger', 'Belum Selesai'];

    	return badge($status);
    }

    public function getPaymentStatusTextAttribute(): String
    {
        return $this->payment_status ? 'Sudah Bayar' : 'Belum Bayar';
    }

    public function getWorkingStatusTextAttribute(): String
    {
        return $this->working_status ? 'Sudah Selesai' : 'Belum Selesai';
    }

    public function getDateAttribute(): String
    {
    	return localDate($this->created_at);
    }

    public function getFinishDateAttribute(): String
    {
        return localDate($this->finish);
    }

    public function getTotalFormattedAttribute(): String
    {
    	return number_format($this->total);
    }

}
