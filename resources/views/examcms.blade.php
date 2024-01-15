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
        <table class="table table-scroll table-info  table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    @foreach($units as $unit)
                    @if($unit->exams->count()!=null)
                    <th>{{$unit->unit_code}}</th>
                    @endif
                    @endforeach
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $r=>$s)
                <?php $total = 0; $status=false;?>
                <tr>
                    <td>{{$r+1}}</td>
                    <td>{{$s->student_name}} <br> {{$s->reg_no}}</td>
                    @foreach($units as $k=>$unit)
                    @foreach(($unit->exams->where('student_id',$s->id)) as $ex)
                    @if(($ex->CAT!=null) && ($ex->Exam!=null))
                    <?php $total += ($ex->CAT)+($ex->Exam);?>
                    <td >{{($ex->CAT)+($ex->Exam)}}</td>
                    @else
                    <?php $status = true;?>
                    <td class="{{($ex->CAT==null && $ex->Exam==null)?'bg-danger':(($ex->CAT==null)?'bg-primary':'bg-warning')}}">INCOMPLETE</td>
                    @endif
                    @endforeach
                    @endforeach
                    @if($status == false)
                    <td>{{$total}}</td>
                    @else
                    <td class="bg-danger text-light">Missing Marks</td>
                    @endif
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