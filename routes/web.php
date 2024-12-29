<?php
// GLOBAL
use Illuminate\Support\Facades\Route;
// AUTH
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AccountController;
// SUPER ADMIN
use App\Http\Controllers\SuperAdmin\HomeController as SuperAdminHome;
use App\Http\Controllers\SuperAdmin\LogViewerController as SuperAdminLogViewer;
// ADMINISTRATION ADMIN
use App\Http\Controllers\AdministrationAdmin\HomeController as AdministrationAdminHome;
use App\Http\Controllers\AdministrationAdmin\AnnouncementController as AdministrationAdminAnnouncement;
use App\Http\Controllers\AdministrationAdmin\ClassesController as AdministrationAdminClasses;
use App\Http\Controllers\AdministrationAdmin\RoomController as AdministrationAdminRoom;
use App\Http\Controllers\AdministrationAdmin\StudentController as AdministrationAdminStudent;
use App\Http\Controllers\AdministrationAdmin\StudentPermitController as AdministrationAdminStudentPermit;
use App\Http\Controllers\AdministrationAdmin\TeacherController as AdministrationAdminTeacher;
use App\Http\Controllers\AdministrationAdmin\StudentRegistrantController as AdministrationAdminStudentRegistrant;
// STUDENT
// STUDENT REGISTRANT
use App\Http\Controllers\StudentRegistrant\HomeController as StudentRegistrantHome;

// Route::get('/', function () {
//     return view('index');
// });
// AUTH
Route::redirect('/', '/login');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// ACCOUNT
Route::prefix('account')->name('account.')->middleware(['auth'])->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::put('update/{user}', [AccountController::class, 'update'])->name('update');
    Route::put('update-student/{student}', [AccountController::class, 'updateStudent'])->name('update-student');
    Route::put('update-teacher/{teacher}', [AccountController::class, 'updateTeacher'])->name('update-teacher');
});
// SUPER ADMIN
Route::prefix('superadmin')->name('superadministrationadmin.')->middleware(['auth', 'can:isSuperAdmin'])->group(function () {
    Route::redirect('/', '/superadmin/home', 301);
    Route::get('/home', [SuperAdminHome::class, 'index'])->name('home');
    // log Viewer
    Route::prefix('log-viewer')->name('logs.')->group(function () {
        Route::get('/', [SuperAdminLogViewer::class, 'index'])->name('index');
        Route::get('/show/{filename}', [SuperAdminLogViewer::class, 'show'])->name('show');
        Route::delete('/delete/{filename}', [SuperAdminLogViewer::class, 'destroy'])->name('destroy');
        Route::get('/download/{filename}', [SuperAdminLogViewer::class, 'download'])->name('download');
    });
});
// ADMINISTRATION ADMIN
Route::prefix('administrationadmin')->name('administrationadmin.')->middleware(['auth', 'can:isAdministrationAdmin'])->group(function () {
    Route::redirect('/', '/administrationadmin/home', 301);
    Route::get('/home', [AdministrationAdminHome::class, 'index'])->name('home');

    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/', [AdministrationAdminStudent::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminStudent::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminStudent::class, 'store'])->name('store');
        Route::get('show/{student}', [AdministrationAdminStudent::class, 'show'])->name('show');
        Route::get('edit/{student}', [AdministrationAdminStudent::class, 'edit'])->name('edit');
        Route::put('update/{student}', [AdministrationAdminStudent::class, 'update'])->name('update');
        Route::delete('destroy/{student}', [AdministrationAdminStudent::class, 'destroy'])->name('destroy');
    });
    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/', [AdministrationAdminTeacher::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminTeacher::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminTeacher::class, 'store'])->name('store');
        Route::get('show/{teacher}', [AdministrationAdminTeacher::class, 'show'])->name('show');
        Route::get('edit/{teacher}', [AdministrationAdminTeacher::class, 'edit'])->name('edit');
        Route::put('update/{teacher}', [AdministrationAdminTeacher::class, 'update'])->name('update');
        Route::delete('destroy/{teacher}', [AdministrationAdminTeacher::class, 'destroy'])->name('destroy');
    });
    Route::prefix('class')->name('class.')->group(function () {
        Route::get('/', [AdministrationAdminClasses::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminClasses::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminClasses::class, 'store'])->name('store');
        Route::get('show/{class}', [AdministrationAdminClasses::class, 'show'])->name('show');
        Route::get('edit/{class}', [AdministrationAdminClasses::class, 'edit'])->name('edit');
        Route::put('update/{class}', [AdministrationAdminClasses::class, 'update'])->name('update');
        Route::delete('destroy/{class}', [AdministrationAdminClasses::class, 'destroy'])->name('destroy');
        Route::get('list/{class}', [AdministrationAdminClasses::class, 'list'])->name('list');
        Route::delete('list/delete-student/{student}', [AdministrationAdminClasses::class, 'deleteStudentFromClass'])->name('delete.student-from-class');
        Route::get('list/add-student/{class}', [AdministrationAdminClasses::class, 'addStudentToClassForm'])->name('add.student-to-class.form');
        Route::post('list/add-student/{class}', [AdministrationAdminClasses::class, 'addStudentToClass'])->name('add.student-to-class');
    });
    Route::prefix('room')->name('room.')->group(function () {
        Route::get('/', [AdministrationAdminRoom::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminRoom::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminRoom::class, 'store'])->name('store');
        Route::get('show/{room}', [AdministrationAdminRoom::class, 'show'])->name('show');
        Route::get('edit/{room}', [AdministrationAdminRoom::class, 'edit'])->name('edit');
        Route::put('update/{room}', [AdministrationAdminRoom::class, 'update'])->name('update');
        Route::delete('destroy/{room}', [AdministrationAdminRoom::class, 'destroy'])->name('destroy');
        Route::get('list/{room}', [AdministrationAdminRoom::class, 'list'])->name('list');
        Route::delete('list/delete-student/{student}', [AdministrationAdminRoom::class, 'deleteStudentFromRoom'])->name('delete.student-from-room');
        Route::get('list/add-student/{room}', [AdministrationAdminRoom::class, 'addStudentToRoomForm'])->name('add.student-to-room.form');
        Route::post('list/add-student/{room}', [AdministrationAdminRoom::class, 'addStudentToRoom'])->name('add.student-to-room');
    });
    Route::prefix('studentpermit')->name('studentpermit.')->group(function () {
        Route::get('/', [AdministrationAdminStudentPermit::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminStudentPermit::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminStudentPermit::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [AdministrationAdminStudentPermit::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [AdministrationAdminStudentPermit::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [AdministrationAdminStudentPermit::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [AdministrationAdminStudentPermit::class, 'destroy'])->name('destroy');
    });
    Route::prefix('announcement')->name('announcement.')->group(function () {
        Route::get('/', [AdministrationAdminAnnouncement::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminAnnouncement::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminAnnouncement::class, 'store'])->name('store');
        Route::get('show/{announcement}', [AdministrationAdminAnnouncement::class, 'show'])->name('show');
        Route::get('edit/{announcement}', [AdministrationAdminAnnouncement::class, 'edit'])->name('edit');
        Route::put('update/{announcement}', [AdministrationAdminAnnouncement::class, 'update'])->name('update');
        Route::delete('destroy/{announcement}', [AdministrationAdminAnnouncement::class, 'destroy'])->name('destroy');
    });
    Route::prefix('studentregistrant')->name('studentregistrant.')->group(function () {
        Route::get('/', [AdministrationAdminStudentRegistrant::class, 'index'])->name('index');
        // user
        Route::get('user', [AdministrationAdminStudentRegistrant::class, 'user'])->name('user');
        Route::get('create', [AdministrationAdminStudentRegistrant::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminStudentRegistrant::class, 'store'])->name('store');
        Route::get('edit/{user}', [AdministrationAdminStudentRegistrant::class, 'edit'])->name('edit');
        Route::put('update/{user}', [AdministrationAdminStudentRegistrant::class, 'update'])->name('update');
        Route::delete('destroy/{user}', [AdministrationAdminStudentRegistrant::class, 'destroy'])->name('destroy');
        //student registrant list
        Route::get('show/{studentRegistrant}', [AdministrationAdminStudentRegistrant::class, 'show'])->name('show');
        Route::put('accept/{studentRegistrant}', [AdministrationAdminStudentRegistrant::class, 'accept'])->name('accept');
        Route::post('sendNotification', [AdministrationAdminStudentRegistrant::class, 'sendNotification'])->name('sendNotification');
    });
});
// TEACHER
Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'can:isTeacher'])->group(function () {
    Route::redirect('/', '/teacher/home', 301);
    Route::get('/home', [AdministrationAdminHome::class, 'index'])->name('home');

    Route::prefix('studentpermit')->name('studentpermit.')->group(function () {
        Route::get('/', [AdministrationAdminStudentPermit::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminStudentPermit::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminStudentPermit::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [AdministrationAdminStudentPermit::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [AdministrationAdminStudentPermit::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [AdministrationAdminStudentPermit::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [AdministrationAdminStudentPermit::class, 'destroy'])->name('destroy');
        Route::put('approve/{studentPermit}', [AdministrationAdminStudentPermit::class, 'approve'])->name('approve');
    });
    Route::prefix('announcement')->name('announcement.')->group(function () {
        Route::get('/', [AdministrationAdminAnnouncement::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminAnnouncement::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminAnnouncement::class, 'store'])->name('store');
        Route::get('show/{announcement}', [AdministrationAdminAnnouncement::class, 'show'])->name('show');
        Route::get('edit/{announcement}', [AdministrationAdminAnnouncement::class, 'edit'])->name('edit');
        Route::put('update/{announcement}', [AdministrationAdminAnnouncement::class, 'update'])->name('update');
        Route::delete('destroy/{announcement}', [AdministrationAdminAnnouncement::class, 'destroy'])->name('destroy');
    });
});
// STUDENT
Route::prefix('student')->name('student.')->middleware(['auth', 'can:isStudent'])->group(function () {
    Route::redirect('/', '/student/home', 301);
    Route::get('/home', [AdministrationAdminHome::class, 'index'])->name('home');

    Route::prefix('permit')->name('permit.')->group(function () {
        Route::get('/', [AdministrationAdminStudentPermit::class, 'index'])->name('index');
        Route::get('create', [AdministrationAdminStudentPermit::class, 'create'])->name('create');
        Route::post('store', [AdministrationAdminStudentPermit::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [AdministrationAdminStudentPermit::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [AdministrationAdminStudentPermit::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [AdministrationAdminStudentPermit::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [AdministrationAdminStudentPermit::class, 'destroy'])->name('destroy');
    });
});
//STUDENT REGISTRANT
Route::prefix('studentregistrant')->name('studentregistrant.')->middleware(['auth', 'can:isStudentRegistrant'])->group(function () {
    Route::redirect('/', '/studentregistrant/home', 301);
    Route::get('/home', [StudentRegistrantHome::class, 'index'])->name('home');

    Route::post('store', [StudentRegistrantHome::class, 'store'])->name('store');
    // Route::put('update', [StudentRegistrantHome::class, 'update'])->name('update');
});
