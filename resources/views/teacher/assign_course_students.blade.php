@extends('teacher.master')
@section('title') Teacher - Course Students @stop
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="tddts">
                        <h4 class="text-center"> TEACHER COURSE STUDENTS</h4>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">S.No</th>
                                    <th width="40%">Course Title</th>
                                    <th width="50%">Students Name</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teachers_students as $key=>$item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->course->title}}</td>
                                    <label for="">Students</label> 
                                    <td> 
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">--Select Student--</option>
                                        @forelse($item->students as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @empty
                                        @endforelse
                                    </select> 
                                    </td>
                                    
                                   
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@stop
@section('footer-script')
<!-- <script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script> -->

<script>
     $(document).ready(function() {
        $('form[id="add_form"]').validate({
        rules: {
            title: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "<span style='color:red'>This field is required</span>",
            },	
        },
        submitHandler: function(form) {
            run_waitMe(current_effect);
            var course_id = $("#course_id").val();
            var user_id   = $("#user_id").val();
            var teacher_id   = $("#teacher_id").val();
            $.ajax({
                url: '{{route('assignCourseStudent')}}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",course_id:course_id,user_id:user_id,teacher_id:teacher_id
                },
                success: function (response) {
                    console.log(response);
                   var type = response.type;
                   if(response.type == 'error')
                   {
                    toastr.error(response.message);
                   }else{
                        $("#modal_container").hide();
                        toastr.success(response.message);
                        setInterval(function() {location.reload();}, 1000);
                   }
                    $('#modal_container').waitMe('hide');
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong");
                    // $('#modal_container').waitMe('hide');
                    setInterval(function() {location.reload();}, 1000);
                }
            });
        }
    });
    $(document).on('click','#modal_container_btn',function(){
        $("#modal_container").show();
    });
    $(document).on('click','#close_modal_container_btn',function(){
        $("#modal_container").hide();
    });
    $(document).on('click','.edit-Data',function(){
        run_waitMe(current_effect);
        var user_id = $(this).data('userid');
        $.ajax({
            url: '{{route('edit-course')}}',
            type: 'GET',
            data: {
                user_id,
            },
            success: function (response) {
                //console.log(response);
                $("#user_id").val(response.id);
                $("#edit_title").val(response.title);
                $("#edit_modal_container").show();
                $('#edit_modal_container').waitMe('hide');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toastr.error("Something Went Wrong");
            }
        });
        //$("#edit_modal_container").show();
    });
    $(document).on('click','#close_edit_modal_container_btn',function(){
        $("#edit_modal_container").hide();
    });
    $('form[id="edit_form"]').validate({
        rules: {
            title: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "<span style='color:red'>This field is required</span>",
            },
        },
        submitHandler: function(form) {
            run_waitMe(current_effect);
            var title = $("#edit_title").val();
            var user_id = $("#user_id").val();
            $.ajax({
                url: '{{route('update-course')}}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",title,user_id,
                },
                success: function (response) {
                    toastr.success("Record updated successfully.");
                    $("#edit_modal_container").hide();
                    $('#edit_modal_container').waitMe('hide');
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong");
                    location.reload();
                }
            });
        }
    });
    
});

$("#course_id").on('change', function(event){
    event.stopPropagation();
    event.stopImmediatePropagation();
    var course_id = $("#course_id").val();
    var html = null;
    $("#show_teacher").empty();
    $.ajax({
                url: '{{route('get-course')}}',
                type: 'GET',
                data: {
                    course_id:course_id
                },
                success: function (response) {
                    html = '<label>Teacher</label>';
                    html += '<select name="teacher_id" id="teacher_id" class="form-control">';
                    html += '<option value="">--Select Teacher</option>';
                    for(i = 0;i<response.length;i++)
                    {
                        html += '<option value='+response[i].id+'>'+response[i].first_name+' '+response[i].last_name+'</option>';
                    }
                    html += '</select>';
                    $("#show_teacher").append(html);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong");
                    // location.reload();
                }
            });
});
</script>
@stop