@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Teacher</h1>
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
                          <input type="text" class="form-control" value="{{old('name')}}" name="name" required placeholder="First Name">
                          <span class="text-danger">
                            @error('name')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Last Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" required placeholder="Last Name">
                          <span class="text-danger">
                            @error('last_name')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control" required>
                              <option value="">Select Gender</option>
                              <option {{(old('gender') == 'Male') ? 'selected' : ''}} value="Male">Male</option>
                              <option {{(old('gender') == 'Female') ? 'selected' : ''}} value="Female">Female</option>
                              <option {{(old('gender') == 'Other') ? 'selected' : ''}} value="Other">Other</option>
                            </select>
                            <span class="text-danger">
                              @error('gender')
                              {{$message}}
                              @enderror
                          </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Date Of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{old('date_of_birth')}}" name="date_of_birth" required >
                            <span class="text-danger">
                                @error('date_of_birth')
                                {{$message}}
                                @enderror
                            </span>
                          </div>


                          <div class="form-group col-md-6">
                            <label>Date Of Joining <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{old('admission_date')}}" required name="admission_date">
                            <span class="text-danger">
                                @error('admission_date')
                                {{$message}}
                                @enderror
                            </span>
                          </div>


                          <div class="form-group col-md-6">
                            <label>Mobile Number <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('mobile_number')}}" name="mobile_number" placeholder="Mobile Number">
                            <span class="text-danger">
                                @error('mobile_number')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Marital Status <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('marital_status')}}" name="marital_status"  placeholder="Marital Status">
                            <span class="text-danger">
                                @error('marital_status')
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
                          </div>

                          <div class="form-group col-md-6">
                            <label>Current Address<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" id="" cols="" rows="" required>{{old('address')}}</textarea>
                            <span class="text-danger">
                                @error('address')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Permanent Address<span class="text-danger"></span></label>
                            <textarea class="form-control" name="permanent_address" id="" cols="" rows="">{{old('permanent_address')}}</textarea>
                            <span class="text-danger">
                                @error('permanent_address')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Qualification<span class="text-danger"></span></label>
                            <textarea class="form-control" name="qualification" id="" cols="" rows="">{{old('qualification')}}</textarea>
                            <span class="text-danger">
                                @error('qualification')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Work Experience<span class="text-danger"></span></label>
                            <textarea class="form-control" name="work_experience" id="" cols="" rows="">{{old('work_experience')}}</textarea>
                            <span class="text-danger">
                                @error('work_experience')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Note<span class="text-danger"></span></label>
                            <textarea class="form-control" name="note" id="" cols="" rows="">{{old('note')}}</textarea>
                            <span class="text-danger">
                                @error('note')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                              <option value="">Select Status</option>
                              <option {{(old('status') == 0) ? 'selected' : ''}} value="0">Active</option>
                              <option {{(old('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
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
                    <input type="email" class="form-control" value="{{old('email')}}" name="email" required  placeholder="Enter email">
                    <span class="text-danger">
                      @error('email')
                      {{$message}}
                      @enderror
                  </span>
                  </div>
                  <div class="form-group">
                    <label>Password<span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="password" required  placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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

