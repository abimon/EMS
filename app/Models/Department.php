<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'uni_id',
        'dep_name',
        'faculty',
    ];
    protected $guarded = ['id'];
    public function univ(){
        return $this->belongsTo(University::class, 'uni_id', 'id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'dep_id', 'id');
    }

}
