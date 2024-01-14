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
                                    <th>Score</th>
                                </thead>
                                <tbody>
                                    @foreach($exams as $exam)
                                    <tr>
                                        <td>{{$exam->unit_code}}</td>
                                        <td>{{$exam->unit_title}}</td>
                                        @if($exam->CAT!=null && $exam->Exam!=null)
                                        <td>{{($exam->CAT)+($exam->Exam)}}</td>
                                        @else
                                        <td>Missing {{($exam->CAT!=null && $exam->Exam!=null)?'':($exam->Exam!=null?'Exam':'CAT')}} Marks</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <h2 class="card-title">Other</h2>

                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection