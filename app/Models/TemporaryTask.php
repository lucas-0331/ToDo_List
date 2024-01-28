<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

//    public function setDateAttribute($value)
//    {
//        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
//    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setImageAttribute($value)
    {
        return $value ?? asset('storage/img/no_image.png');
    }


    public function getDateAttribute()
    {
        return date('d/m/Y');
    }
}
