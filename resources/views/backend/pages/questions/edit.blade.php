    @extends('backend.layouts.app')

    @section('title')
    Edit Question
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">Questions</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Question</li>
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
                        <form class="form-horizontal" action="{{route('admin.questions.update',$questions->id)}}" method="POST" id="pages" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('success') }}</p>
                            </div>
                            @endif
                            <div class="card-body">
                                <h4 class="card-title">Update Question</h4>


                                @include('backend.layouts.partials.messages')
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-12 ">
                                            <div class="form-group required">
                                                <label for="name" class="text-right control-label ">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{$questions->title }}" placeholder="eg: পহেলা বৈশাখ কত তারিখে পালিত হয়?" required="" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group required">
                                                <label for="question_set_id" class="text-right ">Question Set</label>
                                                <select class="form-control select2" name="question_set_id" required>
                                                    @foreach ($questionSet as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $questions->question_set_id ? 'selected' : '' }}>{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 ">
                                            <div class="form-group">
                                                <label for="first_answer" class="text-right control-label ">First Answer</label>
                                                <input type="text" class="form-control" id="first_answer" name="first_answer" value="{{ $questions->first_answer }}" placeholder="eg: 1st Boishakh" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="is_correct">Is Correct?</label>
                                                <input type="radio" id="is_correct" name="is_correct" value="first_answer" {{ $questions->first_check? 'checked' : '' }} />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 ">
                                            <div class="form-group">
                                                <label for="second_answer" class="text-right control-label ">Second Answer</label>
                                                <input type="text" class="form-control" id="second_answer" name="second_answer" value="{{ $questions->second_answer }}" placeholder="eg: 1st Boishakh" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="is_correct">Is Correct?</label>
                                                <input type="radio" id="is_correct" name="is_correct" value="second_answer" {{ $questions->second_check? 'checked' : '' }} />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 ">
                                            <div class="form-group">
                                                <label for="third_answer" class="text-right control-label ">Third Answer</label>
                                                <input type="text" class="form-control" id="third_answer" name="third_answer" value="{{ $questions->third_answer }}" placeholder="eg: 1st Boishakh" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="is_correct">Is Correct?</label>
                                                <input type="radio" id="is_correct" name="is_correct" value="third_answer" {{ $questions->third_check? 'checked' : '' }} />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 ">
                                            <div class="form-group">
                                                <label for="fourth_answer" class="text-right control-label ">Fourth Answer</label>
                                                <input type="text" class="form-control" id="fourth_answer" name="fourth_answer" value="{{ $questions->fourth_answer }}" placeholder="eg: 1st Boishakh" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="is_correct">Is Correct?</label>
                                                <input type="radio" id="is_correct" name="is_correct" value="fourth_answer" {{ $questions->fourth_check? 'checked' : '' }} />
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