@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Assign Class Teacher</h1>
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
              <form action="" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Class Name</label>
                    <select class="form-control" name="class_id" required>
                        <option value="0">Select Class</option>
                        @foreach ($getClass as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>

                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Teacher Name</label>
                        @foreach ($getTeacher as $teacher)
                            <div>
                                <label for="" style="font-weight:normal">
                                    <input type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]"> {{$teacher->name}} {{$teacher->last_name}}
                                </label>
                            </div>
                        @endforeach
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select>
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

