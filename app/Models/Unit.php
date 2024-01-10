<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'unit_title',
        'unit_code',
        'sem',
        'yearG'
    ];
    public function quiz(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
