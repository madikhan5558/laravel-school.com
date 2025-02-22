@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Attendance <span class="text-primary">(Total : {{$getRecord->total()}})</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search My Attendance</h3>
                            </div>
                            <form action="" method="get">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-3 col-lg-3">
                                            <label>Class</label>
                                            <select class="form-control" name="class_id">
                                                <option value="">Select</option>

                                                @foreach ($getClass as $class)
                                                    <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }}
                                                        value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3 col-lg-3">
                                            <label>Attendance Type</label>
                                            <select class="form-control" name="attendance_type" id="">
                                                <option value="">Select</option>
                                                <option {{ (Request::get('attendance_type') == 1) ? 'selected' : '' }} value="1">Present</option>
                                                <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Late</option>
                                                <option {{ (Request::get('attendance_type') == 3) ? 'selected' : '' }} value="3">Absent</option>
                                                <option {{ (Request::get('attendance_type') == 4) ? 'selected' : '' }} value="4">Half Day</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3 col-lg-3">
                                            <label>Start Attendance Date</label>
                                            <input type="date" class="form-control" name="start_attendance_date" value="{{ Request::get('start_attendance_date') }}">
                                        </div>

                                        <div class="form-group col-md-3 col-lg-3">
                                            <label>End Attendance Date</label>
                                            <input type="date" class="form-control" name="end_attendance_date" value="{{ Request::get('end_attendance_date') }}">
                                        </div>

                                        <div class="form-group col-md-3 col-lg-3">
                                            <button class="btn btn-primary" type="submit"
                                                >Search</button>
                                            <a href="{{ url('student/my_attendance') }}" class="btn btn-success">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">My Attendance</h3>
                                </div>

                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Attendance Type</th>
                                                <th>Attendance Date</th>
                                                <th>Created Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($getRecord as $value)
                                                <tr>
                                                    <td>{{$value->class_name}}</td>
                                                    <td>
                                                        @if ($value->attendance_type == 1)
                                                            Present
                                                        @elseif ($value->attendance_type == 2)
                                                            Late
                                                        @elseif ($value->attendance_type == 3)
                                                            Absent
                                                        @elseif ($value->attendance_type == 4)
                                                            Half Day
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-danger text-center" colspan="100%">Record Not Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div style="float: right; padding: 10px">
                                        {{$getRecord->links()}}
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection
