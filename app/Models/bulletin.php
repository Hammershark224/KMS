<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
class bulletin extends Model
{
    use HasFactory;

    protected $table = 'bulletin';
    protected $primaryKey = 'bulletinId'; // Specify the primary key column
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt'; 
    
    static public function getSingle($bulletinId)
    {
        return self::find($bulletinId);
    }

    static public function getRecord($role)
    {
        $return = self::select('bulletin.*','users.full_name as createdBy_full_name')
           ->join('users', 'users.user_ID', '=','bulletin.createdBy');
    
    if ($role == 1) {
        // User is admin, fetch bulletins created by admin
        $return = $return->where('users.role', '=', 1);
    } elseif ($role == 4) {
        // User is muip, fetch bulletins created by muip
        $return = $return->where('users.role', '=', 4);
    }
        
        if(!empty(Request::get('bulletinTitle')))
        {
            $return = $return->where('bulletin.bulletinTitle', 'like', '%'. trim(Request::get('bulletinTitle')).'%');
        }

        if(!empty(Request::get('publishDate_from')))
        {
            $return = $return->where('bulletin.publishDate', '>=', Request::get('publishDate_from'));
        }

        if(!empty(Request::get('publishDate_to')))
        {
            $return = $return->where('bulletin.publishDate', '<=', Request::get('publishDate_to'));
        }

        if(!empty(Request::get('publishTo')))
        {
            $return = $return->join('publish', 'publish.bulletin_bulletinId','=', 'bulletinId');

            $return = $return->where('publish.publishTo', '=', Request::get('publishTo'));
        }


        $return = $return->orderBy('bulletin.bulletinId','desc')
               ->paginate(20);
        return $return;
       
    }

    static public function getRecordUser($publishTo)
    {
        $return = bulletin::select('bulletin.*','users.name as createdBy_name')
               ->join('users', 'users.id', '=','bulletin.createdBy');
        
        $return = $return->join('publish', 'publish.bulletin_bulletinId','=', 'bulletinId');

        if(!empty(Request::get('bulletinTitle')))
        {
            $return = $return->where('bulletin.bulletinTitle', 'like', '%'. trim(Request::get('bulletinTitle')).'%');
        }

        if(!empty(Request::get('publishDate_from')))
        {
            $return = $return->where('bulletin.publishDate', '>=', Request::get('publishDate_from'));
        }

        if(!empty(Request::get('publishDate_to')))
        {
            $return = $return->where('bulletin.publishDate', '<=', Request::get('publishDate_to'));
        }

        $return = $return->where('publish.publishTo', '=',$publishTo);

        $return = $return->where('bulletin.publishDate' , '<=' ,date('Y-m-d'));

        $return = $return->orderBy('bulletin.bulletinId','desc')
               ->paginate(20);
        
        return $return;
    }

    public function getBulletinDetails()
    {
        return $this->hasMany(publish::class,"bulletin_bulletinId");
    }

    public function getBulletinDetailsToSingle($bulletin_bulletinId, $publishTo)
    {
        return publish::where('bulletin_bulletinId', '=', $bulletin_bulletinId)->where('publishTo', '=', $publishTo)->first();
    }
    

}
