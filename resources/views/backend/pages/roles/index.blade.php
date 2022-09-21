@extends('backend.layouts.app')

@section('title')
Role Lists |
@endsection

@section('top-content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <div class="page-header-left float-left">
                <h3>Role Lists</h3>
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
                   
                      <a  href="{{route('admin.roles.create')}}" class="btn btn-primary btn-sm-report"><i class="fa fa-plus"></i>Add New Role</a>  
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
            <table class="table table-bordered table-striped ajax_view" id="pages_table">
                <thead>
                    <tr>
                        <th>Name</th>
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
    pages_table = $('table#pages_table').DataTable({
        dom: 'Blfrtip',  
        processing: true,
        serverSide: true,
        searchable:true,
        aaSorting: [
            // [3, 'desc']
        ],
        // ajax:"admin/pages",
          "ajax": {
            "url": "roles",
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
        
        columns: [
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action' },
        ],
       
    });
  

</script>


@endsection