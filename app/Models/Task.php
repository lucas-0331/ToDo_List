<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'date',
        'image',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }

    public function getDateAttribute()
    {
        return date('d/m/Y');
    }

    public function getImageAttribute($value)
    {
        return $value ?? asset('storage/img/no_image.png');
    }
}
