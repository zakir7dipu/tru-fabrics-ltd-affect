@extends('layouts.master')
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">

                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Greige Stock Position">Grey Fabric Stock
                                Position</h5>
                            <h5 class="mt-3 mb-3">{{number_format($grayStock['totalStock'],0)}} Yds</h5>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2 font-18"><i
                                        class="mdi mdi-currency-usd"></i><strong> {{systemDashbordMoneyFormat($grayStock['totalStockValue'])}}</strong></span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Greige Stock Position">Dyes & Chemical Stock
                                Position</h5>
                            <h5 class="mt-3 mb-3">{{number_format($dyesChemicalStock['totalStock'])}} Kg</h5>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2 font-18"><i
                                        class="mdi mdi-currency-usd"></i><strong> {{systemDashbordMoneyFormat($dyesChemicalStock['totalStockValue'])}}</strong></span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Greige Stock Position">Work Order Export
                            </h5>
                            <h5 class="mt-3 mb-3">{{number_format($fgDeliveryStock['totalDelivery'])}} Yds</h5>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2 font-18"><i
                                        class="mdi mdi-currency-usd"></i><strong> {{systemDashbordMoneyFormat($fgDeliveryStock['totalDeliveryValue'])}}</strong></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card widget-flat">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="mdi mdi-pulse widget-icon"></i>
                            </div>
                            <h5 class="text-muted fw-normal mt-0" title="Greige Stock Position">Work Order Realization
                            </h5>
                            <h5 class="mt-3 mb-3">{{number_format($fgDeliveryStock['totalDelivery'])}} Yds</h5>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2 font-18"><i
                                        class="mdi mdi-currency-usd"></i><strong> {{systemDashbordMoneyFormat($fgDeliveryRealization)}}</strong></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-12 order-lg-2 order-xl-1">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title">Work Order P&L Status</h4>
                        </div>

                        <div class="card-body pt-0" style="max-height: 510px !important;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">

                                            <select name="work_order_id" id="work_order_id"
                                                    class="form-control select2"
                                                    onchange="calculateProfitLoss($(this))">
                                                @foreach($workOrders as $workOder)
                                                    <option
                                                        value="{{$workOder->id}}" {{request()->has('work_order_id')?(request()->get('work_order_id')==$workOder->id?'selected':''):''}}>{{$workOder->work_order_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2 p-2" id="showProfitLoss">

                        </div>
                    </div>
                </div>

                @php
                    $ids = \DB::table('logs')->when(isset(auth()->user()->id), function ($query) {
                            return $query->whereIn('notification_event_id', auth()->user()->assginNotificationEvents->pluck('pivot.notification_event_id')->toArray());
                    })->whereJsonContains('read_by', auth()->user()->id)->pluck('id')->toArray();

                    $logs = \DB::table('logs')->when(isset(auth()->user()->id), function ($query) {
                            return $query->whereIn('notification_event_id', auth()->user()->assginNotificationEvents->pluck('pivot.notification_event_id')->toArray());
                    })->whereNotIn('id',$ids)
                        ->orderBy('id', 'desc')
                            ->take(10)
                            ->get();
                @endphp
                <div class="col-xl-4 col-lg-4 order-lg-1">
                    <div class="card">
                        <div class="d-flex card-header justify-content-between align-items-center">
                            <h4 class="header-title"><a href="{{ url('admin/notifications') }}">Recent Activity</a></h4>
                        </div>

                        <div class="card-body py-0 mb-3" data-simplebar style="max-height: 510px;">
                            <div class="timeline-alt py-0">
                                @if(isset($logs[0]))
                                    @foreach($logs as $log)
                                        <div class="timeline-item">
                                            <i class="mdi mdi-notification-clear-all bg-info-lighten text-info timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <small>{{ $log->log }}</small>
                                                <p class="mb-0 pb-2">
                                                    <small
                                                        class="text-muted">{{ date('F jS y, g:i a', strtotime($log->created_at)) }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        calculateProfitLoss()

        function calculateProfitLoss(element) {
            let workOrderId = $('#work_order_id').val();

            $('#showProfitLoss').html('<center><h3>Loading....</h3></center>')

            $.ajax({
                type: 'get',
                url: `{{url('get-work-order-wise-pl')}}/${workOrderId}`,

            }).done(function (response) {
                $('#showProfitLoss').html(response);
            })
                .fail(function (response) {
                    $('#showProfitLoss').html(' ');
                });
        }
    </script>
@endsection
