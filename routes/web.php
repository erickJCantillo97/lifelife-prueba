<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\EmployeeController;
use App\Imports\UsersImport;
use App\Models\Access;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', [EmployeeController::class , 'index'])->middleware(['auth'])->name('dashboard');

Route::post('/employees', [EmployeeController::class , 'store'])->middleware(['auth'])->name('employees.store');
Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee');

Route::post('/employees/loadMasive', function(Request $request){
    $import = Excel::Import(new UsersImport, $request->file);  
    return back();   
})->middleware(['auth'])->name('employees.loadMasive');

Route::post('/employees/{employee}', [EmployeeController::class , 'destroy'])->middleware(['auth'])->name('employees.delete');
Route::post('/employees/update/{employee}', [EmployeeController::class , 'update'])->middleware(['auth'])->name('employees.update');

Route::post('/employeedissabled' ,function(Request $request){
    $employee = Employee::where('id', $request->id)->first();
    $employee->dissabled = !$request->status; 
    $employee->save();
    return back();
})->name('dissabled');

Route::get('/access', [AccessController::class, 'index'])->name('access');

Route::get('exportPDF', function(){
    $access = Access::get();
    $pdf = PDF::loadview('exports.access', ['access' => $access]);
    return $pdf->stream();
})->name('exportPDF');

require __DIR__.'/auth.php';
