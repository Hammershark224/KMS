<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $primaryKey = 'result_id';

    protected $fillable = [
        'student_id', 
        'stu_ic',
        'exam_center_id',
        'year',
        'grade_solat',
        'grade_pchi',
        'grade_quran',
        'grade_jawi',
        'grade_sirah',
        'grade_syariah',
        'grade_adab',
        'grade_lughah',
    ];

    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class, 'student_ID', 'student_id');
    }

    public function examCenter()
    {
        return $this->belongsTo(ResultReference::class, 'exam_center_id');
    }
}
