@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parent List (Total : {{$getRecord->total()}})</h1>
          </div>
          <div class="col-sm-6" style="text-align: right">
            <a href="{{url('admin/parent/add')}}" class="btn btn-primary">Add New Parent</a>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Student</h3>
                </div>
                <form action="" method="get">
                  {{-- @csrf --}}
                  <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Name</label>
                                <input type="text" class="form-control" value="{{Request::get('name')}}" name="name"  placeholder="Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Last Name</label>
                                <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name"  placeholder="Last Name">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Email</label>
                                <input type="text" class="form-control" value="{{Request::get('email')}}" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option {{(Request::get('gender') == 'Male') ? 'selected' : ''}} value="Male">Male</option>
                                    <option {{(Request::get('gender') == 'Female') ? 'selected' : ''}} value="Female">Female</option>
                                    <option {{(Request::get('gender') == 'Other') ? 'selected' : ''}} value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" value="{{Request::get('mobile_number')}}" name="mobile_number" placeholder="Mobile Number">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Occupation</label>
                                <input type="text" class="form-control" value="{{Request::get('occupation')}}" name="occupation" placeholder="Occupation">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Address</label>
                                <input type="text" class="form-control" value="{{Request::get('address')}}" name="address" placeholder="Address">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option {{(Request::get('status') == 100) ? 'selected' : ''}} value="100">Active</option>
                                    <option {{(Request::get('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Created Date</label>
                                <input type="date" class="form-control" value="{{Request::get('date')}}" name="date">
                            </div>
                            <div class="form-group col-md-3">
                                <button class="btn btn-primary" type="submit" style="margin-top:30px">Search</button>
                                <a href="{{url('admin/parent/list')}}" class="btn btn-success" style="margin-top:30px">Reset</a>
                            </div>
                        </div>
                  </div>
                </form>
            </div>

                @include('message')

                <!-- /.card -->

             <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parent List</h3>
                </div>
              <!-- /.card-header -->
              <div class="card-body p-0"  style="overflow:auto">
                <table class="table table-striped"style="width: max-content;">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Profile Pic</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Mobile Number</th>
                      <th>Occupation</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($getRecord as $value )
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>
                            @if(!empty($value->getProfileDirect()))
                            <img src="{{ $value->getProfileDirect() }}" alt="" style="width: 50px; height: 50px; border-radius: 50px;">
                            @endif
                        </td>
                        <td>{{ $value->name }} {{ $value->last_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->gender}}</td>
                        <td>{{ $value->mobile_number}}</td>
                        <td>{{ $value->occupation}}</td>
                        <td>{{ $value->address}}</td>
                        <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                        <td>
                            <a href="{{url('admin/parent/edit/' .$value->id)}}" class="btn btn-primary">Edit</a>
                            <a href="{{url('admin/parent/delete/' .$value->id)}}" class="btn btn-danger">Delete</a>
                            <a href="{{url('admin/parent/my-student/' .$value->id)}}" class="btn btn-primary">My Student</a>
                            <a href="{{url('chat?receiver_id=' .base64_encode($value->id))}}" class="btn btn-success">Send Message</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div style="float: right; padding: 10px">
            {{$getRecord->links()}}
        </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection

