@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
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
                          <label>Admission Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="{{old('admission_number')}}" name="admission_number" required placeholder="Admission Number">
                          <span class="text-danger">
                            @error('admission_number')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Roll Number <span class="text-danger"></span></label>
                          <input type="text" class="form-control" value="{{old('roll_number')}}" name="roll_number" placeholder="Roll Number">
                          <span class="text-danger">
                            @error('roll_number')
                            {{$message}}
                            @enderror
                        </span>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Class <span class="text-danger">*</span></label>
                          <select name="class_id" class="form-control" required>
                            <option value="">Select Class</option>
                            @foreach ($getClass as $value)
                                <option {{(old('class_id') == $value->id) ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                          </select>
                          <span class="text-danger">
                            @error('class_id')
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
                            <label>Caste <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('caste')}}" name="caste"  placeholder="Caste">
                            <span class="text-danger">
                                @error('caste')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Religion <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('religion')}}" name="religion"  placeholder="Religion">
                            <span class="text-danger">
                                @error('religion')
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
                            <label>Admission Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{old('admission_date')}}" required name="admission_date">
                            <span class="text-danger">
                                @error('admission_date')
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
                            <label>Blood Group <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('blood_group')}}" name="blood_group" placeholder="Blood Group">
                            <span class="text-danger">
                                @error('blood_group')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Height <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('height')}}" name="height" placeholder="Height">
                            <span class="text-danger">
                                @error('height')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Weight <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('weight')}}"  name="weight" placeholder="Weight">
                            <span class="text-danger">
                                @error('weight')
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

