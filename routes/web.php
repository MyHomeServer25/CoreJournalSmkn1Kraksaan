<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SetttingController;

Route::get('/', function () { return view('auth.login'); });
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('/admin', function () { return view('admin.index'); })->name('admin.index');
        
        // Journal monitoring (hanya admin)
        Route::get('/journal/monitoring' , [JournalController::class , 'monitoring'])->name('journal.monitoring');

        // Management Teacher
        Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
        Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
        Route::put('/teacher/update/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('/teacher/delete/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.delete');

        // Management Dudi
        Route::get('/dudi', [DudiController::class, 'index'])->name('dudi.index');
        Route::post('/dudi/store', [DudiController::class, 'store'])->name('dudi.store');
        Route::put('/dudi/update/{dudi}', [DudiController::class, 'update'])->name('dudi.update');
        Route::delete('/dudi/delete/{dudi}', [DudiController::class, 'destroy'])->name('dudi.delete');

        // approve route
        Route::patch('/settings/approve/{StudentRequest}', [SetttingController::class, 'approve'])->name('setting.approve');

        // import excel
        Route::post('/import-students', [StudentController::class, 'import'])->name('student.import');
        Route::get('/student/{name}', [StudentController::class, 'Getbyemail'])->name('student.Getbyemail');
        Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    });

    // Route::group(['middleware' => ['role:student']], function() {
        // Journal student
        // Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
        // Route::post('/journal/store', [JournalController::class, 'store'])->name('journal.store');
        // Route::put('/journal/update/{journal}', [JournalController::class, 'update'])->name('journal.update');
        // Route::delete('/journal/delete/{journal}', [JournalController::class, 'destroy'])->name('journal.delete');

        // // Settings (Student)
        // Route::get('/settings', [SetttingController::class, 'index'])->name('setting.index');
        // Route::put('/update/setting/{student}', [SetttingController::class, 'update'])->name('update.setting');
    // });

    // Route::group(['middleware' => ['role:teacher']], function() {
    //     Route::get('/mentor', [TeacherController::class, 'mentor'])->name('mentor.index');
    //     Route::get('/mentor/journal', [TeacherController::class, 'journal'])->name('mentor.journal.index');
    //     Route::get('/mentor/student', [TeacherController::class, 'student'])->name('mentor.student.index');
    //     Route::get('/detail/student/{student}', [TeacherController::class, 'detailStudent'])->name('detail.student');
    // });
});    
