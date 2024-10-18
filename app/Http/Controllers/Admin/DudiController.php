<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
    public function dudi()
    {
       $dudis = dudi::all();
       return view('admin.dudi', compact('dudis'));
    }

}
