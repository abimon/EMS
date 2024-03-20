<?php

namespace App\Http\Controllers;

use App\Exports\ExamExport;
use App\Imports\ExamImport;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamTotal;
use App\Models\Pass;
use App\Models\Sem;
use App\Models\SemStudents;
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
        $items = Exam::orderBy('reg_no', 'asc')->get();
        $units = SemUnits::all();
        return view('exams.index', compact('items', 'units'));
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
                    $stude = Student::where('reg_no', $da[0])->orWhere('student_name', $da[1])->first();
                    $id = $stude->id;
                    $unit = SemUnits::findOrFail(request()->unit_id);
                    $exam = Exam::create([
                        'unit_id' => $unit->id,
                        'sem_id' => $unit->sem_id,
                        'student_id' => $id,
                        'attempt' => $da[2],
                        'CAT' => $da[3],
                        'Exam' => $da[4]
                    ]);

                    if ($da[3] == null || $da[4] == null) {

                        if ($da[3] == null) {
                            Sup::create([
                                'exam_id' => $exam->id,
                                'student_id' => $id
                            ]);
                            Stata::create([
                                'student_id' => $id,
                                'comment' => 'CAT Marks missing for the unit ' . ($unit->unit_code) . ' ' . ($unit->unit_title),
                                'author_id' => Auth()->user()->id
                            ]);
                        }
                        if ($da[4] == null) {
                            Sup::create([
                                'exam_id' => $exam->id,
                                'student_id' => $id
                            ]);
                            Stata::create([
                                'student_id' => $id,
                                'comment' => 'Exam Marks missing for the unit ' . ($unit->unit_code) . ' ' . ($unit->unit_title),
                                'author_id' => Auth()->user()->id
                            ]);
                        }
                    } else {
                        $g = $da[3] + $da[4];
                        if ($g > 40) {
                            Pass::create([
                                'exam_id' => $exam->id,
                                'student_id' => $id
                            ]);
                        } elseif ($g > 0) {
                            Sup::create([
                                'exam_id' => $exam->id,
                                'student_id' => $id
                            ]);
                            Stata::create([
                                'student_id' => $id,
                                'comment' => 'Supplimentary exam on the unit ' . ($unit->unit_code) . ' ' . ($unit->unit_title),
                                'author_id' => Auth()->user()->id
                            ]);
                        } else {
                            Special::create([
                                'exam_id' => $exam->id,
                                'student_id' => $id
                            ]);
                            Stata::create([
                                'student_id' => $id,
                                'comment' => 'Special exam on the unit ' . ($unit->unit_code) . ' ' . ($unit->unit_title),
                                'author_id' => Auth()->user()->id
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
        $exams = Exam::where('sem_id', $id)->get();
        return view('exams.index', compact('exams'))->with('sem', 'semUnit', 'student');
    }

    public function edit($id, $year, $sem)
    {
        $students = Student::all();
        $units = Unit::where([['course_id', $id], ['yearG', $year], ['sem', $sem]])->get();
        return view('examcms', compact('students', 'units'))->with('exams');
    }

    public function update($id)
    {
        Exam::where('id', $id)->update(['Exam' => request()->Exam, 'CAT' => request()->CAT]);
        return redirect()->back();
    }

    public function destroy(Exam $exam)
    {
        //
    }
    public function exExam($c, $y, $sem)
    {
        $cor = (Course::findOrFail($c))->course_name;
        
        return Excel::download(new ExamExport($c, $y, $sem), $cor . '_year_' . $y . '_sem_' . $sem . '_exam_results.xlsx');

    }
    public function SenateDoc($year,$sem)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $nf = new \NumberFormatter('en',\NumberFormatter::SPELLOUT);
        $section = $phpWord->addSection();
        $phpWord->addFontStyle('r2Style', array('bold'=>true, 'italic'=>false, 'size'=>12,'underline'=>true));
        $phpWord->addParagraphStyle('p2Style', array('align'=>'center'));
        $students = Student::all();
        $exams = Exam::where('sem_id', $sem)->get();
        $units = SemUnits::where([['sem_id',$sem],['year',$year]])->get();
        $passes=[];
        $carry=[];
        $fails=[];
        $unkown=[];
        $p=0;$f=0;$c=0;
        $pass=0;
        foreach ($students as $student) {
            $semStudent = true;
            $semUnit = true;
            $pass = 0;
            foreach ($units as $unit) {
                if (!(Exam::where('unit_id', $unit->unit_id)->first())) {
                    $semUnit = false;
                }
            }
            if (!SemStudents::find($student->id)) {
                $semStudent = false;
            }
            foreach ($exams->where('student_id', $student->id) as $exam) {
                if (($exam->CAT != null) && ($exam->Exam != null)) {
                    $total = ($exam->CAT) + ($exam->Exam);
                    if ($total >= 30) {
                        $pass += 1;
                    }
                }
            }
            // array_push($passes, ["name" => $student->student_name, "passed" => $pass . '/' . ($units->count())]);
            if ($semStudent == true && $semUnit == true && $pass == ($units->count())) {
                array_push($passes,['name'=>$student->student_name,'reg'=>$student->reg_no]);
            }
            elseif($semStudent == false && $semUnit == true && $pass == ($units->count())){
                array_push($carry,['name'=>$student->student_name,'reg'=>$student->reg_no]);
            }
            elseif($semStudent == true && $semUnit == true && $pass < ($units->count())){
                array_push($fails,['name'=>$student->student_name,'reg'=>$student->reg_no]);
            }
            else{
                array_push($unkown,['name'=>$student->student_name,'reg'=>$student->reg_no]);
            }
        }
        // return $passes;
        $table = $section->addTable();
        $table->addRow();
        $table->addCell()->addText('PASS',);
        $table->addCell(2050)->addText(count($passes));
        $table->addRow();
        $table->addCell()->addText('FAIL',);
        $table->addCell(2050)->addText(count($fails));

        $section->addText('PASS','r2Style','p2Style');
        $section->addText('The following '.$nf->format(count($passes)).' ('.count($passes).') candidate(s) satisfied the School of Engineering Board of Examiners in the 2019/2020 Academic Year SESSION IX (AUGUST-DECEMBER 2019) Examinations for the Bachelor of Science in Civil Engineering – Module III.');
        $table = $section->addTable();
        $table->addRow();
        $table->addCell()->addText('No.',array('bold'=>true));
        $table->addCell(2050)->addText('Reg. No.',array('bold'=>true));
        $table->addCell()->addText('Name',array('bold'=>true));
        foreach($passes as $pass){
            $table->addRow();
            $table->addCell()->addText($p+1);
            $table->addCell()->addText($pass['reg']);
            $table->addCell()->addText($pass['name']);
            $p+=1;
        }
        
        $section->addText('FAIL','r2Style','p2Style');
        $section->addText('The following '.$nf->format(count($fails)).' ('.count($fails).') candidate(s) failed to satisfy the School of Engineering Board of Examiners in the units indicated against their names during the 2019/2020 Academic Year SESSION IX (AUGUST-DECEMBER 2019) Examinations for the Bachelor of Science in Civil Engineering – Module III.');
        $table = $section->addTable();
        $table->addRow();
        $table->addCell()->addText('No.',array('bold'=>true));
        $table->addCell(2050)->addText('Reg. No.',array('bold'=>true));
        $table->addCell()->addText('Name',array('bold'=>true));
        foreach($fails as $fa){
            $table->addRow();
            $table->addCell()->addText($f+1);
            $table->addCell()->addText($fa['reg']);
            $table->addCell()->addText($fa['name']);
            $f+=1;
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $name='Year_'.$year.'_'.((Sem::find($sem))->sem).'_Sem_'.'_Senate_Document.docx';
        $objWriter->save($name);
        return response()->download(public_path($name));
    }
}
