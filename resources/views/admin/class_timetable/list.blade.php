@extends('layouts.app')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class Timetable</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

         <!-- /.col -->
          <div class="col-md-12">

                @include('message')

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Class Timetable</h3>
                    </div>
                    <form action="" method="get">
                      <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Class Name</label>
                                    <select class="form-control getClass" name="class_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Subject Name</label>
                                    <select class="form-control getSubject" name="subject_id" required>
                                        <option value="">Select</option>

                                        @if (!empty($getSubject))
                                            @foreach ($getSubject as $subject)
                                            <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : '' }} value="{{$subject->subject_id}}">{{$subject->subject_name}}</option>
                                            @endforeach

                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary" type="submit" style="margin-top:30px">Search</button>
                                    <a href="{{url('admin/class_timetable/list')}}" class="btn btn-success" style="margin-top:30px">Reset</a>
                                </div>
                            </div>
                      </div>
                    </form>
                </div>

                @if(!empty(Request::get('class_id')) && !empty(Request::get('subject_id')))
                    <form action="{{ url('admin/class_timetable/add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                        <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Class Timetable</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Room Number</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($week as $value)
                                        <tr>
                                            <input type="hidden" name="timetable[{{ $i }}][week_id]" value="{{ $value['week_id'] }}">
                                            <th>{{ $value['week_name'] }}</th>
                                            <td>
                                                <input type="time" name="timetable[{{ $i }}][start_time]" value="{{ $value['start_time'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="time" name="timetable[{{ $i }}][end_time]" value="{{ $value['end_time'] }}" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="timetable[{{ $i }}][room_number]" value="{{ $value['room_number'] }}" class="form-control" style="width:200px">
                                            </td>
                                        </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                                </table>
                                <div class="p-2">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection


{{--
  @section('script')
    <script src="" type="text/javascript">
        $('.getClass').on('change',function(){
            var class_id = $(this).val();
             console.log(class_id);
            $.ajax({
                url:"{{ url('admin/class_timetable/get_subject') }}",
                type: "POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    class_id:class_id,
                },
                dataType:"json",
                success:function(response){
                    $('.getSubject').html(response.html);
                },
            });
        });
    </script>
  @endsection --}}

