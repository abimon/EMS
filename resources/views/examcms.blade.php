@extends('layouts.tables')
@section('content')
<?php
$res = false;
foreach ($students as $s) {
    foreach ($units as $k => $unit) {
        foreach (($unit->exams->where('student_id', $s->id)) as $ex) {
            $res = true;
        }
    }
}
?>
@if($res == true)
<div class="container-fluid row bg-light">
    <div class="col-12">
        <table class="table table-scroll table-info table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    @foreach($units as $unit)
                    <th>{{$unit->unit_code}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($students as $r=>$s)
                <tr>
                    <td>{{$r+1}}</td>
                    <td>{{$s->student_name}} <br> {{$s->reg_no}}</td>
                    @foreach($units as $k=>$unit)
                    @foreach(($unit->exams->where('student_id',$s->id)) as $ex)
                    <td>{{$ex->marks}}</td>
                    @endforeach
                    @endforeach
                </tr>
                @endforeach
            </tbody>

        </table>
        <h2>Unit Key</h2>
    </div>
    <div class="col-md-6">
        <ul>
            @foreach($units as $key=>$unit)
            @if(($key+1)<=4) <p>{{$key+1}}. {{$unit->unit_title}}</p>
                @endif
                @endforeach
                </ol>
    </div>
    <div class="col-md-6">
        <ul>
            @foreach($units as $key=>$unit)
            @if(($key+1)>4)
            <p>{{$unit->unit_code}} {{$unit->unit_title}}</p>
            @endif
            @endforeach
        </ul>
    </div>
</div>
@else
<div class="row">
    <div class="d-flex justify-content-center">
        <div class="col-md-6">
        <div class="card bg-warning p-3">
            @if($units->count()>0)
            <h2>Sorry. There are no students registered in this semester.</h2>
            @else
            <h2>Sorry. There are no units registered in this semester.</h2>
            @endif
        </div>
        </div>
    </div>
</div>
@endif
@endsection