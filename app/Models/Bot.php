<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bot extends Model
{
    protected $fillable = ['user_id', 'amount', 'duration', 'strategy', 'account_type', 'profit', 'profit_values', 'profit_position', 'asset', 'asset_class', 'asset_ticker', 'asset_image_url', 'sentiment', 'status', 'timer_checkpoint', 'start', 'end'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
