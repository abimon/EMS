<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTotal extends Model
{
    use HasFactory;
    protected $fillable = [
        'unit_id',
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
        'CAT_total',
        'ASN_total',
        'exam_total'
    ];
}
