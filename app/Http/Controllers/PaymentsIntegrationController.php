<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentsIntegrationController extends Controller
{


    public function index()
    {
        return view('admin.connections.index');
    }
}
