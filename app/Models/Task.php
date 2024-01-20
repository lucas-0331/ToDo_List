<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }

    public function getDateAttribute()
    {
        return date('d/m/Y');
    }

    public function getDescriptionAttribute($value)
    {
        return  Str::limit($value, 80);
    }
}
