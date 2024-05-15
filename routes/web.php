<?php

use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\StaffDetailController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ActivityController;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::view('/dashboard', 'ManageUser.dashboard')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	//Manage Student Registration
	Route::get('/student-list', [StudentApplicationController::class, 'indexAdmin'])->name('student.manage');
	Route::get('/children-list', [StudentApplicationController::class, 'index'])->name('children.manage');
	Route::get('/add-child', [StudentApplicationController::class, 'create'])->name('children.add');
	Route::post('/store-child', [StudentApplicationController::class, 'store'])->name('children.store');
	Route::get('/show-student/{id}', [StudentApplicationController::class, 'show'])->name('student.show');
	Route::get('/edit-student/{id}', [StudentApplicationController::class, 'edit'])->name('student.edit');
	Route::get('/update-student/{id}', [StudentApplicationController::class, 'update'])->name('student.update');
	Route::get('/delete-student/{id}', [StudentApplicationController::class, 'destroy'])->name('student.delete');

	//Activity Management
	Route::get('/KAFAActivities', [ActivityController::class, 'index'])->name('Activities');
	Route::get('/CreateActivity', [ActivityController::class, 'create'])->name('create-activity');
	Route::post('/CreateActivity', [ActivityController::class, 'store'])->name('create-activity.perform');
	Route::get('/ViewActivity/{id}', [ActivityController::class, 'show'])->name('view-activity');
	Route::get('/EditActivity/{id}', [ActivityController::class, 'edit'])->name('edit-activity');
	Route::post('/EditActivity/{id}', [ActivityController::class, 'update'])->name('update-activity');
	Route::get('/activities/{id}', [ActivityController::class, 'destroy'])->name('delete-activity');
	Route::get('/AddParticipants/{id}', [ActivityController::class, 'join'])->name('join-activity');
	Route::post('/AddParticipants/{id}', [ActivityController::class, 'addParticipants'])->name('add-participants');
	Route::get('/JoinedActivities', [ActivityController::class, 'JoinedActivities'])->name('joined-activities');
	Route::get('/JoinedActivity/{id}', [ActivityController::class, 'viewJoinedActivity'])->name('joined-activity');
	Route::get('/DeleteParticipants/{id}', [ActivityController::class, 'unjoin'])->name('unjoin-activity');
	Route::get('/ListOfParticipants/{id}', [ActivityController::class, 'participantsList'])->name('participants-list');
	Route::post('/DeleteParticipants/{id}', [ActivityController::class, 'DeleteParticipants'])->name('delete-participants');
	//Result Management
	Route::get('/results-list', [ResultController::class, 'index'])->name('results-list');
	Route::get('/view-result', [ResultController::class, 'show'])->name('view-result');
	Route::get('/view-result-slip', [ResultController::class, 'slip'])->name('view-result-slip');
	Route::get('/add-result', [ResultController::class, 'create'])->name('add-result');
	Route::post('/add-result', [ResultController::class, 'store'])->name('add-result.perform');
	Route::get('/edit-result/{result_id}', [ResultController::class, 'edit'])->name('edit-result');
	Route::post('/edit-result', [ResultController::class, 'update'])->name('edit-result.perform');
	Route::get('/delete-result', [ResultController::class, 'destroy'])->name('delete-result');
});
