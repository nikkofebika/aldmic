<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Item;
use App\Models\SavedSearch;

class DashboardController extends Controller {
	public function index(){
		$admins = DB::table('users')->where('is_admin', 1)->count();
		$users = DB::table('users')->where('is_admin', 0)->count();
		$articles = DB::table('articles')->count();
		$facilities = DB::table('facilities')->count();
		$rooms = DB::table('rooms')->count();
		return view('console.dashboard.index', ['page_title' => 'Bulletin', 'active_menu' => 'dashboard', 'admins' => $admins, 'users' => $users, 'articles' => $articles, 'facilities' => $facilities, 'rooms' => $rooms]);
	}
}
