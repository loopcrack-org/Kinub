<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CtrlPublicSection extends BaseController
{
    public function viewPublicSection()
    {
        return view("admin/PublicSection");
    }
    public function viewPublicSectionEdit() {
        return view("admin/PublicSectionEdit");
    }
    public function editPublicSection() {
        return "editing Public Section...";
    }
}
