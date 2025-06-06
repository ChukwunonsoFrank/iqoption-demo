<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['user_id', 'amount', 'payment_method', 'address', 'status'];

    protected $appends = ['updated_at_formatted'];

    public function getUpdatedAtFormattedAttribute()
    {
        return Carbon::parse($this->updated_at)->format('d.m.y');
    }
}
