<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {
    public function index() {
        $articles = DB::table('articles')->select('title','seo_title','image','published_at')->whereNotNull('approved_by')->limit(10)->get();
    	return view('index', ['active_menu' => 'index', 'articles' => $articles]);
    }

    public function company_policy() {
        return view('company_policy', ['active_menu' => 'company_policy']);
    }

    public function forgot_password() {
        return view('forgot_password', ['active_menu' => 'forgot_password']);
    }

    public function facilities() {
        $facilities = DB::table('facilities')->select('name','url','image')->where('is_active', 1)->get();
    	return view('facilities', ['active_menu' => 'facilities', 'facilities' => $facilities]);
    }

    public function calendar() {
        return view('calendar', ['active_menu' => 'calendar']);
    }

    public function kalender() {
        return view('kalender', ['active_menu' => 'kalender']);
    }

    public function bulletin() {
    	$bulletins = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where([['published_at', '<=', NOW()], ['approved', 1]])->paginate(5);
        $recent_bulletins = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where([['published_at', '<=', NOW()], ['approved', 1]])->orderBy('published_at', 'desc')->limit(5)->get();
    	return view('bulletin', ['bulletins' => $bulletins, 'recent_bulletins' => $recent_bulletins, 'active_menu' => 'bulletin']);
    }

    public function detail_bulletin($seo_title) {
    	$bulletin = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where('seo_title', $seo_title)->where([['published_at', '<=', NOW()], ['approved', 1]])->first();
        $recent_bulletins = DB::table('articles')->select('title','seo_title','description','image','published_at','created_by')->where([['published_at', '<=', NOW()], ['approved', 1]])->where('seo_title','!=',$bulletin->seo_title)->orderBy('published_at', 'desc')->limit(5)->get();
    	return view('detail_bulletin', ['bulletin' => $bulletin, 'recent_bulletins' => $recent_bulletins, 'active_menu' => 'bulletin']);
    }
}
