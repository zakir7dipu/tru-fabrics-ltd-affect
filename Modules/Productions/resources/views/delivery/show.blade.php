<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('FG Reference No') }}
                                :</strong> {{$fgDelivery->reference_no}}
                        </li>
                        <li><strong>{{__('FG Challan No') }}
                                :</strong> {{$fgDelivery->challan_no}}
                        </li>

                        <li><strong>{{__('Work Order No')}}
                                :</strong>{{$fgDelivery->workOrder->work_order_no}}
                        </li>
                        <li><strong>{{__('Delivered Date')}}
                                :</strong> {{date('d M Y',strtotime($fgDelivery->delivered_date))}}
                        </li>
                        <li><strong>{{__('UP Ref No')}}
                                :</strong> {{$fgDelivery->custom_charge_ref_no}}
                        </li>
                        <li><strong>{{__('UP Charge')}}
                                :</strong> {{systemMoneyFormat($fgDelivery->custom_charge,'$',2)}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Vendor')}}
                                :</strong> {{ucfirst(isset($fgDelivery->vendor->name)?$fgDelivery->vendor->name:'')}}
                        </li>
                        <li><strong>{{__('Truck No')}}:</strong> {{ucfirst($fgDelivery->truck_no)}}</li>
                        <li><strong>{{__('Driver Name')}}:</strong> {{ucfirst($fgDelivery->driver_name)}}</li>
                        <li><strong>{{__('Driver Phone')}}:</strong> {{ucfirst($fgDelivery->driver_phone)}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th>SL</th>
                    <th>Product Category</th>
                    <th>Product Detail</th>
                    <th>UOM</th>
                    <th>Delivery Qty</th>
                    <th width="10%">UOM Type</th>
                    <th width="10%">UOM Qty</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fgDelivery->finishedGoodDeliveryItems as $key=>$item)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->workOrderItem->product->category->name)?$item->workOrderItem->product->category->name:''}}</td>
                        <td>{{isset($item->workOrderItem->product->name)?$item->workOrderItem->product->name:''}}
                            ( {{isset($item->workOrderItem->product->sku)?$item->workOrderItem->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->workOrderItem->product) }}</td>
                        <td>{{ isset($item->workOrderItem->product->productUnit->unit_name)?$item->workOrderItem->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{$item->delivery_qty}}</td>
                        <td class="text-center">{{$item->uom_type}}</td>
                        <td class="text-center">{{$item->uom_qty}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right">Total</td>
                    <td class="text-center">{{$fgDelivery->finishedGoodDeliveryItems->sum('delivery_qty')}}</td>
                    <td colspan="2"></td>
                </tr>
                </tbody>
            </table>

            <div>
                <strong> Remarks </strong>
                {!! $fgDelivery->remarks !!}
            </div>
        </div>
    </div>
</div>
