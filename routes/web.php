<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPermitController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Route::redirect('/', '/login');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('account')->name('account.')->middleware(['auth'])->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::put('update/{user}', [AccountController::class, 'update'])->name('update');
    Route::put('update-student/{student}', [AccountController::class, 'updateStudent'])->name('update-student');
    Route::put('update-teacher/{teacher}', [AccountController::class, 'updateTeacher'])->name('update-teacher');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('create', [StudentController::class, 'create'])->name('create');
        Route::post('store', [StudentController::class, 'store'])->name('store');
        Route::get('show/{student}', [StudentController::class, 'show'])->name('show');
        Route::get('edit/{student}', [StudentController::class, 'edit'])->name('edit');
        Route::put('update/{student}', [StudentController::class, 'update'])->name('update');
        Route::delete('destroy/{student}', [StudentController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('create', [TeacherController::class, 'create'])->name('create');
        Route::post('store', [TeacherController::class, 'store'])->name('store');
        Route::get('show/{teacher}', [TeacherController::class, 'show'])->name('show');
        Route::get('edit/{teacher}', [TeacherController::class, 'edit'])->name('edit');
        Route::put('update/{teacher}', [TeacherController::class, 'update'])->name('update');
        Route::delete('destroy/{teacher}', [TeacherController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [ClassesController::class, 'index'])->name('index');
        Route::get('create', [ClassesController::class, 'create'])->name('create');
        Route::post('store', [ClassesController::class, 'store'])->name('store');
        Route::get('show/{class}', [ClassesController::class, 'show'])->name('show');
        Route::get('edit/{class}', [ClassesController::class, 'edit'])->name('edit');
        Route::put('update/{class}', [ClassesController::class, 'update'])->name('update');
        Route::delete('destroy/{class}', [ClassesController::class, 'destroy'])->name('destroy');

        Route::get('list/{class}', [ClassesController::class, 'list'])->name('list');
        Route::delete('list/delete-student/{student}', [ClassesController::class, 'deleteStudentFromClass'])->name('delete.student-from-class');
        Route::get('list/add-student/{class}', [ClassesController::class, 'addStudentToClassForm'])->name('add.student-to-class.form');
        Route::post('list/add-student/{class}', [ClassesController::class, 'addStudentToClass'])->name('add.student-to-class');
    });
    Route::prefix('room')->name('room.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::get('create', [RoomController::class, 'create'])->name('create');
        Route::post('store', [RoomController::class, 'store'])->name('store');
        Route::get('show/{room}', [RoomController::class, 'show'])->name('show');
        Route::get('edit/{room}', [RoomController::class, 'edit'])->name('edit');
        Route::put('update/{room}', [RoomController::class, 'update'])->name('update');
        Route::delete('destroy/{room}', [RoomController::class, 'destroy'])->name('destroy');

        Route::get('list/{room}', [RoomController::class, 'list'])->name('list');
        Route::delete('list/delete-student/{student}', [RoomController::class, 'deleteStudentFromRoom'])->name('delete.student-from-room');
        Route::get('list/add-student/{room}', [RoomController::class, 'addStudentToRoomForm'])->name('add.student-to-room.form');
        Route::post('list/add-student/{room}', [RoomController::class, 'addStudentToRoom'])->name('add.student-to-room');
    });
    Route::prefix('student-permit')->name('student-permit.')->group(function () {
        Route::get('/', [StudentPermitController::class, 'index'])->name('index');
        Route::get('create', [StudentPermitController::class, 'create'])->name('create');
        Route::post('store', [StudentPermitController::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [StudentPermitController::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [StudentPermitController::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [StudentPermitController::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [StudentPermitController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('announcement')->name('announcement.')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('index');
        Route::get('create', [AnnouncementController::class, 'create'])->name('create');
        Route::post('store', [AnnouncementController::class, 'store'])->name('store');
        Route::get('show/{announcement}', [AnnouncementController::class, 'show'])->name('show');
        Route::get('edit/{announcement}', [AnnouncementController::class, 'edit'])->name('edit');
        Route::put('update/{announcement}', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('destroy/{announcement}', [AnnouncementController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('student')->name('student.')->middleware(['auth', 'can:student'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('permit')->name('permit.')->group(function () {
        Route::get('/', [StudentPermitController::class, 'index'])->name('index');

        Route::get('create', [StudentPermitController::class, 'create'])->name('create');
        Route::post('store', [StudentPermitController::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [StudentPermitController::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [StudentPermitController::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [StudentPermitController::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [StudentPermitController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'can:teacher'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('student-permit')->name('student-permit.')->group(function () {
        Route::get('/', [StudentPermitController::class, 'index'])->name('index');

        Route::get('create', [StudentPermitController::class, 'create'])->name('create');
        Route::post('store', [StudentPermitController::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [StudentPermitController::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [StudentPermitController::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [StudentPermitController::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [StudentPermitController::class, 'destroy'])->name('destroy');
        Route::put('approve/{studentPermit}', [StudentPermitController::class, 'approve'])->name('approve');
    });
    Route::prefix('announcement')->name('announcement.')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('index');
        Route::get('create', [AnnouncementController::class, 'create'])->name('create');
        Route::post('store', [AnnouncementController::class, 'store'])->name('store');
        Route::get('show/{announcement}', [AnnouncementController::class, 'show'])->name('show');
        Route::get('edit/{announcement}', [AnnouncementController::class, 'edit'])->name('edit');
        Route::put('update/{announcement}', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('destroy/{announcement}', [AnnouncementController::class, 'destroy'])->name('destroy');
    });
});
