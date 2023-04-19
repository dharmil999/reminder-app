<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Reminder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function scheduledAt(): Attribute
    {        
        return Attribute::make(
            get: fn ($value) => Carbon::createFromTimestamp($value,session('timezone'))->toDateTimeString() ,
        );
    }
}
