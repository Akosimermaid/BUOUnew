<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $fillable = [
        /**
         * Below are the Column names of the table research
         */
        'id',
        'Date',
        'Title',
        'Research_Name',
        'Partner_Agency',
        'Designation',
        'Start_Date',
        'Target_Date',
        'CREC',
        'URECOM',
        'Fund',
        'Budget',
        'Remarks',
        'updated_at',
        'created_at',
    ];
     public function posts(){

        return $this->hasMany(Post::class);
     }
}
