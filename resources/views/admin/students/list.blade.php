@extends('admin.master')
@section('title') Admin - Students @stop
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="tddts">
                        <h4 class="text-center"> ALL STUDENTS</h4>
                            <button type="button" class="btn btn-primary" id="modal_container_btn">ADD NEW STUDENT</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($records as $key=>$record)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$record->first_name}}</td>
                                    <td>{{$record->last_name}}</td>
                                    <td>{{$record->email}}</td>
                                    <td>{{$record->gender}}</td>
                                    <td>{{$record->status}}</td>
                                    <td>{{$record->role}}</td>
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
                <h4 class="modal-title"><b>ADD NEW STUDENT</b></h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="add_form">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control addData" name="first_name" id="first_name"
                            placeholder="First Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control addData" name="last_name" id="last_name"
                            placeholder="Last Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control addData" name="email" id="email"
                            placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control addData" name="password" id="password"
                            placeholder="Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>What is your gender ?
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="Male" checked> Male
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="Female"> Female
                        </p>
                       
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
                <h4 class="modal-title"><b>EDIT TEACHER</b></h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" id="edit_form">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control addData" name="first_name" id="edit_first_name"
                            placeholder="First Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control addData" name="last_name" id="edit_last_name"
                            placeholder="Last Name">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control addData" name="email" id="edit_email"
                            placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>What is your gender ?
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="edit_gender" value="Male" id="edit_male"> Male
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="edit_gender" value="Female" id="edit_female"> Female
                        </p>
                       
                    </div>
                    <div class="form-group has-feedback">
                        <p>Change Status ?
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="enabled" id="edit_enabled"> Enabled
                        &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" value="disabled" id="edit_disabled"> Disabled
                        </p>
                       
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
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "<span style='color:red'>This field is required</span>",
            },
            last_name: {
                required: "<span style='color:red'>This field is required</span>",
            },
            email: {
                required: "<span style='color:red'>This field is required</span>",
                email: "<span style='color:red'>Please enter a valid email address.</span>",
            },
            password: {
                required: "<span style='color:red'>This field is required</span>",
            },		
        },
        submitHandler: function(form) {
            run_waitMe(current_effect);
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var gender = $('input[name="gender"]:checked').val();
            $.ajax({
                url: '{{route('add-new-student')}}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",first_name,last_name,email,password,gender,
                },
                success: function (response) {
                toastr.success("Record added and verification email sent successfully.");
                $("#modal_container").hide();
                $('#modal_container').waitMe('hide');
                setInterval(function() {location.reload();}, 1000);
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
            url: '{{route('edit-teacher')}}',
            type: 'GET',
            data: {
                user_id,
            },
            success: function (response) {
                //console.log(response);
                $("#user_id").val(response.id);
                $("#edit_first_name").val(response.first_name);
                $("#edit_last_name").val(response.first_name);
                $("#edit_email").val(response.email);
                if(response.gender=='Male'){
                    $("#edit_male").attr('checked',true);
                }else{
                    $("#edit_female").attr('checked',true);
                }
                if(response.status=='disabled'){
                    $("#edit_disabled").attr('checked',true);
                }else{
                    $("#edit_enabled").attr('checked',true);
                }
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
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
            },
        },
        messages: {
            first_name: {
                required: "<span style='color:red'>This field is required</span>",
            },
            last_name: {
                required: "<span style='color:red'>This field is required</span>",
            },
            email: {
                required: "<span style='color:red'>This field is required</span>",
                email: "<span style='color:red'>Please enter a valid email address.</span>",
            },	
        },
        submitHandler: function(form) {
            run_waitMe(current_effect);
            var first_name = $("#edit_first_name").val();
            var last_name = $("#edit_last_name").val();
            var email = $("#edit_email").val();
            var gender = $('input[name="edit_gender"]:checked').val();
            var status = $('input[name="status"]:checked').val();
            var user_id = $("#user_id").val();
            $.ajax({
                url: '{{route('update-teacher')}}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",first_name,last_name,email,gender,status,user_id,
                },
                success: function (response) {
                    toastr.success("Record updated successfully.");
                    $("#edit_modal_container").hide();
                    $('#edit_modal_container').waitMe('hide');
                    setInterval(function() {location.reload();}, 1000);
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
            url: '{{route('delete-teacher')}}',
            type: 'GET',
            data: {
                user_id,
            },
            success: function (response) {
                toastr.success("Record deleted successfully.");
                setInterval(function() {location.reload();}, 1000);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                toastr.error("Something Went Wrong");
            }
        });
    });
});
</script>
@stop