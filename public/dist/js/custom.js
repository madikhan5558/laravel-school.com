
$('.getClass').on('change',function(){
    var class_id = $(this).val();
    var token = document.head.querySelector('meta[name="csrf-token"]').content;

    $.ajax({
        url:"http://localhost/school.com/admin/class_timetable/get_subject",
        type: "POST",
        data:{
            "_token": token,
            class_id:class_id,
        },
        dataType:"json",
        success:function(response){
            $('.getSubject').html(response.html);
        },
    });
});

