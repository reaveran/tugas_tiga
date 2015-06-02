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
  
  public static function valid2($id='') {
      Validator::extend('xlsx', function($field,$value,$parameters){
        $allowed = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel','text/plain','text/csv','text/tsv');
        
        return in_array($value, $allowed);
      });
      return array(
        'mimeType' => 'xlsx'
      );
  }
}