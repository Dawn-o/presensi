<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'user_id',
        'check_in',
        'check_out',
        'status',
        'ip_address'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}