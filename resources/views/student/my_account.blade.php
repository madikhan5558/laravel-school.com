@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
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

            @include('message')
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
                            <label>Date Of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{old('date_of_birth', $getRecord->date_of_birth)}}" name="date_of_birth" required >
                            <span class="text-danger">
                                @error('date_of_birth')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Caste <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('caste', $getRecord->caste)}}" name="caste"  placeholder="Caste">
                            <span class="text-danger">
                                @error('caste')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Religion <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('religion', $getRecord->religion)}}" name="religion"  placeholder="Religion">
                            <span class="text-danger">
                                @error('religion')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Mobile Number <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('mobile_number', $getRecord->mobile_number)}}" name="mobile_number" placeholder="Mobile Number">
                            <span class="text-danger">
                                @error('mobile_number')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Admission Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="{{old('admission_date', $getRecord->admission_date)}}" required name="admission_date">
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
                            @if(!empty($getRecord->getProfile()))
                            <img src="{{ $getRecord->getProfile() }}" alt="" width="auto" height="40px">
                            @endif
                          </div>

                          <div class="form-group col-md-6">
                            <label>Blood Group <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('blood_group', $getRecord->blood_group)}}" name="blood_group" placeholder="Blood Group">
                            <span class="text-danger">
                                @error('blood_group')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Height <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('height', $getRecord->height)}}" name="height" placeholder="Height">
                            <span class="text-danger">
                                @error('height')
                                {{$message}}
                                @enderror
                            </span>
                          </div>

                          <div class="form-group col-md-6">
                            <label>Weight <span class="text-danger"></span></label>
                            <input type="text" class="form-control" value="{{old('weight', $getRecord->weight)}}"  name="weight" placeholder="Weight">
                            <span class="text-danger">
                                @error('weight')
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

