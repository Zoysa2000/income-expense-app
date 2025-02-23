<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'income'; // Ensure this matches your database table name

    // Allow mass assignment for these fields
    protected $fillable = [
        'amount',
        'income-category',  // Ensure this matches your database column name
    ];
}
