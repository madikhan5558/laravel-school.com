@extends('layouts.app')

@section('style')
<style type="text/css">
.fc-daygrid-event {
    border-radius: 3px;
    font-size: var(--fc-small-font-size);
    position: relative;
    white-space: normal;
}
</style>

@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Calendar <span class="text-primary">({{ $getStudent->name }} {{ $getStudent->last_name }})</span></h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @endsection


  @section('script')
  <script src="{{ url('public/dist/fullcalendar/index.global.js') }}"></script>

  <script type="text/javascript">

    var events = new Array();

    @foreach($getMyTimetable as $value )
        @foreach($value['week'] as $week)
            events.push({
                    title: '{{ $value['name'] }}',
                    daysOfWeek: [ {{$week['fullcalendar_day'] }} ],
                    startTime: '{{ $week['start_time'] }}',
                    endTime: '{{ $week['end_time'] }}',
            });
        @endforeach
    @endforeach

    @foreach($getExamTimetable as $valueE )
        @foreach($valueE['exam'] as $exam)
            events.push({
                    title: '{{ $valueE['name'] }} - {{ $exam['subject_name'] }} ({{ date('h:i A', strtotime($exam['start_time'])) }} to {{ date('h:i A', strtotime($exam['end_time'])) }})',
                    start: '{{ $exam['exam_date'] }}',
                    end: '{{ $exam['end_time'] }}',
                    color:'black',
            });
        @endforeach
    @endforeach

    var calendarID = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarID,{
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, timeGridDay, listMonth'
        },
        initialDate: '<?=date('Y-m-d')?>',
        navLinks: true,
        editable: false,
        events:events,
        // initialView: 'listMonth',
    });

    calendar.render();

  </script>

  @endsection
