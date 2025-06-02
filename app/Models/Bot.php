<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    protected $fillable = ['user_id', 'amount', 'duration', 'strategy', 'account_type', 'profit', 'profit_values', 'profit_position', 'asset', 'sentiment', 'status', 'timer_checkpoint', 'start', 'end'];
}
