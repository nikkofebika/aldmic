<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller {
	public function index(){
		$categories = ArticleCategory::all();
		return view('console.article_categories.index', ['page_title' => 'Article Category', 'active_menu' => 'article_category', 'categories' => $categories]);
	}

	public function show($id) {
		$category = DB::table('article_categories')->select('name')->where('id', $id)->first();
		if (!$category) {
			return ['success'=>false];
		}
		return ['success'=>true,'category'=>$category];
	}

	public function ajax_cek_category() {
		$category = DB::table('article_categories')->where('title', trim($_POST['title']));
		if (isset($_POST['id']) && $_POST['id'] != '') {
			$category->where('id', '!=', $_POST['id']);
		}
		$category = $category->first();
		if ($category) {
			return ['success'=>false];
		}
		return ['success'=>true];
	}

	public function store(Request $request) {
		$arrValidator = [];
		if ($request->has('id')) {
			$ac = ArticleCategory::findOrFail($request->id);
			$arrValidator = ['title' => 'required|unique:article_categories,title,'.$request->id];
			$msg = 'Kategori berhasil diupdate';
		} else {
			$ac = new ArticleCategory;
			$arrValidator = ['title' => 'required|unique:article_categories,title'];
			$msg = 'Kategori berhasil ditambahkan';
		}

		$validator = Validator::make($request->all(), $arrValidator);

		if ($validator->fails()) {
			return redirect('console/article-categories')->with('notification', $this->flash_data('error', 'Gagal', 'Permintaan gagal. Mohon coba kembali.'));
			return response()->json(["success" => false]);
		}
		
		$ac->title = trim($request->title);
		$ac->seo_title = Str::slug($ac->title, '-');
		$ac->save();
		return redirect('console/article-categories')->with('notification', $this->flash_data('success', 'Berhasil', $msg));
		// return response()->json(["success" => true]);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'title' => 'required|unique:article_categories,title'.$id,
		]);

		$ac = ArticleCategory::findOrFail($id);
		$ac->title = $request->title;
		$ac->seo_title = Str::slug($ac->title, '-');
		$ac->save();
		return redirect('console/article-categories')->with('notification', $this->flash_data('success', 'Berhasil', 'Kategori berhasil diupdate'));
	}

	public function destroy($id){
		$c = ArticleCategory::findOrFail($id)->delete();
		return redirect('console/article-categories')->with('notification', $this->flash_data('success', 'Berhasil', 'Kategori berhasil dihapus'));
	}

	public function ajax_active_category(Request $request) {
		if ($request->ajax()) {
			if ($_POST['val'] == 1) {
				DB::table('article_categories')->where('id', $_POST['category_id'])->update(["approved_by" => auth()->guard('admin')->user()->id]);
				return ['success'=>true, 'message'=> 'Kategori Aktif'];
			} else {
				DB::table('article_categories')->where('id', $_POST['category_id'])->update(["approved_by" => null]);
				return ['success'=>false, 'message'=> 'Kategori Nonaktif'];
			}
		}
	}
}
