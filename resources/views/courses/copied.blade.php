@foreach($exams as $key=>$exam)
                                    @if($exam->semUnit->year==$i)
                                    <?php $total = 0;$status=false;$count=0;?>
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$exam->student->student_name}}</td>
                                        @foreach($uns as $k=>$unit)
                                        <?php 
                                        if($unit->unit->exams->count()>0){$count+=1;}
                                        ?>
                                        @foreach(($unit->unit->exams->where('student_id',$exam->student->id)) as $ex)
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
                                        <td>{{floor($total/$count)}}</td>
                                        @else
                                        <td class="bg-danger text-light">Missing Marks</td>
                                        @endif
                                    </tr>
                                    @endif
                                    @endforeach