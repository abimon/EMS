@extends('layouts.admin')
@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <img src="{{asset('storage/images/user.png')}}" alt="Profile" class="rounded-circle">
                    <h2>{{$student->student_name}}</h2>
                    <h3>{{$student->reg_no}}</h3>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change">Update Student</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Records</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Results</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Student Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8">{{$student->student_name}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Reg. No</div>
                                <div class="col-lg-9 col-md-8">{{$student->reg_no}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Intake Year</div>
                                <div class="col-lg-9 col-md-8">{{$student->intake}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Identifier</div>
                                <div class="col-lg-9 col-md-8">{{$student->identifier}}</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit" id="profile-edit">
                            <h2 class="card-title">Records</h2>
                            <ul>
                                @foreach($records as $rec)
                                <li>{{$rec->comment}}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="profile-settings">
                            <h2 class="card-title">Results</h2>
                            <table class="table table-responsive">
                                <thead>
                                    <th>Unit Code</th>
                                    <th>Unit Name</th>
                                    <th>CAT</th>
                                    <th>Exam</th>
                                </thead>
                                <tbody>
                                    @foreach($exams as $exam)
                                    <tr>
                                        <td data-bs-toggle="modal" type='button' data-bs-target="#exam{{$exam->id}}">{{$exam->unit_code}}</td>
                                        <td>{{$exam->unit_title}}</td>
                                        <td>{{$exam->CAT}}</td>
                                        <td>{{$exam->Exam}}</td>
                                    </tr>
                                    <div class="modal fade" id="exam{{$exam->id}}" tabindex="-1" aria-labelledby="addstuLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="addstuLabel">{{$exam->unit_title}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{route('exams.update',$exam->id)}}" method="get" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <input type="text" name="CAT" placeholder=" " id="" class="form-control mb-2" value="{{$exam->CAT}}">
                                                            <label for="">CAT</label>
                                                        </div>
                                                        <div class="form-floating">
                                                            <input type="text" name="Exam" placeholder=" " id="" class="form-control mb-2" value="{{$exam->Exam}}">
                                                            <label for="">Exam</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-change">
                            <h2 class="card-title">Edit Student</h2>
                            <form action="{{route('students.update',$student->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-floating">
                                        <input type="text" name="student_name" value="{{$student->student_name}}" id="" class="form-control mb-2">
                                        <label for="">Student Name</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" name="reg_no" value="{{$student->reg_no}}" id="" class="form-control mb-2">
                                        <label for="">Student Reg. No.</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" name="intake" value="{{$student->intake}}" id="" class="form-control mb-2">
                                        <label for="">Student Intake Year</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" name="identifier" value="{{$student->identifier}}" id="" class="form-control mb-2">
                                        <label for="">Student Identifier</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('students.destroy',$student->id)}}"><button type="button" class="btn btn-danger">Delete</button></a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection