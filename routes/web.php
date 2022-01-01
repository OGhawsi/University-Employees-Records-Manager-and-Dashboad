<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UniversityController;

Route::get('/', function () {
    return Inertia::render('Public/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/employees/export', [ReportController::class, 'export'])->name('report.export')->middleware(['auth', 'verified']);

Route::get('/dashboard', DashboardController::class)
        ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/setting', [UniversityController::class, 'edit'])
        ->middleware(['auth', 'verified'])->name('setting');
Route::put('/setting/{university}', [UniversityController::class, 'update'])
        ->middleware(['auth', 'verified'])->name('setting.update');

Route::middleware(['auth', 'verified'])
        ->prefix('rank')
        ->group( function() {
            // routes for the academic rank names 
            Route::get('/', [RankController::class, 'addRank'])->name('rank.addRank');
            Route::post('/', [RankController::class, 'storeRank'])->name('rank.storeRank');
            Route::get('/edit/{rank}', [RankController::class, 'editRank'])->name('rank.editRank');
            Route::put('/{rank}', [RankController::class, 'updateRank'])->name('rank.updateRank');
            Route::delete('/{rank}', [RankController::class, 'destroyRank'])->name('rank.deleteRank');
});


// reports routes
Route::get('/report', [ReportController::class, 'index'])
        ->middleware(['auth','verified'])
        ->name('report.index');
        // Faculty routes
Route::middleware(['auth', 'verified'])
    ->prefix('faculty')
    ->group(function () {
        Route::get('/{faculty}', [FacultyController::class, 'index'])->name('faculty.index');
        Route::post('/', [FacultyController::class, 'store'])->name('faculty.store');
        Route::get('/new/create', [FacultyController::class, 'create'])->name('faculty.create');
        Route::get('/edit/{faculty}', [FacultyController::class, 'edit'])->name('faculty.edit');
        Route::put('/{faculty}', [FacultyController::class, 'update'])->name('faculty.update');
        Route::delete('/{faculty}', [FacultyController::class, 'destroy'])->name('faculty.delete');
});
// department routes
Route::middleware(['auth', 'verified'])
    ->prefix('department')
    ->group(function () {
        Route::post('/', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/{faculty}/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::get('/edit/{department}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('department.update');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('department.delete');
});
Route::middleware(['auth', 'verified'])
    ->prefix('employee')
    ->group(function () {
        // basic info 
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/{employee}/show', [EmployeeController::class, 'show'])->name('employee.show');
        Route::post('/', [EmployeeController::class, 'store'])->name('employee.store');
       
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('employee.delete');
        Route::put('/avatar/{employee}', [EmployeeController::class, 'addAvatar'])->name('employee.addAvatar');
        Route::delete('/avatar/{employee}', [EmployeeController::class, 'removeAvatar'])->name('employee.removeAvatar');

        // degree routes
        Route::prefix('/{employee}/degree')->group( function() {
            Route::post('/', [DegreeController::class, 'store'])->name('degree.store');
            Route::get('/create', [DegreeController::class, 'create'])->name('degree.create');
        });
        Route::prefix('/degree') -> group(function() {
            Route::delete('degree/{degree}', [DegreeController::class, 'destroy'])->name('degree.delete');
            Route::put('degree/{degree}', [DegreeController::class, 'update'])->name('degree.update');
            Route::get('degree/edit/{degree}', [DegreeController::class, 'edit'])->name('degree.edit');
        });
        // address routes
        Route::prefix('/{employee}/address')->group( function() {
            Route::post('/', [AddressController::class, 'store'])->name('address.store');
            Route::get('/create', [AddressController::class, 'create'])->name('address.create');
        });
        Route::prefix('/address')->group(function() {
            Route::delete('/{address}', [AddressController::class, 'destroy'])->name('address.delete');
            Route::put('/{address}', [AddressController::class, 'update'])->name('address.update');
            Route::get('/edit/{address}', [AddressController::class, 'edit'])->name('address.edit');
        });

        // employment routes
        Route::prefix('/{employee}/employment')->group( function() {
            Route::post('/', [EmploymentController::class, 'store'])->name('employment.store');
            Route::get('/create', [EmploymentController::class, 'create'])->name('employment.create');
        });
        Route::prefix('/employment')->group(function() {
            Route::delete('/{employment}', [EmploymentController::class, 'destroy'])->name('employment.delete');
            Route::put('/{employment}', [EmploymentController::class, 'update'])->name('employment.update');
            Route::get('/edit/{employment}', [EmploymentController::class, 'edit'])->name('employment.edit');
        });

        // rank routes
        Route::prefix('/{employee}/rank')->group( function() {
            Route::post('/', [RankController::class, 'store'])->name('rank.store');
            Route::get('/create', [RankController::class, 'create'])->name('rank.create');
        });
        Route::prefix('/rank')->group(function() {
            Route::delete('/{pivot}', [RankController::class, 'destroy'])->name('rank.delete');

            Route::put('/{employee}', [RankController::class, 'update'])->name('rank.update');
            
            Route::get('/edit/{employee}/{rank}', [RankController::class, 'edit'])->name('rank.edit');

           

        });


        // attachment routes
        Route::prefix('/{employee}/attachment')->group( function() {
            Route::post('/', [AttachmentController::class, 'store'])->name('attachment.store');
            Route::get('/create', [AttachmentController::class, 'create'])->name('attachment.create');
        });
        Route::prefix('/attachment')->group(function() {
            Route::delete('/{attachment}', [AttachmentController::class, 'destroy'])->name('attachment.delete');
            Route::put('/{attachment}', [AttachmentController::class, 'update'])->name('attachment.update');
            // Route::get('/show/{attachment}', [AttachmentController::class, 'show'])->name('attachment.show');
            Route::get('/download/{attachment}', [AttachmentController::class, 'download'])->name('attachment.download');
        });
});
require __DIR__.'/auth.php';
