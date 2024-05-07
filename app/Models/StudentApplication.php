<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    use HasFactory;

    public function parentDetail()
    {
        return $this->belongsTo(ParentDetail::class, 'parent_ID');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'student_id');
    }
}
