@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Marks Register</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Marks Register</h3>
                            </div>
                            <form action="" method="get">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>Exam</label>
                                            <select class="form-control" name="exam_id" required>
                                                <option value="">Select</option>
                                                @foreach ($getExam as $exam)
                                                    <option {{ Request::get('exam_id') == $exam->exam_id ? 'selected' : '' }}
                                                        value="{{ $exam->exam_id }}">{{ $exam->exam_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Class</label>
                                            <select class="form-control" name="class_id" required>
                                                <option value="">Select</option>
                                                @foreach ($getClass as $class)
                                                    <option {{ Request::get('class_id') == $class->class_id ? 'selected' : '' }}
                                                        value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <button class="btn btn-primary" type="submit"
                                                style="margin-top:30px">Search</button>
                                            <a href="{{ url('admin/examinations/marks_register') }}" class="btn btn-success"
                                                style="margin-top:30px">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @include('message')

                        @if (!empty($getSubject) && !empty($getSubject->count()))

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Marks Register</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                @foreach ($getSubject as $subject)
                                                    <th>{{ $subject->subject_name }} <br>
                                                        ({{ $subject->subject_type }} : {{ $subject->passing_marks }} /
                                                        {{ $subject->full_marks }})
                                                    </th>
                                                @endforeach
                                                <th> ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($getStudent) && !empty($getStudent->count()))
                                                @foreach ($getStudent as $student)
                                                    <form action="" name="post" class="SubmitForm"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="student_id"
                                                            value="{{ $student->id }}">
                                                        <input type="hidden" name="exam_id"
                                                            value="{{ Request::get('exam_id') }}">
                                                        <input type="hidden" name="class_id"
                                                            value="{{ Request::get('class_id') }}">
                                                        <tr>
                                                            <td>{{ $student->name }} {{ $student->last_name }}</td>
                                                            @php
                                                                $i = 1;
                                                                $totalStudentMarks = 0;
                                                                $totalFullMarks = 0;
                                                                $totalPassingMarks = 0;
                                                                $pass_fail_vali = 0;
                                                            @endphp
                                                            @foreach ($getSubject as $subject)
                                                                @php
                                                                    $totalMark = 0;
                                                                    $totalFullMarks = $totalFullMarks + $subject->full_marks;
                                                                    $totalPassingMarks = $totalPassingMarks + $subject->passing_marks;

                                                                    $getMark = $subject->getMark(
                                                                        $student->id,
                                                                        Request::get('exam_id'),
                                                                        Request::get('class_id'),
                                                                        $subject->subject_id,
                                                                    );
                                                                    if (!empty($getMark)) {
                                                                        $totalMark =
                                                                            $getMark->class_work +
                                                                            $getMark->home_work +
                                                                            $getMark->test_work +
                                                                            $getMark->exam;
                                                                    }

                                                                    $totalStudentMarks = $totalStudentMarks + $totalMark;
                                                                @endphp
                                                                <td>
                                                                    <div class="mb-2">Class Work
                                                                        <input type="hidden"
                                                                        name="mark[{{ $i }}][full_marks]"
                                                                        value="{{ $subject->full_marks }}">

                                                                    <input type="hidden"
                                                                        name="mark[{{ $i }}][passing_marks]"
                                                                        value="{{ $subject->passing_marks }}">

                                                                        <input type="hidden"
                                                                            name="mark[{{ $i }}][id]"
                                                                            value="{{ $subject->id }}">
                                                                        <input type="hidden"
                                                                            name="mark[{{ $i }}][subject_id]"
                                                                            value="{{ $subject->subject_id }}">
                                                                        <input type="text"
                                                                            id="class_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            name="mark[{{ $i }}][class_work]"
                                                                            value ="{{ !empty($getMark->class_work) ? $getMark->class_work : '' }}"
                                                                            class="form-control" placeholder="Enter Marks"
                                                                            style="width: auto">
                                                                    </div>
                                                                    <div class="mb-2">Home Work
                                                                        <input type="text"
                                                                            id="home_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            name="mark[{{ $i }}][home_work]"
                                                                            value ="{{ !empty($getMark->home_work) ? $getMark->home_work : '' }}"class="form-control"
                                                                            placeholder="Enter Marks" style="width: auto">
                                                                    </div>
                                                                    <div class="mb-2">Test Work
                                                                        <input type="text"
                                                                            id="test_work_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            name="mark[{{ $i }}][test_work]"
                                                                            value ="{{ !empty($getMark->test_work) ? $getMark->test_work : '' }}"
                                                                            class="form-control" placeholder="Enter Marks"
                                                                            style="width: auto">
                                                                    </div>
                                                                    <div class="mb-2">Exam
                                                                        <input type="text"
                                                                            id="exam_{{ $student->id }}{{ $subject->subject_id }}"
                                                                            name="mark[{{ $i }}][exam]"
                                                                            value ="{{ !empty($getMark->exam) ? $getMark->exam : '' }}"
                                                                            class="form-control" placeholder="Enter Marks"
                                                                            style="width: auto">
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <button type="button"
                                                                            class="btn btn-primary SaveSingleSubject"
                                                                            id="{{ $student->id }}"
                                                                            data-val="{{ $subject->subject_id }}"
                                                                            data-exam="{{ Request::get('exam_id') }}"
                                                                            data-class="{{ Request::get('class_id') }}"
                                                                            data-schedule="{{ $subject->id }}">Save</button>

                                                                        @if (!empty($getMark))
                                                                    </div class="mb-2">
                                                                    @php
                                                                    $getLoopGrade = App\Models\MarksGradeModel::getGrade($totalMark);
                                                                    @endphp
                                                                    <b>Total Marks :</b> {{ $totalMark }} <br>
                                                                    <b>Passing Marks :</b>
                                                                    <span
                                                                        class="text-primary">{{ $subject->passing_marks }}</span>
                                                                    <br>
                                                                    @if (!empty($getLoopGrade))
                                                                    <b>Grade :</b> {{ $getLoopGrade }} <br>
                                                                    @endif
                                                                    @if (!empty($totalMark >= $subject->passing_marks))
                                                                       Result : <span class="text-success"><b>Passed</b></span>
                                                                    @else
                                                                       Result : <span class="text-danger"><b>Failed</b></span>
                                                                        @php
                                                                            $pass_fail_vali = 1;
                                                                        @endphp
                                                                    @endif
                                                                    <div>
                                                            @endif


                                </div>
                                </td>

                                @php
                                    $i++;
                                @endphp
                        @endforeach
                        <td>
                            <button type="submit" class="btn btn-success">Save</button> <br> <br>

                            @if (!empty($totalStudentMarks))
                                <b>Total Subject Marks :</b>{{ $totalFullMarks }} <br>
                                <b>Total Passing Marks :</b>{{ $totalPassingMarks }} <br>
                                <b>Total Student Marks :</b>{{ $totalStudentMarks }} <br>
                                @php
                                    $percentage = ($totalStudentMarks / $totalFullMarks) * 100;
                                    $getGrade = App\Models\MarksGradeModel::getGrade($percentage);

                                @endphp <br>
                                    <b>Percentage :</b> {{ round($percentage, 2) }}%
                                    <br>
                                @if (!empty($getGrade))
                                    <b>Grade :</b> {{ $getGrade }}
                                    <br>
                                @endif
                                @if ($pass_fail_vali == 0 )
                                    Result : <span class="text-success"><b>Passed</b></span>
                                @else
                                    Result : <span class="text-danger"><b>Failed</b></span>
                                @endif
                            @endif
                        </td>
                        </tr>
                        </form>
                        @endforeach
                        @endif
                        </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
    </div>
    </div>
    </section>
    <!-- /.content -->
    </div>

@endsection

@section('script')
    .
    <script type="text/javascript">
        $('.SubmitForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('teacher/submit_marks_register') }}",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                }
            });
        });

        $('.SaveSingleSubject').click(function(e) {
            var student_id = $(this).attr('id');
            var subject_id = $(this).attr('data-val');
            var exam_id = $(this).attr('data-exam');
            var class_id = $(this).attr('data-class');
            var id = $(this).attr('data-schedule');
            var class_work = $('#class_work_' + student_id + subject_id).val();
            var home_work = $('#home_work_' + student_id + subject_id).val();
            var test_work = $('#test_work_' + student_id + subject_id).val();
            var exam = $('#exam_' + student_id + subject_id).val();

            $.ajax({
                type: "POST",
                url: "{{ url('teacher/single_submit_marks_register') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    student_id: student_id,
                    subject_id: subject_id,
                    exam_id: exam_id,
                    class_id: class_id,
                    class_work: class_work,
                    home_work: home_work,
                    test_work: test_work,
                    exam: exam
                },
                dataType: "json",
                success: function(data) {
                    alert(data.message);
                }
            });
        });
    </script>
@endsection
