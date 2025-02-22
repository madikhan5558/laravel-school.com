@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exam Result <span class="text-primary">({{$getStudent->name}} {{$getStudent->last_name}})</span></h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

            @foreach ($getRecord as $value)
            <div class="col-md-12">

              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title text-primary"><b>{{ $value['exam_name'] }}</b></h3>
                  </div>
                  <div class="card-body p-0">
                      <table class="table table-striped">
                      <thead>
                          <tr>
                          <th>Subject</th>
                          <th>Class Work</th>
                          <th>Home Work</th>
                          <th>Test Work</th>
                          <th>Exam</th>
                          <th>Total Score</th>
                          <th>Passing Marks</th>
                          <th>Full Marks</th>
                          <th>Result</th>
                          </tr>
                      </thead>
                      <tbody>
                            @php
                                $total_score = 0;
                                $full_marks = 0;
                                $result_validation = 0;
                            @endphp
                          @foreach ($value['subject'] as $exam)

                          @php
                              $total_score = $total_score + $exam['total_score'];
                              $full_marks = $full_marks + $exam['full_marks'];
                          @endphp

                          <tr class="">
                              <td>{{ $exam['subject_name'] }}</td>
                              <td>{{ $exam['class_work'] }}</td>
                              <td>{{ $exam['home_work'] }}</td>
                              <td>{{ $exam['test_work'] }}</td>
                              <td>{{ $exam['exam'] }}</td>
                              <td class="text-primary text-center">{{ $exam['total_score'] }}</td>
                              <td>{{ $exam['passing_marks'] }}</td>
                              <td>{{ $exam['full_marks'] }}</td>
                              <td>
                                @if ($exam['total_score'] >= $exam['passing_marks'])
                                    <span class="text-success"> <b>Passed</b></span>
                                @else
                                    @php
                                        $result_validation = 1;
                                    @endphp
                                    <span class="text-danger"> <b>Failed</b></span>
                                @endif
                              </td>
                          </tr>
                          @endforeach
                          <tr>
                            <td colspan="2">
                                <b>Total Marks : {{$full_marks}}</b>
                            </td>
                            <td colspan="2">
                                <b>Obtained Marks : <span class="text-primary">{{$total_score}}</span></b>
                            </td>
                            <td colspan="2">
                                @php
                                    $percentage = ($total_score / $full_marks) * 100;
                                    $getGrade = App\Models\MarksGradeModel::getGrade($percentage);
                                @endphp
                                <b>Percentage : <span class="text-primary">{{ round($percentage, 2) }}%</span></b>
                            </td>
                            <td colspan="1">
                                <b>Grade : <span class="text-primary">{{ $getGrade }}</span></b>
                            </td>
                            <td colspan="3">
                                <b>Result :
                                    @if ($result_validation == 0)
                                        <span class="text-success"> <b>Passed</b></span>
                                    @else
                                        <span class="text-danger"> <b>Failed</b></span>
                                    @endif
                                </b>
                            </td>
                          </tr>
                      </tbody>
                      </table>
                  </div>
              </div>
            </div>
            @endforeach

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection

