<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $table = 'participation';

    protected $fillable = [
        'activityID',
        'student_id'
    ];
    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class, 'student_ID', 'student_id');
    }

    public function students()
    {
        return $this->belongsTo(StudentApplication::class, 'student_ID', 'student_id');
    }
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

