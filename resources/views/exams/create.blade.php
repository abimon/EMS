@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-5 m-1">
                <input type="text" name="unit_title" placeholder="Unit Title eg. Structural Design" class="form-control">
            </div>
            <div class="form-group col-md-5 m-1">
                <input type="file" name="file" accept=".xls,.xlsx" id="file" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
@endsection