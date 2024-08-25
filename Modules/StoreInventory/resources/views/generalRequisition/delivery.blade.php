@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', [
                'item' => ['/' => languageValue(websiteSettings()->name), 'active' => 'Store Inventory'],
                'pTitle' => $title,
            ])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('general-requisitions-delivery.index')}}"
                                           class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="General Requisition List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('General Requisition Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                {!! Form::open(array('route' => 'general-requisitions-delivery.store','method'=>'POST',
                                'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}

                                <div class="row">

                                    {{--                                    <div class="col-md-3">--}}
                                    {{--                                        <div class="form-group">--}}
                                    {{--                                            <div class="form-line">--}}
                                    {{--                                                {!!  Form::label('reference_no', 'Reference No', ['class' => 'col-form-label']) !!}--}}
                                    {{--                                                <span class="text-danger">*</span>--}}
                                    {{--                                                {!! Form::text('reference_no', isset($sku)?$sku:request()->old('reference_no'), [--}}
                                    {{--                                                    'id' => 'reference_no',--}}
                                    {{--                                                    'class' => 'form-control',--}}
                                    {{--                                                    'placeholder' => 'Enter Reference No'--}}
                                    {{--                                                ]) !!}--}}
                                    {{--                                                {!! $errors->first('reference_no') !!}--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <input type="hidden" name="reference_no"
                                           value="{{isset($sku)?$sku:request()->old('reference_no')}}">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('requisition_id', 'Requisition No', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                <input type="text" readonly class="form-control"
                                                       value="{{$requisition->requisition_no}}">

                                                <input type="hidden" name="requisition_id" class="form-control"
                                                       value="{{$requisition->id}}">

                                                {!! $errors->first('requisition_id') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('delivery_date', 'Delivery Date', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::date('delivery_date', date('Y-m-d'), [
                                                    'id' => 'delivery_date',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter Date'
                                                ]) !!}
                                                {!! $errors->first('delivery_date') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('received_by', 'Received By', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::text('received_by', request()->old('received_by'), [
                                                    'id' => 'received_by',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Mr. X : 89073'
                                                ]) !!}
                                                {!! $errors->first('received_by') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-12 table-responsive style-scroll mt-4 mb-2">

                                    <table class="table table-striped table-bordered miw-500 dac_table"
                                           cellspacing="0"
                                           width="100%" id="dataTable">
                                        <thead>
                                        <tr class="text-center">
                                            <th width="15%">Product Category</th>
                                            <th width="25%">Product Detail</th>
                                            <th width="5%">UOM</th>
                                            {{--<th width="5%">Stock Qty</th>--}}
                                            <th width="10%">Raw Material Request Qty</th>
                                            <th width="10%">Raw Material Issued Qty</th>
                                            <th width="10%">Issuing Qty</th>
                                            <th width="20%">Warehouse</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($requisition)
                                            @foreach($requisition->requisitionItems as $item)
                                                @php
                                                    $deliveredQty =  $item->requisitionDeliveryItems->sum('issued_qty');
                                                @endphp
                                                @if($item->qty != $deliveredQty)
                                                    @php
                                                        $left = $deliveredQty>0 ? $item->qty-$deliveredQty : $item->qty;
                                                        $stockInventoryWiseDeliveryQty = \Modules\Commercial\app\Models\RequisitionDeliveryItems::whereIn('stock_inventory_id',$item->storeInventories->pluck('id'))->sum('issued_qty');

                                                         $count = $item->storeInventories->where(function($query){
                                                                        return $query->where('grnItem.expire_date', '>', date('Y-m-d'))
                                                                        ->orWhereNull('grnItem.expire_date');
                                                                    });

                                                         $currentStockQty = $count->sum('qty')-$stockInventoryWiseDeliveryQty;


                                                         $deliveryQty = $left>$currentStockQty?$currentStockQty:$left;
                                                    @endphp

                                                    <tr id="SelectedRow{{$item->product_id}}">
                                                        <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                                                        <td>{{isset($item->product->name)?$item->product->name:''}} {{ getProductAttributesFaster($item->product) }}</td>
                                                        <td class="text-center">
                                                            {{ $item->product->productUnit->unit_name }}
                                                        </td>
                                                        {{--                                                            <td class="text-center">{{$currentStockQty}}</td>--}}
                                                        <td class="text-center">{{$item->qty}}</td>
                                                        <td class="text-center">{{$deliveredQty}}</td>
                                                        <td class="text-center">
                                                            <input type="number"
                                                                   name="issued_qty[{{$item->id}}]"
                                                                   id="issued_qty_{{$item->id}}"
                                                                   class="form-control issued_qty text-right"
                                                                   min="0"
                                                                   max="{{$deliveryQty}}"
                                                                   value="{{$deliveryQty}}"
                                                                   data-id="{{$item->id}}"
                                                                   data-qty="{{$deliveryQty}}"
                                                                   step="any"
                                                                   onchange="checkDeliveryQuantity($(this))"
                                                                   onkeyup="checkDeliveryQuantity($(this))">
                                                        </td>
                                                        <td class="text-center">
                                                            <select class="form-control select2 stock_inventory_id"
                                                                    name="stock_inventory_id[{{$item->id}}]"
                                                                    id="stock_inventory_id{{$item->id}}"
                                                                    data-id="{{$item->id}}"
                                                                    onchange="updateDeliveryQuantity($(this))">
                                                                @if($count->count() > 0)
                                                                    @foreach($count as $data)
                                                                        @php
                                                                            $sumOfDeliveryItemQty = $data->requisitionDeliveryItems->sum('issued_qty');
                                                                        @endphp

                                                                        @if($sumOfDeliveryItemQty!=$data->qty)
                                                                            <option value="{{$data->id}}"
                                                                                    data-remaining="{{$data->qty}}"> {!! (isset($data->warehouse->name)?$data->warehouse->name:'') . ' ('.$data->mrr_no.' | '.$data->qty-$sumOfDeliveryItemQty.')' !!}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
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
                                    {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
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

    <div class="modal fade bd-example-modal-xl" id="showUserDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="myLargeModalLabel">{{ translate('Requisition Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="modal-body" id="dataBody">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>

        updateDeliveryQuantity($('.stock_inventory_id'));

        function updateDeliveryQuantity(element) {
            var dataId = element.attr('data-id');

            var left = element.parent().parent().find('.stock_inventory_id').find(':selected').attr('data-remaining') !== undefined ? element.parent().parent().find('.stock_inventory_id').find(':selected').attr('data-remaining') : 0;

            var requestQty = $('#issued_qty_' + dataId).attr('data-qty');

            console.log(requestQty)
            console.log(left)

            $('#issued_qty_' + dataId).val((parseFloat(left) <= parseFloat(requestQty)) ? parseFloat(left) : parseFloat(requestQty)).attr('max', (parseFloat(left) <= parseFloat(requestQty)) ? parseFloat(left) : parseFloat(requestQty));
        }

        function checkDeliveryQuantity(element) {
            var value = parseFloat(element.val());
            var max = parseFloat(element.attr('max'));
            var min = parseFloat(element.attr('min'));

            if (value > max) {
                element.val(max);
            }

            if (value < min) {
                element.val(min);
            }
        }
    </script>
@endsection
