<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'stu_ic',
        'exam_center',
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
}
