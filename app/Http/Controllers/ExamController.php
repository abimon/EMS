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
            foreach ($data[0] as $da) {
                if ((($da[1] != null)&&(is_numeric($da[1])))) {
                    Exam::create([
                        'unit_id'=>request()->unit_id,
                        'reg_no' => $da[2],
                        'name' => $da[3],
                        'attempt' => $da[4],
                        'CAT1' => $da[5],
                        'CAT2' => $da[6],
                        'CAT3' => $da[7],
                        'ASN1' => $da[9],
                        'ASN2' => $da[10],
                        'ASN3' => $da[11],
                        'Q1' => $da[14],
                        'Q2' => $da[15],
                        'Q3' => $da[16],
                        'Q4' => $da[17],
                        'Q5' => $da[18],
                        'marks'=>0
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
