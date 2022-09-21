    @extends('backend.layouts.app')

    @section('title')
    Edit Question Set
    @endsection

    @section('admin-content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title ">Pages</h4>
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
                        <form class="form-horizontal" action="{{route('admin.question-set.update',$questionSet->id)}}" method="POST" id="pages" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                            @endif
                            <div class="card-body">
                                <h4 class="card-title">Update Question Set</h4>


                                @include('backend.layouts.partials.messages')
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12 ">
                                            <div class="form-group required">
                                                <label for="name" class="text-right control-label ">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{$questionSet->title }}" placeholder="eg; Soft Drinks" required="" />
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
                        </form>
                    </div>
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