<?php

namespace App\Controllers\Registrar;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageStudent extends BaseController
{
    public function index()
    {
        return view('registrar/registrar-student/registrar-student');
    }
}
