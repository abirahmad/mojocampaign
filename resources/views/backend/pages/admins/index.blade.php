@extends('backend.layouts.app')

@section('title')
Admins Lists |
@endsection

@section('top-content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <div class="page-header-left float-left">
                <h3>Admins Lists</h3>
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

                <a href="{{route('admin.admins.create')}}" class="btn btn-primary btn-sm-report"><i class="fa fa-plus"></i>Add New Admin</a>
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
            <table class="table table-bordered table-striped ajax_view" id="admins_table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone No.</th>
                        <th>Email</th>
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
    // $('#test_report_filter_form #item_type, #test_report_filter_form #item').change(function() {
    //     // alert('serching');
    //         question_requisition.ajax.reload();
    //     });
    admins_table = $('table#admins_table').DataTable({
        dom: 'Blfrtip',
        processing: true,
        serverSide: true,
        searchable: true,
        aaSorting: [
            // [3, 'desc']
        ],
        // ajax:"admin/pages",
        "ajax": {
            "url": "admins",
        },
        columnDefs: [{
            //     "targets": [7, 8],
            //     // "orderable": false,
            //     // "searchable": false
        }],

        aLengthMenu: [
            [25, 50, 100, 1000, -1],
            [25, 50, 100, 1000, "All"]
        ],


        //  buttons: [
        //     'excel', 'pdf', 'print'
        // ],

        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'phone_no',
                name: 'phone_no'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],

    });
</script>


@endsection