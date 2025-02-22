@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fees Collection <span class="text-primary">({{$getStudent->name}} {{$getStudent->last_name}})</span></h1>
          </div>
          <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-primary" id="AddFees">Add Fees</button>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

                @include('message')


             <div class="card overflow-auto">
                <div class="card-header">
                    <h3 class="card-title">Payment Details</h3>
                </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
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

                    @forelse ($getFees as $value)
                        <tr>
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
          </div>
        </div>
      </div>
    </section>
  </div>


  <div class="modal fade" id="AddFeesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Fees</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-1">
                        <label class="col-form-label">Class Name : {{$getStudent->class_name}}</label>
                    </div>

                    <div class="form-group mb-1">
                        <label class="col-form-label">Total Amount : <span class="text-primary">{{number_format ($getStudent->amount, 2)}}</span> </label>
                    </div>

                    <div class="form-group mb-1">
                        <label class="col-form-label">Paid Amount : {{number_format ($paid_amount, 2)}}</label>
                    </div>
                    <div class="form-group mb-1">
                        @php
                            $RemainingAmount = $getStudent->amount - $paid_amount;
                        @endphp
                        <label class="col-form-label">Remaining Amount : {{number_format ($RemainingAmount, 2)}}</label>
                    </div>

                    <div class="form-group mb-2">
                        <label class="col-form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>

                    <div class="form-group mb-2">
                        <label class="col-form-label">Payment Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="payment_type" required>
                            <option value="">Select Payment</option>
                            <option value="Easypaisa">Easypaisa</option>
                            <option value="Jazzcash">Jazzcash</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label class="col-form-label">Remark</label>
                        <textarea class="form-control" name="remark"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        </div>
  </div>

  @endsection

  @section('script')
    <script type="text/javascript">

        $('#AddFees').click(function(){
            $('#AddFeesModal').modal('show');
        });

    </script>
  @endsection
