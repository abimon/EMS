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
        'Exam',
    ];
    // protected $guarded = ['id'];
    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    public function sem(){
        return $this->belongsTo(Sem::class, 'sem_id', 'id');
    }
    public function semUnit(){
        return $this->belongsTo(SemUnits::class, 'sem_id', 'id');
    }
    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function sups(){
        return $this->hasMany(Sup::class, 'exam_id','id');
    }
    public function specials(){
        return $this->belongsTo(Special::class, 'exam_id','id');
    }
    public function pass(){
        return $this->hasMany(Pass::class, 'exam_id','id');
    }
}
