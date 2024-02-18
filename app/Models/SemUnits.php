<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemUnits extends Model
{
    use HasFactory;
    protected $fillable = [
        'sem_id',
        'unit_id',
        'year'
    ];
    public function sem(){
        return $this->belongsTo(Sem::class, 'id', 'sem_id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class, 'id', 'unit_id');
    }
}
