<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','UsersController@index');
Route::get('/singlepost/{id}','UsersController@singlePost');
Route::get('/test_login','UsersController@test_login');
Route::get('/terms','UsersController@terms');
Route::get('/login','UsersController@login');
Route::get('/logout',function(){
	try {
		Auth::logout();
		return Redirect::to('/');
	} catch (Exception $e) {
		return Redirect::to('/');
	}
});

Route::group(array('before' => 'auth.redirect'), function()
{
	Route::get('/home','UsersController@home');
	Route::get('/commonroom','UsersController@common');
	Route::get('/campus','UsersController@campus');
	Route::get('/profile','UsersController@profile');
	Route::get('/profile/{id}','UsersController@getProfile');
	Route::post('/giveanswer','UsersController@give_answer');
	Route::get('/viewnotification/{id}','UsersController@viewNotification');
  	
});
Route::get('/viewmorecomments','AjaxsController@viewMoreComments');//viewmorecomments?post_id=1&off=5
Route::get('/getcomments/{id}','AjaxsController@getComments');
		
Route::group(array('before' => 'auth'), function()
{
//Ajaxs
	Route::post('/createpost','AjaxsController@createPost');
	Route::get('/viewmoreposts','AjaxsController@viewMorePost');//viewmoreposts?off=5

	Route::post('/createcomment/{id}','AjaxsController@createComment');
	Route::get('/getuserldratio/{id}','AjaxsController@getIndividualPersonsPostsLikeDislikeRatio');
	Route::get('/createreport/','AjaxsController@createReport');//createreport?pid=3&rid=2
	Route::get('/follow/','AjaxsController@following');//follow?following_id=2
	Route::get('/unfollow/','AjaxsController@unfollowing');//unfollow?following_id=2
	// Like Dislike Manager
		Route::get('/like/{id}','AjaxsController@like');
		Route::get('/unlike/{id}','AjaxsController@unlike');
		Route::get('/dislike/{id}','AjaxsController@dislike');
		Route::get('/undislike/{id}','AjaxsController@undislike');
	// 
	Route::get('/confession/','AjaxsController@confess');//confession?confess=string
	Route::get('/viewconfession/','AjaxsController@viewConfession');//viewconfession?cid = 12
	
	Route::get('/setpicture/{id}','AjaxsController@setProfilePicture');//setpicture/id
	Route::get('/deletepost/{id}','AjaxsController@deletePost');//deletepost/id
	Route::get('/requesttodelete/{id}','AjaxsController@requestToDelete');//requesttodelete/id
	Route::get('/searchresult/','AjaxsController@getResultByTag');//searchresult?tag=#mask
	Route::get('/searchtag/','AjaxsController@getTagsByTag');//searchtag?tag=mask
	Route::get('/enable/','AjaxsController@enable');
	Route::get('/disable/','AjaxsController@disable');
	Route::get('/notificationclick/','AjaxsController@checkedNotification');
	Route::get('/getnotification/','AjaxsController@getNotification');
	

	Route::get('/setcampus/{id}','AjaxsController@setCampus');//setcampus/id


	Route::post('/setusername/','AjaxsController@setUsername');///setusername/?name=jhjhg
//Ajaxs
});


// New Routes Added 5/31/2015
// Admin Routes

Route::get('/adm','AdminController@index');
Route::post('/adm/l','AdminController@doLogin');
Route::group(array('before' => 'admin'), function()
{
	Route::get('/adm/h','AdminController@home');
	
	Route::post('/adm/makeq','AdminController@makeQuestion');
	
	Route::get('/adm/d/{id}','AdminController@postDelete');
	
	Route::get('/adm/logout',function(){
	try {
		Session::put('login_for_maskcamp', '1');
		return Redirect::to('/adm');
	} catch (Exception $e) {
		return Redirect::to('/');
	}
	});
	
	Route::get('/adm/bu/{id}','AdminController@banUser');
	
	Route::get('/adm/disbu/{id}','AdminController@disbanUser');
	

});
// Admin Routes

Route::get('/test','UsersController@test');