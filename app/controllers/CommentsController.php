<?php

class CommentsController extends \BaseController {

	protected $layout = 'layouts.application';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validate = Validator::make(Input::all(), Comment::valid());
      	if($validate->fails()) {
	        return Redirect::to('articles/'.Input::get('article_id'))
	          ->withErrors($validate)
	          ->withInput();
      	} else {
	        $comment = new Comment;
	        $comment->content = Input::get('content');
	        $comment->article_id = Input::get('article_id');
	        $comment->user = Input::get('user');
	        $comment->save();
	        Session::flash('notice', 'Success add comment');
	        return Redirect::to('articles/'.Input::get('article_id'));
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
	    $comments = Article::find($id)->comments->sortBy('Comment.created_at');
	    return View::make('articles.show')
	      ->with('article', $article)
	      ->with('comments', $comments);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
