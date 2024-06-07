<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bulletin;
use App\Models\Publish;
use Auth;

class BulletinController extends Controller
{

    public function bulletin()
    {
        $role = Auth::user()->role;
        $data['getRecord'] = Bulletin::getRecord($role);
        $data['header_title'] = 'Bulletin Board';
        return view('ManageKAFABulletin.listbulletin', $data);
    }

    public function createbulletin()
    {
        $data['header_title'] = 'Add New Bulletin';
        return view('ManageKAFABulletin.createbulletin', $data);
    }

    public function storebulletin(Request $request)
    {
        $save = new Bulletin;
        $save->bulletinTitle = $request->bulletinTitle;
        $save->publishDate = $request->publishDate;
        $save->bulletinDetails = $request->bulletinDetails;
        $save->createdBy = Auth::user()->id;
        $save->save();

        if (!empty($request->publishTo)) {
            foreach ($request->publishTo as $publishTo) {
                $bulletinDetails = new Publish;
                $bulletinDetails->bulletin_bulletinId = $save->bulletinId;
                $bulletinDetails->publishTo = $publishTo;
                $bulletinDetails->save();
            }
        }
        return redirect('listbulletin')->with('success', "Bulletin successfully created");
    }


    public function editbulletin($bulletinId)
    {
        $data['getRecord'] = Bulletin::getSingle($bulletinId);
        $data['header_title'] = 'Edit Bulletin';
        return view('ManageKAFABulletin.editbulletin', $data);
    }


    public function updatebulletin($bulletinId, Request $request)
    {
        $save = Bulletin::getSingle($bulletinId);
        $save->bulletinTitle = $request->bulletinTitle;
        $save->publishDate = $request->publishDate;
        $save->bulletinDetails = $request->bulletinDetails;
        $save->save();

        Publish::where('bulletin_bulletinId', $bulletinId)->delete();

        if (!empty($request->publishTo)) {
            foreach ($request->publishTo as $publishTo) {
                $bulletinDetails = new Publish;
                $bulletinDetails->bulletin_bulletinId = $save->bulletinId;
                $bulletinDetails->publishTo = $publishTo;
                $bulletinDetails->save();
            }

        }

        return redirect('listbulletin')->with('success', "Bulletin successfully updated");
    }

    public function deletebulletin($bulletinId)
    {
        $save = Bulletin::getSingle($bulletinId);
        $save->delete();

        Publish::DeleteRecord($bulletinId);

        return redirect()->back()->with('success', "Bulletin successfully deleted");
    }

    // View Bulletin Functionality

    public function viewbulletin($bulletinId)
    {
        $data['getRecord'] = Bulletin::getSingle($bulletinId);
        $data['header_title'] = 'View Bulletin';
        return view('ManageKAFABulletin.viewbulletin', $data);
    }

    // Teacher Side Work

    public function mybulletinteacher()
    {
        $data['getRecord'] = Bulletin::getRecordUser(Auth::user()->role);
        $data['header_title'] = 'My Bulletin';
        return view('teacher.teacherbulletin', $data);
    }

    public function mybulletinparent()
    {
        $data['getRecord'] = Bulletin::getRecordUser(Auth::user()->role);
        $data['header_title'] = 'My Bulletin';
        return view('parent.parentbulletin', $data);
    }
}
