@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Collect Fees</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Collect Fees Student</h3>
                    </div>
                    <form action="" method="get">
                      <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Class</label>
                                    <select class="form-control" name="class_id">
                                        <option value="">Select Class</option>
                                        @foreach ($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Student ID</label>
                                    <input type="text" class="form-control" value="{{Request::get('student_id')}}" name="student_id"  placeholder="Student ID">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Student First Name</label>
                                    <input type="text" class="form-control" value="{{Request::get('first_name')}}" name="first_name"  placeholder="Student First Name">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Student Last Name</label>
                                    <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name"  placeholder="Student Last Name">
                                </div>

                                <div class="form-group col-md-2">
                                    <button class="btn btn-primary" type="submit" style="margin-top:30px">Search</button>
                                    <a href="{{url('admin/fees_collection/collect_fees')}}" class="btn btn-success" style="margin-top:30px">Reset</a>
                                </div>
                            </div>
                      </div>
                    </form>
                </div>

                @include('message')


             <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student List</h3>
                </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Class Name</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Remaining Amount</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (!empty($getRecord))
                        @forelse ($getRecord as $value)
                            @php
                                $paid_amount = $value->getPaidAmount($value->id, $value->class_id);

                                $RemainingAmount = $value->amount - $paid_amount;
                            @endphp
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                <td>{{ $value->class_name }}</td>
                                <td>{{number_format ($value->amount, 2)}}</td>
                                <td>{{number_format ($paid_amount, 2)}}</td>
                                <td>{{number_format ($RemainingAmount, 2)}}</td>
                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                <td>
                                    <a href="{{ url('admin/fees_collection/collect_fees/add_fees/'.$value->id) }}" class="btn btn-success">Collect Fees</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-danger">Record not found</td>
                            </tr>
                        @endforelse

                    @else
                        <tr>
                            <td colspan="100%" class="text-danger">Record not found</td>
                        </tr>
                    @endif
                  </tbody>
                </table>
            </div>
        </div>
        <div style="float: right; padding: 10px">
            @if(!empty($getRecord))
             {{$getRecord->links()}}
            @endif
        </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection

