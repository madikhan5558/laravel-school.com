@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Marks Grade</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Grade Name</label>
                    <input type="text" class="form-control" value="{{old('name', $getRecord->name)}}" name="name" required placeholder="Grade Name">
                  </div>
                  <div class="form-group">
                    <label>Percent From</label>
                    <input type="number" class="form-control" value="{{old('percent_from', $getRecord->percent_from)}}" name="percent_from" required placeholder="">
                  </div>
                  <div class="form-group">
                    <label>Percent To</label>
                    <input type="number" class="form-control" value="{{old('percent_to', $getRecord->percent_to)}}" name="percent_to" required placeholder="">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

  @endsection

