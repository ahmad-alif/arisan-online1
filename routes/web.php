<?php

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArisanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\MemberArisanController;
use App\Http\Controllers\WinnerArisanController;
use App\Models\Setoran;

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
Route::post('/check-email-availability', [AuthController::class, 'checkEmailAvailability'])->name('checkEmailAvailability');
Route::post('/check-nohp-availability', [AuthController::class, 'checkNoHpAvailability'])->name('checkNoHpAvailability');

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
// Route::get('/profile/ubah-profile', [ProfileController::class, 'ubahProfile'])->name('ubah-profile')->middleware('auth');
// Route::post('/profile/ubah-profile', [ProfileController::class, 'updateProfile'])->name('update-profile')->middleware('auth');
// Route::get('/profile/ubah-foto', [ProfileController::class, 'ubahFoto'])->name('ubah-foto')->middleware('auth');
// Route::post('/profile/ubah-foto', [ProfileController::class, 'updateFoto'])->name('update-foto')->middleware('auth');
// Route::get('/profile/ubah-password', [ProfileController::class, 'ubahPassword'])->name('ubah-password')->middleware('auth');
// Route::post('/profile/ubah-password', [ProfileController::class, 'updatePassword'])->name('update-password')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);

        Route::get('/pengaturan-akun', [ProfileController::class, 'ubahProfile'])->name('ubah-profile');
        Route::post('/ubah-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');

        // Route::get('/ubah-foto', [ProfileController::class, 'ubahFoto'])->name('ubah-foto');
        Route::post('/ubah-foto', [ProfileController::class, 'updateFoto'])->name('update-foto');

        // Route::get('/ubah-password', [ProfileController::class, 'ubahPassword'])->name('ubah-password');
        // Route::post('/ubah-password', [ProfileController::class, 'updatePassword'])->name('update-password');
        // Route::post('/ubah-password', [ProfileController::class, 'checkOldPassword'])->name('check-old-password');
        Route::post('/ubah-password', [ProfileController::class, 'updatePassword'])->name('update-password');
        Route::post('/ubah-password-check', [ProfileController::class, 'checkOldPassword'])->name('check-old-password');
    });
});


// Route admin
Route::group(['middleware' => ['auth', 'user-access:2']], function () {
    Route::put('/activate-arisan/{uuid}', [DashboardController::class, 'processActivateArisan'])->name('activate-arisan');
    Route::put('/deactivate-arisan/{uuid}', [DashboardController::class, 'processDeactivateArisan'])->name('deactivate-arisan');
    Route::put('/activate-account/{id}', [DashboardController::class, 'processActivateAccount'])->name('activate-account');
    Route::put('/activate-account-owner/{id}', [DashboardController::class, 'processActivateAccountOwner'])->name('activate-account-owner');
    Route::get('/manage-owner', [DashboardController::class, 'manageOwner'])->name('manage-owner');
    Route::get('/manage-owner', [DashboardController::class, 'searchManageOwner'])->name('manage-owner.search');
    Route::get('/add-owner', [DashboardController::class, 'addOwner'])->name('add-owner');
    Route::post('/add-owner', [DashboardController::class, 'processAddOwner'])->name('processAddOwner');
    Route::get('/edit-owner/{id}', [DashboardController::class, 'editOwner'])->name('edit-owner');
    Route::post('/edit-owner/{id}', [DashboardController::class, 'processEditOwner'])->name('processEditOwner');
    Route::delete('/delete-owner/{id}', [DashboardController::class, 'deleteOwner'])->name('delete-owner');
    Route::get('/export-owners-excel', [DashboardController::class, 'exportOwnersExcel'])->name('export-owners-excel');
    Route::get('/data-member', [DashboardController::class, 'manageMember'])->name('data-member');
    Route::get('/data-member', [DashboardController::class, 'searchManageMember'])->name('data-member.search');
    Route::get('/add-member', [DashboardController::class, 'addMember'])->name('add-member');
    Route::post('/add-member', [DashboardController::class, 'processAddMember'])->name('processAddMember');
    Route::get('/edit-member/{id}', [DashboardController::class, 'editMember'])->name('edit-member');
    Route::post('/edit-member/{id}', [DashboardController::class, 'processEditMember'])->name('processEditMember');
    Route::delete('/delete-member/{id}', [DashboardController::class, 'deleteMember'])->name('delete-member');
    Route::get('/export-members-excel', [DashboardController::class, 'exportMembersExcel'])->name('export-members-excel');
    Route::get('/data-arisan', [ArisanController::class, 'index'])->name('data-arisan');
    Route::get('/add-arisan', [ArisanController::class, 'addArisan'])->name('add-arisan');
    Route::post('/add-arisan', [ArisanController::class, 'processAddArisan'])->name('processAddArisan');
    Route::get('/edit-arisan/{uuid}', [ArisanController::class, 'editArisan'])->name('edit-arisan');
    Route::post('/edit-arisan/{uuid}', [ArisanController::class, 'processEditArisan'])->name('processEditArisan');
    Route::delete('/delete-arisan/{uuid}', [ArisanController::class, 'deleteArisan'])->name('delete-arisan');
    Route::get('/export-arisans-excel', [ArisanController::class, 'exportArisansExcel'])->name('export-arisans-excel');
    Route::get('/data-category', [CategoryController::class, 'index']);
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/process-add-category', [CategoryController::class, 'store'])->name('processAddCategory');
    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
    Route::put('/edit-category/{id}', [CategoryController::class, 'processEditCategory'])->name('processEditCategory');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');
    Route::get('/page-arisan/{uuid}', [ArisanController::class, 'pageArisan'])->name('page-arisan');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/add-notifikasi', [NotifikasiController::class, 'addNotifikasi'])->name('add-notifikasi');
    Route::post('/add-notifikasi', [NotifikasiController::class, 'sendNotifikasi'])->name('processNotifikasi');
    Route::get('/edit-notifikasi/{slug}', [NotifikasiController::class, 'editNotifikasi'])->name('edit-notifikasi');
    Route::post('/edit-notifikasi/{slug}', [NotifikasiController::class, 'processEditNotifikasi'])->name('processEditNotifikasi');
    Route::delete('/delete-notifikasi/{slug}', [NotifikasiController::class, 'deleteNotifikasi'])->name('delete-notifikasi');
    Route::get('/data-setoran', [SetoranController::class, 'dataSetoran'])->name('data-setoran');
});

// Route owner
Route::group(['middleware' => ['auth', 'user-access:1']], function () {
    Route::get('/manage-arisan', [ArisanController::class, 'manageArisan'])->name('manage-arisan');
    Route::get('/manage-arisan', [ArisanController::class, 'searchManageArisan'])->name('manage-arisan.search');
    Route::get('/export-pdf-manage-arisan', [ArisanController::class, 'exportPDFmanageArisan'])->name('export-pdf-manage-arisan');
    Route::get('/export-excel-manage-arisan', [ArisanController::class, 'exportExcelmanageArisan'])->name('export-excel-manage-arisan');
    Route::get('/arisan/add', [ArisanController::class, 'addArisanOwner'])->name('add-arisan-owner');
    Route::post('/arisan/add', [ArisanController::class, 'processAddArisanOwner'])->name('processAddArisanOwner');
    Route::get('/arisan/edit/{uuid}', [ArisanController::class, 'editArisanOwner'])->name('edit-arisan-owner');
    Route::post('/arisan/edit/{uuid}', [ArisanController::class, 'processEditArisanOwner'])->name('processUbahArisanOwner');
    Route::delete('/arisan/delete/{uuid}', [ArisanController::class, 'deleteArisanOwner'])->name('hapus-arisan-owner');
    Route::get('/arisan/{uuid}', [ArisanController::class, 'detailArisan'])->name('detail-arisan');
    Route::get('/manage-member', [MemberArisanController::class, 'index'])->name('manage-member');
    // Route::get('/member-detail/{id}', [MemberController::class, 'showDetail'])->name('member-detail');
    Route::get('/add-member-arisan', [MemberArisanController::class, 'addMember'])->name('add-member-arisan');
    Route::get('/verification-account', [AuthController::class, 'verificationAccount'])->name('verification-account');
    Route::post('/verification-account', [AuthController::class, 'processVerificationAccount'])->name('processVerificationAccount');
    Route::get('/arisan/start/{uuid}', [ArisanController::class, 'startArisan'])->name('start-arisan-owner');
    Route::get('/manage-setoran', [SetoranController::class, 'manageSetoran'])->name('manage-setoran');
    Route::patch('/update-setoran-status/{setoran}', [SetoranController::class, 'updateSetoranStatus'])->name('update-setoran-status');
    Route::get('/export-setoran', [SetoranController::class, 'exportSetoran'])->name('export-setoran');

    Route::get('/winner/show/{uuid}', [WinnerArisanController::class, 'showWinner'])->name('show-winner');
    Route::post('/winner/draw/{uuid}', [WinnerArisanController::class, 'drawWinner'])->name('draw-winner');

    // Route::get('/winner/{id}', [WinnerArisanController::class, 'drawWinner'])->name('winner-arisan');
    // Route::post('/winner/{id}', [WinnerArisanController::class, 'selectWinner'])->name('select-winner');
});

//Route User
Route::group(['middleware' => ['auth', 'user-access:0']], function () {
    Route::get('/arisanku', [ArisanController::class, 'arisanku'])->name('arisanku');
    Route::get('/list-arisan', [ArisanController::class, 'listArisan'])->name('list-arisan');
    Route::get('/detail-arisan/{uuid}', [ArisanController::class, 'detailArisan'])->name('arisan.detail.member');
    Route::get('/verification-account-member', [AuthController::class, 'verificationAccountMember'])->name('verification-account-member');
    Route::post('/verification-account-member', [AuthController::class, 'processVerificationAccountMember'])->name('processVerificationAccountMember');
    Route::get('/setoran', [SetoranController::class, 'index'])->name('all-setoran');
    Route::get('/setoran/{uuid}', [SetoranController::class, 'setoran'])->name('setoran');
    Route::post('/buat-invoice/{uuid}', [SetoranController::class, 'createInvoice'])->name('buat.invoice');
    Route::get('/cetak-invoice/{uuid}', [SetoranController::class, 'cetakPdfInvoice'])->name('cetak.invoice');
    Route::get('/invoice/{invoice_number}', [SetoranController::class, 'tampilInvoice'])->name('invoice');
    // Route::get('/setoran/upload/{invoice_number}', [SetoranController::class, 'uploadSetoran'])->name('upload-setoran');
    // Route::post('/setoran/upload/{invoice_number}', [SetoranController::class, 'processUploadSetoran'])->name('processSetoran');
    Route::post('/setoran/upload/{invoice_number}/{uuid}', [SetoranController::class, 'uploadSetoran'])->name('upload-setoran');
    // Route::post('/setoran/upload/{invoice_number}/{uuid}', [SetoranController::class, 'processUploadSetoran'])
    // ->name('processSetoran');
    // Route::get('/arisanku', [ArisanController::class, 'arisanku'])->name('arisanku');
});

// Rute-rute terkait Arisan
Route::group(['middleware' => ['allowAllUsers']], function () {
    Route::get('/list-arisan/search', [ArisanController::class, 'search'])->name('list-arisan.search');
    Route::get('/data-setoran', [SetoranController::class, 'search'])->name('setoran.search');
    Route::get('/manage-setoran', [SetoranController::class, 'searchOwner'])->name('setoran.search.owner');
    Route::get('/data-category', [CategoryController::class, 'search'])->name('search-category');
    Route::get('/get-usernames', [NotifikasiController::class, 'getUsernameList']);

    Route::post('/arisan/join/{arisan}', [ArisanController::class, 'joinArisan'])->middleware('auth')->name('arisan.join');
});


Route::get('/reset-password', function () {
    return view('reset-password');
});




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');
