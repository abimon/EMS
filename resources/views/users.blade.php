@extends('layouts.admin')
@section('content')
<table class="table table-scroll table-info table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone No.</th>
            <th scope="col">Institution</th>
            <th scope="col">Duration</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $key=>$user)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->contact}}</td>
            <td>{{$user->univ->uni_name}}</td>
            <td>{{($user->updated_at)->diffForHumans()}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection