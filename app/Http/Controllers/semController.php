<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Sem;
use App\Models\SemStudents;
use App\Models\SemUnits;
use Illuminate\Http\Request;

class semController extends Controller
{
    public function index()
    {
        $sems = Sem::where('dep_id',Auth()->user()->department_id)->get();
        return view('sem.index',compact('sems'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Sem::create([
            'dep_id'=>Auth()->user()->department_id,
            'timelines'=>(request()->from).'-'.(request()->to),
            'year'=>date('Y'),
            'sem'=>request()->sem,
            'status'=>1
        ]);
        return redirect()->back();
    }

    public function show($id)
    {
        $sem = Sem::findOrFail($id);
        $exams = Exam::where('sem_id',$id)->get();
        $semStudents=SemStudents::where('sem_id',$id)->get();
        $uns = SemUnits::where('sem_id',$id)->get();
        return view('sem.show',compact('sem','exams','uns','semStudents'))->with('units','sem','results','students','sem','semUnit','student','unit');
    }

    public function edit(string $id)
    {

    }

    public function update($id)
    {
        $sem=Sem::findOrFail($id);
        if($sem->status==0){
            $status = 1;
        }
        else{
            $status = 0;
        }
        Sem::where('id',$id)->update(['status'=>$status]);
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        Sem::destroy($id);
        return redirect()->back();
    }
}
