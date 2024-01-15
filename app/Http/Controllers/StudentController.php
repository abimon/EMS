<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Models\Exam;
use App\Models\Stata;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
   
    public function index()
    {
        $users=Student::where('course_id',request()->id)->get();
        return view('students.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        request()->validate([
            'students' => 'required|mimes:xlsx,xls',
        ]);
        $file = request()->file('students');
        if ($file) {
            $data = Excel::toCollection(new StudentImport, $file);
            // return $data[0][0][1];
            foreach ($data[0] as $da) {
                if ($da[0] != null) {
                    Student::create([
                        "course_id"=>request()->course_id,
                        "student_name"=>$da[1],
                        "reg_no"=>$da[0],
                        "intake"=>$da[2],
                        "identifier"=>$da[3]
                    ]);
                    
                }
            }
            return back()->with('message', 'Student registered successfully.');
        }
        return back()->with('message', 'Please Check your file, Something is wrong there.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $exams=Exam::where('student_id',$id)->join('units','units.id','=','exams.unit_id')->select('exams.*','units.unit_code','units.unit_title')->get();
        $student = Student::findOrFail($id);
        $records = Stata::where('student_id',$id)->get();
        return view('students.show',compact('student','exams','records'));
    }

    public function edit(Student $student)
    {
        $users=Student::all();
        return view('students.index',compact('users'));
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }
}