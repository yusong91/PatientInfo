<?php


use \Vanguard\Http\Controllers\Web\{
    PatientsController,
    LocationCodeController,
    CommonCodeController,
    InterviewController,
    ListTasksController,
    PatientHistoryController,
    PatientRelatedController,
};

use \Vanguard\Http\Controllers\Web\FormStep1Controller;
use Vanguard\Helpers\ChildMenu;
use Vanguard\Helpers\Helper;


/**
 * Authentication
 */
Route::get('login', 'Auth\LoginController@show');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::group(['middleware' => ['registration', 'guest']], function () {
    Route::get('register', 'Auth\RegisterController@show');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::emailVerification();

Route::group(['middleware' => ['password-reset', 'guest']], function () {
    Route::resetPassword();
});

/**
 * Two-Factor Authentication
 */
Route::group(['middleware' => 'two-factor'], function () {
    Route::get('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@show')->name('auth.token');
    Route::post('auth/two-factor-authentication', 'Auth\TwoFactorTokenController@update')->name('auth.token.validate');
});

/**
 * Social Login
 */
Route::get('auth/{provider}/login', 'Auth\SocialAuthController@redirectToProvider')->name('social.login');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

/**
 * Impersonate Routes
 */
Route::group(['middleware' => 'auth'], function () {
    Route::impersonate();
});

Route::group(['middleware' => ['auth', 'verified']], function () {

    /**
     * Dashboard
     */
    //Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard-info', 'DashboardController@info')->name('dashboardinfo');

    Route::get('/', 'PatientsController@index')->name('dashboard');
    Route::get('/patientReport', 'PatientsController@report')->name('patients.report');
    Route::get('/dashboard-report', 'PatientsController@settingReport')->name('settingReport.report');

    /**
        *  Patient Info
     */
    
    Route::get('patients/print', function () {
        return Helper::patientPrint();
    })->name('patients.print');

    // Route::get('patient/importexcel', function () {
    //     return Helper::importExcelPatient();
    // })->name('patients.importexcel');



//    Route::get('patient/texcel', function () {
//        return Helper::excelPatient();
//    })->name('patients.excel');

    Route::resource('patients/importexcel', 'ImportExcelController');
    Route::get('patient/export',[ListTasksController::class,'excel'])->name('patients.excel');
    Route::get('/form',[FormStep1Controller::class,'index'])->name('formstep1');
    Route::get('/form2',[FormStep1Controller::class,'form2'])->name('form2');
    Route::get('/form3',[FormStep1Controller::class,'form3'])->name('form3');
    Route::get('/form4',[FormStep1Controller::class,'form4'])->name('form4');
    Route::get('/form-export',[FormStep1Controller::class,'formExport'])->name('form-export');
    Route::get('/location',[LocationCodeController::class,'index'])->name('location.index');
    Route::get('/location/create',[LocationCodeController::class,'create'])->name('location.create');
    Route::post('/location/store',[LocationCodeController::class,'store'])->name('location.store');
    Route::get('/location/edit/{id}',[LocationCodeController::class,'edit'])->name('location.edit');
    Route::put('/location/update/{id}',[LocationCodeController::class,'update'])->name('location.update');
    Route::delete('/location/destroy/{id}',[LocationCodeController::class,'destroy'])->name('location.destroy');
    Route::post('/location/upload',[LocationCodeController::class,'import'])->name('location.import');
    /**
     *  Patient Info
     */
    //Route::get('/patients',[PatientsController::class,'index'])->name('patients');

    /**
        *  Patient Info
     */
 

    Route::get('/patients',[PatientsController::class,'index'])->name('patients');
    Route::get('/patients/create',[PatientsController::class,'create'])->name('patients.create');
    Route::post('/patients/store',[PatientsController::class,'store'])->name('patients.store');
    Route::get('/patients/edit/{id}',[PatientsController::class,'edit'])->name('patients.edit');
    Route::post('/patients/update',[PatientsController::class,'update'])->name('patients.update');
    Route::get('/patients/delete/{id}',[PatientsController::class,'delete'])->name('patient.delete');

    Route::get('/interview/{id}',[InterviewController::class,'interview'])->name('interview');
    Route::post('/interview',[InterviewController::class,'interviewStore'])->name('interview.store');

    Route::post('/patient-history/store',[PatientHistoryController::class,'store'])->name('patient-history.store');
    Route::post('/patient-related/store',[PatientRelatedController::class,'store'])->name('patient-related.store');
    Route::get('/patient-related/delete',[PatientRelatedController::class,'destroy'])->name('patient-related.delete');
    Route::post('/research',[InterviewController::class,'researchStoreDone'])->name('research.store');

    Route::post('/research/closecase',[InterviewController::class,'closeCase'])->name('research.closecase');

    Route::post('/interview/research',[InterviewController::class,'setResearch'])->name('interview.research');

    /**
        *  List Task
     */

    Route::get('/list-tasks', [ListTasksController::class,'index'])->name('list-tasks');
    
    Route::get('/report', [ListTasksController::class,'report'])->name('report');

    Route::get('list-tasks', 'ListTasksController@index')->name('list-tasks')->middleware('permission:task.index');

    Route::get('list-tasks/show/{id}', 'ListTasksController@show')->name('list-tasks.show');
 
    Route::post('list-tasks/attach-file', [ListTasksController::class,'attachFile'])->name('list-tasks.attach-file');

    Route::get('list-tasks/done', [ListTasksController::class,'tasksDone'])->name('list-tasks.done');

    Route::get('list-tasks/process', [ListTasksController::class,'tasksProcess'])->name('list-tasks.process');

    Route::get('list-tasks/basicinterview/{id}', [ListTasksController::class,'basicInterview'])->name('list-tasks.basicinterview')->middleware('permission:basic.interview'); 

    Route::get('list-tasks/datatechnical/{id}', [ListTasksController::class,'dataTechnical'])->name('list-tasks.datatechnical')->middleware('permission:data.technical'); 

    Route::get('list-tasks/fullinterview/{id}', [ListTasksController::class,'fullInterview'])->name('list-tasks.fullinterview')->middleware('permission:full.interview');

    Route::get('list-tasks/research/{id}', [ListTasksController::class,'showResearch'])->name('list-tasks.research.show')->middleware('permission:research.index');

    //Route::get('list-tasks/research/full/{id}', [InterviewController::class,'researchFull'])->name('list-tasks.research.full')->middleware('permission:research.index');

    Route::post('list-tasks/patient/save',[ListTasksController::class,'fullInterviewStore'])->name('list-tasks.fullinterview.store');
 
    Route::post('list-tasks/patientfamily/save',[ListTasksController::class,'patientFamilyStore'])->name('list-tasks.patientfamily.store');

    Route::get('list-tasks/patientfamily/delete/{id}',[ListTasksController::class,'deletePatientFamily'])->name('list-tasks.patientfamily.delete');

    Route::get('list-tasks/patienttravel/delete/{id}',[ListTasksController::class,'deletePatientTravel'])->name('list-tasks.patienttravel.delete');

    Route::get('list-tasks/patienttravel/edit/{id}',[ListTasksController::class,'editPatientTravel'])->name('list-tasks.patienttravel.edit');

    Route::get('list-tasks/patientrelated/edit/{id}',[PatientRelatedController::class,'editPatientRelated'])->name('list-tasks.patientrelated.edit');

    Route::get('list-tasks/patientfamily/edit/{id}',[ListTasksController::class,'editPatientFamily'])->name('list-tasks.patientfamily.edit');

    Route::post('list-tasks/patienttravel/save',[ListTasksController::class,'patientTravelStore'])->name('list-tasks.patienttravel.store');

    Route::post('list-tasks/full/researchorclosecase',[ListTasksController::class,'setSearchOrCloseCase'])->name('list-tasks.full.researchclose');

    Route::post('list-tasks/patientworkplace/save',[ListTasksController::class,'fullInterviewWorkplaceStore'])->name('list-tasks.patientworkplace.store');

    Route::get('list-tasks/fullinterview/done/{id}',[ListTasksController::class,'fullInterviewDone'])->name('list-tasks.fullinterview.done');

    Route::get('patient/approve/{id}',[PatientsController::class,'approveFullInterivew'])->name('patient.superior.approve');

    Route::get('list-tasks/basicinterview/search/{id}',[InterviewController::class,'basicInterviewSearch'])->name('list-tasks.basicinterview.search');

    Route::get('patients/import/', function () { 
        return Helper::importPatient();
    })->name('patients.import');

    Route::post('/patients/excel/store',[PatientsController::class,'storeExcel'])->name('patients.excel.store');

    Route::get('patients/download/report/{id}', function ($id) { 
        
        return downloadPatientReport($id);
    
    })->name('patients.download.report')->middleware('permission:download.patient.report'); 

    Route::post('list-tasks/interview/again',[PatientsController::class,'interviewAgain'])->name('list-tasks.interview.again');

    Route::post('list-tasks/interview/finish',[PatientsController::class,'finishInterview'])->name('list-tasks.superior.finish');

    /**
        *  LocationCode
     */

    Route::get('location/district/{id}', function ($id) {
        
        return Helper::district($id);

    })->name('location.district');

    Route::get('location/commune/{id}', function ($id) {
        
        return Helper::commune($id);

    })->name('location.commune');

    Route::get('location/village/{id}', function ($id) {
        
        return Helper::village($id);

    })->name('location.village');

    /**
     * User Profile
     */

    Route::group(['prefix' => 'profile', 'namespace' => 'Profile'], function () {
        Route::get('/', 'ProfileController@show')->name('profile');
        Route::get('activity', 'ActivityController@show')->name('profile.activity');
        Route::put('details', 'DetailsController@update')->name('profile.update.details');
        Route::post('avatar', 'AvatarController@update')->name('profile.update.avatar');
        Route::post('avatar/external', 'AvatarController@updateExternal')
            ->name('profile.update.avatar-external');

        Route::put('login-details', 'LoginDetailsController@update')
            ->name('profile.update.login-details');

        Route::get('sessions', 'SessionsController@index')
            ->name('profile.sessions')
            ->middleware('session.database');

        Route::delete('sessions/{session}/invalidate', 'SessionsController@destroy')
            ->name('profile.sessions.invalidate')
            ->middleware('session.database');
    });

    /**
     * Two-Factor Authentication Setup
     */

    Route::group(['middleware' => 'two-factor'], function () {
        Route::post('two-factor/enable', 'TwoFactorController@enable')->name('two-factor.enable');

        Route::get('two-factor/verification', 'TwoFactorController@verification')
            ->name('two-factor.verification')
            ->middleware('verify-2fa-phone');

        Route::post('two-factor/resend', 'TwoFactorController@resend')
            ->name('two-factor.resend')
            ->middleware('throttle:1,1', 'verify-2fa-phone');

        Route::post('two-factor/verify', 'TwoFactorController@verify')
            ->name('two-factor.verify')
            ->middleware('verify-2fa-phone');

        Route::post('two-factor/disable', 'TwoFactorController@disable')->name('two-factor.disable');
    });



    /**
     * User Management
     */
    Route::resource('users', 'Users\UsersController')
        ->except('update')->middleware('permission:users.manage');

    Route::group(['prefix' => 'users/{user}', 'middleware' => 'permission:users.manage'], function () {
        Route::put('update/details', 'Users\DetailsController@update')->name('users.update.details');
        Route::put('update/login-details', 'Users\LoginDetailsController@update')
            ->name('users.update.login-details');

        Route::post('update/avatar', 'Users\AvatarController@update')->name('user.update.avatar');
        Route::post('update/avatar/external', 'Users\AvatarController@updateExternal')
            ->name('user.update.avatar.external');

        Route::get('sessions', 'Users\SessionsController@index')
            ->name('user.sessions')->middleware('session.database');

        Route::delete('sessions/{session}/invalidate', 'Users\SessionsController@destroy')
            ->name('user.sessions.invalidate')->middleware('session.database');

        Route::post('two-factor/enable', 'TwoFactorController@enable')->name('user.two-factor.enable');
        Route::post('two-factor/disable', 'TwoFactorController@disable')->name('user.two-factor.disable');
    });

    /**
     * Roles & Permissions
     */
    Route::group(['namespace' => 'Authorization'], function () {
        Route::resource('roles', 'RolesController')->except('show')->middleware('permission:roles.manage');

        Route::post('permissions/save', 'RolePermissionsController@update')
            ->name('permissions.save')
            ->middleware('permission:permissions.manage');

        Route::resource('permissions', 'PermissionsController')->middleware('permission:permissions.manage');
    });


    /**
     * Settings
     */

    Route::get('settings', 'SettingsController@general')->name('settings.general')
        ->middleware('permission:settings.general');

    Route::post('settings/general', 'SettingsController@update')->name('settings.general.update')
        ->middleware('permission:settings.general');

    Route::get('settings/auth', 'SettingsController@auth')->name('settings.auth')
        ->middleware('permission:settings.auth');

    Route::post('settings/auth', 'SettingsController@update')->name('settings.auth.update')
        ->middleware('permission:settings.auth');

    if (config('services.authy.key')) {
        Route::post('settings/auth/2fa/enable', 'SettingsController@enableTwoFactor')
            ->name('settings.auth.2fa.enable')
            ->middleware('permission:settings.auth');

        Route::post('settings/auth/2fa/disable', 'SettingsController@disableTwoFactor')
            ->name('settings.auth.2fa.disable')
            ->middleware('permission:settings.auth');
    }

    Route::post('settings/auth/registration/captcha/enable', 'SettingsController@enableCaptcha')
        ->name('settings.registration.captcha.enable')
        ->middleware('permission:settings.auth');

    Route::post('settings/auth/registration/captcha/disable', 'SettingsController@disableCaptcha')
        ->name('settings.registration.captcha.disable')
        ->middleware('permission:settings.auth');

    Route::get('settings/notifications', 'SettingsController@notifications')
        ->name('settings.notifications')
        ->middleware('permission:settings.notifications');

    Route::post('settings/notifications', 'SettingsController@update')
        ->name('settings.notifications.update')
        ->middleware('permission:settings.notifications');

    /**
     * Activity Log 
     */

    Route::get('activity', 'ActivityController@index')->name('activity.index')
        ->middleware('permission:users.activity');

    Route::get('activity/user/{user}/log', 'Users\ActivityController@index')->name('activity.user')
        ->middleware('permission:users.activity');


//    Route::resource('commoncode', 'CommonCodeController');

    Route::get('common-codes', [CommonCodeController::class,'index'])->name('common-codes.index');
    Route::get('common-codes/update-order', [CommonCodeController::class,'updateOrder'])->name('common-codes.update-order');
    Route::get('common-codes/create', [CommonCodeController::class,'create'])->name('common-codes.create');
    Route::post('common-codes/store', [CommonCodeController::class,'store'])->name('common-codes.store');
    Route::get('common-codes/show/{id}', [CommonCodeController::class,'show'])->name('common-codes.show');
    Route::get('common-codes/edit/{id}', [CommonCodeController::class,'edit'])->name('common-codes.edit');
    Route::put('common-codes/update/{id}', [CommonCodeController::class,'update'])->name('common-codes.update');
    Route::delete('common-codes/destroy/{id}', [CommonCodeController::class,'destroy'])->name('common-codes.destroy');

    Route::get('childmenu/create', function () {
        ChildMenu::createChildMenu(1);
    })->name('childmenu.create');
});


/**
 * Installation
 */

Route::group(['prefix' => 'install'], function () {
    Route::get('/', 'InstallController@index')->name('install.start');
    Route::get('requirements', 'InstallController@requirements')->name('install.requirements');
    Route::get('permissions', 'InstallController@permissions')->name('install.permissions');
    Route::get('database', 'InstallController@databaseInfo')->name('install.database');
    Route::get('start-installation', 'InstallController@installation')->name('install.installation');
    Route::post('install-app', 'InstallController@install')->name('install.install');
    Route::get('complete', 'InstallController@complete')->name('install.complete');
    Route::get('error', 'InstallController@error')->name('install.error');
});