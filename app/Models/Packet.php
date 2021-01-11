<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'time', 'detail'];

    public function getPriceTextAttribute(): String
    {
    	return number_format($this->price).'/kilo';
    }

    public function getPriceFormattedAttribute(): String
    {
        return number_format($this->price);
    }

    public function getTimeTextAttribute(): String
    {
    	return $this->time.' hari';
    }
}
