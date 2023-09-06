<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlHomeSection extends BaseController
{
    public function viewHomeSection()
    {
        return view("admin/HomeSection");
    }
    public function viewHomeSectionEdit() {
        return view("admin/HomeSectionEdit");
    }
    public function editHomeSection() {
        return "editing HomeSection...";
    }
}
