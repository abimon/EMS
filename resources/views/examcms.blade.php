@extends('layouts.tables')
@section('content')
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
@endsection