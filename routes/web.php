<?php

/**
 * Dokumentasi dan Aturan Penulisan Route
 *
 * 1. Penulisan nama alias Class Controller
 *    Gunakan format RoleFitur untuk penamaan alias controller.
 *    Contoh: jika controller tersebut mengelola fitur home untuk role SuperAdmin,
 *    maka penamaannya adalah SuperAdminHome. Pastikan untuk mengikuti konvensi ini
 *    agar mudah dikenali dan dikelompokkan berdasarkan peran.
 *
 * 2. Menambah Route untuk Role Baru
 *    Ketika menambahkan route untuk role baru, gunakan format berikut:
 *
 *    Route::prefix('role')->name('role.')->middleware(['auth', 'can:isRole'])->group(function () {
 *        Route::redirect('/', '/role/home', 301); // Redirect ke halaman home role
 *        Route::get('/home', [RoleHome::class, 'index'])->name('home'); // Mendefinisikan route home
 *        // Di sini, Anda dapat menambahkan semua grup fitur lainnya yang relevan untuk role ini.
 *    });
 *
 * 3. Menambah Fitur di Dalam Route Role
 *    Jika Anda ingin menambahkan fitur di dalam route untuk role tertentu,
 *    gunakan format berikut:
 *
 *    Route::prefix('fiture')->name('fiture.')->group(function () {
 *        // Definisikan semua metode HTTP yang diperlukan seperti get, post, put, delete
 *    });
 */

// **Dependencies**
use App\Http\Controllers\SuperAdmin\TreeViewController as SuperAdminTreeView;
use Illuminate\Support\Facades\Route;

// **Controllers**
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SuperAdmin\HomeController as SuperAdminHome;
use App\Http\Controllers\SuperAdmin\AdminController as SuperAdminAdmin;
use App\Http\Controllers\SuperAdmin\LogViewerController as SuperAdminLogViewer;
use App\Http\Controllers\AdministrationAdmin\HomeController as AdministrationAdminHome;
use App\Http\Controllers\AdministrationAdmin\AnnouncementController as AdministrationAdminAnnouncement;
use App\Http\Controllers\Teacher\AnnouncementController as TeacherAnnouncement;
use App\Http\Controllers\AdministrationAdmin\ClassesController as AdministrationAdminClasses;
use App\Http\Controllers\AdministrationAdmin\RoomController as AdministrationAdminRoom;
use App\Http\Controllers\AdministrationAdmin\StudentController as AdministrationAdminStudent;
use App\Http\Controllers\AdministrationAdmin\StudentPermitController as AdministrationAdminStudentPermit;
use App\Http\Controllers\Student\StudentPermitController as StudentStudentPermit;
use App\Http\Controllers\Teacher\StudentPermitController as TeacherStudentPermit;
use App\Http\Controllers\AdministrationAdmin\TeacherController as AdministrationAdminTeacher;
use App\Http\Controllers\AdministrationAdmin\StudentRegistrantController as AdministrationAdminStudentRegistrant;
use App\Http\Controllers\StudentRegistrant\HomeController as StudentRegistrantHome;

/**
 * **Root**
 */
Route::redirect('/', '/login');

/**
 * **Auth Routes**
 */
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/**
 * **Common Routes**
 */
Route::prefix('account')->name('account.')->middleware(['auth'])->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::put('update/{user}', [AccountController::class, 'update'])->name('update');
    Route::put('update-student/{student}', [AccountController::class, 'updateStudent'])->name('update-student');
    Route::put('update-teacher/{teacher}', [AccountController::class, 'updateTeacher'])->name('update-teacher');
});
Route::prefix('chat')->name('chat.')->middleware(['auth'])->group(function () {
    Route::get('/', [MessageController::class, 'index'])->name('index');
    Route::get('contacts', [MessageController::class, 'contacts'])->name('contacts');
    Route::post('send/', [MessageController::class, 'send'])->name('send');
    Route::get('history/{recipientId}', [MessageController::class, 'history'])->name('history');
    Route::post('read/', [MessageController::class, 'read'])->name('read');
    Route::post('setstatus/{user}', [MessageController::class, 'setStatus'])->name('set-status');
    Route::put('edituser/{user}', [MessageController::class, 'editUser'])->name('edit-user');
});
Route::prefix('kanban')->name('kanban.')->middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('common.kanban.index');
    })->name('index');
    // Route::get('/', [KanbanController::class, 'index'])->name('index');
    // Route::post('create', [KanbanController::class, 'create'])->name('create');
    // Route::put('update/{task}', [KanbanController::class, 'update'])->name('update');
    // Route::delete('delete/{task}', [KanbanController::class, 'destroy'])->name('destroy');
});

/**
 * **Super Admin Routes**
 */
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth', 'can:isSuperAdmin'])->group(function () {
    Route::redirect('/', '/superadmin/home', 301);
    Route::get('/home', [SuperAdminHome::class, 'index'])->name('home');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [SuperAdminAdmin::class, 'index'])->name('index');
        Route::get('create', [SuperAdminAdmin::class, 'create'])->name('create');
        Route::post('store', [SuperAdminAdmin::class, 'store'])->name('store');
        Route::get('show/{admin}', [SuperAdminAdmin::class, 'show'])->name('show');
        Route::get('edit/{admin}', [SuperAdminAdmin::class, 'edit'])->name('edit');
        Route::put('update/{admin}', [SuperAdminAdmin::class, 'update'])->name('update');
        Route::delete('destroy/{admin}', [SuperAdminAdmin::class, 'destroy'])->name('destroy');
    });
    Route::prefix('logviewer')->name('logs.')->group(function () {
        Route::get('/', [SuperAdminLogViewer::class, 'index'])->name('index');
        Route::get('/show/{filename}', [SuperAdminLogViewer::class, 'show'])->name('show');
        Route::delete('/delete/{filename}', [SuperAdminLogViewer::class, 'destroy'])->name('destroy');
        Route::get('/download/{filename}', [SuperAdminLogViewer::class, 'download'])->name('download');
    });
    Route::prefix('foldertree')->name('foldertree.')->middleware(['auth'])->group(function () {
        Route::get('/', [SuperAdminTreeView::class, 'index'])->name('index');
    });
});

/**
 * **Administration Admin Routes**
 */
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
        Route::get('show/{studentRegistrant}', [AdministrationAdminStudentRegistrant::class, 'show'])->name('show');
        Route::put('approve/{studentRegistrant}', [AdministrationAdminStudentRegistrant::class, 'approve'])->name('approve');
        Route::put('reject/{studentRegistrant}', [AdministrationAdminStudentRegistrant::class, 'reject'])->name('reject');
        Route::post('sendNotification', [AdministrationAdminStudentRegistrant::class, 'sendNotification'])->name('sendNotification');
        Route::delete('destroy/{studentRegistrant}', [AdministrationAdminStudentRegistrant::class, 'destroy'])->name('destroy');


        Route::get('indexuser', [AdministrationAdminStudentRegistrant::class, 'indexuser'])->name('indexuser');
        Route::get('createuser', [AdministrationAdminStudentRegistrant::class, 'createuser'])->name('createuser');
        Route::post('storeuser', [AdministrationAdminStudentRegistrant::class, 'storeuser'])->name('storeuser');
        Route::get('edituser/{user}', [AdministrationAdminStudentRegistrant::class, 'edituser'])->name('edituser');
        Route::put('updateuser/{user}', [AdministrationAdminStudentRegistrant::class, 'updateuser'])->name('updateuser');
        Route::delete('destroyuser/{user}', [AdministrationAdminStudentRegistrant::class, 'destroyuser'])->name('destroyuser');
    });
});

/**
 * **Teacher Routes**
 */
Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'can:isTeacher'])->group(function () {
    Route::redirect('/', '/teacher/home', 301);
    Route::get('/home', [AdministrationAdminHome::class, 'index'])->name('home');

    Route::prefix('studentpermit')->name('studentpermit.')->group(function () {
        Route::get('/', [TeacherStudentPermit::class, 'index'])->name('index');
        Route::get('create', [TeacherStudentPermit::class, 'create'])->name('create');
        Route::post('store', [TeacherStudentPermit::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [TeacherStudentPermit::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [TeacherStudentPermit::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [TeacherStudentPermit::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [TeacherStudentPermit::class, 'destroy'])->name('destroy');
        Route::put('approve/{studentPermit}', [TeacherStudentPermit::class, 'approve'])->name('approve');
        Route::put('reject/{studentPermit}', [TeacherStudentPermit::class, 'reject'])->name('reject');
    });
    Route::prefix('announcement')->name('announcement.')->group(function () {
        Route::get('/', [TeacherAnnouncement::class, 'index'])->name('index');
        Route::get('create', [TeacherAnnouncement::class, 'create'])->name('create');
        Route::post('store', [TeacherAnnouncement::class, 'store'])->name('store');
        Route::get('show/{announcement}', [TeacherAnnouncement::class, 'show'])->name('show');
        Route::get('edit/{announcement}', [TeacherAnnouncement::class, 'edit'])->name('edit');
        Route::put('update/{announcement}', [TeacherAnnouncement::class, 'update'])->name('update');
        Route::delete('destroy/{announcement}', [TeacherAnnouncement::class, 'destroy'])->name('destroy');
    });
});

/**
 * **Student Routes**
 */
Route::prefix('student')->name('student.')->middleware(['auth', 'can:isStudent'])->group(function () {
    Route::redirect('/', '/student/home', 301);
    Route::get('/home', [AdministrationAdminHome::class, 'index'])->name('home');

    Route::prefix('permit')->name('permit.')->group(function () {
        Route::get('/', [StudentStudentPermit::class, 'index'])->name('index');
        Route::get('create', [StudentStudentPermit::class, 'create'])->name('create');
        Route::post('store', [StudentStudentPermit::class, 'store'])->name('store');
        Route::get('show/{studentPermit}', [StudentStudentPermit::class, 'show'])->name('show');
        Route::get('edit/{studentPermit}', [StudentStudentPermit::class, 'edit'])->name('edit');
        Route::put('update/{studentPermit}', [StudentStudentPermit::class, 'update'])->name('update');
        Route::delete('destroy/{studentPermit}', [StudentStudentPermit::class, 'destroy'])->name('destroy');
    });
});

/**
 * **Student Registrant Routes**
 */
Route::prefix('studentregistrant')->name('studentregistrant.')->middleware(['auth', 'can:isStudentRegistrant'])->group(function () {
    Route::redirect('/', '/studentregistrant/home', 301);
    Route::get('/home', [StudentRegistrantHome::class, 'index'])->name('home');

    Route::post('store', [StudentRegistrantHome::class, 'store'])->name('store');
    Route::put('update/{studentRegistrant}', [StudentRegistrantHome::class, 'update'])->name('update');
});
