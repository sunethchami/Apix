<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DummyController extends Controller
{
    public function getData(){
        return ['name' => 'Suneth','sex'=>'dick','fav-subject'=>'fucking'];
    }
}
