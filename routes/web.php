<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is all of the frontend routes will be declared
|
*/

// Route::get('/', 'Frontend\PagesController@index')->name('index');

// Auth::routes();
/**
 * Authentication Routes
 */
Route::get('/', 'Frontend\Auth\RegistrationController@showRegistrationForm')->name('user.registration');
Route::post('/registration/submit', 'Frontend\Auth\RegistrationController@registration')->name('user.registration.submit');
Route::get('/login', 'Frontend\Auth\LoginController@showLoginForm')->name('user.login');
Route::post('/login/submit', 'Frontend\Auth\LoginController@login')->name('user.login.submit');
Route::post('/logout/submit', 'Frontend\Auth\LoginController@logout')->name('user.logout');
Route::get('/sync-data', 'Frontend\CronJobController@updateWinner')->name('user.sync.data');

Route::group(['prefix' => 'user'], function () {

    /**
     * Page Routes
     */
    Route::get('/ranking', 'Frontend\PagesController@ranking')->name('user.ranking');
    Route::get('/result/{response_id}', 'Frontend\PagesController@result')->name('user.result');
    Route::post('/history/{user_id}', 'Frontend\PagesController@history')->name('user.history');

    Route::group(['as' => 'user.'], function () {
        Route::resource('quizes', 'Frontend\QuizController');
    });
});



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is all of the api routes will be declared
|
*/
Route::group(['prefix' => 'api/quiz'], function () {

    //QuizApiController
    Route::post('check-answer', 'Api\QuizApiController@checkAnswer')->name('check.answer');
    Route::post('store-response', 'Api\QuizApiController@storeResponse')->name('response.store');
    Route::get('get-options/{id}', 'Api\QuizApiController@getOptions')->name('options.get');
});



/*
|--------------------------------------------------------------------------
| Backend/Admin Panel Routes
|--------------------------------------------------------------------------
|
| Here is all of the backaned/admin panel routes will be declared
|
*/

Route::group(['prefix' => 'admin'], function () {

    // Auth::routes();
    /**
     * Authentication Routes
     */
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout');

    /**
     * Page Routes
     */
    Route::get('/', 'Backend\PagesController@index')->name('admin.index');
    Route::get('/settings', 'Backend\PagesController@settings')->name('admin.pages.settings');
    Route::post('/settings/update/{id}', 'Backend\PagesController@settingsUpdate')->name('admin.pages.settingsUpdate');

    Route::group(['as' => 'admin.'], function () {
        Route::resource('questions', 'Backend\QuestionController');
        Route::post('/questions/delete/{id}', 'Backend\QuestionController@destroy');
        Route::resource('question-set', 'Backend\QuestionSetController');
        Route::resource('blogs', 'Backend\BlogsController');
        Route::resource('users', 'Backend\UserController');
        Route::resource('admins', 'Backend\AdminController');
        Route::resource('roles', 'Backend\RoleController');
        Route::resource('responses', 'Backend\ResponseController');
        Route::resource('daily-winners', 'Backend\DailyWinnerController');
        Route::resource('monthly-winners', 'Backend\MonthlyWinnerController');
    });
});
