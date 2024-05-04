<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('FG Reference No') }}
                                :</strong> {{$fgDelivery->reference_no}}
                        </li>

                        <li><strong>{{__('Work Order No')}}
                                :</strong>{{$fgDelivery->workOrder->work_order_no}}
                        </li>
                        <li><strong>{{__('Garments Name')}}
                                :</strong> {{$fgDelivery->workOrder->garments_name}}
                        </li>
                        <li><strong>{{__('Estimated Delivery Date')}}
                                :</strong> {{date('d M Y',strtotime($fgDelivery->workOrder->delivery_date))}}
                        </li>

                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Delivered Date')}}
                                :</strong> {{date('d M Y',strtotime($fgDelivery->delivered_date))}}
                        </li>
                        <li><strong>{{__('Customer')}}
                                :</strong>{{isset($fgDelivery->workOrder->customer->name)?$fgDelivery->workOrder->customer->name:''}}
                        </li>
                        <li><strong>{{__('Lab Dep Approval')}}
                                :</strong> {{ucfirst($fgDelivery->workOrder->lab_dep_approval)}}</li>
                        <li><strong>{{__('Shrinkage')}}:</strong> {{ucfirst($fgDelivery->workOrder->shrinkage)}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th>SL</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>UOM</th>
                    <th>Delivery Qty</th>
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
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right">Total</td>
                    <td class="text-center">{{$fgDelivery->finishedGoodDeliveryItems->sum('delivery_qty')}}</td>
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
