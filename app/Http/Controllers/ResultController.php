<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        return view('ManageStudentResult.resultsList');
    }

    public function show()
    {
        return view('ManageStudentResult.viewResult');
    }

    public function create()
    {
        return view('ManageStudentResult.addResult');
    }
}