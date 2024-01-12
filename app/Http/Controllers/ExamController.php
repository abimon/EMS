<?php

namespace App\Http\Controllers;

use App\Imports\ExamImport;
use App\Models\Exam;
use App\Models\ExamTotal;
use App\Models\Unit;
use App\Models\University;
use Illuminate\Http\Request;
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
            ExamTotal::create([
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
                    Exam::create([
                        'unit_id'=>request()->unit_id,
                        'reg_no' => $da[2],
                        'name' => $da[3],
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
                    
                }
                
            }
        return back()->with('message', 'Results recorded successfully.');

        }
        return back()->with('message', 'Please Check your file, Something is wrong there.');
    }


    public function show($id)
    {
        $items=Exam::where('unit_id',$id)->orderBy('reg_no','asc')->get();
        $units = Unit::all();
        $totals=ExamTotal::where('unit_id',$id)->first();
        return view('exams.index',compact('items','units','totals'));
    }

    public function edit(Exam $exam)
    {
        
    }

    public function update(Request $request, Exam $exam)
    {
        //
    }

    public function destroy(Exam $exam)
    {
        //
    }
}
