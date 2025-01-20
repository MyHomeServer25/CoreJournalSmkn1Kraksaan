<?php

use App\Http\Controllers\DudiController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\SetttingController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () { return view('auth.login'); });
    Auth::routes();



Route::middleware('auth')->group(function () {
        Route::get('/admin', function () { return view('admin.index'); })->name('admin.index');
        Route::get('/student', function () { return view('student.index'); })->name('student.index');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // journal monitoring
        Route::get('/journal/monitoring' , [JournalController::class , 'monitoring'])->name('journal.monitoring');
    // end jornal
    // journal student
        Route::get('/journal' , [JournalController::class , 'index'])->name('journal.index');
        Route::post('/journal/store' , [JournalController::class , 'store'])->name('journal.store');
        Route::put('/journal/update/{journal}' , [JournalController::class , 'update'])->name('journal.update');
        Route::delete('/journal/delete/{journal}' , [JournalController::class , 'destroy'])->name('journal.delete');
    // end journal student
    // teacher
        Route::get('/teacher' , [TeacherController::class , 'index'])->name('teacher.index');
        Route::post('/teacher/store' , [TeacherController::class , 'store'])->name('teacher.store');
        Route::delete('/teacher/delete/{teacher}' , [TeacherController::class , 'destroy'])->name('teacher.delete');
        Route::put('/teacher/update/{teacher}' , [TeacherController::class , 'update'])->name('teacher.update');
    // end teacher
    // dudi
        Route::get('/dudi' , [DudiController::class , 'index'])->name('dudi.index');
        Route::post('/dudi/store' , [DudiController::class , 'store'])->name('dudi.store');
        Route::delete('/dudi/delete/{dudi}' , [DudiController::class , 'destroy'])->name('dudi.delete');
        Route::put('/dudi/update/{dudi}' , [DudiController::class , 'update'])->name('dudi.update');
    // end dudi
    // settings
        Route::get('/settings' , [SetttingController::class , 'index'])->name('setting.index');
        Route::put('/update/setting/{student}' , [SetttingController::class, 'update'])->name('update.setting');
    // end settings

    // teacher
        Route::get('/mentor' , [TeacherController::class , 'mentor'])->name('mentor.index');
        Route::get('/mentor/journal' , [TeacherController::class , 'journal'])->name('mentor.journal.index');
        Route::get('/mentor/student' , [TeacherController::class , 'student'])->name('mentor.student.index');
        Route::get('/detail/student/{student}' , [TeacherController::class , 'detailStudent'])->name('detail.student');
    // end teacher
});
