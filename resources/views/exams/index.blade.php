@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="modal-footer">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by Name or Reg. No..." class="m-2 form-control w-50">
    </div>
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <table class="table table-responsive table-striped-columns" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Reg. No</th>
                <th>Name</th>
                <th>Attempt</th>
                <th>CAT 1</th>
                <th>CAT 2</th>
                <th>CAT 3</th>
                <th>ASN 1</th>
                <th>ASN 2</th>
                <th>ASN 3</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th>Q5</th>
                <!-- <th>1</th>
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
            <th>16</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($items as $key=>$item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->reg_no}} <br> <small>{{$item->name}}</small></td>
                <td>{{$item->attempt}}</td>
                <td class="{{$item->CAT1==''?'bg-info':''}}">{{$item->CAT1}}</td>
                <td class="{{$item->CAT2==''?'bg-info':''}}">{{$item->CAT2}}</td>
                <td class="{{$item->CAT3==''?'bg-info':''}}">{{$item->CAT3}}</td>
                <td class="{{$item->ASN1==''?'bg-info':''}}">{{$item->ASN1}}</td>
                <td class="{{$item->ASN2==''?'bg-info':''}}">{{$item->ASN2}}</td>
                <td class="{{$item->ASN3==''?'bg-info':''}}">{{$item->ASN3}}</td>
                <td class="{{$item->Q1==''?'bg-info':''}}">{{$item->Q1}}</td>
                <td class="{{$item->Q2==''?'bg-info':''}}">{{$item->Q2}}</td>
                <td class="{{$item->Q3==''?'bg-info':''}}">{{$item->Q3}}</td>
                <td class="{{$item->Q4==''?'bg-info':''}}">{{$item->Q4}}</td>
                <td class="{{$item->Q5==''?'bg-info':''}}">{{$item->Q5}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection