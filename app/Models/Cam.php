<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cam extends Model
{
    protected $table = 'cam';
    protected $fillable = ['slot', 'status'];
}
