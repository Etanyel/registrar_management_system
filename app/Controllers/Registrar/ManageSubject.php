<?php

namespace App\Controllers\Registrar;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageSubject extends BaseController
{
    public function index()
    {
        return view('registrar/registrar-subject/registrar-subject');
    }
}
