@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Finished Goods'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! Form::open(array('route' => 'finished-goods-inspections.store','method'=>'POST',
                                                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}
                                <div class="row">

                                    <div class="col-md-12 table-responsive-xl mt-2">
                                        <table class="table table-striped table-bordered miw-500"
                                               cellspacing="0"
                                               width="100%" id="dataTable">
                                            <thead>
                                            <tr class="text-center">
                                                <th>SL</th>
                                                <th>Category</th>
                                                <th width="25%">Product</th>
                                                <th>UOM</th>
                                                <th>Qty</th>
                                                <th>Prev. QC Qty</th>
                                                <th>Left QC Qty</th>
                                                @foreach($qualityStatus as $key=>$value)
                                                    <th width="10%">{{$value}}</th>
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($finishedGood->finishedGoodItems as $key=>$item)
                                                @php
                                                    $previousQty = collect($item->finishedGoodQualityControl)->where('is_wip','no')->sum('qty');
                                                    $receivedQty = $previousQty >0? ($item->qty-$previousQty):$item->qty;
                                                @endphp
                                                <input type="hidden" name="finished_good_item_id[]"
                                                       value="{{$item->id}}">

                                                @if($receivedQty>0)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{$key+1}}
                                                        </td>
                                                        <td>{{isset($item->workOrderItem->product->category->name)?$item->workOrderItem->product->category->name:''}}</td>
                                                        <td>{{isset($item->workOrderItem->product->name)?$item->workOrderItem->product->name:''}}
                                                            ( {{isset($item->workOrderItem->product->sku)?$item->workOrderItem->product->sku:''}}
                                                            ) {{ getProductAttributesFaster($item->workOrderItem->product) }}</td>
                                                        <td>{{ isset($item->workOrderItem->product->productUnit->unit_name)?$item->workOrderItem->product->productUnit->unit_name:'' }}</td>
                                                        <td class="text-center">{{$item->qty}}</td>
                                                        <td class="text-center">{{$previousQty}}</td>
                                                        <td class="text-center">{{$receivedQty}}</td>

                                                        @foreach($qualityStatus as $key=>$value)
                                                            <td>
                                                                <input type="number"
                                                                       name="{{$key}}_qty[{{isset($item->id)?$item->id:0}}]"
                                                                       class="form-control bg-white {{ $key }}-items"
                                                                       min="0"
                                                                       max="{{$receivedQty}}"
                                                                       id="{{$key}}_qty{{$item->id}}"
                                                                       value="{{$key=='fresh'?$receivedQty:0}}"
                                                                       placeholder="0"
                                                                       keyType="{{$key}}"
                                                                       itemId="{{$item->id}}"

                                                                       onchange="checkQuantity($(this))"
                                                                       onkeyup="checkQuantity($(this))"
                                                                       onkeydown="checkQuantity($(this))"
                                                                    {{ $key == 'wip' ? 'readonly' : '' }}
                                                                >
                                                            </td>
                                                        @endforeach

                                                    </tr>
                                                @endif
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        {!! Form::submit('FG Quality Ensure', ['class' => 'btn btn-success pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
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

@endsection
@section('javascript')
    <script>
        function checkQuantity(element) {
            var keyType = element.attr('keyType');
            var value = parseInt(element.val());
            var max = parseInt(element.attr('max'));
            var min = parseInt(element.attr('min'));
            if (value > max) {
                value = max;
                element.val(value);
            }
            if (value < min) {
                value = min;
                element.val(value);
            }

            var fresh = parseInt(element.parent().parent().find('.fresh-items').val());
            var reject = parseInt(element.parent().parent().find('.reject-items').val());

            if (keyType === 'fresh') {
                if(fresh+reject > max){
                    fresh = max-reject;
                }
            } else if (keyType === 'reject') {
                if(fresh+reject > max){
                    reject = max-fresh;
                }
            }

            var wip = max - (fresh + reject);
            element.parent().parent().find('.fresh-items').val(fresh);
            element.parent().parent().find('.reject-items').val(reject);
            element.parent().parent().find('.wip-items').val(wip);
        }
    </script>
@endsection


