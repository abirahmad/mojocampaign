@extends('backend.layouts.app')

@section('title')
Questions Lists |
@endsection

@section('top-content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <div class="page-header-left float-left">
                <h3>Questions Lists</h3>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary" id="accordion">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                        <i class="fa fa-filter" aria-hidden="true">Filters</i>
                    </a>
                </h3>
            </div>

            <div class="text-right">

                <a href="{{route('admin.questions.create')}}" class="btn btn-primary btn-sm-report"><i class="fa fa-plus"></i>Add New Question</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')

<div class="row">
    <div class="col-xl-12 xl-100">
        @include('backend.layouts.partials.messages')
        <div class="table-responsive product-table">
            <table class="table table-bordered table-striped ajax_view" id="questions_table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Question Title</th>
                        <th>Question Options</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    questions_table = $('table#questions_table').DataTable({
        dom: 'Blfrtip',
        processing: true,
        serverSide: true,
        searchable: true,
        "ajax": {
            "url": "questions",
        },
        columnDefs: [{}],

        aLengthMenu: [
            [25, 50, 100, 1000, -1],
            [25, 50, 100, 1000, "All"]
        ],

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'options',
                name: 'options'
            },
            {
                data: 'action',
                name: 'action'
            }
        ],

    });
</script>


@endsection