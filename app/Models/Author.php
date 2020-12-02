<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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


    /**
     * @return BelongsToMany
     */
    public function books() : BelongsToMany
    {
        return $this->belongsToMany(Book::class,Author_Book::class);
    }
}
