<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller {
    public function index() {
        return view('dashboard.room', ['active_menu'=>'room']);
    }
}
