<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sup extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'unit_code'
    ];
}
