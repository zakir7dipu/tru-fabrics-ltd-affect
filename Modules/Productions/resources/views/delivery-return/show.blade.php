<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('Reference No') }}
                                :</strong> {{$fgItemReturn->reference_no}}
                        </li>
                        <li><strong>{{__('Challan No') }}
                                :</strong> {{$fgItemReturn->challan_no}}
                        </li>

                        <li><strong>{{__('Work Order No')}}
                                :</strong>{{$fgItemReturn->finishedGoodDeliveryItem->workOrderItem->workOrder->work_order_no}}
                        </li>
                        <li><strong>{{__('Return Date')}}
                                :</strong> {{date('d M Y',strtotime($fgItemReturn->datetime))}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Truck No')}}:</strong> {{ucfirst($fgItemReturn->truck_no)}}</li>
                        <li><strong>{{__('Driver Name')}}:</strong> {{ucfirst($fgItemReturn->driver_name)}}</li>
                        <li><strong>{{__('Driver Phone')}}:</strong> {{ucfirst($fgItemReturn->driver_phone)}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th>Product Category</th>
                    <th>Product Detail</th>
                    <th>UOM</th>
                    <th>Delivered Qty</th>
                    <th>Return Qty</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{isset($fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->category->name)?$fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->category->name:''}}</td>
                    <td>{{isset($fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->name)?$fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->name:''}}
                        ( {{isset($fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->sku)?$fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->sku:''}}
                        ) {{ getProductAttributesFaster($fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product) }}</td>
                    <td>{{ isset($fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->productUnit->unit_name)?$fgItemReturn->finishedGoodDeliveryItem->workOrderItem->product->productUnit->unit_name:'' }}</td>
                    <td class="text-center">{{$fgItemReturn->finishedGoodDeliveryItem->delivery_qty}}</td>
                    <td class="text-center">{{$fgItemReturn->quantity}}</td>
                </tr>
                </tbody>
            </table>

            <div>
                <strong> Remarks </strong>
                {!! $fgItemReturn->comments !!}
            </div>
        </div>
    </div>
</div>
