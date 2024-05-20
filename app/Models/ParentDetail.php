<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'parent_ID';
    protected $fillable = [
        'user_ID', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }

    public function studentApplication()
    {
        return $this->hasMany(StudentApplication::class, 'parent_ID', 'parent_ID');
    }
}
