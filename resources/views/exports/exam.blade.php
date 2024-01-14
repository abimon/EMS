<?php
$res = false;
$pre = false;
foreach ($students as $s) {
    foreach ($units as $k => $unit) {
        foreach (($unit->exams->where('student_id', $s->id)) as $ex) {
            $res = true;
            foreach($pass->where('exam_id',$ex->id) as $pas){
                $pre = true;
            }
        }
        
    }
    
}
?>
@if($res == true)
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Reg. No.</th>
            @foreach($units as $unit)
            <th>{{$unit->unit_code}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($students as $r=>$s)
        <tr>
            <td>{{$r+1}}</td>
            <td>{{$s->student_name}}</td>
            <td>{{$s->reg_no}}</td>
            <?php
            $unix=[];
            foreach($units as $k=>$unit)
            {
                foreach(($unit->exams->where('student_id',$s->id)) as $ex){
                    $un = $unit->unit_code;
                    $marks=$ex->marks;
                    array_push($unix,[$un,$marks]);
                }
            }
            ?>
            @foreach($unix as $unit)
            {{$unit[0][1]}}
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
@endif