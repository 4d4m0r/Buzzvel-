<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable = ['title', 'description', 'date', 'location'];
}
