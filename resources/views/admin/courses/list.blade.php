@extends('admin.master')
@section('title') Admin - Courses @stop
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="tddts">
                        <h4 class="text-center"> ALL COURSES</h4>
                            <button type="button" class="btn btn-primary" id="modal_container_btn">ADD NEW COURSE</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">S.No</th>
                                    <th width="50%">Course Title</th>
                                    <th width="20%">Created</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($records as $key=>$record)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$record->title}}</td>
                                    <td>{{$record->created_at}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="edit-Data" data-userid="{{$record->id}}"><span class="edit_icon"><i class="fa fa-pencil"
                                                    aria-hidden="true"></i></span></a>
                                        <a href="javascript:void(0)"  class="delete-Data" data-userid="{{$record->id}}"><span class="delete_icon"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></span></a>
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
<!-- The Add Modal -->
<div class="modal"  id="modal_container">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><b>ADD NEW COURSE</b></h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="add_form">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="title" id="title"
                            placeholder="Course Title">
                        <span class="glyphicon glyphicon-text form-control-feedback"></span>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" id="close_modal_container_btn">Close</button>
                    </div>
            </form>
                
            </div>

            
        </div>
    </div>
</div>
<!-- The Add Modal -->
<div class="modal"  id="edit_modal_container">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><b>EDIT COURSE</b></h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="edit_form">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control addData" name="title" id="edit_title"
                            placeholder="Course Title">
                        <span class="glyphicon glyphicon-users form-control-feedback"></span>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <input type="hidden" id="user_id" value="">
                        <button type="button" class="btn btn-danger" id="close_edit_modal_container_btn">Close</button>
                    </div>
                </form>
                
            </div>
            
        </div>
    </div>
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
            var title = $("#title").val();
            $.ajax({
                url: '{{route('add-new-course')}}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",title,
                },
                success: function (response) {
                    toastr.success("Record added successfully.");
                    $("#modal_container").hide();
                    $('#modal_container').waitMe('hide');
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error("Something Went Wrong");
                    location.reload();
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
    $(document).on('click','.delete-Data',function(){
        if(!confirm("Are you sure you want to delete?")){
            return false;
        }
        run_waitMe(current_effect);
        var user_id = $(this).data('userid');
        $.ajax({
            url: '{{route('delete-course')}}',
            type: 'GET',
            data: {
                user_id,
            },
            success: function (response) {
                toastr.success("Record deleted successfully.");
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toastr.error("Something Went Wrong");
            }
        });
    });
});
</script>
@stop