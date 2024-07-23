<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rv extends Model
{
    protected $fillable = ['motif','medecin','NomPatient','jour','heure'];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
