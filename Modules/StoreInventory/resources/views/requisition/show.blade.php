<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        @if(isset($model->requisition->workOrderItem))
                            <li><strong>{{__('Work Order No')}}
                                    : </strong> {{isset($model->requisition->workOrderItem->workOrder->work_order_no)?$model->requisition->workOrderItem->workOrder->work_order_no:''}}
                            </li>
                        @endif
                        <li><strong>{{__('Requisition No')}}
                                : </strong> {{isset($model->requisition->requisition_no)?$model->requisition->requisition_no:''}}
                        </li>
                        <li><strong>{{__('Received By')}}
                                : </strong>{{isset($model->received_by)?$model->received_by:''}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Delivery Date')}}
                                : </strong>{{date('d M Y',strtotime($model->delivery_date))}}
                        </li>
                        <li><strong>{{__('Delivered By')}}
                                : </strong>{{isset($model->deliverdBy->name)?$model->deliverdBy->name:''}}
                        </li>
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
                    <th>Raw Material Request Qty</th>
                    <th>Raw Material Issued Qty</th>
                    {{--                    <th>Unit Price (With LC & GRN Cost)</th>--}}
                    {{--                    <th>Total Price (With LC & GRN Cost)</th>--}}
                </tr>
                </thead>
                <tbody>
                @php
                    $totalReqItem = 0;
                @endphp
                @foreach($model->requisitionDeliveryItems as $key=>$item)
                    @php
                        $totalReqItem += $item->requisitionItem->qty;

                        $unit_price = getGrnItemUnitPrice($item->stockInventory->grnItem, $item->stockInventory->grnItem->goodReceivedNote);
                    @endphp
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->requisitionItem->product->category->name)?$item->requisitionItem->product->category->name:''}}</td>
                        <td>{{isset($item->requisitionItem->product->name)?$item->requisitionItem->product->name:''}}
                            ( {{isset($item->requisitionItem->product->sku)?$item->requisitionItem->product->id:''}}
                            ) {{ getProductAttributesFaster($item->requisitionItem->product) }}</td>
                        <td>{{ isset($item->requisitionItem->product->productUnit->unit_name)?$item->requisitionItem->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{$item->requisitionItem->qty}}</td>
                        <td class="text-center">{{$item->issued_qty}}</td>

                        {{--                        <td class="text-center">{{systemMoneyFormat( $unit_price['unit_price']) }}</td>--}}
                        {{--                        <td class="text-center">{{ systemMoneyFormat($item->issued_qty*$unit_price['unit_price']) }}</td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div>
                <strong> Remarks : </strong>
                {!! $model->remarks !!}
            </div>

        </div>
    </div>
</div>
