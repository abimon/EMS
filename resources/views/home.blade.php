@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{asset('storage/images/exam.png')}}" alt="" style="width:100%;">
        </div>
        <div class="col-md-6 p-2">
            <h1 class="text-center">Exam Management System</h1>
            <p>Take your department to another level with our systems. Upload a list of score sheets and process your final results. Manage student scores from CATs, Assignments and final exams with verdicts on supplimentaries, specials or met expectetions.</p>
            <h4 class="text-center">Pricing</h4>
            <p>Our pricing happens to be so much friendly. We also help you integrate services such as SMS, mailing etc in your application(s).</p>
            <a href="https://wa.me/+254701583807"><button class="btn btn-success"><i class="fa-brands fa-whatsapp"></i>  Whatsapp Chat</button></a>
        </div>
    </div>
</div>
@endsection