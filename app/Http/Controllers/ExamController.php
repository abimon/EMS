<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Imports\ExamImport;
use App\Models\Exam;
use App\Models\ExamTotal;
use App\Models\Pass;
use App\Models\Special;
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
            $t=ExamTotal::create([
                'unit_id'=>request()->unit_id,
                'CAT1'=>$data[0][15][5],
                'CAT2'=>$data[0][15][6],
                'CAT3'=>$data[0][15][7],
                'CAT_total'=>$data[0][15][8],
                'ASN1'=>$data[0][15][9],
                'ASN2'=>$data[0][15][10],
                'ASN3'=>$data[0][15][11],
                'ASN_total'=>$data[0][15][12],
                'Q1'=>$data[0][15][14],
                'Q2'=>$data[0][15][15],
                'Q3'=>$data[0][15][16],
                'Q4'=>$data[0][15][17],
                'Q5'=>$data[0][15][18],
                'exam_total'=>$data[0][15][19]
            ]);
            $count1=0;
            $count2=0;
            $count3=0;
            $count4=0;
            $count5=0;
            $count6=0;
            $students=0;
            $CAT1_t=$data[0][15][5];
            $CAT2_t=$data[0][15][6];
            $CAT3_t=$data[0][15][7];
            $CAT_total=$data[0][15][8];
            $ASN1_t=$data[0][15][9];
            $ASN2_t=$data[0][15][10];
            $ASN3_t=$data[0][15][11];
            $ASN_total=$data[0][15][12];
            foreach ($data[0] as $da) {
                if(($da[1] != null)&&(is_numeric($da[1]))){
                    $students+=1;
                    if($da[5]==null){$count1+=1;}
                    if($da[6]==null){$count2+=1;}
                    if($da[7]==null){$count3+=1;}
                    if($da[9]==null){$count4+=1;}
                    if($da[10]==null){$count5+=1;}
                    if($da[11]==null){$count6+=1;}
                }
            }
            foreach ($data[0] as $da) {
                if ((($da[1] != null)&&(is_numeric($da[1])))) {
                    if ($da[7] != null) {
                        if ($da[6] != null) {
                            if ($da[5] != null) {
                                $c_total = ((($da[5]) / ($CAT1_t)) + (($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 3;
                            } else {
                                if ($count1 == $students) {
                                    $c_total = ((($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 2;
                                } else {
                                    $c_total = ((($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 3;
                                }
                            }
                        } else {
                            if ($count2 == $students) {
                                $c_total = ($da[7]) / ($CAT3_t);
                            } else {
                                $c_total =(($da[7]) / ($CAT3_t))/2;
                            }
                        }
                    }
                    else{
                        if($count3 == $students){
                            if ($da[6] != null) {
                                if ($da[5] != null) {
                                    $c_total = ((($da[5]) / ($CAT1_t)) + (($da[6]) / ($CAT2_t))) / 2;
                                } else {
                                    if ($count1 == $students) {
                                        $c_total = ((($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 2;
                                    } else {
                                        $c_total = ((($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 3;
                                    }
                                }
                            } else {
                                if ($count2 == $students) {
                                    if($da[5] != null){
                                        $c_total = ($da[5]) / ($CAT1_t);
                                    }
                                    else{
                                        $c_total=0;
                                    }
                                } else {
                                    $c_total =(($da[7]) / ($CAT3_t))/2;
                                }
                            }
                        }
                        else{
                            if ($da[6] != null) {
                                if ($da[5] != null) {
                                    $c_total = ((($da[5]) / ($CAT1_t)) + (($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 3;
                                } else {
                                    if ($count1 == $students) {
                                        $c_total = ((($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 2;
                                    } else {
                                        $c_total = ((($da[6]) / ($CAT2_t))+(($da[7]) / ($CAT3_t))) / 3;
                                    }
                                }
                            } else {
                                if ($count2 == $students) {
                                    $c_total = ($da[7]) / ($CAT3_t);
                                } else {
                                    $c_total =(($da[7]) / ($CAT3_t))/2;
                                }
                            }
                        }
                    }

                    if ($da[11] != null) {
                        if ($da[10] != null) {
                            if ($da[9] != null) {
                                $a_total = ((($da[9]) / ($ASN1_t)) + (($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 3;
                            } else {
                                if ($count4 == $students) {
                                    $a_total = ((($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 2;
                                } else {
                                    $a_total = ((($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 3;
                                }
                            }
                        } else {
                            if ($count5 == $students) {
                                $a_total = ($da[11]) / ($ASN3_t);
                            } else {
                                $a_total =(($da[11]) / ($ASN3_t))/2;
                            }
                        }
                    }
                    else{
                        if($count6 == $students){
                            if ($da[10] != null) {
                                if ($da[9] != null) {
                                    $a_total = ((($da[9]) / ($ASN1_t)) + (($da[10]) / ($ASN2_t))) / 2;
                                } else {
                                    if ($count4 == $students) {
                                        $a_total = ((($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 2;
                                    } else {
                                        $a_total = ((($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 3;
                                    }
                                }
                            } else {
                                if ($count5 == $students) {
                                    if($da[9] != null){
                                        $a_total = ($da[9]) / ($ASN1_t);
                                    }
                                    else{
                                        $a_total=0;
                                    }
                                } else {
                                    $a_total =(($da[11]) / ($ASN3_t))/2;
                                }
                            }
                        }
                        else{
                            if ($da[10] != null) {
                                if ($da[9] != null) {
                                    $a_total = ((($da[9]) / ($ASN1_t)) + (($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 3;
                                } else {
                                    if ($count4 == $students) {
                                        $a_total = ((($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 2;
                                    } else {
                                        $a_total = ((($da[10]) / ($ASN2_t))+(($da[11]) / ($ASN3_t))) / 3;
                                    }
                                }
                            } else {
                                if ($count5 == $students) {
                                    $a_total = ($da[11]) / ($ASN3_t);
                                } else {
                                    $a_total =(($da[11]) / ($ASN3_t))/2;
                                }
                            }
                        }
                    }
                    $c=round($c_total*($CAT_total),1);
                    $a=round($a_total*($ASN_total),1);
                    $m=($da[14])+($da[15])+($da[16])+($da[17])+($da[18]);
                    $g = round($m+$c+$a);
                    $stu = Student::where('student_name',$da[3])->where('reg_no',$da[2])->first();
                    if(!$stu){
                        $stu=Student::create([
                            'student_name'=>$da[3],
                            'reg_no'=>$da[2]
                        ]);
                    }
                    $exam=Exam::create([
                        'unit_id'=>request()->unit_id,
                        'student_id' => $stu->id,
                        't_id' => $t->id,
                        'attempt' => $da[4],
                        'CAT1' => $da[5],
                        'CAT2' => $da[6],
                        'CAT3' => $da[7],
                        'CAT_t'=>$c,
                        'ASN1' => $da[9],
                        'ASN2' => $da[10],
                        'ASN3' => $da[11],
                        'ASN_t'=>$a,
                        'Q1' => $da[14],
                        'Q2' => $da[15],
                        'Q3' => $da[16],
                        'Q4' => $da[17],
                        'Q5' => $da[18],
                        'Exam_t'=>$m,
                        'marks'=>$g
                    ]);
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
                    }
                    else{
                        Special::create([
                            'exam_id'=>$exam->id,
                            'unit_code'=>$exam->unit_id
                        ]);
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
        $totals=ExamTotal::where('unit_id',$id)->first();
        return view('exams.index',compact('items','unit','totals','pass','specs','sups'));
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
    public function exExam($id,$year){
        // return Excel::download(new ExamExport, (Auth()->user()->department).'B.xlsx', null, ['X-Vapor-Base64-Encode' => 'True']);
        return Excel::download(new ExamExport, 'exam.xlsx');
    }
}
