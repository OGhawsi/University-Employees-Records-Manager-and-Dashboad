<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Public/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/employee', function () {
    return Inertia::render('Employee/Index');
})->middleware(['auth', 'verified'])->name('employee.index');

Route::get('/employee/edit', function () {
    return Inertia::render('Employee/Index');
})->middleware(['auth', 'verified'])->name('employee.edit');


Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');

Route::get('/employee/create', function () {
    return Inertia::render('Employee/Create/Index');
})->middleware(['auth', 'verified'])->name('employee.create');


Route::get('/employee/create/personal', function () {
    return Inertia::render('Employee/Create/Personal');
})->middleware(['auth', 'verified'])->name('employee.create.personal');

Route::get('/employee/create/academic', function () {
    return Inertia::render('Employee/Create/Academic');
})->middleware(['auth', 'verified'])->name('employee.create.academic');


require __DIR__.'/auth.php';
