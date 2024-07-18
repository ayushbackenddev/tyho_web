<?php

use App\Http\Controllers\AllCoachesController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AvalabilityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientSessionController;
use App\Http\Controllers\ExpressionOfInterestController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\OnboardingFormController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TherapistSessionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\TherapistEditProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ClientsDetailsController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\CouponController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::POST('showSelectedSlots', [BookingController::class, 'selectedSlotsById']);

Route::POST('userList', [UserController::class, 'showUserlist']);

Route::POST('showSlots', [AllCoachesController::class, 'getAddedSlots']);

Route::POST('showCalenderSlot', [UserController::class, 'getCalenderShowSlotPage']);

Route::POST('addCalenderSlot', [UserController::class, 'getCalenderAddSlotPage']);

Route::POST('bulkAdd', [UserController::class, 'getBulkAddSlotForm']);

Route::POST('RegForm', [UserController::class, 'getSignUpForm']);
Route::POST('LoginForm', [UserController::class, 'getSignInForm']);
Route::POST('ResetPassword', [UserController::class, 'getResetForm']);

//for User Login
Route::POST('signIn', [ApiController::class, 'Login']);
Route::POST('logoutUser', [ApiController::class, 'userLogout']);

//for Doctors Login
Route::POST('dLogin', [ApiController::class, 'DocLogin']);
Route::POST('send', [ApiController::class, 'SendOTP']);
Route::POST('verify', [ApiController::class, 'VerifyOTP']);
Route::POST('logoutTherapist', [ApiController::class, 'therapistLogout']);

//for Registration
Route::POST('signUp', [ApiController::class, 'Registration']);
Route::POST('sendOtpForUser', [UserController::class, 'OTPsend']);
Route::POST('otpverifyForUser', [UserController::class, 'OTPverification']);

//for User Reset Password
Route::POST('userSendOtp', [ApiController::class, 'ResetSendOTP']);
Route::POST('userVerifyOtp', [ApiController::class, 'ResetVerifyOTP']);
Route::POST('resetUserPassword', [ApiController::class, 'UserResetPassword']);

//for Doctors Reset Password
Route::POST('docSendOtp', [ApiController::class, 'DocResendOTP']);
Route::POST('docVerifyOtp', [ApiController::class, 'DocVerifyOTP']);
Route::POST('resetDocPassword', [ApiController::class, 'DoctorResetPassword']);
Route::POST('setTherapistPassword', [ApiController::class, 'therapistSetPassword']);

//for Expression
Route::POST('expression', [ExpressionOfInterestController::class, 'ExpressionOfInterest']);

//for Intake
Route::POST('intake1', [IntakeController::class, 'IntakeForm1']);
Route::POST('intake2', [IntakeController::class, 'IntakeForm2']);

Route::POST('application', [ApplicationController::class, 'ApplicationForm']);

Route::POST('onboarding', [OnboardingFormController::class, 'OnBoardingForm']);
Route::POST('sendOTPOnboarding', [UserController::class, 'OnboardingSendOTP']);
Route::POST('otpVerify', [UserController::class, 'OnboardingVerifyOTP']);

Route::POST('viewApplication', [OnboardingFormController::class, 'ApplicationViewbyId']);

Route::POST('AllCoaches', [AllCoachesController::class, 'getAllCoaches']);

Route::POST('Coaches', [AllCoachesController::class, 'showAllCoaches']);

Route::POST('singleCoacheData', [AllCoachesController::class, 'getCoachesData']);

Route::POST('showExpression', [ApplicationController::class, 'ExpressionViewbyId']);

Route::POST('getlanguages', [ExpressionOfInterestController::class, 'selectLanguages']);

Route::POST('allIssues', [IntakeController::class, 'getAllIssues']);

Route::POST('getallIssues', [ApplicationController::class, 'AllIssues']);

Route::POST('issues', [UserController::class, 'getAllIssues']);

Route::POST('language', [UserController::class, 'getAllLanguages']);

Route::POST('service', [UserController::class, 'getAllServices']);

Route::POST('medium', [UserController::class, 'getAllMediums']);

Route::POST('country', [UserController::class, 'getAllCountries']);

Route::POST('coachesData', [AllCoachesController::class, 'showCoacheData']);

Route::POST('clientBooking', [AllCoachesController::class, 'getclientBookingPage']);

Route::POST('otherTherapist', [AllCoachesController::class, 'getOtherTherapist']);

Route::POST('addSlots', [AvalabilityController::class, 'slotsAddForBooking']);
Route::POST('getSlotData', [AvalabilityController::class, 'getDataByDateAndTherapistId']);
Route::POST('showDataByDate', [AvalabilityController::class, 'getDataByDate']);
Route::POST('showLocation', [AvalabilityController::class, 'getLocation']);
Route::POST('addSlotBulk', [AvalabilityController::class, 'addBulkSlot']);
Route::POST('addBulk', [AvalabilityController::class, 'addSelectedBulkSlot']);

Route::POST('slotBook', [CartController::class, 'addSlotIntoCart']);

Route::POST('removeSlot', [BookingController::class, 'removeSelectedSlots']);

Route::POST('editSlot', [AllCoachesController::class, 'editSlotPage']);

Route::POST('selectedSlot', [AllCoachesController::class, 'getSelectedSlots']);

Route::POST('paymentStripe', [BookingController::class, 'slotBookingPayment']);

Route::POST('showSessions', [TherapistSessionController::class, 'showTherapistSessions']);

Route::POST('showBookedSessions', [ClientSessionController::class, 'showBookedSessionsByClient']);
Route::POST('ReqRescheduleData', [ClientSessionController::class, 'showRequestReschedule']);
Route::POST('requestReschedule', [ClientSessionController::class, 'RequestRescheduleForm']);
Route::POST('cancelFormData', [ClientSessionController::class, 'showCancelForm']);

Route::POST('inpersonSlots', [AllCoachesController::class, 'getAddedSlotsForInpreson']);
Route::POST('sessionOrder', [OrderController::class, 'showOrders']);
Route::POST('rescheduleBooking', [AllCoachesController::class, 'rescheduleBooking']);

Route::POST('otherBookedTherapist', [AllCoachesController::class, 'showOtherBookedTherapist']);

Route::POST('orderCancelClient', [OrderController::class, 'cancelOrderClient']);
Route::POST('orderCancel', [OrderController::class, 'cancelOrder']);
Route::POST('orderCancelKeep', [OrderController::class, 'cancelOrderAndKeep']);
Route::POST('rescheduleBookingAPI', [OrderController::class, 'rescheduleBookingAPI']);
Route::POST('delaySessionClient', [OrderController::class, 'delaySessionClient']);
Route::POST('RequestRescheduleClient', [OrderController::class, 'RequestRescheduleClient']);

Route::POST('therapistProfileEditAPI', [AllCoachesController::class, 'editTherapistProfile']);

Route::POST('updateProfile', [TherapistEditProfileController::class, 'UpdateTherapistProfile']);

Route::POST('updateTherapistProfile', [TherapistEditProfileController::class, 'ProfileUpdate']);

Route::POST('therapistProfileUpdate', [TherapistEditProfileController::class, 'UpdateTherapistProfileThird']);

Route::POST('sendOtp', [TherapistEditProfileController::class, 'OTPsend']);
Route::POST('verifyOtp', [TherapistEditProfileController::class, 'OTPverification']);

Route::POST('getCountry', [BookingController::class, 'GetCountries']);
Route::POST('getState', [BookingController::class, 'GetState']);
Route::POST('getCity', [BookingController::class, 'GetCity']);

Route::POST('stripePayment', [WalletController::class, 'insertIntoWallet']);
Route::POST('ledgerForm', [WalletController::class, 'getWalletLedger']);
Route::POST('withdrawForm', [WalletController::class, 'getWithdrawForm']);
Route::POST('walletData', [WalletController::class, 'showWalletData']);
Route::POST('insertWallet', [WalletController::class, 'insertToWallet']);

Route::POST('myclient', [ClientsDetailsController::class, 'showMyClient']);
Route::POST('clientDetail', [ClientsDetailsController::class, 'ClientDetail']);
Route::POST('clientData', [ClientsDetailsController::class, 'showMyClientData']);
Route::POST('clientintakForm', [ClientsDetailsController::class, 'showclientintakForm']);

Route::POST('addNotes', [ClientsDetailsController::class, 'AddQuickNotes']);

Route::POST('editUserProfile', [ClientProfileController::class, 'ClientDetailForEdit']);
Route::POST('updateClientProfile', [ClientProfileController::class, 'updateClientProfile']);
Route::POST('sendOtpClient', [ClientProfileController::class, 'OTPsendClient']);
Route::POST('otpverifyClient', [ClientProfileController::class, 'OTPverificationClient']);

Route::POST('showCouponData', [CouponController::class, 'showCouponData']);
Route::POST('getclientDetails', [CouponController::class, 'getclientDetails']);
Route::POST('addCoupons', [CouponController::class, 'AddCoupon']);
Route::POST('therapiscoupuntatus', [CouponController::class, 'therapiscoupuntatus']);
Route::POST('createcouponForm', [CouponController::class, 'createcouponForm'] );
Route::POST('apllycoupncode', [CouponController::class, 'apllycoupncode'] );
Route::POST('applycoupondisable', [CouponController::class, 'applycoupondisable']);

Route::POST('showPaymentsNotes', [TherapistSessionController::class, 'paymentsNotes']);
Route::POST('acceptRequest', [TherapistSessionController::class, 'Accept']);
Route::POST('rejectRequest', [TherapistSessionController::class, 'Reject']);
Route::POST('cancelFormDataTherapist', [TherapistSessionController::class, 'showCancelFormInTherapist']);