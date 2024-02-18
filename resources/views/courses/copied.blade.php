<!-- <div class="d-flex justify-content-between">
                        <a href="/cms/{{$course->id}}/{{$i}}/1"><button class="btn btn-primary">SEM 1 SCORE LIST</button></a>
                        <a href="/examExport/{{$course->id}}/{{$i}}/1"><button class="btn btn-success">Export Sem 1 CMS</button></a>
                        <a href="/cms/{{$course->id}}/{{$i}}/2"><button class="btn btn-primary">SEM 2 SCORE LIST</button></a>
                        <a href="/examExport/{{$course->id}}/{{$i}}/2"><button class="btn btn-success">Export Sem 2 CMS</button></a>
                        <a href="/cms/{{$course->id}}/{{$i}}/3"><button class="btn btn-primary">SEM 3 SCORE LIST</button></a>
                        <a href="/examExport/{{$course->id}}/{{$i}}/3"><button class="btn btn-success">Export Sem 3 CMS</button></a>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$unit->id}}">
                            <i class="fa fa-upload">
                            </i> Results
                        </button>
                        <div class="modal fade" id="staticBackdrop{{$unit->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Exams</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('exams.store',['unit_id'=>$unit->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <p>Upload Excel sheet containing exam results in this unit. Remember to format columns in the order <b>"student_reg_no | student_name |attempt | CAT_and_Assignment_score | Exam_score"</b> without empty column or headers.</p>

                                            <input type="text" class="form-control" value="{{$unit->unit_code}}" disabled>
                                            <div class="form-group m-1">
                                                <input type="file" name="file" accept=".xls,.xlsx" id="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('exams.show',$unit->id)}}">
                            <button type="button" class=" btn btn-outline-success">
                                <i class="fa fa-eye ms-3"></i> Results
                            </button>
                        </a>
                    </div> -->