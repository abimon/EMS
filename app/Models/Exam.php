<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_id',
        'student_id',
        't_id',
        'attempt',
        'CAT1',
        'CAT2',
        'CAT3',
        'ASN1',
        'ASN2',
        'ASN3',
        'Q1',
        'Q2',
        'Q3',
        'Q4',
        'Q5',
        'marks',
        'CAT_t',
        'ASN_t',
        'Exam_t'
    ];
    protected $guarded = ['id'];
    public function course(){
        return $this->belongsTo(Course::class, 'dep_id', 'id');
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
