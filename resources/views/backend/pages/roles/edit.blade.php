@extends('backend.layouts.app')

@section('title')
Create Role
@endsection


@section('admin-content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title ">Roles</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <form class="form-horizontal" action="{{route('admin.roles.update',$role->id)}}" method="POST" id="pages">
                        @csrf
                        @method('put')
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">Create Role</h4>


                            @include('backend.layouts.partials.messages')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group required">
                                        <label for="">Name</label>
                                        <input class="form-control" type="text" name="name" value="{{ $role->name }}" required >
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Permissions:</label>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                    <div class="col-md-2">
                                            <h4 style="font-size:15px" >Dashboard</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"  name="permissions[]" value="dashboard.view"
                                                {{ in_array("dashboard.view",$role_permissions)?"checked":"" }}>
                                                <label class="form-check-label" for="exampleCheck1">Dashboard View</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                            
                            <div class="row">
                                <div class="col-md-2">
                                        <h4 style="font-size:15px" >User</h4>
                                </div>
                                   
                                {{-- <div class="col-md-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" >
                                            <label class="form-check-label" for="exampleCheck1">Select All</label>
                                        </div>
                                </div> --}}

                                <div class="col-md-9">
                                    <div class="col-md-12">
                                            <div class="form-check">
                                                    
                                                    <input type="checkbox" class="form-check-input" name="permissions[]" value="user.view"
                                                    {{ in_array("user.view",$role_permissions)?"checked":"" }}>
                                                    <label class="form-check-label" for="exampleCheck1">User View</label>
                                                </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"   name="permissions[]" value="user.create"
                                                    {{ in_array("user.create",$role_permissions)?"checked":"" }}>
                                                    <label class="form-check-label" for="exampleCheck1">User Create</label>
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"  name="permissions[]" value="user.edit"
                                                    {{ in_array("user.edit",$role_permissions)?"checked":"" }}>
                                                    <label class="form-check-label" for="exampleCheck1">User Edit</label>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        <hr>
                            <div class="row">
                                    <div class="col-md-2">
                                            <h4 style="font-size:15px" >Role</h4>
                                    </div>
                                       
                                    {{-- <div class="col-md-2">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" >
                                                <label class="form-check-label" for="exampleCheck1">Select All</label>
                                            </div>
                                    </div> --}}
    
                                    <div class="col-md-9">
                                        <div class="col-md-12">
                                                <div class="form-check">
                                                        
                                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="role.view"
                                                        {{ in_array("role.view",$role_permissions)?"checked":"" }}>
                                                        <label class="form-check-label" for="exampleCheck1">Role View</label>
                                                    </div>
                                        </div>
                                        <div class="col-md-12">
                                                <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"  name="permissions[]" value="role.create"
                                                        {{ in_array("role.create",$role_permissions)?"checked":"" }}>
                                                        <label class="form-check-label" for="exampleCheck1">Role Create</label>
                                                </div>
                                        </div>
                                        <div class="col-md-12">
                                                <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"  name="permissions[]" value="role.edit"
                                                        {{ in_array("role.edit",$role_permissions)?"checked":"" }}>
                                                        <label class="form-check-label" for="exampleCheck1">Role Edit</label>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                        <div class="col-md-2">
                                                <h4 style="font-size:15px" >Permission</h4>
                                        </div>
                                           
                                        {{-- <div class="col-md-2">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" >
                                                    <label class="form-check-label" for="exampleCheck1">Select All</label>
                                                </div>
                                        </div> --}}
        
                                        <div class="col-md-9">
                                            <div class="col-md-12">
                                                    <div class="form-check">
                                                            
                                                            <input type="checkbox" class="form-check-input"  name="permissions[]" value="permission.view"
                                                            {{ in_array("permission.view",$role_permissions)?"checked":"" }}>
                                                            <label class="form-check-label" for="exampleCheck1">Permission View</label>
                                                        </div>
                                            </div>
                                            <div class="col-md-12">
                                                    <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"  name="permissions[]" value="permission.create"
                                                            {{ in_array("permission.create",$role_permissions)?"checked":"" }}>
                                                            <label class="form-check-label" for="exampleCheck1">Permission Create</label>
                                                    </div>
                                            </div>
                                            <div class="col-md-12">
                                                    <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" name="permissions[]" value="permission.edit"
                                                            {{ in_array("permission.edit",$role_permissions)?"checked":"" }}>
                                                            <label class="form-check-label" for="exampleCheck1">Permission Edit</label>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                            <div class="col-md-2">
                                                    <h4 style="font-size:15px" >Question</h4>
                                            </div>
                                               
                                            {{-- <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" >
                                                        <label class="form-check-label" for="exampleCheck1">Select All</label>
                                                    </div>
                                            </div> --}}
                                            
                                            <div class="col-md-9">
                                                <div class="col-md-12">
                                                        <div class="form-check">
                                                                
                                                                <input type="checkbox" class="form-check-input"  name="permissions[]" value="question.view"
                                                                {{ in_array("question.view",$role_permissions)?"checked":"" }}>
                                                                <label class="form-check-label" for="exampleCheck1">Question View</label>
                                                            </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <div class="form-check">
                                                                <input type="checkbox" class="form-check-input"  name="permissions[]" value="question.create"
                                                                {{ in_array("question.create",$role_permissions)?"checked":"" }}>
                                                                <label class="form-check-label" for="exampleCheck1">Question Create</label>
                                                        </div>
                                                </div>
                                                <div class="col-md-12">
                                                        <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" name="permissions[]" value="question.edit"
                                                                {{ in_array("question.edit",$role_permissions)?"checked":"" }}>
                                                                <label class="form-check-label" for="exampleCheck1">Question Edit</label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                                <div class="col-md-2">
                                                        <h4 style="font-size:15px" >Settings</h4>
                                                </div>
                                                   
                                                {{-- <div class="col-md-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" >
                                                            <label class="form-check-label" for="exampleCheck1">Select All</label>
                                                        </div>
                                                </div> --}}
                                                
                                                <div class="col-md-9">
                                                    <div class="col-md-12">
                                                            <div class="form-check">
                                                                    
                                                                    <input type="checkbox" class="form-check-input"  name="permissions[]" value="settings.view"
                                                                    {{ in_array("settings.view",$role_permissions)?"checked":"" }}>
                                                                    <label class="form-check-label" for="exampleCheck1">Settings View</label>
                                                                </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"  name="permissions[]" value="settings.create"
                                                                    {{ in_array("settings.create",$role_permissions)?"checked":"" }}>
                                                                    <label class="form-check-label" for="exampleCheck1">Settings Create</label>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                            <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" name="permissions[]" value="settings.edit"
                                                                    {{ in_array("settings.edit",$role_permissions)?"checked":"" }}>
                                                                    <label class="form-check-label" for="exampleCheck1">Settings Edit</label>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="row">
                                                    <div class="col-md-2">
                                                            <h4 style="font-size:15px" >Pages</h4>
                                                    </div>
                                                       
                                                    {{-- <div class="col-md-2">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" >
                                                                <label class="form-check-label" for="exampleCheck1">Select All</label>
                                                            </div>
                                                    </div> --}}
                                                    
                                                    <div class="col-md-9">
                                                        <div class="col-md-12">
                                                                <div class="form-check">
                                                                        
                                                                        <input type="checkbox" class="form-check-input"  name="permissions[]" value="pages.view"
                                                                        {{ in_array("pages.view",$role_permissions)?"checked":"" }}>
                                                                        <label class="form-check-label" for="exampleCheck1">Pages View</label>
                                                                    </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                                <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input"  name="permissions[]" value="pages.create"
                                                                        {{ in_array("pages.create",$role_permissions)?"checked":"" }}>
                                                                        <label class="form-check-label" for="exampleCheck1">Pages Create</label>
                                                                </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                                <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" name="permissions[]" value="pages.edit"
                                                                        {{ in_array("pages.edit",$role_permissions)?"checked":"" }}>
                                                                        <label class="form-check-label" for="exampleCheck1">Pages Edit</label>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                                <div class="row">
                                                        <div class="col-md-2">
                                                                <h4 style="font-size:15px" >Blogs</h4>
                                                        </div>
                                                           
                                                        {{-- <div class="col-md-2">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" >
                                                                    <label class="form-check-label" for="exampleCheck1">Select All</label>
                                                                </div>
                                                        </div> --}}
                                                        
                                                        <div class="col-md-9">
                                                            <div class="col-md-12">
                                                                    <div class="form-check">
                                                                            
                                                                            <input type="checkbox" class="form-check-input"  name="permissions[]" value="blogs.view"
                                                                            {{ in_array("blogs.view",$role_permissions)?"checked":"" }}>
                                                                            <label class="form-check-label" for="exampleCheck1">Blogs View</label>
                                                                        </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                    <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input"  name="permissions[]" value="blogs.create"
                                                                            {{ in_array("blogs.create",$role_permissions)?"checked":"" }}>
                                                                            <label class="form-check-label" for="exampleCheck1">Blogs Create</label>
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                    <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="permissions[]" value="blogs.edit"
                                                                            {{ in_array("blogs.edit",$role_permissions)?"checked":"" }}>
                                                                            <label class="form-check-label" for="exampleCheck1">Blogs Edit</label>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                            <div class="col-md-2">
                                                                    <h4 style="font-size:15px" >Admin Profile</h4>
                                                            </div>
                                                               
                                                            {{-- <div class="col-md-2">
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" >
                                                                        <label class="form-check-label" for="exampleCheck1">Select All</label>
                                                                    </div>
                                                            </div> --}}
                                                            
                                                            <div class="col-md-9">
                                                                <div class="col-md-12">
                                                                        <div class="form-check">
                                                                                
                                                                                <input type="checkbox" class="form-check-input"  name="permissions[]" value="admin_profile.view"
                                                                                {{ in_array("admin_profile.view",$role_permissions)?"checked":"" }}>
                                                                                <label class="form-check-label" for="exampleCheck1">Admin Profile View</label>
                                                                            </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                        <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" name="permissions[]" value="admin_profile.edit"
                                                                                {{ in_array("admin_profile.edit",$role_permissions)?"checked":"" }}>
                                                                                <label class="form-check-label" for="exampleCheck1">Admin Profile Edit</label>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
    $(document).ready(function() {

        $(".test-form").parsley({

            errorsContainer: function(ParsleyField) {

                return ParsleyField.$element.attr("title");

            },
            // errorsWrapper: false

        });
        window.Parsley.on('field:error', function(fieldInstance) {
            var messages = ParsleyUI.getErrorsMessages(fieldInstance);
            var errorMsg = messages.join(';');
            fieldInstance.$element.tooltip('dispose');
            fieldInstance.$element.tooltip({
                animation: true,
                container: 'body',
                placement: 'top',
                title: errorMsg
            });
        });
        window.Parsley.on('field:success', function(fieldInstance) {
            fieldInstance.$element.tooltip('dispose');
        });
    });
</script>
@endsection