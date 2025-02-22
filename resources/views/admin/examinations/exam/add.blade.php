@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Exam</h1>
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
                    <label>Exam Name</label>
                    <input type="text" class="form-control" value="{{old('name')}}" name="name" required placeholder="Exam Name">
                  </div>
                  <div class="form-group">
                    <label>Note</label>
                    <textarea class="form-control" name="note" placeholder="Enter Your Note"></textarea>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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

