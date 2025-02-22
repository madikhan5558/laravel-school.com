@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Submitted Homework</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Submitted Homework</h3>
                </div>
                <form action="" method="get">
                  <div class="card-body">
                        <div class="row">

                            <div class="form-group col-lg-3 col-md-4">
                                <label>Student First Name</label>
                                <input type="text" class="form-control" value="{{Request::get('first_name')}}" name="first_name" placeholder="Student First Name">
                            </div>

                            <div class="form-group col-lg-3 col-md-4">
                                <label>Student Last Name</label>
                                <input type="text" class="form-control" value="{{Request::get('last_name')}}" name="last_name" placeholder="Student Last Name">
                            </div>

                            <div class="form-group col-lg-3 col-md-4">
                                <label>From Created Date</label>
                                <input type="date" class="form-control" value="{{Request::get('from_created_date')}}" name="from_created_date">
                            </div>

                            <div class="form-group col-lg-3 col-md-4">
                                <label>To Created Date</label>
                                <input type="date" class="form-control" value="{{Request::get('to_created_date')}}" name="to_created_date">
                            </div>
                            <div class="form-group col-lg-3 col-md-4">
                                <button class="btn btn-primary" type="submit">Search</button>
                                <a href="{{url('teacher/homework/home_work/submitted/'.$homework_id)}}" class="btn btn-success">Reset</a>
                            </div>
                        </div>
                  </div>
                </form>
            </div>
                @include('message')


             <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Submitted Homework List</h3>
                </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Student Name</th>
                      <th>Document</th>
                      <th>Description</th>
                      <th>Created Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                            <td>
                                @if (!empty($value->getDocument()))
                                    <a href="{{$value->getDocument()}}" class="btn-sm btn-primary" download="">Download</a>
                                @endif
                            </td>
                            <td>{!!$value->description!!}</td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-danger" colspan="100%">Record not found</td>
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

