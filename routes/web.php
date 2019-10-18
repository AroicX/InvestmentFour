<?php

use App\Http\Middleware\twoFa;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    
    Route::get('/', array(
        'as'   => 'home', 
        'uses' => 'HomePagesController@getHome'
    )); //roue to home page

    Route::get('/offers', array(
        'as'   => 'offers',
        'uses' => 'HomePagesController@getOffers'
    )); //rouet to offers page

    Route::get('/about', array(
        'as'   => 'about',
        'uses' => 'HomePagesController@getAbout'
    )); //route to about us page

    Route::get('/contact', array(
        'as'   => 'contact',
        'uses' => 'HomePagesController@getContact'
    )); //route to contact us page

    Route::post('/contact', array(
        'as'   => 'contact',
        'uses' => 'HomePagesController@postContactMessage'
    ));

    Route::get('/blog', array(
        'as' => 'press',
        'uses' => 'HomePagesController@getPress'
    )); //route to blog page

    Route::get('/blog/{token}', array(
        'as'   => 'getpresspost',
        'uses' => 'AppController@getBlogPost'
    ));

    Route::get('/affiliation', array(
        'as' => 'affiliation',
        'uses' => 'HomePagesController@getAffiliation'
    )); //route to affilitation page

    Route::get('/career', array(
        'as' => 'career',
        'uses' => 'HomePagesController@getCareer'
    )); //route to career page

    Route::get('account/login', array(
        'as' => 'login.investors',
        'uses' => 'InvestorController@getLogin'
    )); //route to get login page

    Route::post('account/login', array(
        'as' => 'login',
        'uses' => 'InvestorController@postLogin'
    )); //route to process login credentials

    Route::get('account/register', array(
        'as' => 'register.investors',
        'uses' => 'InvestorController@getRegister'
    )); //route to get register page

    Route::post('account/register', array(
        'as' => 'register',
        'uses' => 'InvestorController@postRegister'
    )); //route to process register credentials

    Route::get('account/register/activate/{token}', [
        'as'   => 'activate-account',
        'uses' => 'InvestorController@getCode'
    ]); //route for activating account after registration

    Route::get('account/register/activate/', [
        'as'   => 'active-account',
        'uses' => 'InvestorController@getActivateAccount'
    ]); //route for activating account after registration

    Route::get('/account/recover-password/',[
        'as'   => 'password-forgot',
        'uses' => 'InvestorController@getRecoverPassword'
    ]);

    Route::post('/account/recover-password', [
        'as'   => 'password-forgot',
        'uses' => 'InvestorController@postRecoverPassword'
    ]);

    Route::get('/account/two-fa/verification', [
        'as'   => 'two-fa',
        'uses' => 'InvestorController@getTwoFAVerification'
    ]);

    Route::post('/account/two-fa/verification', [
        'as'   => 'two-fa',
        'uses' => 'InvestorController@postTwoFAVerification'
    ]);

});

Route::group(['middleware' => ['auth', twoFa::class]], function () 
{

    Route::get('/investor/dashboard/profile/info/', array(
        'as'   => 'info',
        'uses' => 'InvestorProfileController@info'
    ));

    Route::get('/investor/dashboard/profile/add/personal_information/', array(
        'as'  => 'addPersonal',
        'uses' => 'InvestorProfileController@getAddPersonal'
    ));

    Route::post('/investor/dashboard/profile/add/personal_information/', array(
        'as'   => 'addPersonal',
        'uses' => 'InvestorProfileController@postAddPersonal'
    ));

    Route::get('/investor/dashboard/profile/add/bank_information/', array(
        'as'  => 'addBank',
        'uses' => 'InvestorProfileController@getAddBank'
    ));

    Route::post('/investor/dashboard/profile/add/bank_information/', array(
        'as'   => 'addBank',
        'uses' => 'InvestorProfileController@postAddBank'
    ));

    Route::get('/investor/dashboard/profile/add/kin_information/', array(
        'as'  => 'addKin',
        'uses' => 'InvestorProfileController@getAddKin'
    ));

    Route::post('/investor/dashboard/profile/add/kin_information/', array(
        'as'   => 'addKin',
        'uses' => 'InvestorProfileController@postAddKin'
    ));

    Route::get('/investor/dashboard/profile/settings/', array(
        'as'   => 'settings',
        'uses' => 'InvestorProfileController@getSettings'
    ));

    Route::post('/investor/dashboard/profile/settings/', array(
        'as'   => 'settings',
        'uses' => 'InvestorProfileController@postSettings'
    ));

    Route::post('/investor/dashboard/profile/settings/2FA/', [
        'as'   => 'setting-2fa',
        'uses' => 'InvestorProfileController@postSettingsTwoFA'
    ]);

    Route::get('/investor/dashboard/profile/settings/disable-account/', [
        'as'   => 'disable-account',
        'uses' => 'InvestorProfileController@getDisabledAccount'
    ]);

    Route::get('/investor/dashboard/potfolio/all/', array(
        'as'   => 'all',
        'uses' => 'InvestorPotfolioController@getAllInvestment' 
    ));

    Route::get('/investor/dashboard/potfolio/active/', array(
        'as'   => 'active',
        'uses' => 'InvestorPotfolioController@getActiveInvestment'
    ));

    Route::get('/investor/dashboard/potfolio/all/search/', array(
        'as'   => 'investmentsearch',
        'uses' => 'InvestorPotfolioController@getInvestmentSearch'
    ));

    Route::get('/investor/dashboard/transactions/', array(
        'as'   => 'transactions',
        'uses' => 'InvestorTransactionController@getTransactions'
    ));

    Route::get('/investor/dashboard/transaction/{token}', array(
        'as'   => 'transaction',
        'uses' => 'InvestorTransactionController@getTransaction'
    ));

    Route::get('/investor/dashboard/transaction/report/generatepdf/{token}', array(
        'as'   => 'generatepdf',
        'uses' => 'InvestorTransactionController@getPDF'
    ));

    Route::get('/investor/dashboard/transactions/search/', array(
        'as'   => 'transactionsearch',
        'uses' => 'InvestorTransactionController@getTransactionSearch'
    ));

    Route::get('/investor/dashboard/offers/', array(
        'as'   => 'offer',
        'uses' => 'InvestorOfferController@getOffer'
    ));

    Route::match(['get','post'],'/investor/dashboard/offers/search/', [
        'as'   => 'offerSearch',
        'uses' => 'InvestorOfferController@postOfferSearch'
    ]);

    Route::get('/investor/dashboard/offers/invest/{token}', array(
        'as'   => 'offerInvest',
        'uses' => 'InvestorOfferController@getOfferInvest'
    ));

    Route::post('/investor/dashboard/offers/invest/', array(
        'as'   => 'offerInvestpost',
        'uses' => 'InvestorOfferController@postOfferInvest'
    ));

    Route::get('/investor/dashboard/ticket/create/', array(
        'as'   => 'ticket',
        'uses' => 'InvestorTicketController@getCreateTicket'
    ));

    Route::post('/investor/dashboard/ticket/create/', [
        'as'   => 'ticket',
        'uses' => 'InvestorTicketController@postCreateTicket'
    ]);

    Route::get('/investor/dashboard/ticket/responses/', array(
        'as'   => 'ticketResponse',
        'uses' => 'InvestorTicketController@getticketResponse'
    ));

    Route::get('/investor/dashboard/ticket/response/read/{token}', array(
        'as'   => 'readResponse',
        'uses' => 'InvestorTicketController@getreadResponse'
    ));

    Route::post('/investor/dashboard/ticket/response/reply/', array(
        'as'   => 'replyResponse',
        'uses' => 'InvestorTicketController@postReply'
    ));

    Route::get('/investor/dashboard/ticket/response/reload/reply/{token}', array(
        'as'   => 'responseReload',
        'uses' => 'InvestorTicketController@responseReload'
    ));

    Route::get('/investor/dashboard/ticket/delete/{token}', array(
        'as'   => 'deleteTicket',
        'uses' => 'InvestorTicketController@getDeleteTicket'
    ));

    Route::get('/investor/dashboard/ticket/response/satisfied/{token}', array(
        'as'   => 'satisfiedResponse',
        'uses' => 'InvestorTicketController@getSatisfied'
    ));

    Route::get('/investor/dashboard/ticket/response/reload/', array(
        'as'   => 'reload',
        'uses' => 'InvestorTicketController@reloadResponse'
    ));

    Route::get('/investor/dashboard/offers/wishlist/', array(
        'as'   => 'wishlist',
        'uses' => 'InvestorWishlistController@wishList'
    ));

    Route::get('/investtor/dashboard/wishlist/add/{token}', [
        'as'   => 'addWishList',
        'uses' => 'InvestorWishListController@getAddToList'
    ]);

    Route::get('/investtor/dashboard/notification/', array(
        'as'   => 'notifications',
        'uses' => 'NotificationController@index'
    ));

    Route::get('/investor/dashboard/notification/mark/', array(
        'as'   => 'markAsRead',
        'uses' => 'NotificationController@markAsRead'
    ));

});

Route::get('/investor/dashboard/logout', [
    'as'   => 'logout',
    'uses' => 'InvestorProfileController@getLogout'
]);


Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
  Route::post('/login-admin', 'AdminAuth\LoginController@login');
  Route::post('/logout-admin', 'AdminAuth\LoginController@logout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm');
  Route::post('/register-admin', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});
