@extends('backend.layouts.app')

@section('title')
Create Users
@endsection


@section('admin-content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title ">Users</h4>
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
        <div class="row" >
            <div class="col-md-12">
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <form class="form-horizontal" action="{{route('admin.users.store')}}" method="POST" id="pages" enctype="multipart/form-data" >
                        @csrf
                        @method('post')
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">Create Users</h4>
                           
                        
                            @include('backend.layouts.partials.messages')
                        <div class="row">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-6 ">
                                        <div class="form-group required">
                                            <label for="first_name" class="text-right control-label ">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label for="last_name" class="text-right control-label ">Last Name<span style="color:#0B61B7; font-weight: bold">(Optional)</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                        <div class="col-sm-6 ">
                                            <div class="form-group required">
                                                <label for="username" class="text-right control-label ">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Enter Username" required="" />
                                            </div>
                                        </div>
    
                                        <div class="col-sm-6 ">
                                                <div class="form-group">
                                                    <label for="phone_no" class="text-right control-label ">Phone Number<span style="color:#0B61B7; font-weight: bold">(Optional)</span></label>
                                                    <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" placeholder="eg:1234567890" />
                                                </div>
                                            </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <div class="form-group required">
                                                <label for="email" class="text-right control-label ">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="eg:example@email.com" required="" />
                                            </div>
                                        </div>
    
                                        <div class="col-sm-6">
                                            <div class="form-group required">
                                                <label for="is_approved" class="text-right ">Approval</label>
                                                <select class="form-control select2" name="is_approved" required>
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <div class="form-group required">
                                                <label for="password" class="text-right control-label ">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter a Password" minlength="6" required="" />
                                            </div>
                                        </div>
    
                                        <div class="col-sm-6 ">
                                                <div class="form-group required">
                                                    <label for="confirm_password" class="text-right control-label ">Confirm Password</label>
                                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Enter Password to Confirm" required/>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group required">
                                                    <label for="role" class="text-right ">Role</label>
                                                    <select class="form-control select2" name="role" required>
                                                        <option value="">Please Select</option>
                                                            @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                            @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                </div>
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
    $(document).ready(function () {
    
    $(".test-form").parsley({
      
      errorsContainer: function (ParsleyField) {
          
        return ParsleyField.$element.attr("title");
        
    },
        // errorsWrapper: false

    });
    window.Parsley.on('field:error', function (fieldInstance) {
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
    window.Parsley.on('field:success', function (fieldInstance) {
        fieldInstance.$element.tooltip('dispose');
    });
    });

</script> 

<script>
    var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
@endsection