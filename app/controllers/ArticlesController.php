<?php

class ArticlesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::all();
   		return View::make('articles.index')
      	->with('articles', $articles);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('articles.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validate = Validator::make(Input::all(), Article::valid());
		if($validate->fails()) {
		    return Redirect::to('articles/create')
		    ->withErrors($validate)
		    ->withInput();
		} else {
		    $article = new Article;
		    $article->title = Input::get('title');
		    $article->content = Input::get('content');
		    $article->author = Input::get('author');
		    $article->save();
		    Session::flash('notice', 'Success add article');
		    return Redirect::to('articles');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = Article::find($id);
    	return View::make('articles.show')
        ->with('article', $article);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = Article::find($id);
    	return View::make('articles.edit')
      	->with('article', $article);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validate = Validator::make(Input::all(), Article::valid($id));
	    if($validate->fails()) {
	    	return Redirect::to('articles/'.$id.'/edit')
	     	->withErrors($validate)
	     	->withInput();
	    } else {
		    $article = Article::find($id);
		    $article->title = Input::get('title');
		    $article->content = Input::get('content');
		    $article->author = Input::get('author');
		    $article->save();
		    Session::flash('notice', 'Success update article');
		    return Redirect::to('articles');
	    }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = Article::find($id);
	    $article->delete();
	    Session::flash('notice', 'Article success delete');
	    return Redirect::to('articles');
	}

	// -------------- IMPORT ----------------------------
	public function importUserList()
    {
        // Handle the import
        $file = Input::file('file');
        $input = array(
		    'upload' => $file
		);

	    $rules = array(
	        'upload' => 'required'
	    );
	    $validate = Validator::make($input, $rules);
	    if($validate->fails()) {
		   	return Redirect::to('articles/create')
		    ->withErrors($validate)
		    ->withInput();
		} else {
		    $validation = Validator::make($input, $rules);
	    	$mimes = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel','text/plain','text/csv','text/tsv');
			if(in_array($_FILES['file']['type'],$mimes)){
		        $file2 = Input::file('file')->move(storage_path(),$file->getClientOriginalName());
		        $import = Excel::selectSheetsByIndex(0)->load('app/storage/'.$file->getClientOriginalName(), function($reader) {})->get();
		        $reads = $import->toArray();

				$status="berhasil";
				$i=0;
				while ( $i< count($reads) and $status=="berhasil") {
					$read = $reads[$i];
					$input = array(
				        'title' => $read["title"],
				        'content' => $read["content"],
				        'author' => $read["author"]
					);
					$validate = Validator::make($input, Article::valid());
					if ($validate->fails()) {
						$status="gagal";
					} 	
					$i++;
				}
				if ($status=="gagal") {
					Session::flash('notice', 'not success adding article, cek again format');
					return Redirect::to('articles/create');
				} else {
					foreach ($reads as $key => $read) {
					    $article = new Article;
					    $article->title = $read["title"];
					    $article->content = $read["content"];
					    $article->author = $read["author"];
					    $article->save(); 
					}
					Session::flash('notice', 'Success add article');
					return Redirect::to('articles');
				}	
			} else {
			  	Session::flash('notice', 'file must excel file');
				return Redirect::to('articles/create');
			}
        }
    }
    // -------------- export ----------------------------
    public function download()
	{
		
		
		Excel::create('download', function($excel) {
		    $excel->sheet('sheet', function($sheet) {
		    	$sheet->setAutoSize(false);
		    	$sheet->cells('A1:C1', function($cells) {
				    $cells->setFontWeight('bold');
				});
		    	$id=Input::get('id');
		    	$article = Article::find($id);
				$comments = Article::find($id)->comments;
		        $sheet->row(1, array(
				    'title', 'content','author'
				));
				$sheet->row(2, array(
				    $article->title, $article->content,$article->author
				));
				$sheet->row(4, array(
				    'comment: '
				));
				$sheet->cells('A5:B5', function($cells) {
				    $cells->setFontWeight('bold');
				});
				$sheet->row(5, array(
				    'user','content'
				));
				$i=6;
				foreach ($comments as $key => $comment) {
					$sheet->row($i, array(
				    	$comment->user,$comment->content
					));
					$i++;
				}
		    });
		})->export('xls');

		return Redirect::to('articles/index');
	}

}
