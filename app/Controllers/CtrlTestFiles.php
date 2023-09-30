<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlTestFiles extends BaseController
{
    public function index()
    {
        return view('admin/test/testFiles');
    }
    public function saveData() {
        return redirect()->back();
    }
}
