<?php

namespace App\Http\Controllers;

use App\Imports\StudentImport;
use App\Imports\UnitImport;
use App\Models\SemStudents;
use App\Models\SemUnits;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class semStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        request()->validate([
            'students' => 'required|mimes:xlsx,xls',
        ]);
        $file = request()->file('students');
        $notfound=[];
        if ($file) {
            $data = Excel::toCollection(new StudentImport, $file);
            foreach ($data[0] as $da) {
                if ($da[0] != null) {
                    $student=Student::where('reg_no',$da[0])->first();
                    if($student){
                        $student_id=$student->id;
                        SemStudents::create([
                            'sem_id'=>request()->sem_id,
                            'student_id' => $student_id,
                            'year' => $da[1],
                        ]);
                        if($da[2]!=null){
                            Student::where('id',$student_id)->update([
                                'identifier'=>$da[2]
                            ]);
                        }
                    }
                    else{
                        array_push($notfound, $da[0]);
                    } 
                }
            }
            if(count($notfound)<=0){
                return back()->with('message', 'Students uploaded successfully.');
            }
            else{
                return back()->with('error',count($notfound).' student(s) were not found in the system. Their registrations are '.json_encode($notfound));
            }
        }
        return back()->with('error', 'Please Check your file, Something is wrong there.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
