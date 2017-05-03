<?php


Route::get('comments', 'CommentController@getComments')->name('commentList');
Route::post('comments', 'CommentController@postComment')->name('createComment');
