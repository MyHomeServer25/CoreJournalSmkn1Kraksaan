<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Api\DudiController;
use App\Http\Controllers\Api\JurnalController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\SetttingController;
use App\Http\Controllers\Api\auth\LoginController;
use App\Http\Controllers\Api\auth\RegisterController;
use App\Http\Controllers\Api\auth\ResetPasswordController;
// use App\Http\Controllers\pi\JournalController;

//test api
Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => "Api berhasil di jalankan"
    ]);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware(['cors'])->group(function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');
});

Route::middleware(['auth:api', 'throttle:api', 'cors'])->group(function () {
    Route::group(['middleware' => ['role:student']], function() {

        // Route api jurnal
        Route::get('/journal', [JurnalController::class, 'index'])->name('journal.index');
        Route::post('/journal', [JurnalController::class, 'store'])->name('journal.store');
        Route::put('/journal/{journal}', [JurnalController::class, 'update'])->name('journal.update');
        Route::delete('/journal/{journal}', [JurnalController::class, 'destroy'])->name('journal.destroy');
        Route::get('/export-pdf', [JurnalController::class, 'exportPDF'])->name('journal.exportPDF');

        // Route api setting
        Route::get('/settings', [SetttingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{student}', [SetttingController::class, 'update'])->name('setting.update');

        // Route student update and delete account
        Route::put('/student/{student}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('/student/{student}', [StudentController::class, 'destroy'])->name('student.destroy');

        // Route show student by auth
        Route::get('/student_auth', [StudentController::class, 'getByUser'])->name('student.getByUser');

        Route::get('/studentRequest', [SetttingController::class, 'getStatus'])->name('setting.getStatus');
    });
    
    
    Route::group(['middleware' => ['role:admin']], function() {
        // journal monitoring
        Route::get('/journal/monitoring', [JurnalController::class, 'monitoring'])->name('journal.monitoring');
    
        // Routes api teacher
        Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
        Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store');
        Route::put('/teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('/teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

        // Routes api Dudi 
        Route::get('/dudi', [DudiController::class, 'index'])->name('dudi.index');
        Route::post('/dudi', [DudiController::class, 'store'])->name('dudi.store');
        Route::put('/dudi/{dudi}', [DudiController::class, 'update'])->name('dudi.update');
        Route::delete('/dudi/{dudi}', [DudiController::class, 'destroy'])->name('dudi.destroy');

        // approve route
        Route::patch('/settings/approve/{StudentRequest}', [SetttingController::class, 'approve']);

        // import excel
        Route::post('import-students', [StudentController::class, 'import'])->name('student.import');
        Route::get('/student/{name}', [StudentController::class, 'Getbyemail'])->name('student.Getbyemail');
        Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    });
    
    Route::group(['middleware' => ['role:teacher']], function() {
        //route mentor
        Route::get('/mentor/journal', [TeacherController::class, 'journal'])->name('mentor.journal.index');
        Route::get('/mentor/student', [TeacherController::class, 'student'])->name('mentor.student.index');
        Route::get('/detail/student/{student}', [TeacherController::class, 'detailStudent'])->name('detail.student');
    });
    
    // Route api student
    // Route::apiResource('/student', StudentController::class);
});

Route::middleware(['cors'])->group(function () {
    Route::post('/forgot-password', [ResetPasswordController::class, 'resetPassword']);
    Route::post('/logout', App\Http\Controllers\Api\auth\LogoutController::class)->name('logout');
});

