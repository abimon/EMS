<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use App\Models\Department;
use App\Models\Exam;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/home',function(){return redirect('/');} );
Route::middleware('auth')->group(function(){
    Route::resources([
        'exams'=>ExamController::class,
        'department'=>DepController::class,
        'course'=>CourseController::class,
        'user'=>UserController::class,
        'unit'=>UnitController::class,
        'students'=>StudentController::class,
        ]);

    Route::get('/dashboard',function(){return view('dashboard');} );
    Route::get('/profile',function(){
        $fac = Department::where('uni_id',Auth()->user()->uni_id)->first();
        return view('profile',compact('fac'));
    } );
    Route::get('/student',[StudentController::class,'edit']);

    Route::get('/cms/{i}/{y}/{s}',[ExamController::class,'edit']);
    Route::get('/examExport/{c}/{y}/{s}',[ExamController::class,'exExam']);
});
Auth::routes();

