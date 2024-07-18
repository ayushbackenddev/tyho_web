<?php

use App\Http\Controllers\AllCoachesController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OnboardingFormController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TherapistSessionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\CouponController;

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

Route::get('/', function () {
	return view('Website/User/Landing_Page/landing_page');
});

Route::group(['middleware' => ['DoctorMiddleware']], function () {

	Route::GET('therapistDashboard', [AllCoachesController::class, 'getTherapistDashboard'])->name('therapistDashboard');
	Route::GET('calender_view', [UserController::class, 'calender'])->name('calender_view');
	Route::GET('myClients', [UserController::class, 'showMyClients'])->name('myClients');
	Route::GET('clientDetail/{id}', [UserController::class, 'showClientDetails'])->name('clientDetail');
	Route::GET('cDetails', [UserController::class, 'clientsDetail'])->name('cDetails');
	Route::GET('editTherapistProfile', [AllCoachesController::class, 'getTherapistEditProfilePage'])->name('editTherapistProfile');
	Route::GET('couponview', [CouponController::class, 'couponView'])->name('couponview');
	Route::GET('paymentNote', [UserController::class, 'showPaymentNotes'])->name('paymentNote');
});

Route::group(['middleware' => ['UserMiddleware']], function () {

	Route::GET('clientDashboard', [UserController::class, 'getClientDashboard'])->name('clientDashboard');
	Route::GET('sessionRecpt', [UserController::class, 'sessionReceipts'])->name('sessionRecpt');
	Route::GET('booking', [UserController::class, 'getConfirmBookingPage'])->name('booking');
	Route::GET('myWallet', [WalletController::class, 'viewWalletPage'])->name('myWallet');
	Route::GET('clientEditProfile', [ClientProfileController::class, 'getClientEditProfileView'])->name('clientEditProfile');
});

//for client
Route::GET('cRegister', [UserController::class, 'ShowReg'])->name('cRegister');
Route::GET('cLogin', [UserController::class, 'ShowLogin'])->name('cLogin');
Route::GET('cReset', [UserController::class, 'ShowReset'])->name('cReset');
Route::GET('landing', [UserController::class, 'getLandingPage'])->name('landing');
Route::GET('intake1/{id}', [UserController::class, 'getIntake1'])->name('intake1');
Route::GET('intake2/{id}', [UserController::class, 'getIntake2'])->name('intake2');
Route::GET('allCoaches', [AllCoachesController::class, 'getAllCoachesPage'])->name('allCoaches');
Route::GET('coache/{id}', [AllCoachesController::class, 'getCoachesPage'])->name('coache');
// Route::GET('booking_2', [UserController::class, 'getConfirmBooking2Page'])->name('booking_2');
Route::GET('email', [UserController::class, 'getEmail'])->name('email');

//for therapist
Route::GET('Dlogin', [UserController::class, 'getDoctorsLogin'])->name('Dlogin');
Route::GET('Dreset', [UserController::class, 'getDoctorsResetPassword'])->name('Dreset');
Route::GET('setPassword/{id}', [UserController::class, 'DoctorSetPassword'])->name('setPassword');
Route::GET('expression', [UserController::class, 'getExpression'])->name('expression');
Route::GET('application/{id}', [ApplicationController::class, 'getApplicationForm'])->name('application');
Route::GET('boarding/{id}', [OnboardingFormController::class, 'getOnboarding'])->name('boarding');
Route::GET('onboardingRestrict', [OnboardingFormController::class, 'getOnboarding'])->name('onboardingRestrict');
Route::GET('boardingSuccess', [OnboardingFormController::class, 'successOnboardingForm'])->name('boardingSuccess');
Route::GET('applicationRestrict', [ApplicationController::class, 'getApplicationForm'])->name('applicationRestrict');
Route::GET('ApplicationSuccess', [ApplicationController::class, 'successApplicationForm'])->name('ApplicationSuccess');

/*---------------For Strip------------------*/
Route::get('stripe', [BookingController::class, 'stripe']);
Route::post('stripe', [BookingController::class, 'stripePost'])->name('stripe.post');

/*-----------------------Extra Views-----------------------*/

// Route::GET('calender_slots', [UserController::class, 'showCalenderDetails'])->name('calender_slots');
// Route::GET('slot_add', [UserController::class, 'showCalenderAddSlots'])->name('slot_add');
// Route::GET('show_slots', [UserController::class, 'showCalenderSlots'])->name('show_slots');