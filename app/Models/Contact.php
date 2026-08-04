<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class)->latest();
    }
}
