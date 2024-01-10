@extends('layouts.app')
 
@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div class="d-flex justify-content-center">
    <h2>Dedan Kimathi University of Technology</h2>
    <h2>Score Sheet</h2>
</div>
<table class="responsive-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Reg. No</th>
            <th>Name</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
            <th>16</th>
        </tr>
    </thead>
</table>
</div>
@endsection