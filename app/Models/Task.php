<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $casts = [
        'date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusAttribute($value)
    {
        return (bool) $value;
    }

    public function getDateAttribute($value)
    {
        $carbonDate = is_string($value) ? Carbon::parse($value) : $value;
        return $carbonDate instanceof Carbon ? $carbonDate->format('d/m/Y') : $value;
    }

    public function getImageAttribute($value)
    {
        return $value ?? asset('storage/img/no_image.png');
    }
}
