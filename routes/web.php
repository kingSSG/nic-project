<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Anandadhara\AnandadharaController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\ExcelReportController;

use App\Http\Controllers\Kcc\KccController;
use App\Http\Controllers\KishanMandi\KishanMandiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Mgnregs\MgnregsController;
use App\Http\Controllers\PdfControlller;
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

Route::middleware(['guest'])->group(function () {
    Route::view('/','home')->name('home');
    Route::get('/loginPage', [UserAuthenticationController::class,'index'])->name('index');
    Route::get('/showRegistrationForm',[UserAuthenticationController::class,'showRegistrationForm'])->name('showRegistrationForm');
    Route::post('/register',[UserAuthenticationController::class,'register'])->name('register');
    Route::post('/login',[UserAuthenticationController::class,'login'])->name('login');

    // reset password

    Route::get('/forgotPasswordPage',[ForgotPasswordController::class,'showForgotPasswordForm'])->name('forgotPasswordPage');
    Route::post('/submitForgotPasswordForm',[ForgotPasswordController::class,'submitForgotPasswordForm'])->name('submitForgotPasswordForm');
    Route::get('/showResetPasswordForm/{token}',[ForgotPasswordController::class,'showResetPasswordForm'])->name('showResetPasswordForm');
    Route::post('/submitResetPasswordForm',[ForgotPasswordController::class,'submitResetPasswordForm'])->name('submitResetPasswordForm');
    
});

Route::prefix('users')->name('users.')->group(function(){
     
     
     
     Route::middleware(['auth'])->group(function(){
          
          Route::get('/logout',[UserAuthenticationController::class,'logout'])->name('logout');
          Route::get('/userDashboard',[MenuController::class,'show'])->name('userDashboard');
          
          //for dynamic dropdowns used in ajax request from js/dropdown.js
          Route::post('/getSubdivision',[DropdownController::class,'getSubdivision'])->name('subdivision');
          Route::post('/getMunicipality',[DropdownController::class,'getMunicipality'])->name('municipality');

            //EntryForm
            Route::get('/KCC_entry_update',[KccController::class,'KCC_entry_update'])->name('KCC_entry_update');
            Route::get('/KM_entry_update',[KishanMandiController::class,'KM_entry_update'])->name('KM_entry_update');
            Route::get('/MGNREGS_Entry_update',[MgnregsController::class,'MGNREGS_Entry_update'])->name('MGNREGS_Entry_update');
            Route::get('/Anandadhara_Entry_Update',[AnandadharaController::class,'Anandadhara_Entry_Update'])->name('Anandadhara_Entry_Update');
           

            //check data
            Route::post('/checkkccData',[KccController::class,'checkKccData'])->name('checkKccData');
            Route::post('/checkKishanMandiData',[KishanMandiController::class,'checkKishanMandiData'])->name('checkKishanMandiData');
            Route::post('/checkMgnregsData',[MgnregsController::class,'checkMgnregsData'])->name('checkMgnregsData');
            Route::post('/checkAnandadharaData',[AnandadharaController::class,'checkAnandadharaData'])->name('checkAnandadharaData');
            //insert data into tables
            Route::post('/kccinsert',[KccController::class,'insertToKccTable'])->name('insertKcc');
            Route::post('/insertKishanMandi',[KishanMandiController::class,'insertKishanMandi'])->name('insertKishanMandi');
            Route::post('/insertAnandhara',[AnandadharaController::class,'insertAnandhara'])->name('insertAnandhara');
            Route::post('/insertMgnregs',[MgnregsController::class,'insertMgnregs'])->name('insertMgnregs');


            //reports
            Route::get('/KCC_Report',[KccController::class,'KCC_Report'])->name('KCC_Report');
            Route::get('/KM_report',[KishanMandiController::class,'KM_report'])->name('KM_report');
            Route::get('/MGNREGS_report',[MgnregsController::class,'MGNREGS_report'])->name('MGNREGS_report');
            Route::get('/Anandadhara_report',[AnandadharaController::class,'Anandadhara_report'])->name('Anandadhara_report');

            //pdf
            Route::post('/kccDownload',[PdfControlller::class,'kccDownload'])->name('kccDownload');
            Route::post('/kmDownload',[PdfControlller::class,'kmDownload'])->name('kmDownload');
            Route::post('/anandadharaDownload',[PdfControlller::class,'anandadharaDownload'])->name('anandadharaDownload');
            Route::post('/mgnregsDownload',[PdfControlller::class,'mgnregsDownload'])->name('mgnregsDownload');

            //excel
            Route::post('/cmReportDownload',[ExcelReportController::class,'downloadCMSReport'])->name('downloadCMReport');
            Route::get('/KCCExcelReport',[ExcelReportController::class,'KCCExcelReport'])->name('KCCExcelReport');
            Route::get('/KMExcelReport',[ExcelReportController::class,'KMExcelReport'])->name('KMExcelReport');
            Route::get('/MGNREGSReport',[ExcelReportController::class,'MGNREGSReport'])->name('MGNREGSExcelReport');
            Route::get('/AnandharaReport',[ExcelReportController::class,'AnandharaReport'])->name('AnandharaExcelReport');
            
              
            Route::get('/showExcelReportCritera',[PdfControlller::class,'showExcelReportCritera'])->name('showExcelReportCritera');
            Route::get('/showExceldata',[PdfControlller::class,'showExceldata'])->name('showExceldata');
   });

});

Route::prefix('admin')->name('admin.')->group(function(){
    
     Route::middleware(['auth','isAdmin'])->group(function(){

         
          Route::post('/logout',[UserAuthenticationController::class,'logout'])->name('logout');
          
          Route::resource('usermanagement', AdminDashboardController::class);
          Route::post('/updateRole/{user}',[AdminDashboardController::class,'updateRole'])->name('updateRole');

          Route::get('/showExcelReportCritera',[AdminDashboardController::class,'showExcelReportCritera'])->name('showExcelReportCritera');
             
          Route::get('/showExceldata',[PdfControlller::class,'showExceldata'])->name('showExceldata');
     });
 

});

