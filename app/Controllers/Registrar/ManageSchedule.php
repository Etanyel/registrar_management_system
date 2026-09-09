<?php

namespace App\Controllers\Registrar;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageSchedule extends BaseController
{
    public function index()
    {
        return view('registrar/registrar-schedule/registrar-schedule');
    }
}
