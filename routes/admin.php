<?php



Route::get('/home', 'AdministratorController@dashboard');
Route::post('/add-new-Administrator', 'AdministratorController@AddNewAdministrator');
Route::get('/blog',function (){
    return view('admin.blog.blog');
});


Route::get('/get-investor/{id}', 'AdministratorController@getByIdInvestor');
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


Route::get('/view-property', 'PropertyController@index');
Route::get('/add-property', 'PropertyController@create');
Route::post('/add-property', 'PropertyController@store');
Route::get('/edit-property/{id}', 'PropertyController@show');
Route::post('/edit-property', 'PropertyController@update');
Route::get('/delete-property/{id}', 'PropertyController@destroy');
Route::get('/act-property/{id}', 'PropertyController@Toggle');
Route::get('/property-investment/{id}', 'PropertyController@showInvest');
Route::post('/activate-property', 'PropertyController@Activate');
Route::post('/edit-investment', 'PropertyController@edit');

Route::get('/get-investment/{id}', 'PropertyController@getInvestmentById');
Route::post('/activate-property', 'PropertyController@Activate');


// report routes

Route::get('/users-report', 'ReportController@users');
Route::post('/users-report-edit', 'ReportController@usersUpdate');
Route::get('/users-report-deactive/{id}', 'ReportController@usersDeactive');

Route::get('/transactions-report', 'ReportController@transactions');
Route::get('/properties-report', 'ReportController@properties');
// Route::post('/users-report-edit', 'ReportController@usersUpdate');
// Route::post('/users-report-deactive/{id}', 'ReportController@usersDeactive');




//maintenance 
Route::get('/up', 'AdministratorController@Up');
Route::get('/down', 'AdministratorController@Down');

Route::get('/check', 'AdministratorController@CheckForMaintance');

//settings

Route::get('/settings', 'AdministratorController@Settings');
Route::post('/settings-updatePassword', 'AdministratorController@SettingsUpdatePassword');

Route::get('/markAll', 'AdminNotificationController@markAsRead');






//Payment 

Route::get('/get-payments','PaymentController@getDuePayments');