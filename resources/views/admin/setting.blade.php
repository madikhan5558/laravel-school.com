@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('message')
            <div class="card card-primary">
              <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Easypaisa Account Number</label>
                    <input type="text" class="form-control" name="account_number" value="{{ $getRecord->account_number }}" required  placeholder="Easypaisa Account Number">
                  </div>

                  <div class="form-group">
                    <label>Logo</label>
                    <input type="file" class="form-control" name="logo">
                    @if(!empty($getRecord->getLogo()))
                    <img src="{{ $getRecord->getLogo() }}" alt="" width="auto" height="40px">
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Fevicon Icon</label>
                    <input type="file" class="form-control" name="fevicon_icon">
                    @if(!empty($getRecord->getFevicon()))
                    <img src="{{ $getRecord->getFevicon() }}" alt="" width="auto" height="40px">
                    @endif
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>

          </div>
        </div>

      </div>
    </section>
  </div>

  @endsection

