<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificateModel extends Model
{
    protected $DBGroup       = 'default';
    protected $table         = 'certificates';
    protected $primaryKey    = 'certificateId';
    protected $allowedFields = ['certificatefileName', 'certificatePreviewId', 'certificatefileId'];
}
