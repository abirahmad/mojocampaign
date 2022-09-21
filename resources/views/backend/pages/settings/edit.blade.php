@extends('backend.layouts.app')

@section('title')
Edit Settings
@endsection


@section('admin-content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title ">Settings</h4>
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
                    <form class="form-horizontal" action="{{route('admin.pages.settingsUpdate',$settings->id)}}" method="POST" id="pages" enctype="multipart/form-data" >
                        @csrf
                        @method('post')
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">Update Settings</h4>
                           
                        
                            @include('backend.layouts.partials.messages')
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group required ">

                                <label for="name" class="text-right control-label ">Business Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name" value="{{$settings->name}}" placeholder="Enter Business Name Here" required>
                            </div>
                                
                              </div>

                                    <div class="form-group row">
                                        <label for="image" class="text-right control-label col-form-label">Old Image</label>
                                        <div class="col-sm-8 ">
                                            <a class="dropdown-item" href="#showModal{{ $settings->id }}" data-toggle="modal">
                                                <img class="report-min-img" src="{{ url('public/assets/backend/images/logo/'.$settings->logo) }}">
                                            </a>
                                        </div>
                                   </div>
                                    @if($settings->logo == null)
                                    <div class="form-group required">
                                        
                                        <label for="logo" class="text-right control-label col-form-label">Logo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="logo" name="logo" required>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group">
                                        
                                        <label for="logo" class="text-right control-label col-form-label">Logo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="logo" name="logo">
                                        </div>
                                    </div>
                                    @endif

                                <div class="form-group">
                                        
                                        <label for="contact_toll_free_number" class="text-right control-label col-form-label">Contact Toll Free Number</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                       <div class="col-sm-8">
                                            <input type="text" class="form-control" id="contact_toll_free_number" name="contact_toll_free_number" value="{{$settings->contact_toll_free_number}}" placeholder="Enter toll free number">
                                        </div>
                                </div>


                                <div class="form-group">
                                        
                                        <label for="contact_hotline_number" class="text-right control-label col-form-label">Hotline Number</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                       <div class="col-sm-8">
                                            <input type="text" class="form-control" id="contact_hotline_number" name="contact_hotline_number" value="{{$settings->contact_hotline_number}}" placeholder="Enter Hotline Number">
                                        </div>
                                </div>

                                 <div class="form-group">
                                        
                                        <label for="email" class="text-right control-label col-form-label">Email</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                       <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" name="email" value="{{$settings->email}}" placeholder="Enter Email here">
                                        </div>
                                </div>

                                 <div class="form-group required">
                                        
                                        <label for="address" class="text-right control-label col-form-label">Address</label>
                                       <div class="col-sm-8">
                                            <input type="text" class="form-control" id="address" name="address" value="{{$settings->address}}" placeholder="Enter address" required>
                                        </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="office_hour" class="text-right control-label col-form-label">Office Hour</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                           <div class="col-sm-8">
                                                <input type="text" class="form-control" id="office_hour" name="office_hour" value="{{$settings->office_hour}}" placeholder="Enter Office hour here">
                                            </div>
                                         </div>

                                         <div class="form-group">
                                            <label for="facebook_link" class="text-right control-label col-form-label">Facebook Link</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                           <div class="col-sm-8">
                                                <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="{{$settings->facebook_link}}" placeholder="Enter facebook link here">
                                            </div>
                                         </div>

                                         <div class="form-group">
                                            <label for="twitter_link" class="text-right control-label col-form-label">Twitter Link</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                           <div class="col-sm-8">
                                                <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="{{$settings->twitter_link}}" placeholder="Enter twitter link here">
                                            </div>
                                         </div>

                                         <div class="form-group">
                                            <label for="likedin_link" class="text-right control-label col-form-label">Linkdin Link</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                           <div class="col-sm-8">
                                                <input type="text" class="form-control" id="likedin_link" name="likedin_link" value="{{$settings->likedin_link}}" placeholder="Enter linkedin link here">
                                            </div>
                                         </div>

                                         <div class="form-group">
                                            <label for="instagram_link" class="text-right control-label col-form-label">Instagram Link</label><span style="color:#0B61B7; font-weight: bold">(Optional)</span>
                                           <div class="col-sm-8">
                                                <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="{{$settings->instagram_link}}" placeholder="Enter instagram link here">
                                            </div>
                                         </div>

                                         <div class="form-group required">
                                            <label for="footer_text" class="text-right control-label col-form-label">Footer Text</label>
                                           <div class="col-sm-8">
                                                <input type="text" class="form-control" id="footer_text" name="footer_text" value="{{$settings->footer_text}}" placeholder="Enter footer text here" required="">
                                            </div>
                                         </div>


                                    </div>

                                     <div class="modal fade delete-modal" id="showModal{{ $settings->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{$settings->name}}-Logo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="modal-max-img" src="{{ url('public/assets/backend/images/logo/'.$settings->logo) }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i
                                                class="fa fa-times"></i> Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                </div>
                            </div>
                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
@endsection