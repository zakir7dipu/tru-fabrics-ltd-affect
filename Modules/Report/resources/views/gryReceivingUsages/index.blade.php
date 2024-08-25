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
                                    <form action="{{ url('admin/report/gray-receiving-uses-summery') }}" method="get"
                                          accept-charset="utf-8" id="report-form" target="_parent">
                                        <input type="hidden" name="type" id="type" value="{{ null }}">
                                        <div class="col-md-12">
                                            <div class="row">
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
                                                <div class="col-md-2">
                                                    <label for="lc_no" class="mb-1"><strong>Select Lc
                                                            No</strong></label>
                                                    <select name="lc_no" id="lc_no"
                                                            class="form-control select2">
                                                        <option value="{{null}}">Select One</option>
                                                        @foreach($proformaInvoices as $lcNo)
                                                            <option
                                                                value="{{$lcNo->id}}" {{request()->has('lc_no')?(request()->get('lc_no')==$lcNo->id?'selected':''):''}}>{{isset($lcNo->lc_no)?$lcNo->lc_no:$lcNo->invoice_no}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 pt-2">
                                                    @include('report-buttons', [
                                                        'url' => url('admin/report/gray-receiving-uses-summery')
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
                                <div class="col-md-12">
                                    @include('report::gryReceivingUsages.report')
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
