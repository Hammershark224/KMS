<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bulletin;
use App\Models\publish;
use Auth;

class BulletinController extends Controller
{
  // Display the bulletin for the user based on their role
  public function bulletin()
  {
        $role = Auth::user()->role;
        $data['getRecord'] = bulletin::getRecord($role);
        $data['header_title'] = 'Bulletin Board';
        return view('ManageKAFABulletin.listbulletin', $data);
  }

  // Show the form to create a new bulletin
    public function createbulletin()
    {
        $data['header_title'] = 'Add New Bulletin';
        return view('ManageKAFABulletin.createbulletin', $data);
    }

    // Store a new bulletin in the database
    public function storebulletin(Request $request)
    {
        $save = new bulletin;
        $save->bulletinTitle = $request->bulletinTitle;
        $save->publishDate = $request->publishDate;
        $save->bulletinDetails = $request->bulletinDetails;
        $save->createdBy = Auth::user()->user_ID;
        $save->save();

    // Save publication details if any
        if(!empty($request->publishTo))
        {
            foreach ($request->publishTo as $publishTo)
            {
                $bulletinDetails = new publish;
                $bulletinDetails->bulletinId = $save->bulletinId;
                $bulletinDetails->publishTo = $publishTo;
                $bulletinDetails->save();
            }
        }
        return redirect('listbulletin')->with('success', "Bulletin successfully created");
    }

    // display form to edit an existing bulletin
    public function editbulletin($bulletinId)
    {
        $data['getRecord'] = bulletin::getSingle($bulletinId);
        $data['header_title'] = 'Edit Bulletin';
        return view('ManageKAFABulletin.editbulletin', $data);
    }

   // Update an existing bulletin in the database
    public function  updatebulletin($bulletinId, Request $request)
    {
        $save = bulletin::getSingle($bulletinId);
        $save->bulletinTitle =$request->bulletinTitle;
        $save->publishDate = $request->publishDate;
        $save->bulletinDetails = $request->bulletinDetails;     
        $save->save();

        // Delete existing publication details
        publish::where('bulletinId',$bulletinId)->delete();
        
         // Save updated publication details if any
        if(!empty($request->publishTo))
        {
            foreach ($request-> publishTo as $publishTo)
            {
                $bulletinDetails = new publish;
                $bulletinDetails->bulletinId = $save->bulletinId;
                $bulletinDetails->publishTo = $publishTo;
                $bulletinDetails->save();
            }

        }
 
        return redirect('listbulletin')->with('success', "Bulletin successfully updated");
    }

    // Delete a bulletin from the database
    public function deletebulletin($bulletinId)
    {
        // Delete the bulletin
        $save = bulletin::getSingle($bulletinId);
        $save->delete();

        // Delete associated publication details
        publish::DeleteRecord($bulletinId);

        return redirect()->back()->with('success', "Bulletin successfully deleted");
    }
   
    // View details of a specific bulletin
    public function viewbulletin($bulletinId)
    {
        $data['getRecord'] = bulletin::getSingle($bulletinId);
        $data['header_title'] = 'View Bulletin';
        return view('ManageKAFABulletin.viewbulletin', $data);
    }

    // Display bulletins for teachers
    public function mybulletinteacher()
    {
    $teacherRole = 4; 
    $data['getRecord'] = bulletin::getRecordUser($teacherRole);
    $data['header_title'] = 'My Bulletin';
    return view('ManageKAFABulletin.teacherbulletin', $data);
    }

    // Display bulletins for parents
    public function mybulletinparent()
    {
    $parentRole = 2; 
    $data['getRecord'] = bulletin::getRecordUser($parentRole);
    $data['header_title'] = 'My Bulletin';
    return view('ManageKAFABulletin.parentbulletin', $data);
    }
        

}