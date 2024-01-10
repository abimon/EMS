<?php

namespace App\Http\Controllers;

use App\Imports\ExamImport;
use App\Models\Exam;
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
        return view('exams.index',compact('items','units'));
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
