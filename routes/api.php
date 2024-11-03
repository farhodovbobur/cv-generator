<?php

use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LevelController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\SocialNetworkController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('students', StudentController::class);

Route::apiResource('projects', ProjectController::class);

Route::apiResource('educations', EducationController::class);

Route::apiResource('experiences', ExperienceController::class);

Route::apiResource('languages', LanguageController::class);

Route::apiResource('levels', LevelController::class);

Route::apiResource('networks', SocialNetworkController::class);

Route::apiResource('skills', SkillController::class);

