@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Homework</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Class <span class="text-danger">*</span></label>
                        <select class="form-control" id="getClass" name="class_id" required>
                            <option value="">Select Class</option>
                            @foreach ($getClass as $class)
                            <option {{ ($getRecord->class_id == $class->class_id) ? 'selected' : '' }} value="{{$class->class_id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subject <span class="text-danger">*</span></label>
                        <select class="form-control" id="getSubject" name="subject_id" required>
                            <option value="">Select Subject</option>
                            @foreach ($getSubject as $subject)
                            <option {{ ($getRecord->subject_id == $subject->subject_id) ? 'selected' : '' }} value="{{$subject->subject_id}}">{{$subject->subject_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Homework Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" value="{{$getRecord->homework_date}}" name="homework_date" required>
                    </div>
                    <div class="form-group">
                        <label>Submission Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" value="{{$getRecord->submission_date}}" name="submission_date" required>
                    </div>

                    <div class="form-group">
                        <label>Document</label>
                        <input type="file" class="form-control mb-2" name="document_file">
                        @if (!empty($getRecord->getDocument()))
                            <a href="{{$getRecord->getDocument()}}" class="btn-sm btn-primary mt-4" download="">Download</a>
                        @endif
                    </div>

                        <label>Description <span class="text-danger">*</span></label>
                        <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px">
                            {{$getRecord->description}}
                        </textarea>

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
  </div>

  @endsection

@section('script')

    <!-- Summernote -->
    <script src="{{url('public/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            $('#compose-textarea').summernote({
                height: 200
            });

            $('#getClass').change(function(){
                var class_id = $(this).val();

                    $.ajax({
                    type: "POST",
                    url: "{{ url('teacher/ajax_get_subject') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        class_id : class_id,
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#getSubject').html(data.success);
                    }
                });
            });
        });
    </script>

@endsection
