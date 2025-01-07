<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MembersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TermsConditionController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Frontend\FrontendHome;
use App\Http\Controllers\Admin\ChangePasswordController;

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

Route::get('/login', function () {
    return view('auth/login');
});

Route::prefix('admin')->name('admin.')->middleware(['auth:web'])->group(function () {

    Route::get('/change-password', [ChangePasswordController::class, 'changePassword'])->name('changePassword');
    Route::post('/update-password', [ChangePasswordController::class, 'updatePassword'])->name('updatePassword');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/members', [MembersController::class, 'index'])->name('member.index');

    // This is For Admin Deshbord
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
        Route::get('/view/{id}', [CustomerController::class, 'view'])->name('view');
        Route::post('/update', [CustomerController::class, 'update'])->name('update');
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('edit');
        Route::post('/update', [ServiceController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ServiceController::class, 'delete'])->name('delete');
    });

    Route::prefix('agent')->name('agent.')->group(function () {
        Route::get('/', [AgentController::class, 'index'])->name('index');
        Route::get('/create', [AgentController::class, 'create'])->name('create');
        Route::post('/store', [AgentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AgentController::class, 'edit'])->name('edit');
        Route::post('/update', [AgentController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AgentController::class, 'delete'])->name('delete');
    });

    Route::prefix('review')->name('review.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/create', [ReviewController::class, 'create'])->name('create');
        Route::post('/store', [ReviewController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name('edit');
        Route::post('/update', [ReviewController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ReviewController::class, 'delete'])->name('delete');
    });

    Route::prefix('city')->name('city.')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::get('/create', [CityController::class, 'create'])->name('create');
        Route::post('/store', [CityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CityController::class, 'edit'])->name('edit');
        Route::post('/update', [CityController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CityController::class, 'delete'])->name('delete');
    });

    Route::prefix('state')->name('state.')->group(function () {
        Route::get('/', [StateController::class, 'index'])->name('index');
        Route::get('/create', [StateController::class, 'create'])->name('create');
        Route::post('/store', [StateController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StateController::class, 'edit'])->name('edit');
        Route::post('/update', [StateController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [StateController::class, 'delete'])->name('delete');
    });

    Route::prefix('privacypolicy')->name('privacypolicy.')->group(function () {
        Route::get('/', [PrivacyPolicyController::class, 'index'])->name('index');
        Route::get('/create', [PrivacyPolicyController::class, 'create'])->name('create');
        Route::post('/store', [PrivacyPolicyController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PrivacyPolicyController::class, 'edit'])->name('edit');
        Route::post('/update', [PrivacyPolicyController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [PrivacyPolicyController::class, 'delete'])->name('delete');
    });

    Route::prefix('termscondition')->name('termscondition.')->group(function () {
        Route::get('/', [TermsConditionController::class, 'index'])->name('index');
        Route::get('/create', [TermsConditionController::class, 'create'])->name('create');
        Route::post('/store', [TermsConditionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TermsConditionController::class, 'edit'])->name('edit');
        Route::post('/update', [TermsConditionController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [TermsConditionController::class, 'delete'])->name('delete');
    });

    Route::prefix('contactus')->name('contactus.')->group(function () {
        Route::get('/', [ContactUsController::class, 'index'])->name('index');
        Route::get('/create', [ContactUsController::class, 'create'])->name('create');
        Route::post('/store', [ContactUsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ContactUsController::class, 'edit'])->name('edit');
        Route::post('/update', [ContactUsController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ContactUsController::class, 'delete'])->name('delete');
    });
});



// ==========================================   Frontend Routes   =================================================

// this route for home 
Route::get('/', [FrontendHome::class, 'view'])->name('home');

// this Route For About
Route::view('about', 'frontend.about')->name('about');

// This Route for Show Contact Us
Route::view('contact', 'frontend.contact')->name('contact');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact.store');

// This Route For  How To Work
Route::view('work', 'frontend.work')->name('work');

// This Route For Inquery
Route::post('/submit-inquiry', [CustomerController::class, 'store'])->name('submit.inquiry');

// This Route For Tearms & Condtion and Privacy Policy Show in Frontend
Route::get('/terms-condition', [TermsConditionController::class, 'showFrontend'])->name('termsconditions.frontend');
Route::get('/pivacy-policy', [PrivacyPolicyController::class, 'showFrontend'])->name('pivacypolicy.frontend');

// This Route Show All Service In Frontend
Route::view('services', 'frontend.services')->name('services');
Route::view('personal-loan', 'frontend.personal-loan')->name('personal-loan');
Route::view('home-improvement-loan', 'frontend.home-improvement-loan')->name('home-improvement-loan');
Route::view('education-loan', 'frontend.education-loan')->name('education-loan');
Route::view('mobile-loan', 'frontend.mobile-loan')->name('mobile-loan');
Route::view('new-car-loan', 'frontend.new-car-loan')->name('new-car-loan');
Route::view('business-loan', 'frontend.business-loan')->name('business-loan');
Route::view('laptop-loan', 'frontend.laptop-loan')->name('laptop-loan');
Route::view('two-wheeler-loan', 'frontend.two-wheeler-loan')->name('two-wheeler-loan');

require __DIR__.'/auth.php';