<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publish extends Model
{
    use HasFactory;

    protected $table = 'publish';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt'; 

    public function bulletin()
    {
        return $this->belongsTo(bulletin::class, 'bulletin_bulletinId', 'bulletinId');
    }
    
    static public function DeleteRecord($bulletinId)
    {
        publish::where('bulletin_bulletinId','=',$bulletinId)->delete();
    }
} 