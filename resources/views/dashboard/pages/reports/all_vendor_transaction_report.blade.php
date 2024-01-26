@extends('dashboard.layouts.app')
@section('content')
    @include('dashboard.layouts.breadcrumbs')
    <section>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header date-range">
                        <form class="row" method="get" action="/dashboard/reports/all_vendor_transaction">

                            <div class="col-2">
                                <h6>Select Date Range</h6>
                            </div>
                            <div class="col-3">
                                <input id="daterange" name="daterange" class="form-control" >
                            </div>
                            <div class="col-3">
                                <button  type="submit" class="btn btn-primary"><i class="fa fa-filter"></i>   Filter</button>
                            </div>
                        </form>
                        <hr/>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Vendor</th>
                                        <th>Total</th>
                                        <th>Commission</th>
                                        <th>Payable Amt</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->vendor_name}}</td>
                                        <td>{{$data->amount}}</td>
                                        <td>{{$data->fee}}</td>
                                        <td>{{$data->amount - $data->fee}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function () {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            $('#daterange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb)
        })
    </script>
@endsection
