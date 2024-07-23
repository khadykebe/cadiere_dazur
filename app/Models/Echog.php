<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Echog extends Model
{
    use HasFactory;
    protected $fillable = ['jour','heure'];
}
