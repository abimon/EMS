<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_id',
        'sem_id',
        'student_id',
        'attempt',
        'CAT',
        'Exam'
    ];
    // protected $guarded = ['id'];
    public function course(){
        return $this->belongsTo(Course::class, 'dep_id', 'id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function sem(){
        return $this->belongsTo(Sem::class, 'sem_id', 'id');
    }
    public function sups(){
        return $this->hasMany(Sup::class, 'exam_id','id');
    }
    public function specials(){
        return $this->hasMany(Special::class, 'exam_id','id');
    }
    public function pass(){
        return $this->hasMany(Pass::class, 'exam_id','id');
    }
}
