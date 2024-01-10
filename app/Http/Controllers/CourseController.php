<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\University;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $dep= Department::where('uni_id',Auth()->uni_id)->first();
        $course = Course::where('dep_id',$dep->id)->get();
        return view('department.course.index',compact('course'))->with('units','department');
    }

    public function create()
    {
        $dep=Department::where();
        return view('courses.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Course::create([
            'dep_id'=>request()->id,
            'course_name'=>request()->course_name,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        Course::where('id',$id)->update([
            'course_name'=>request()->course_name,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if((Auth()->user()->isAllowed)==true){
            Course::destroy($id);
        }
        return redirect()->back()->with('message','Course deleted successfully.');
    }
}
