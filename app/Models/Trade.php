<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = ['user_id', 'asset', 'asset_image_url', 'account_type', 'profit', 'sentiment'];

    protected $appends = ['created_at_formatted'];

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d.m.y');
    }
}
