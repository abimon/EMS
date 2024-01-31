<?php

// namespace App\Exports;

// use App\Models\Course;
// use App\Models\Department;
// use App\Models\Exam;
// use App\Models\Pass;
// use App\Models\Unit;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class ExamExport implements FromCollection
// {
//     /**
//      * @return \Illuminate\Support\Collection
//      */
//     public function collection()
//     {
//         $dep = Department::where('dep_name', Auth()->user()->department)->first();
//         $course = Course::where('dep_id', $dep->id)->get();
//         $passes=collect();
//         foreach ($course as $c) {
//             $units = Unit::where('course_id', $c->id)->get();
//             foreach ($units as $unit) {
//                 $pass= Pass::where('unit_code', $unit->id)->join('exams','exams.id','=','passes.exam_id')->join('students','students.id','=','exams.student_id')->select(
//                     'passes.id',
//                     'students.student_name',
//                     'students.reg_no',
//                     'exams.marks'
//                     )->get();

//                 $passes->put($unit->unit_title,$pass);
//             }
//         }
//         return $passes;
//     }

// }

namespace App\Exports;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Pass;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExamExport implements FromView
{
    protected $sem;
    protected $course_id;
    protected $year;

    function __construct($course_id,$year,$sem)
    {
        $this->sem = $sem;
        $this->course_id = $course_id;
        $this->year = $year;
    }
    public function view(): View
    {
        $students = Student::all();
        $pass = Pass::all();
        $units = Unit::where([['course_id', $this->course_id],['sem', $this->sem], ['yearG', $this->year]])->get();
        // return view('examcms', compact('students','units'))->with('exams');
        return view('exports.exam', compact('students', 'units','pass'))->with('exams');
    }
}
