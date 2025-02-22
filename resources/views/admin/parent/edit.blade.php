@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Parent</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-md-6">
                          <label>First Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="{{old('name', $getRecord->name)}}" name="name" required placeholder="First Name">
                          <span class="text-danger">
                            @error('name')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Last Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="{{old('last_name', $getRecord->last_name)}}" name="last_name" required placeholder="Last Name">
                          <span class="text-danger">
                            @error('last_name')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Address<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="{{old('address', $getRecord->address)}}" name="address" required placeholder="Address">
                          <span class="text-danger">
                            @error('address')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{old('mobile_number', $getRecord->mobile_number)}}" name="mobile_number" placeholder="Mobile Number" required>
                            <span class="text-danger">
                                @error('mobile_number')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                        <div class="form-group col-md-6">
                          <label>Gender <span class="text-danger">*</span></label>
                          <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option {{(old('gender', $getRecord->gender) == 'Male') ? 'selected' : ''}} value="Male">Male</option>
                            <option {{(old('gender', $getRecord->gender) == 'Female') ? 'selected' : ''}} value="Female">Female</option>
                            <option {{(old('gender', $getRecord->gender) == 'Other') ? 'selected' : ''}} value="Other">Other</option>
                          </select>
                          <span class="text-danger">
                            @error('gender')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Occupation<span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('occupation', $getRecord->occupation)}}" name="occupation"  placeholder="Occupation">
                            <span class="text-danger">
                              @error('occupation')
                              {{$message}}
                              @enderror
                          </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Profile Pic <span class="text-danger"></span></label>
                            <input type="file" class="form-control" name="profile_pic">
                            <span class="text-danger">
                                @error('profile_pic')
                                {{$message}}
                                @enderror
                            </span>
                            @if(!empty($getRecord->getProfile()))
                            <img src="{{ $getRecord->getProfile() }}" alt="" width="auto" height="40px">
                            @endif
                          </div>

                          <div class="form-group col-md-6">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                              <option value="">Select Status</option>
                              <option {{(old('status', $getRecord->status) == 0) ? 'selected' : ''}} value="0">Active</option>
                              <option {{(old('status', $getRecord->status) == 1) ? 'selected' : ''}} value="1">Inactive</option>
                            </select>
                            <span class="text-danger">
                                @error('status')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                    </div>

                    <hr>
                  <div class="form-group">
                    <label>Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" value="{{old('email', $getRecord->email)}}" name="email" required  placeholder="Enter email">
                    <span class="text-danger">
                      @error('email')
                      {{$message}}
                      @enderror
                  </span>
                  </div>
                  <div class="form-group">
                    <label>Password<span class="text-danger"></span></label>
                    <input type="text" class="form-control" name="password" placeholder="Password">
                    <p>Do you want to change password so Please add new password </p>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>


          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection

