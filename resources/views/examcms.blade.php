@extends('layouts.tables')
@section('content')
<table class="table table-scroll table-info table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Student</th>
            @foreach($units as $key=>$unit)
            <th>{{$key+1}}</th>
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
@endsection