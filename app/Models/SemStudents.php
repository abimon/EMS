<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemStudents extends Model
{
    use HasFactory;
    protected $fillable = [
        'sem_id',
        'student_id',
        'year'
    ];
    public function sem(){
        return $this->belongsTo(Sem::class, 'id', 'sem_id');
    }
    public function student(){
        return $this->belongsTo(Student::class,  'student_id','id');
    }
    public function exams(){
        return $this->hasMany(Exam::class, 'student_id','id');
    }
    public function sups(){
        return $this->hasMany(Sup::class, 'student_id','id');
    }
    public function passes(){
        return $this->hasMany(Pass::class, 'student_id','id');
    }
    public function specials(){
        return $this->hasMany(Special::class, 'student_id','id');
    }
}
