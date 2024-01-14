<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Imports\ExamImport;
use App\Models\Exam;
use App\Models\ExamTotal;
use App\Models\Pass;
use App\Models\Special;
use App\Models\Stata;
use App\Models\Student;
use App\Models\Sup;
use App\Models\Unit;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index()
    {
        $items=Exam::orderBy('reg_no','asc')->get();
        $units = Unit::all();
        return view('exams.index',compact('items','units'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store()
    {
        request()->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        $file = request()->file('file');
        if ($file) {
            $data = Excel::toCollection(new ExamImport, $file);
            
            foreach ($data[0] as $da) {
                if ($da[0] != null) {
                    // student_reg_no|attempt|CAT_and_Assignment_score|Exam_score
                    $stude=Student::where('reg_no',$da[0])->orWhere('student_name',$da[1])->first();
                    // return $stude;
                    $id=$stude->id;
                    $unit = Unit::findOrFail(request()->unit_id);
                    
                    $exam=Exam::create([
                        'unit_id'=>request()->unit_id,
                        'student_id'=>$id,
                        'attempt'=>$da[2],
                        'CAT'=>$da[3],
                        'Exam'=>$da[4]
                    ]);
                    
                    if($da[3]==null||$da[4]==null){

                        if($da[3]==null){
                            Sup::create([
                                'exam_id'=>$exam->id,
                                'unit_code'=>$exam->unit_id
                            ]);
                            Stata::create([
                                'student_id'=>$id,
                                'comment'=>'CAT Marks missing for the unit '.($unit->unit_code).' '.($unit->unit_title),
                                'author_id'=>Auth()->user()->id
                            ]);
                        }
                        if($da[4]==null){
                            Sup::create([
                                'exam_id'=>$exam->id,
                                'unit_code'=>$exam->unit_id
                            ]);
                            Stata::create([
                                'student_id'=>$id,
                                'comment'=>'Exam Marks missing for the unit '.($unit->unit_code).' '.($unit->unit_title),
                                'author_id'=>Auth()->user()->id
                            ]);
                        }
                    }
                    else{
                        $g=$da[3]+$da[4];
                        if($g>40){
                            Pass::create([
                                'exam_id'=>$exam->id,
                                'unit_code'=>$exam->unit_id
                            ]);
                        }
                        elseif($g>0){
                            Sup::create([
                                'exam_id'=>$exam->id,
                                'unit_code'=>$exam->unit_id
                            ]);
                            Stata::create([
                                'student_id'=>$id,
                                'comment'=>'Supplimentary exam on the unit '.($unit->unit_code).' '.($unit->unit_title),
                                'author_id'=>Auth()->user()->id
                            ]);
                        }
                        else{
                            Special::create([
                                'exam_id'=>$exam->id,
                                'unit_code'=>$exam->unit_id
                            ]);
                            Stata::create([
                                'student_id'=>$id,
                                'comment'=>'Special exam on the unit '.($unit->unit_code).' '.($unit->unit_title),
                                'author_id'=>Auth()->user()->id
                            ]);
                        }
                    }
                }
            }
        return back()->with('message', 'Results recorded successfully.');

        }
        return back()->with('message', 'Please Check your file, Something is wrong there.');
    }

    public function show($id)
    {
        $items=Exam::where('unit_id',$id)->orderBy('reg_no','asc')->join('students','student_id','=','students.id')->select('exams.*','students.student_name','students.reg_no')->get();
        $unit = Unit::where('id',$id)->first();
        $pass = Pass::where('unit_code',$id)->get();
        $specs = Special::where('unit_code',$id)->get();
        $sups = Sup::where('unit_code',$id)->get();
        return view('exams.index',compact('items','unit','pass','specs','sups'));
    }

    public function edit($id,$year,$sem)
    {
        $students=Student::all();
        $units=Unit::where([['course_id',$id],['yearG',$year],['sem',$sem]])->get();
        return view('examcms',compact('students','units'))->with('exams');
    }

    public function update(Request $request, Exam $exam)
    {
        //
    }

    public function destroy(Exam $exam)
    {
        //
    }
    public function exExam($i,$c,$y){
        // return Excel::download(new ExamExport, (Auth()->user()->department).'B.xlsx', null, ['X-Vapor-Base64-Encode' => 'True']);
        return Excel::download(new ExamExport($i,$c,$y), 'exam.xlsx');
    }
}
