<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use DataTables;

class ArticleController extends Controller {
	public function index() {
		return view('console.articles.index', ['page_title' => 'Bulletin', 'active_menu' => 'articles']);
	}

	public function getArticles(Request $request) {
		if ($request->ajax()) {
			$data = Article::select(['id','title','image','created_by','approved_by','approved','published_at','created_at'])->get();
			return Datatables::of($data)
			->addIndexColumn()
			->editColumn('image', function($data) {return '<a href="'.asset($data->image).'" target="_blank"><img src="'.asset($data->image).'" width="100"/></a>';})
			->editColumn('created_by', function($data) {return $data->user->name;})
			->editColumn('published_at', function($data) {return date('d-m-Y H:i', strtotime($data->published_at));})
			->editColumn('approved', function($data) {
				$checked = $data->approved == 1 ? 'checked' : '';
				return '<input type="checkbox" '.$checked.' class="check_approve" data-article_id="'.$data->id.'" />';
			})
			->addColumn('action', function($data){
				return '<a href="'.url('console/articles/'.$data->id).'" class="btn btn-info btn-xs" title="Detail"><i class="fa fa-eye"></i></a> <a href="'.route('console.articles.edit', $data->id).'" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a> <form method="POST" onsubmit="return confirm(\'Hapus '.$data->title.' ?\')" action="'.route("console.articles.destroy", $data->id).'" class="d-inline"><input type="hidden" name="_token" value="'.csrf_token().'" /><input type="hidden" value="DELETE" name="_method"><button type="submit" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button></form>';
			})
			->escapeColumns([])
			->make(true);
		}
	}

	public function create() {
		return view('console.articles.create', ['page_title' => 'Bulletin - Tambah Data', 'active_menu' => 'articles']);
	}

	public function store(Request $request) {
		$request->validate([
			'title' => 'required|unique:articles',
			'description' => 'required',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
		]);

		if ($request->image->isValid()) {
			$imageName = Str::slug($request->title, '-').'-'.time().'.'.$request->image->extension();
			$dir = '/images/articles/';
			if (!file_exists(public_path($dir))) {
				mkdir(public_path($dir), 0777, true);
				chmod(public_path($dir), 0777);
			}
			$request->image->move(public_path($dir), $imageName);
		}

		$ar = new Article;
		$ar->title = trim($request->title);
		$ar->seo_title = Str::slug($ar->title, '-');
		$ar->description = $request->description;
		$ar->image = $dir.$imageName;
		$ar->created_by = auth()->guard('admin')->user()->id;
		$ar->published_at = date('Y-m-d H:i:s', strtotime($request->published_at));
		$ar->save();
		return redirect('console/articles')->with('notification', $this->flash_data('success', 'Berhasil', 'Buletin Berhasil Ditambahkan'));
	}

	public function show($id) {
		$article = Article::findOrFail($id);
		return view('console.articles.show', ['article'=>$article]);
	}

	public function edit($id) {
		$article = Article::findOrFail($id);
		return view('console.articles.edit',['article' => $article, 'page_title' => 'Bulletin - Edit Data', 'active_menu' => 'articles']);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'title' => 'required|unique:articles,title,'.$id,
			'description' => 'required',
			'approved' => 'required',
			'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
		]);

		$ar = Article::findOrFail($id);
		if ($request->hasFile('image')) {
			if ($request->image->isValid()) {
				$imageName = Str::slug($request->title, '-').'-'.time().'.'.$request->image->extension();
				$dir = '/images/articles/';
				if (!file_exists(public_path($dir))) {
					mkdir(public_path($dir), 0777, true);
					chmod(public_path($dir), 0777);
				}
				unlink(public_path($ar->image));
				$request->image->move(public_path($dir), $imageName);
			}
		}

		$ar->title = trim($request->title);
		$ar->seo_title = Str::slug($ar->title, '-');
		$ar->description = $request->description;
		$ar->approved = $request->approved;
		if ($request->hasFile('image')) {
			$ar->image = $dir.$imageName;
		}
		$ar->published_at = date('Y-m-d H:i:s', strtotime($request->published_at));
		$ar->save();
		return redirect('console/articles')->with('notification', $this->flash_data('success', 'Berhasil', 'Buletin Berhasil Diupdate'));
	}

	public function destroy($id) {
		$article = Article::findOrFail($id);
		if (pathinfo($article->image, PATHINFO_FILENAME) !== 'sample_article') {
			unlink(public_path($article->image));
		}
		$article->delete();
		return redirect('console/articles')->with('notification', $this->flash_data('success', 'Berhasil', 'Buletin Berhasil Dihapus'));
	}

	public function ajax_approve_article(Request $request) {
		if ($request->ajax()) {
			if (DB::table('articles')->where('id', $_POST['article_id'])->update(["approved_by" => auth()->guard('admin')->user()->id, "approved" => $_POST['val']])) {
				if ($_POST['val'] == 1) {
					return ['success'=>true, 'message'=> 'Bulletin Approved'];
				}
				return ['success'=>false, 'message'=> 'Bulletin Unapproved'];
			}
			return ['success'=>false, 'message'=> 'Bulletin Unapproved'];
		}
	}
}
