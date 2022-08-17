<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agency extends Model
{
    use HasFactory;
    protected $fillable = [
        /**
         * Below are the Column names of the table research
         */
        'id',
        'Name',
        'Address',
        'updated_at',
        'created_at',
    ];
}
