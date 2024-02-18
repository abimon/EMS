<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Sem;
use App\Models\SemStudents;
use App\Models\SemUnits;
use Illuminate\Http\Request;

class semController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sems = Sem::where('dep_id',Auth()->user()->department_id)->get();
        return view('sem.index',compact('sems'));
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
        // return request()->from;
        Sem::create([
            'dep_id'=>Auth()->user()->department_id,
            'timelines'=>(request()->from).'-'.(request()->to),
            'year'=>date('Y'),
            'sem'=>request()->sem,
            'status'=>1
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $students=SemStudents::where('sem_id',$id)->get();
        // $units = SemUnits::where('sem_id',$id)->get();
        $sem = Sem::findOrFail($id);
        // $results = Exam::where('sem_id',$id)->get();
        return view('sem.show',compact('sem'))->with('units','sem','results','students');
    }

    public function edit(string $id)
    {
        //
    }

    public function update($id)
    {
        $sem=Sem::findOrFail($id);
        // return $sem;
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
