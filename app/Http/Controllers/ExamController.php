<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Imports\ExamImport;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamTotal;
use App\Models\Pass;
use App\Models\SemUnits;
use App\Models\Special;
use App\Models\Stata;
use App\Models\Student;
use App\Models\Sup;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index()
    {
        $items=Exam::orderBy('reg_no','asc')->get();
        $units = SemUnits::all();
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
            // return $data;
            foreach ($data[0] as $da) {
                if ($da[0] != null) {
                    $stude=Student::where('reg_no',$da[0])->orWhere('student_name',$da[1])->first();
                    $id=$stude->id;
                    $unit = SemUnits::findOrFail(request()->unit_id);
                    $exam=Exam::create([
                        'unit_id'=>$unit->id,
                        'sem_id'=>$unit->sem_id,
                        'student_id'=>$id,
                        'attempt'=>$da[2],
                        'CAT'=>$da[3],
                        'Exam'=>$da[4]
                    ]);
                    
                    if($da[3]==null||$da[4]==null){

                        if($da[3]==null){
                            Sup::create([
                                'exam_id'=>$exam->id,
                                'student_id'=>$id
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
                                'student_id'=>$id
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
                                'student_id'=>$id
                            ]);
                        }
                        elseif($g>0){
                            Sup::create([
                                'exam_id'=>$exam->id,
                                'student_id'=>$id
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
                                'student_id'=>$id
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
        $exams = Exam::where('sem_id',$id)->get();
        return view('exams.index',compact('exams'))->with('sem','semUnit','student');
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
    public function exExam($c,$y,$sem){
        $cor = (Course::findOrFail($c))->course_name;
        return Excel::download(new ExamExport($c,$y,$sem), $cor.'_year_'.$y.'_sem_'.$sem.'_exam_results.xlsx');
    }
}
