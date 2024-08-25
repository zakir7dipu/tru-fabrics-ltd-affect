@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'GRN'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! Form::open(array('route' => 'grns.quality.ensure.save','method'=>'POST',
                                                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}
                                <div class="row">

                                    <div class="col-md-12 table-responsive-xl mt-2">
                                        <table class="table table-striped table-bordered miw-500"
                                               cellspacing="0"
                                               width="100%" id="dataTable">
                                            <thead>
                                            <tr class="text-center">
                                                <th width="20%">Product Detail</th>
                                                <th>UOM</th>
                                                <th>GRN Qty</th>
                                                <th width="10%">QC Status</th>
                                                <th width="15%">Qty</th>
                                                <th width="15%">Warehouses</th>
                                                <th width="15%">MRR No</th>
                                                <th>Expire Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if(isset($goodReceivedNote->goodReceivedNoteItems))
                                                @foreach($goodReceivedNote->goodReceivedNoteItems as $key=>$item)
                                                    @if($item->quality_ensure=='pending')

                                                        @php
                                                            $receivedQty = $item->quality_ensure=='replace'? ($item->qty-$item->received_qty):$item->qty;
                                                        @endphp
                                                        <input type="hidden" name="grn_item_id[]" value="{{$item->id}}">
                                                        <tr>
                                                            <td><p>
                                                                    <strong>Category</strong>: {{isset($item->product->category)?$item->product->category->name:''}}
                                                                </p>
                                                                <strong>Item</strong>: {{isset($item->product->name)?$item->product->name:''}} {{ getProductAttributesFaster($item->product) }}
                                                                <input type="hidden" name="product_id[{{$item->id}}]"
                                                                       class="form-control"
                                                                       value="{{isset($item->product_id)?$item->product_id:0}}">
                                                            </td>
                                                            <td>
                                                                {{isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:''}}
                                                            </td>

                                                            <td class="text-center">
                                                                {{$item->qty}}
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <select name="quality_ensure[{{$item->id}}]"
                                                                            id="quality_ensure_{{$item->id}}"
                                                                            class="form-control select2"
                                                                            required>

                                                                        @foreach($qualityStatus as $key=>$value)
                                                                            <option value="{{$key}}"
                                                                                    {{$key==$item->quality_ensure?'selected':''}}
                                                                                    data-uom="">{{ $value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="number"
                                                                       name="received_qty[{{isset($item->id)?$item->id:0}}]"
                                                                       class="form-control bg-white"
                                                                       max="{{$receivedQty}}"
                                                                       step="any"
                                                                       id="received_qty_{{isset($item->id)?$item->id:0}}"
                                                                       value="{{$receivedQty}}" placeholder="0"
                                                                       >
                                                            </td>

                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <select name="warehouse_id[{{$item->id}}]"
                                                                            id="warehouse_id_{{$item->id}}"
                                                                            class="form-control select2"
                                                                            required>

                                                                        @foreach($warehouses as $key=>$value)
                                                                            <option
                                                                                value="{{$value->id}}">{{ $value->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </td>

                                                            <td class="text-center">
                                                                <input type="text"
                                                                       name="mrr_no[{{isset($item->id)?$item->id:0}}]"
                                                                       class="form-control bg-white"
                                                                       id="mrr_no_{{isset($item->id)?$item->id:0}}"
                                                                       placeholder="MRR No">
                                                            </td>
                                                            <td class="text-center">
                                                                @if($item->product->is_expire_date=='yes')
                                                                    <input type="date"
                                                                           name="expire_date[{{isset($item->id)?$item->id:0}}]"
                                                                           class="form-control bg-white"
                                                                           id="expire_date_{{isset($item->id)?$item->id:0}}"
                                                                           required
                                                                           placeholder="Date No">
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-12 mt-4">
                                        {!! Form::submit('Quality Ensure and Stock In', ['class' => 'btn btn-success pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
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

