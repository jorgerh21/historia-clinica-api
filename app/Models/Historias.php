<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Historias extends Model
{
    use HasFactory;
	
	
	public function medico(): belongsTo
    {
        return $this->belongsTo(User::class,'medico_id');
    }
	
	public function paciente(): belongsTo
    {
        return $this->belongsTo(User::class,'paciente_id');
    }
}
