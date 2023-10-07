<?php

namespace App\Models;

use CodeIgniter\Model;

class PublicSectionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'home_section';
    protected $primaryKey       = 'homePageId';
    protected $allowedFields    = ["aboutUsText", "aboutUsImageId", "aboutUsVideoId"];
}
