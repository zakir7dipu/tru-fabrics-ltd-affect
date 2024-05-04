@extends('layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Commercial'],
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
                                        <a href="{{route('finished-goods-deliveries.index')}}"
                                           class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Finished Good Delivery List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Finished Good Delivery Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'finished-goods-deliveries.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('reference_no', 'Reference No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('reference_no', isset($sku)?$sku:request()->old('reference_no'), [
                                                            'id' => 'reference_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Reference No'
                                                        ]) !!}
                                                        {!! $errors->first('reference_no') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('delivered_date', 'Delivered Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('delivered_date', date('Y-m-d'), [
                                                            'id' => 'delivered_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Delivered Date'
                                                        ]) !!}
                                                        {!! $errors->first('delivered_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('work_order_id', 'Work Orders', array('class' => 'col-form-label')) !!}

                                                        <select name="work_order_id"
                                                                id="work_order_id"
                                                                style="width: 100%"
                                                                class="form-control select2"
                                                                onchange="window.open('{{ url('admin/finished-goods-deliveries/create') }}?work_order_id='+$('#work_order_id').val(), '_parent')"
                                                        >

                                                            @if(isset($workOrders))
                                                                <option value="{{null}}">Choose Work Order</option>
                                                                @foreach($workOrders as $key => $workOrder)
                                                                    <option
                                                                        value="{{ $workOrder->id }}" {{ $workOrder->id == \request()->get('work_order_id') ? 'selected' : '' }}>{{ $workOrder->reference_no }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        {!! $errors->first('work_order_id') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 table-responsive style-scroll mt-4 mb-2">

                                                <table class="table table-striped table-bordered miw-500 dac_table"
                                                       cellspacing="0"
                                                       width="100%" id="dataTable">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th width="15%">Category</th>
                                                        <th width="25%">Product</th>
                                                        <th width="5%">UOM</th>
                                                        <th width="5%">Stock Qty</th>
                                                        <th width="10%">Request Qty</th>
                                                        <th width="10%">Prev. Delivered Qty</th>
                                                        <th width="10%">Delivered Qty</th>
                                                        <th width="20%">Warehouse</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($workOderItems[0]))
                                                        @foreach($workOderItems as $item)
                                                            @php
                                                                $item->finishedGoodItems->each(function ($item, $i) {
                                                                        $item['qc_qty'] += $item->finishedGoodQualityControl->where('inspection', 'fresh')->sum('qty');

                                                                        $item['delivered_qty'] += $item->finishedGoodQualityControl->where('inspection', 'fresh')->sum('delivery_qty');
                                                                });

                                                                $stockQty = $item->finishedGoodItems->sum('qc_qty');
                                                                $deliveredQty = $item->finishedGoodItems->sum('delivered_qty');

                                                                $left = $deliveredQty>0?($stockQty-$deliveredQty):$stockQty;
                                                            @endphp


                                                            <tr id="SelectedRow{{$item->product_id}}">
                                                                <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                                                                <td>{{isset($item->product->name)?$item->product->name:''}} {{ getProductAttributesFaster($item->product) }}</td>
                                                                <td class="text-center">
                                                                    {{ $item->product->productUnit->unit_name }}
                                                                </td>
                                                                <td class="text-center">{{$stockQty}}</td>
                                                                <td class="text-center">
                                                                    {{$item->qty}}
                                                                    <input type="hidden" name="work_order_item_id[]"
                                                                           value="{{$item->id}}">
                                                                </td>
                                                                <td class="text-center">{{$deliveredQty}}</td>
                                                                <td class="text-center">
                                                                    <input type="number"
                                                                           name="delivery_qty[{{$item->id}}]"
                                                                           id="delivery_qty_{{$item->id}}"
                                                                           class="form-control delivery_qty text-right"
                                                                           min="0"
                                                                           max="{{$left}}"
                                                                           value="{{$left}}"
                                                                           data-id="{{$item->id}}"
                                                                           data-qty="{{$left}}"
                                                                           step="1"
                                                                           onchange="checkDeliveryQuantity($(this))"
                                                                           onkeyup="checkDeliveryQuantity($(this))">
                                                                </td>
                                                                <td class="text-center">
                                                                    <select
                                                                        class="form-control select2 warehouse_id"
                                                                        name="warehouse_id[{{$item->id}}]"
                                                                        id="warehouse_id{{$item->id}}"
                                                                        data-id="{{$item->id}}"
                                                                        onchange="updateDeliveryQuantity($(this))">
                                                                        @if($warehouses->whereIn('id', $item->finishedGoodItems->pluck('warehouse_id')->toArray())->count() > 0)
                                                                            <option
                                                                                value="0" data-remaining="{{$left}}">All
                                                                                Warehouse
                                                                                ({{ $left }})
                                                                            </option>
                                                                            @foreach($warehouses->whereIn('id', $item->finishedGoodItems->pluck('warehouse_id')->toArray()) as $warehouse)
                                                                                @php
                                                                                    $wh_stockQty = $item->finishedGoodItems->where('warehouse_id', $warehouse->id)->sum('qc_qty');
                                                                                    $wh_deliveredQty = $item->finishedGoodItems->where('warehouse_id', $warehouse->id)->sum('delivered_qty');

                                                                                    $wh_left = $wh_deliveredQty>0?($wh_stockQty-$wh_deliveredQty):$wh_stockQty;
                                                                                @endphp
                                                                                @if($wh_left > 0)
                                                                                <option
                                                                                    value="{{$warehouse->id}}"
                                                                                    data-remaining="{{$wh_left}}"
                                                                                >
                                                                                    {{ $warehouse->name }}
                                                                                    ({{ $wh_left }})
                                                                                </option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </td>
                                                            </tr>
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
        </div>
    </div>

@endsection
@section('javascript')
    <script>

        updateDeliveryQuantity($('.warehouse_id'));

        function updateDeliveryQuantity(element) {
            var dataId = element.attr('data-id');
            var left = element.parent().parent().find('.warehouse_id').find(':selected').attr('data-remaining') != undefined ? element.parent().parent().find('.warehouse_id').find(':selected').attr('data-remaining') : 0;
            var requestQty = $('#delivery_qty_' + dataId).attr('data-qty');
            $('#delivery_qty_' + dataId).val((parseFloat(left) <= parseFloat(requestQty)) ? parseFloat(left) : parseFloat(requestQty)).attr('max', (parseFloat(left) <= parseFloat(requestQty)) ? parseFloat(left) : parseFloat(requestQty));
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
