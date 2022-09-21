@extends('backend.layouts.app')

@section('title')
Daily Winners Lists |
@endsection

@section('top-content')
<div class="page-header">
    <div class="row">
        <div class="col">
            <div class="page-header-left float-left">
                <h3>Daily Winners Lists</h3>
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

                <!-- <a href="{{route('admin.responses.create')}}" class="btn btn-primary btn-sm-report"><i class="fa fa-plus"></i>Add New Response</a> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')

<div class="row">
    <div class="col-xl-12 xl-100">
        @include('backend.layouts.partials.messages')

        <form action="" class=" mb-3" method="GET">
            <input type="date" name="date" id="date" class="form-control" style="width: 300px; display:inline-block" value="{{ isset(request()->date) ? request()->date: null }}"/>
            <button type="submit" class="btn btn-success ml-2">Search</button>
        </form>

        <div class="table-responsive product-table">
            <table class="table table-bordered table-striped ajax_view" id="daily_winners_table">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>User</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Correct Answer</th>
                        <th>Total Time (Seconds)</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dailyWinners as $winner)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $winner->username }}</td>
                            <td>{{ $winner->phone_no }}</td>
                            <td>{{ $winner->location }}</td>
                            <td>{{ $winner->total_correct }}</td>
                            <td>{{ $winner->total_time }}</td>
                            <td>{{ $winner->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    daily_winners_table = $('table#daily_winners_table').DataTable({
        dom: 'Blfrtip',
        searchable: true,

        aLengthMenu: [
            [25, 50, 100, 1000, -1],
            [25, 50, 100, 1000, "All"]
        ]
    });
</script>


@endsection