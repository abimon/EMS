<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_id',
        'reg_no',
        'name',
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
        'marks'
    ];
    protected $guarded = ['id'];
    public function course(){
        return $this->belongsTo(Course::class, 'dep_id', 'id');
    }
}
