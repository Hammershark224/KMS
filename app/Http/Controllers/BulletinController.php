<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bulletin;
use App\Models\publish;
use Auth;

class BulletinController extends Controller
{

  public function bulletin()
  {
        $role = Auth::user()->role;
        $data['getRecord'] = bulletin::getRecord($role);
        $data['header_title'] = 'Bulletin Board';
        return view('admin.admin.listbulletin', $data);
  }
  
    public function createbulletin()
    {
        $data['header_title'] = 'Add New Bulletin';
        return view('admin.admin.createbulletin', $data);
    }

    public function storebulletin(Request $request)
    {
        $save = new bulletin;
        $save->bulletinTitle = $request->bulletinTitle;
        $save->publishDate = $request->publishDate;
        $save->bulletinDetails = $request->bulletinDetails;
        $save->createdBy = Auth::user()->id;
        $save->save();

        if(!empty($request->publishTo))
        {
            foreach ($request->publishTo as $publishTo)
            {
                $bulletinDetails = new publish;
                $bulletinDetails->bulletin_bulletinId = $save->bulletinId;
                $bulletinDetails->publishTo = $publishTo;
                $bulletinDetails->save();
            }
        }
        return redirect('listbulletin')->with('success', "Bulletin successfully created");
    }


    public function editbulletin($bulletinId)
    {
        $data['getRecord'] = bulletin::getSingle($bulletinId);
        $data['header_title'] = 'Edit Bulletin';
        return view('admin.admin.editbulletin', $data);
    }

   
    public function  updatebulletin($bulletinId, Request $request)
    {
        $save = bulletin::getSingle($bulletinId);
        $save->bulletinTitle =$request->bulletinTitle;
        $save->publishDate = $request->publishDate;
        $save->bulletinDetails = $request->bulletinDetails;     
        $save->save();

        publish::where('bulletin_bulletinId',$bulletinId)->delete();

        if(!empty($request->publishTo))
        {
            foreach ($request-> publishTo as $publishTo)
            {
                $bulletinDetails = new publish;
                $bulletinDetails->bulletin_bulletinId = $save->bulletinId;
                $bulletinDetails->publishTo = $publishTo;
                $bulletinDetails->save();
            }

        }
 
        return redirect('listbulletin')->with('success', "Bulletin successfully updated");
    }

    public function deletebulletin($bulletinId)
    {
        $save = bulletin::getSingle($bulletinId);
        $save->delete();

        publish::DeleteRecord($bulletinId);

        return redirect()->back()->with('success', "Bulletin successfully deleted");
    }

        //teacher side work

        public function mybulletinteacher()
        {
            $data['getRecord'] = bulletin::getRecordUser(Auth::user()->role);
            $data['header_title']='My Bulletin';
            return view('teacher.teacherbulletin', $data);
        }

        public function mybulletinparent()
        {
            $data['getRecord'] = bulletin::getRecordUser(Auth::user()->role);
            $data['header_title']='My Bulletin';
            return view('parent.parentbulletin', $data);
        }
}
