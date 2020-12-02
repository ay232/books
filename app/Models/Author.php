<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'birth_date'=>'date:d-m-Y',
        'death_date'=>'date:d-m-Y',
        'created_at'=>'datetime:d-m-Y',
        'updated_at'=>'datetime:d-m-Y',
    ];
    //protected $fillable=[];

    /**
     * @param $value
     * @return string
     */
    public function getBirthDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * @param $value
     * @return string
     */
    public function getDeathDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * @param $value
     */
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date']=Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * @param $value
     */
    public function setDeathDateAttribute($value)
    {
        $this->attributes['death_date']=Carbon::parse($value)->format('Y-m-d');
    }



    public function books()
    {
        return $this->belongsToMany(Book::class,Author_Book::class);
    }
}
