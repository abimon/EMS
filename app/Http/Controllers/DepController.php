<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\University;
use Illuminate\Http\Request;

class DepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deps=Department::where('uni_id',Auth()->user()->uni_id)->get();
        $univ = University::where('id',Auth()->user()->uni_id)->first();
        return view('department.index',compact('deps','univ'))->with('courses');
    }

    public function create()
    {
        return view('department.create');
    }

    public function store()
    {
        Department::create([
            'uni_id'=>Auth()->user()->uni_id,
            'dep_name'=>request()->dep_name,
            'faculty'=>request()->faculty,
        ]);
        return redirect()->route('department.index');
    }
    public function show($name)
    {
        $dep = Department::where([['dep_name',$name],['uni_id',Auth()->user()->uni_id]])->first();
        return view('department.show',compact('dep'))->with('courses');
    }

    public function edit($name)
    {
        
    }

    public function update($id)
    {
        Department::where('id',$id)->update([
            'uni_id'=>Auth()->user()->uni_id,
            'dep_name'=>request()->dep_name,
            'faculty'=>request()->faculty,
        ]);
        return redirect()->route('department.index');
    }

    public function destroy($id)
    {
        $dep = Department::where([['id',$id],['uni_id',Auth()->user()->uni_id]])->first();
        if($dep && ((Auth()->user()->isAllowed)==true)){
            Department::destroy($id);
        }
        return redirect()->route('department.index');
    }
}
