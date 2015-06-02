<?php

class Comment extends \Eloquent {
	public function article() {
    	return $this->belongsTo('article', 'article_id');
  	}
  	public static function valid($id='') {
      return array(
        'content' => 'required|min:5'.($id ? ",$id" : ''),
        'user' => 'required'
      );
  }
}