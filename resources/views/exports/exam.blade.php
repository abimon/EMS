<?php
$res = false;
$pre = false;
foreach ($students as $s) {
    foreach ($units as $k => $unit) {
        foreach (($unit->exams->where('student_id', $s->id)) as $ex) {
            $res = true;
            foreach ($pass->where('exam_id', $ex->id) as $pas) {
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
            <th>Reg. No.</th>
            <th>Name</th>
            @foreach($units as $unit)
            @if($unit->exams->count()!=null)
            <th>{{$unit->unit_code}}</th>
            @endif
            @endforeach
            <th>Total</th>
            <th>Units</th>
            <th>Average</th>
            <th>Recomm.</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $r=>$s)
        <?php $total = 0;$u=0;
        $status = false; ?>
        <tr>
            <td>{{$s->student_name}}</td>
            <td>{{$s->reg_no}}</td>
            @foreach($units as $k=>$unit)
            @foreach(($unit->exams->where('student_id',$s->id)) as $ex)
            <?php $u+=1;?>
            @if(($ex->CAT!=null) && ($ex->Exam!=null))
            <?php $total += ($ex->CAT) + ($ex->Exam); ?>
            <td>{{($ex->CAT)+($ex->Exam)}}</td>
            @else
            <?php $status = true; ?>
            @if($ex->CAT==null && $ex->Exam==null)
            <td style="background-color:red; color:white;">INCOMPLETE</td>
            @elseif($ex->CAT==null)
            <td style="background-color:blue; color:white;">INCOMPLETE</td>
            @else
            <td style="background-color:yellow; color:black;">INCOMPLETE</td>
            @endif
            @endif
            @endforeach
            @endforeach
            @if($status == false)
            <td>{{$total}}</td>
            <td>{{$u}}</td>
            <td>{{$total/$u}}</td>
            @if(($total/$u)>40)
                <td style="color:green">PASS</td>
                @else
                <td style="color:red;">SUPP</td>
                @endif
            
            @else
            <td style="background-color:red; color:white;">Missing Marks</td>
            <td></td>
            <td></td>
            <td style="background-color: red;">SUPP</td>
            @endif
            
        </tr>
        @endforeach
    </tbody>
    <tr>
    <tr>Unit Key</tr>
        @foreach($units as $key=>$unit)
        <tr><td>{{$unit->unit_code}}</td><td>{{$unit->unit_title}}</td></tr>
        @endforeach
</table>
@endif