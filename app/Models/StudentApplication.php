<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_ID';
    public function parentDetail()
    {
        return $this->belongsTo(ParentDetail::class, 'parent_ID');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'student_id', 'student_ID');
    }
    public function participations()
    {
        return $this->hasMany(Participation::class, 'student_id', 'student_ID');
    }
    public function participants()
    {
    return $this->hasMany(Participation::class, 'activityID', 'activityID');
    }
}