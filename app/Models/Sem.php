<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sem extends Model
{
    use HasFactory;
    protected $fillable=[
        'dep_id',
        'timelines',
        'year',
        'sem',
        'status'
    ];
    public function department(){
        return $this->belongsTo(department::class, 'id', 'dep_id');
    }
    public function students(){
        return $this->hasMany(SemStudents::class, 'sem_id','id');
    }
    public function units(){
        return $this->hasMany(SemUnits::class, 'sem_id','id');
    }
    public function results(){
        return $this->hasMany(Exam::class, 'sem_id','id');
    }
}
