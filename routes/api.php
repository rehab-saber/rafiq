<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\ParentPasscodeController;
use App\Http\Controllers\Api\ParentsController;
use App\Http\Controllers\Api\AuthParentsController;
use App\Http\Controllers\Api\DoctorAuthController;
use App\Http\Controllers\Api\ChildController;
use App\Http\Controllers\Api\CarsQuestionController;
use App\Http\Controllers\Api\CarsQuestionOptionController;
use App\Http\Controllers\Api\CarsAnswerController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SectionLevelController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PlanActivityController;
use App\Http\Controllers\Api\ActivityAttemptController;

//doctor route
Route::get('/doctorsShow', [DoctorController::class, 'index']);
Route::get('/doctorsSowOne/{id}', [DoctorController::class, 'show']);
Route::post('/doctorsStore', [DoctorController::class, 'store']);
Route::post('/doctorsUpdate', [DoctorController::class, 'update']);
Route::delete('/doctorsDelete/{id}', [DoctorController::class, 'delete']);

//doctor Auth route



Route::prefix('doctor')->group(function () {

    // ===== AUTH =====
    Route::post('/register', [DoctorAuthController::class, 'register']);
    Route::post('/login', [DoctorAuthController::class, 'login']);
    Route::post('/social-login/{provider}', [DoctorAuthController::class, 'socialLogin']);

    // ===== PROTECTED ROUTES =====
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [DoctorAuthController::class, 'logout']);
        Route::get('/profile', [DoctorAuthController::class, 'profile']);
    });

});


// Parent Passcodes route
Route::get('/passcodesShowAll', [ParentPasscodeController::class, 'index']);
Route::get('/passcodesShowOne/{id}', [ParentPasscodeController::class, 'show']);
Route::post('/passcodesStore', [ParentPasscodeController::class, 'store']);
Route::post('/passcodesUpdate', [ParentPasscodeController::class, 'update']);
Route::delete('/passcodesDelete/{id}', [ParentPasscodeController::class, 'delete']);

// Parents CRUD routes
Route::get('/parentsShow', [ParentsController::class, 'index']);
Route::get('/parentsShowOne/{id}', [ParentsController::class, 'show']);
Route::post('/parentsStore', [ParentsController::class, 'store']);
Route::post('/parentsUpdate', [ParentsController::class, 'update']);
Route::delete('/parentsDelete/{id}', [ParentsController::class, 'delete']);

//parent Auth route

Route::prefix('parents')->group(function () {
    // Public
    Route::post('/register', [AuthParentsController::class, 'register']);
    Route::post('/login',    [AuthParentsController::class, 'login']);
    Route::post('/passcode-entry', [AuthParentsController::class, 'passcodeEntry']);
    Route::post('/auth/{provider}', [AuthParentsController::class, 'socialLogin']);
    // Protected
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout',  [AuthParentsController::class, 'logout']);
        Route::get('/profile',  [AuthParentsController::class, 'profile']);

    }); 
});


// Children route
Route::get('/childrenShow', [ChildController::class, 'index']);
Route::get('/childrenShowOne/{id}', [ChildController::class, 'show']);
Route::post('/childrenStore', [ChildController::class, 'store']);
Route::post('/childrenUpdate', [ChildController::class, 'update']);
Route::delete('/childrenDelete/{id}', [ChildController::class, 'delete']);

//carsQuestion route
Route::get('/QuestionShow', [CarsQuestionController::class, 'index']);
Route::get('/QuestionShowOne/{id}', [CarsQuestionController::class, 'show']);
Route::post('/QuestionStore', [CarsQuestionController::class, 'store']);
Route::post('/QuestionUpdate', [CarsQuestionController::class, 'update']);
Route::delete('/QuestionDelete/{id}', [CarsQuestionController::class, 'delete']);

// Cars Question Options routes
Route::get('/OptionShow', [CarsQuestionOptionController::class, 'index']);
Route::get('/OptionShowOne/{id}', [CarsQuestionOptionController::class, 'show']);
Route::post('/OptionStore', [CarsQuestionOptionController::class, 'store']);
Route::post('/OptionUpdate', [CarsQuestionOptionController::class, 'update']);
Route::delete('/OptionDelete/{id}', [CarsQuestionOptionController::class, 'delete']);


//cars answer route
Route::get('/AnswerShow', [CarsAnswerController::class, 'index']);
Route::get('/AnswerShowOne/{id}', [CarsAnswerController::class, 'show']);
Route::post('/AnswerStore', [CarsAnswerController::class, 'store']);
Route::post('/AnswerUpdate', [CarsAnswerController::class, 'update']);
Route::delete('/AnswerDelete/{id}', [CarsAnswerController::class, 'destroy']);


// Section routes
Route::get('/SectionShow', [SectionController::class, 'index']);
Route::get('/SectionShowOne/{id}', [SectionController::class, 'show']);
Route::post('/SectionStore', [SectionController::class, 'store']);
Route::post('/SectionUpdate', [SectionController::class, 'update']);
Route::delete('/SectionDelete/{id}', [SectionController::class, 'delete']);

// SectionLevel routes
Route::get('/LevelShow', [SectionLevelController::class, 'index']);
Route::get('/LevelShowOne/{id}', [SectionLevelController::class, 'show']);
Route::post('/LevelStore', [SectionLevelController::class, 'store']);
Route::post('/LevelUpdate', [SectionLevelController::class, 'update']);
Route::delete('/LevelDelete/{id}', [SectionLevelController::class, 'delete']);

// Activity routes
Route::get('/ActivityShow', [ActivityController::class, 'index']);
Route::get('/ActivityShowOne/{id}', [ActivityController::class, 'show']);
Route::post('/ActivityStore', [ActivityController::class, 'store']);
Route::post('/ActivityUpdate', [ActivityController::class, 'update']);
Route::delete('/ActivityDelete/{id}', [ActivityController::class, 'delete']);

// Plan routes
Route::get('plansShow', [PlanController::class, 'index']);
Route::get('plansShowOne/{id}', [PlanController::class, 'show']);
Route::post('plansStore', [PlanController::class, 'store']);
Route::post('plansUpdate', [PlanController::class, 'update']);
Route::delete('plansDelete/{id}', [PlanController::class, 'delete']);

// PlanActivity routes

Route::get('plan-activitiesShow', [PlanActivityController::class, 'index']);
Route::get('plan-activitiesShowOne/{id}', [PlanActivityController::class, 'show']);
Route::post('plan-activitiesStore', [PlanActivityController::class, 'store']);
Route::post('plan-activitiesUpdate', [PlanActivityController::class, 'update']);
Route::delete('plan-activitiesDelete/{id}', [PlanActivityController::class, 'delete']);

//ActivityAttempt route
Route::get('activity-attemptsShow', [ActivityAttemptController::class, 'index']);
Route::get('activity-attemptsShowOne/{id}', [ActivityAttemptController::class, 'show']);
Route::post('activity-attemptsStore', [ActivityAttemptController::class, 'store']);
Route::post('activity-attemptsUpdate', [ActivityAttemptController::class, 'update']);
Route::delete('activity-attemptsDelete/{id}', [ActivityAttemptController::class, 'delete']);