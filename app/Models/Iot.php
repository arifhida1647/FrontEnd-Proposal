<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iot extends Model
{
    protected $table = 'iot';
    protected $fillable = ['slot', 'status'];
}
