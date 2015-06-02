<?php

class Article extends \Eloquent {
	
	public function comments() {
    	return $this->hasMany('Comment', 'article_id');
  	}
  public static function valid($id='') {
      return array(
        'title' => 'required|min:5|unique:articles,title'.($id ? ",$id" : ''),
        'content' => 'required|min:100|unique:articles,content'.($id ? ",$id" : ''),
        'author' => 'required'
      );
  }
}