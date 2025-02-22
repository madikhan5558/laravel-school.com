@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Collect Fees Report</h1>
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
                    <h3 class="card-title">Search Collect Fees Report</h3>
                </div>
                <form action="" method="get">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3 col-lg-2">
                                <label>Student ID</label>
                                <input type="text" class="form-control" placeholder="Student ID" name="student_id" value="{{ Request::get('student_id') }}">
                            </div>

                            <div class="form-group col-md-3 col-lg-2">
                                <label>Student Name</label>
                                <input type="text" class="form-control" placeholder="Student Name" name="student_name" value="{{ Request::get('student_name') }}">
                            </div>

                            <div class="form-group col-md-3 col-lg-2">
                                <label>Student Last Name</label>
                                <input type="text" class="form-control" placeholder="Student Last Name" name="student_last_name" value="{{ Request::get('student_last_name') }}">
                            </div>


                            <div class="form-group col-md-3 col-lg-2">
                                <label>Class</label>
                                <select class="form-control" name="class_id">
                                    <option value="">Select</option>

                                    @foreach ($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }}
                                            value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3 col-lg-2">
                                <label>Payment Type</label>
                                <select class="form-control" name="payment_type" id="">
                                    <option value="">Select</option>
                                    <option {{ (Request::get('payment_type') == 'Cash') ? 'selected' : '' }} value="Cash">Cash</option>
                                    <option {{ (Request::get('payment_type') == 'Cheque') ? 'selected' : '' }} value="Cheque">Cheque</option>
                                    <option {{ (Request::get('payment_type') == 'Easypaisa') ? 'selected' : '' }} value="Easypaisa">Easypaisa</option>
                                    <option {{ (Request::get('payment_type') == 'Jazzcash') ? 'selected' : '' }} value="Jazzcash">Jazzcash</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3 col-lg-2">
                                <label>Start Created Date</label>
                                <input type="date" class="form-control" name="start_created_date" value="{{ Request::get('start_created_date') }}">
                            </div>

                            <div class="form-group col-md-3 col-lg-2">
                                <label>End Created Date</label>
                                <input type="date" class="form-control" name="end_created_date" value="{{ Request::get('end_created_date') }}">
                            </div>


                            <div class="form-group col-md-3 col-lg-2 mt-4 pt-2">
                                <button class="btn btn-primary" type="submit"
                                    >Search</button>
                                <a href="{{ url('admin/fees_collection/collect_fees_report') }}" class="btn btn-success">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                @include('message')


             <div class="card overflow-auto">
                <div class="card-header">
                    <h3 class="card-title">Collect Fees Report</h3>
                </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Student ID</th>
                      <th>Student Name</th>
                      <th>Class Name</th>
                      <th>Total Amount</th>
                      <th>Paid Amount</th>
                      <th>Remaining Amount</th>
                      <th>Payment Type</th>
                      <th>Remark</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                    </tr>
                  </thead>

                  <tbody>

                    @forelse ($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->student_id }}</td>
                            <td>{{ $value->student_first_name }} {{ $value->student_last_name }}</td>
                            <td>{{ $value->class_name }}</td>
                            <td>PKR {{ number_format($value->total_amount, 2) }}</td>
                            <td>PKR {{ number_format($value->paid_amount, 2) }}</td>
                            <td>PKR {{ number_format($value->remaining_amount, 2) }}</td>
                            <td>{{ $value->payment_type }}</td>
                            <td>{{ $value->remark }}</td>
                            <td>{{ $value->created_name }}</td>
                            <td>{{ date('d-m-Y', strtotime( $value->created_at )) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-danger">Record Not Found.</td>
                        </tr>
                    @endforelse

                  </tbody>

                </table>
            </div>
        </div>
            <div style="float: right; padding: 10px">
                {{$getRecord->links()}}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  @endsection

  @section('script')

  @endsection
