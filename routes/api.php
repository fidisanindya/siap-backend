<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AttendeController;
use App\Http\Controllers\Api\OutstationController;
use App\Http\Controllers\Api\AbsentPermissionController;
use App\Http\Controllers\Api\PaidLeaveController;
use App\Http\Controllers\Api\ProjectManagementController;
use App\Http\Controllers\Api\TodoPersonalController;
use App\Http\Controllers\Api\TodoProjectController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('my', [UserController::class, 'show']);
    Route::post('change_password', [UserController::class, 'update_password']);
    Route::get('user', [UserController::class, 'index']);
    Route::get('all-user', [UserController::class, 'getAllUser']);
    Route::post('presence', [AttendeController::class, 'presence']);
    Route::post('presence/cancel', [AttendeController::class, 'cancel']);
    Route::get('presence', [AttendeController::class, 'index']);

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', [UserController::class, 'notifications']);
        Route::post('/', [UserController::class, 'readNotification']);
        Route::get('/read', [UserController::class, 'readAllNotifications']);
        Route::get('/delete', [UserController::class, 'deleteAllNotifications']);
        Route::post('/send', [UserController::class, 'send']);
    });

    Route::get('statistics', [UserController::class, 'myStatistic']);

    Route::group(['prefix' => 'permission'], function () {
        Route::post('/', [AbsentPermissionController::class, 'store']);
        Route::get('/', [AbsentPermissionController::class, 'index']);
        Route::get('/all', [AbsentPermissionController::class, 'all']);
        Route::post('/approve',  [AbsentPermissionController::class, 'approve']);
        Route::post('/picture',  [AbsentPermissionController::class, 'updatePicture']);
    });


    Route::group(['prefix' => 'outstation'], function () {
        Route::post('/', [OutstationController::class, 'store']);
        Route::get('/', [OutstationController::class, 'index']);
        Route::get('/all', [OutstationController::class, 'all']);
        Route::post('/approve', [OutstationController::class, 'approve']);
        Route::post('/picture',  [OutstationController::class, 'updatePicture']);
    });

    Route::group(['prefix' => 'paid-leave'], function () {
        Route::post('/', [PaidLeaveController::class, 'store']);
        Route::get('/', [PaidLeaveController::class, 'index']);
        Route::get('/all', [PaidLeaveController::class, 'all']);
        Route::post('/approve', [PaidLeaveController::class, 'approve']);
        Route::post('/picture',  [PaidLeaveController::class, 'updatePicture']);
    });
    
    Route::group(['prefix' => 'project-management'], function () {
        Route::post('/insert-project', [ProjectManagementController::class, 'insert_project']);
        Route::get('/get-project', [ProjectManagementController::class, 'get_project']);
        Route::post('/update-project', [ProjectManagementController::class, 'update_project']);
        Route::post('/delete-project', [ProjectManagementController::class, 'delete_project']);
        Route::post('/insert-member', [ProjectManagementController::class, 'insert_member_project']);
        Route::get('/get-member/{project_id}', [ProjectManagementController::class, 'get_member']);
        Route::post('/get-member-not-added', [ProjectManagementController::class, 'getUsersNotInProject']);
        Route::post('/delete-member', [ProjectManagementController::class, 'delete_member']);
    });
    
    Route::group(['prefix' => 'todo-list'], function () {
        Route::post('/insert-todo-project', [TodoProjectController::class, 'insert_todo_project']);
        Route::get('/get-all-todo-project/{project_id}', [TodoProjectController::class, 'get_todo_project_byproject']);
        Route::post('/get-todo-project-done-byuser', [TodoProjectController::class, 'get_todo_project_done_byuser']);
        Route::post('/get-todo-project-done', [TodoProjectController::class, 'get_todo_project_done']);
        Route::post('/get-todo-project-undone', [TodoProjectController::class, 'get_todo_project_undone']);
        Route::post('/update-todo-project', [TodoProjectController::class, 'update_todo_project']);
        Route::post('/update-status-done-project', [TodoProjectController::class, 'update_status_done']);
        Route::post('/update-status-undone-project', [TodoProjectController::class, 'update_status_undone']);
        Route::post('/delete-todo-project', [TodoProjectController::class, 'delete_todo_project']);
        // --
        Route::post('/insert-todo-personal', [TodoPersonalController::class, 'insert_todo_personal']);
        Route::get('/get-todo-personal', [TodoPersonalController::class, 'get_todo_personal']);
        Route::get('/get-todo-personal-done', [TodoPersonalController::class, 'get_todo_personal_done']);
        Route::get('/get-todo-personal-undone', [TodoPersonalController::class, 'get_todo_personal_undone']);
        Route::post('/update-todo-personal', [TodoPersonalController::class, 'update_todo_personal']);
        Route::post('/update-status-done', [TodoPersonalController::class, 'update_status_done']);
        Route::post('/update-status-undone', [TodoPersonalController::class, 'update_status_undone']);
        Route::post('/delete-todo-personal', [TodoPersonalController::class, 'delete_todo_personal']);
    });
});
