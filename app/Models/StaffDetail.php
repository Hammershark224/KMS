<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_ID',
        'identity',
        'program'
    ];


    //specifying user table primary key
    protected $primaryKey = "staff_ID";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_ID');
    }
}
