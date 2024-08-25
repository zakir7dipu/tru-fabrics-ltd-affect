@extends('layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Productions'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('billings.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Billings List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Billings Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'billings.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('work_order_id', 'Work Orders', array('class' => 'col-form-label')) !!}

                                                        <select name="work_order_id"
                                                                id="work_order_id"
                                                                class="form-control select2 work-orders"
                                                                onchange="getWorkOrderItems($(this))">

                                                            @if(isset($workOrders))
                                                                <option value="{{null}}">Choose Work Order</option>
                                                                @foreach($workOrders as $key => $workOrder)

                                                                    <option
                                                                        value="{{ $workOrder->id }}"
                                                                        data-order-no="{{$workOrder->reference_no}}"
                                                                        data-delivery-qty="{{number_format($workOrder->workOrderItems->sum('qty'))}}"
                                                                        data-delivery-total="{{$workOrder->workOrderItems->sum('sub_total')}}"
                                                                        data-delivery-date="{{$workOrder->finishedGoodsDeliveries->sortByDesc('delivered_date')->first()->delivered_date}}"
                                                                    >{{ $workOrder->work_order_no }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        {!! $errors->first('work_order_id') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('work-order-no', 'Work Reference NO', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>

                                                        <input type="text" name="work_order_no" class="form-control"
                                                               id="work_order_no" readonly="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('data-delivery-date', 'Delivery Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>

                                                        <input type="text" name="delivery_date" class="form-control"
                                                               id="delivery_date" readonly="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('data-delivery-qty', 'Delivery Qty', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>

                                                        <input type="text" name="delivery_qty" class="form-control"
                                                               id="delivery_qty" readonly="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('data-delivery-total', 'Negotiation Value', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>

                                                        <input type="text" name="data_delivery_total"
                                                               class="form-control mask-money"
                                                               id="data-delivery-total" readonly="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('finished_goods_delivery_id', 'Finished Goods Delivered Reference No ', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>

                                                        <select name="finished_goods_delivery_id[]"
                                                                id="finished_goods_delivery_id"
                                                                class="form-control select2" multiple>

                                                        </select>

                                                        {!! $errors->first('finished_goods_delivery_id') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('export_lc_no', 'Export LC No', ['class' => 'col-form-label']) !!}

                                                        <input type="text" name="export_lc_no" class="form-control"
                                                               id="export_lc_no">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('bill_no', 'Bill ID', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('bill_no', request()->old('bill_no'), [
                                                            'id' => 'bill_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Bill ID',
                                                            'required'
                                                        ]) !!}
                                                        {!! $errors->first('bill_no') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('submit_date', 'Docs. Submission Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('submit_date', date('Y-m-d'), [
                                                            'id' => 'submit_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Submission Date'
                                                        ]) !!}
                                                        {!! $errors->first('submit_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('accept_date', 'Accept Date', ['class' => 'col-form-label']) !!}

                                                        {!! Form::date('accept_date', \request()->old('accept_date'), [
                                                            'id' => 'accept_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Accept Date'
                                                        ]) !!}
                                                        {!! $errors->first('accept_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('maturity_date', 'Maturity Date', ['class' => 'col-form-label']) !!}

                                                        {!! Form::date('maturity_date', \request()->old('maturity_date'), [
                                                            'id' => 'maturity_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Maturity Date'
                                                        ]) !!}
                                                        {!! $errors->first('maturity_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('realization_date', 'Realization Date', ['class' => 'col-form-label']) !!}

                                                        {!! Form::date('realization_date', \request()->old('realization_date'), [
                                                            'id' => 'realization_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Realization Date'
                                                        ]) !!}
                                                        {!! $errors->first('realization_date') !!}
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('discrepancies_charge', 'Discrepancy / Short Realization', ['class' => 'col-form-label']) !!}
                                                        {!! Form::number('discrepancies_charge', request()->old('discrepancies_charge'), [
                                                            'id' => 'discrepancies_charge',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Charge',
                                                            'step'=>'any',
                                                            'min'=>0,
                                                            'onchange'=> 'calculateDueRealized()',
                                                            'onkeyup'=> 'calculateDueRealized()',
                                                        ]) !!}
                                                        {!! $errors->first('discrepancies_charge') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('bank_charge_ait', 'Bank Charge & AIT', ['class' => 'col-form-label']) !!}
                                                        {!! Form::number('bank_charge_ait', request()->old('bank_charge_ait'), [
                                                            'id' => 'bank_charge_ait',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Bank Charge & AIT',
                                                            'step'=>'any',
                                                            'min'=>0,
                                                            'onchange'=> 'calculateDueRealized()',
                                                            'onkeyup'=> 'calculateDueRealized()',
                                                        ]) !!}
                                                        {!! $errors->first('bank_charge_ait') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('realized_value', 'Gross Realized Values', ['class' => 'col-form-label']) !!}
                                                        {!! Form::number('realized_value',request()->old('realized_value'), [
                                                            'id' => 'realized_value',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Value',
                                                            'step'=>'any',
                                                            'min'=>0,
                                                            'onchange'=> 'calculateDueRealized()',
                                                            'onkeyup'=> 'calculateDueRealized()',
                                                        ]) !!}
                                                        {!! $errors->first('realized_value') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('short_realized_amount', 'Net Realized Value', ['class' => 'col-form-label']) !!}
                                                        {!! Form::number('short_realized_amount', request()->old('short_realized_amount'), [
                                                            'id' => 'short_realized_amount',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Value',
                                                            'step'=>'any',
                                                            'min'=>0,
                                                        ]) !!}
                                                        {!! $errors->first('short_realized_amount') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('freight_charge', 'Freight Charge', ['class' => 'col-form-label']) !!}
                                                        {!! Form::number('freight_charge', request()->old('freight_charge'), [
                                                            'id' => 'freight_charge',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Bank Freight Charge',
                                                            'step'=>'any',
                                                            'min'=>0
                                                        ]) !!}
                                                        {!! $errors->first('freight_charge') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('after_sales_charge', 'Touch up/Mending Cost', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        {!! Form::number('after_sales_charge', request()->old('after_sales_charge'), [--}}
                                            {{--                                                            'id' => 'after_sales_charge',--}}
                                            {{--                                                            'class' => 'form-control mask-money',--}}
                                            {{--                                                            'placeholder' => 'Enter After Sales Charge',--}}
                                            {{--                                                            'step'=>'any',--}}
                                            {{--                                                            'min'=>0--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('after_sales_charge') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('poly_paper_lost_cost', 'Poly Paper Lost Cost', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        {!! Form::number('poly_paper_lost_cost', request()->old('poly_paper_lost_cost'), [--}}
                                            {{--                                                            'id' => 'poly_paper_lost_cost',--}}
                                            {{--                                                            'class' => 'form-control mask-money',--}}
                                            {{--                                                            'placeholder' => 'Enter cost',--}}
                                            {{--                                                            'step'=>'any',--}}
                                            {{--                                                            'min'=>0--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('poly_paper_lost_cost') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('repacking_cost', 'Repacking Cost', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        {!! Form::number('repacking_cost', request()->old('repacking_cost'), [--}}
                                            {{--                                                            'id' => 'repacking_cost',--}}
                                            {{--                                                            'class' => 'form-control mask-money',--}}
                                            {{--                                                            'placeholder' => 'Enter cost',--}}
                                            {{--                                                            'step'=>'any',--}}
                                            {{--                                                            'min'=>0--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('repacking_cost') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('contamination_removing_cost', 'Contamination Removing Cost', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        {!! Form::number('contamination_removing_cost', request()->old('contamination_removing_cost'), [--}}
                                            {{--                                                            'id' => 'contamination_removing_cost',--}}
                                            {{--                                                            'class' => 'form-control mask-money',--}}
                                            {{--                                                            'placeholder' => 'Enter cost',--}}
                                            {{--                                                            'step'=>'any',--}}
                                            {{--                                                            'min'=>0--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('contamination_removing_cost') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('extra_logistics_cost', 'Extra Logistics Cost', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        {!! Form::number('extra_logistics_cost', request()->old('extra_logistics_cost'), [--}}
                                            {{--                                                            'id' => 'extra_logistics_cost',--}}
                                            {{--                                                            'class' => 'form-control mask-money',--}}
                                            {{--                                                            'placeholder' => 'Enter cost',--}}
                                            {{--                                                            'step'=>'any',--}}
                                            {{--                                                            'min'=>0--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('extra_logistics_cost') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}
                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('extra_load_unload_cost', 'Extra Load & Unload Cost', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        {!! Form::number('extra_load_unload_cost', request()->old('extra_load_unload_cost'), [--}}
                                            {{--                                                            'id' => 'extra_load_unload_cost',--}}
                                            {{--                                                            'class' => 'form-control mask-money',--}}
                                            {{--                                                            'placeholder' => 'Enter cost',--}}
                                            {{--                                                            'step'=>'any',--}}
                                            {{--                                                            'min'=>0--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('extra_load_unload_cost') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('fg_files', 'Bills File', array('class' => 'col-form-label')) !!}
                                                        <br>
                                                        <input type="file" name="fg_files"
                                                               id="fg_files" class="btn btn-outline-success btn-sm">

                                                        {!! $errors->first('fg_files') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}
                                                        <br>

                                                        <select name="status" id="status" class="form-control select2">
                                                            @if(isset($statuss))
                                                                @foreach($statuss as $key => $value)
                                                                    <option
                                                                        value="{{ $key }}">{{ $value }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        {!! $errors->first('status') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('remarks', 'Remarks', ['class' => 'col-form-label']) !!}
                                                        {!! Form::textarea('remarks', request()->old('remarks'), [
                                                            'id' => 'remarks',
                                                            'class' => 'form-control',
                                                            'rows'=>'5',
                                                            'placeholder' => 'Enter Remarks'
                                                        ]) !!}
                                                        {!! $errors->first('remarks') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                {!! Form::submit('Submit Bills', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                                                &nbsp;
                                            </div>
                                        </div>


                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')

    <script type="text/javascript">
        function getWorkOrderItems(element) {
            $('#finished_goods_delivery_id').html('<option value="">Please Wait...</option>')
                .empty().load('{{URL::to("admin/billings/load-wo-wise-fg-references")}}/' + $('#work_order_id').val());

            $.each($('.work-orders'), function (index, val) {
                $('#work_order_no').val($(this).find(':selected').attr('data-order-no'));
                $('#data-delivery-total').val($(this).find(':selected').attr('data-delivery-total'));
                $('#delivery_qty').val($(this).find(':selected').attr('data-delivery-qty'));
                $('#delivery_date').val($(this).find(':selected').attr('data-delivery-date'));
            });
            calculateDueRealized();
        }

        function calculateDueRealized() {
            let totalWorkOrderValue = $('#data-delivery-total').val();
            let discrepanciesCharge = $('#discrepancies_charge').val();
            let bankChargeAIT = $('#bank_charge_ait').val();
            if (totalWorkOrderValue !== null) {
                let postRealizedValue = parseFloat(totalWorkOrderValue) - parseFloat(discrepanciesCharge);
                $('#realized_value').val(postRealizedValue.toFixed(4));
                let grossRealized = $('#realized_value').val();
                let netRealized = parseFloat(grossRealized) - parseFloat(bankChargeAIT);
                $('#short_realized_amount').val(netRealized.toFixed(4));
            }
        }


    </script>
@endsection
