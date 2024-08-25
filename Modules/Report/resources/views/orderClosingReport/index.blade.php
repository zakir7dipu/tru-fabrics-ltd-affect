@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Report'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <form action="{{ url('admin/report/order-closing-report') }}" method="get"
                                          accept-charset="utf-8" id="report-form" target="_parent">
                                        <input type="hidden" name="type" id="type" value="{{ null }}">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label for="work_order_id" class="mb-1"><strong>Select Work
                                                            Order</strong></label>
                                                    <select name="work_order_id" id="work_order_id"
                                                            class="form-control select2">
                                                        <option value="{{null}}">Select One</option>
                                                        @foreach($workOrders as $workOder)
                                                            <option
                                                                value="{{$workOder->id}}" {{request()->has('work_order_id')?(request()->get('work_order_id')==$workOder->id?'selected':''):''}}>{{$workOder->work_order_no}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="from" class="mb-1"><strong>From</strong></label>
                                                    <input type="date" name="from" id="from" class="form-control"
                                                           value="{{ request()->has('from')? request()->get('from'): date('Y-m-01') }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="to" class="mb-1"><strong>To</strong></label>
                                                    <input type="date" name="to" id="to" class="form-control"
                                                           value="{{ request()->has('to')? request()->get('to'): date('Y-m-t')}}">
                                                </div>

                                                <div class="col-md-3 pt-2">
                                                    @include('report-buttons', [
                                                        'url' => url('admin/report/order-closing-report')
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(request()->get('type') == 'search')
                        <div class="card card-info mt-2 p-2">
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    @include('report::orderClosingReport.report')
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
