<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');


Route::get('/blog',function (){
    return view('admin.blog.blog');
});


Route::post('/create-blog-post', 'AdministratorController@createBlog');
Route::post('/update-blog-post', 'AdministratorController@updateBlog');
Route::get('/view-posts', 'AdministratorController@PostBlog');
Route::get('/edit-post/{id}', 'AdministratorController@editPost');
Route::get('/draft-post/{id}', 'AdministratorController@draftPost');
Route::get('/delete-post/{id}', 'AdministratorController@deletePost');



Route::get('/page-control', 'PageController@index');
Route::post('/page-control-about', 'PageController@pageAbout');
Route::get('/page-control-contact/{id}', 'PageController@getContactPage');
Route::post('/page-control-contact', 'PageController@ContactPage');

Route::get('/page-control-team/{id}', 'PageController@getTeamMember');
Route::post('/page-control-team', 'PageController@TeamMember');

Route::get('/ticket-control', 'TicketController@index');
Route::get('/ticket-edit/{id}', 'TicketController@edit');
Route::get('/ticket-delete/{id}', 'TicketController@delete');
Route::post('/ticket-control-responed', 'TicketController@Responsed');


//maintenance 
Route::get('/up', 'AdministratorController@Up');
Route::get('/down', 'AdministratorController@Down');

Route::get('/check', 'AdministratorController@CheckForMaintance');

