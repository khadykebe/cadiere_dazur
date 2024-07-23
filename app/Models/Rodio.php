<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rodio extends Model
{
    use HasFactory;
    protected $fillable = ['jour','heure'];
}
