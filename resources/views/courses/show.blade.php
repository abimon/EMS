@extends('layouts.app')
@section('content')
<div class="container">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <ul class="nav nav-tabs">
            <li class="nav-item accordion-item">
                <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Semester 1
                </a>
            </li>
            <li class="nav-item accordion-item">
                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                    Semester 2
                </a>
            </li>
            <li class="nav-item accordion-item">
                <a class="nav-link" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                    Semester 3
                </a>
            </li>
        </ul>
        <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder 1</div>
        </div>
        <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder 2</div>
        </div>
        <div id="flush-collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">Placeholder 3</div>
        </div>
    </div>
</div>
@endsection