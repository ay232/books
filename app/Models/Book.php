<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'published_at'=>'date:Y-m-d',
    ];
//    protected $with = ['authors'];

    public function getPublishedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class,Author_Book::class);
    }
}
