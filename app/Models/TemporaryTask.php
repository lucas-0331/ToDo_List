<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemporaryTask extends Model
{
    use HasFactory;
    protected $table = 'temporary_tasks';

    protected $fillable = [
        'name',
        'description',
        'date',
        'status',
        'image',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

//    protected function date(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
//        );
//    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setImageAttribute($value)
    {
        return $value ?? asset('storage/img/no_image.png');
    }
}
