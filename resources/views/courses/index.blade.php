@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div>
        <h2 class='text-center'>Courses</h2>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcourse">+ Add Course</button>

        <!-- Modal -->
        <div class="modal fade" id="addcourse" tabindex="-1" aria-labelledby="addcourseLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addcourseLabel">Add Course</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('course.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="course_name" placeholder="Course Name" id="" class="form-control mb-2">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <table class="table table-responsive">
        <thead>
            <tr class="text-uppercase">
                <th>#</th>
                <th>Course</th>
                <th>Department</th>

            </tr>
        </thead>
        <tbody>
            @foreach($courses as $key=>$course)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$course->course_name}}</td>
                <td>{{Auth()->user()->department}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addstu"><i class="fa fa-upload"></i> Students</button>

                    <!-- Modal -->
                    <div class="modal fade" id="addstu" tabindex="-1" aria-labelledby="addstuLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addstuLabel">Upload Students</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('students.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <div class="modal-body">
                                        <p>
                                        Upload Excel sheet containing students in this course. Remember to format columns in the order <b>"registration_no|name|year_of_intake|identifier(if any)"</b> without empty column or headers.
                                        </p>
                                        <input type="file" name="students" placeholder="Students" id="" class="form-control mb-2">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                            Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <button type="button" class="dropdown-item btn btn-success" data-bs-toggle="modal" data-bs-target="#Backdrop{{$course->id}}" tabindex="-1">Update
                                </button>

                            </li>
                            <li><button type="button" class="dropdown-item btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$course->id}}">
                                    Delete
                                </button>

                            </li>
                            <li>
                                <a href="{{route('course.show',$course->id)}}" class="dropdown-item">View Units</a>
                            </li>
                            <li>
                                <a href="{{route('students.index',['id'=>$course->id])}}" class="dropdown-item">View Students</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal fade" id="Backdrop{{$course->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$course->course_name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('course.update', $course->id)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" name="course_name" value="{{$course->course_name}}" id="" class="form-control mb-2">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="staticBackdrop{{$course->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$course->course_name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('course.destroy', $course->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure you want to delete this course?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection