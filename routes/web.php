<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArisanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberArisanController;

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

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute login dan logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.submit');

Route::get('/register/choose-role', [AuthController::class, 'showRoleSelection'])->name('register.showRoleSelection');
Route::post('/register/choose-role', [AuthController::class, 'selectRole'])->name('register.selectRole');
Route::get('/register/owner', [AuthController::class, 'registerOwner'])->name('register.owner');
Route::post('/register/owner', [AuthController::class, 'processOwnerRegistration'])->name('register.processOwner');
Route::get('/register/user', [AuthController::class, 'registerUser'])->name('register.user');
Route::post('/register/user', [AuthController::class, 'processUserRegistration'])->name('register.processUser');

Route::post('/check-username-availability', [AuthController::class, 'checkUsernameAvailability'])->name('checkUsernameAvailability');
Route::post('/check-nohp-availability', [AuthController::class, 'checkNoHpAvailability'])->name('checkNoHpAvailability');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::get('/profile/ubah-profile', [ProfileController::class, 'ubahProfile'])->name('ubah-profile')->middleware('auth');
Route::post('/profile/ubah-profile', [ProfileController::class, 'updateProfile'])->name('update-profile')->middleware('auth');
Route::get('/profile/ubah-foto', [ProfileController::class, 'ubahFoto'])->name('ubah-foto')->middleware('auth');
Route::post('/profile/ubah-foto', [ProfileController::class, 'updateFoto'])->name('update-foto')->middleware('auth');
Route::get('/profile/ubah-password', [ProfileController::class, 'ubahPassword'])->name('ubah-password')->middleware('auth');
Route::post('/profile/ubah-password', [ProfileController::class, 'updatePassword'])->name('update-password')->middleware('auth');
// Route::get('/account-setting', [AuthController::class, 'accountSetting'])->name('account-setting')->middleware('auth');
// Route::post('/account-setting', [AuthController::class, 'processAccountSetting'])->name('processAccountSetting');
// Route::get('/change-pict', [AuthController::class, 'changePict'])->name('change-pict')->middleware('auth');
// Route::post('/change-pict', [AuthController::class, 'updatePict'])->name('update-pict')->middleware('auth');
// Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
// Route::post('/change-password', [AuthController::class, 'processChangePassword'])->name('processChangePassword');

// Route admin
Route::group(['middleware' => ['auth', 'user-access:2']], function () {
    Route::put('/activate-account/{id}', [DashboardController::class, 'processActivateAccount'])->name('activate-account')->middleware('auth');
    Route::put('/activate-account-owner/{id}', [DashboardController::class, 'processActivateAccountOwner'])->name('activate-account-owner')->middleware('auth');
    Route::get('/manage-owner', [DashboardController::class, 'manageOwner'])->name('manage-owner');
    Route::get('/add-owner', [DashboardController::class, 'addOwner'])->name('add-owner');
    Route::post('/add-owner', [DashboardController::class, 'processAddOwner'])->name('processAddOwner');
    Route::get('/edit-owner/{id}', [DashboardController::class, 'editOwner'])->name('edit-owner');
    Route::post('/edit-owner/{id}', [DashboardController::class, 'processEditOwner'])->name('processEditOwner');
    Route::delete('/delete-owner/{id}', [DashboardController::class, 'deleteOwner'])->name('delete-owner');
    Route::get('/data-member', [DashboardController::class, 'manageMember'])->name('data-member');
    Route::get('/add-member', [DashboardController::class, 'addMember'])->name('add-member');
    Route::post('/add-member', [DashboardController::class, 'processAddMember'])->name('processAddMember');
    Route::get('/edit-member/{id}', [DashboardController::class, 'editMember'])->name('edit-member');
    Route::post('/edit-member/{id}', [DashboardController::class, 'processEditMember'])->name('processEditMember');
    Route::delete('/delete-member/{id}', [DashboardController::class, 'deleteMember'])->name('delete-member');
    Route::get('/data-arisan', [ArisanController::class, 'index'])->name('data-arisan');
    Route::get('/add-arisan', [ArisanController::class, 'addArisan'])->name('add-arisan');
    Route::post('/add-arisan', [ArisanController::class, 'processAddArisan'])->name('processAddArisan');
    Route::get('/edit-arisan/{id}', [ArisanController::class, 'editArisan'])->name('edit-arisan');
    Route::post('/edit-arisan/{id}', [ArisanController::class, 'processEditArisan'])->name('processEditArisan');
    Route::delete('/delete-arisan/{id}', [ArisanController::class, 'deleteArisan'])->name('delete-arisan');
    Route::get('/data-category', [CategoryController::class, 'index']);
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/process-add-category', [CategoryController::class, 'store'])->name('processAddCategory');
    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
    Route::put('/edit-category/{id}', [CategoryController::class, 'processEditCategory'])->name('processEditCategory');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');
});

// Route owner
Route::group(['middleware' => ['auth', 'user-access:1']], function () {
    Route::get('/manage-arisan', [ArisanController::class, 'manageArisan'])->name('manage-arisan');
    Route::get('/arisan/add', [ArisanController::class, 'addArisanOwner'])->name('add-arisan-owner');
    Route::post('/arisan/add', [ArisanController::class, 'processAddArisanOwner'])->name('processAddArisanOwner');
    Route::get('/edit-arisan/{id}', [ArisanController::class, 'editArisan'])->name('edit-arisan');
    Route::post('/edit-arisan/{id}', [ArisanController::class, 'processEditArisan'])->name('processEditArisan');
    Route::get('/manage-member', [MemberArisanController::class, 'index'])->name('manage-member');
    // Route::get('/member-detail/{id}', [MemberController::class, 'showDetail'])->name('member-detail');
    Route::get('/add-member', [MemberArisanController::class, 'addMember'])->name('add-member');
    Route::get('/verification-account', [AuthController::class, 'verificationAccount'])->name('verification-account');
    Route::post('/verification-account', [AuthController::class, 'processVerificationAccount'])->name('processVerificationAccount');
    Route::get('/arisan/start/{id}', [ArisanController::class, 'startArisan'])->name('start-arisan');
});

//Route User
Route::group(['middleware' => ['auth', 'user-access:0']], function () {
    Route::get('/list-arisan', [ArisanController::class, 'listArisan'])->name('list-arisan');
    Route::get('/verification-account', [AuthController::class, 'verificationAccount'])->name('verification-account');
    Route::post('/verification-account', [AuthController::class, 'processVerificationAccount'])->name('processVerificationAccount');
});

// Rute-rute terkait Arisan
Route::group(['middleware' => ['allowAllUsers']], function () {
    Route::get('/list-arisan/search', [ArisanController::class, 'search'])->name('list-arisan.search');
    Route::get('/data-category', [CategoryController::class, 'search'])->name('search-category');

    Route::post('/arisan/join/{arisan}', [ArisanController::class, 'joinArisan'])->middleware('auth')->name('arisan.join');
});





// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');
