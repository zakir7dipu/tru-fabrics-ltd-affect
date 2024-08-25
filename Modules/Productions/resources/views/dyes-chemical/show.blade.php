<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('Usages Reference No') }}
                                :</strong> {{$model->reference_no}}
                        </li>
                        <li><strong>{{__('Usages Date')}}
                                :</strong> {{date('d M Y',strtotime($model->date))}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Work Order No')}}
                                :</strong>{{isset($model->workOrderItem->workOrder->work_order_no)?$model->workOrderItem->workOrder->work_order_no:''}}
                        </li>
                        <li><strong>{{__('Garments Name')}}
                                :</strong> {{isset($model->workOrderItem->workOrder->garments_name)?$model->workOrderItem->workOrder->garments_name:''}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th>Work Oder Item</th>
                    <th colspan="8"
                        class="text-left">{{isset($model->workOrderItem->product->name)?$model->workOrderItem->product->name:''}} {{ getProductAttributesFaster($model->workOrderItem->product) }}</th>
                </tr>
                <tr class="text-center">
                    <th>SL</th>
                    <th>Product Category</th>
                    <th>Product Detail</th>
                    <th>UOM</th>
                    <th>Usages Qty</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Other Charges</th>
{{--                    <th>Total Price (With LC & GRN Cost)</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($model->dyesChemicalUsageItems as $key=>$item)
                    @php
                        $unit_price = getGrnItemUnitPrice($item->requisitionDeliveryItem->stockInventory->grnItem, $item->requisitionDeliveryItem->stockInventory->grnItem->goodReceivedNote);
                    @endphp
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->requisitionDeliveryItem->stockInventory->product->category->name)?$item->requisitionDeliveryItem->stockInventory->product->category->name:''}}</td>
                        <td>{{isset($item->requisitionDeliveryItem->stockInventory->product->name)?$item->requisitionDeliveryItem->stockInventory->product->name:''}}
                            ( {{isset($item->requisitionDeliveryItem->stockInventory->product->sku)?$item->requisitionDeliveryItem->stockInventory->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->requisitionDeliveryItem->stockInventory->product) }}</td>
                        <td>{{ isset($item->requisitionDeliveryItem->stockInventory->product->productUnit->unit_name)?$item->requisitionDeliveryItem->stockInventory->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{$item->qty}}</td>
                        <td class="text-right">{{systemMoneyFormat($item->unit_price)}}</td>
                        <td class="text-right">{{systemMoneyFormat($item->qty*$item->unit_price)}}</td>
                        <td class="text-center">{{systemMoneyFormat( $unit_price['purchaseCharges']) }}</td>
{{--                        <td class="text-center">{{ systemMoneyFormat($item->qty*$unit_price['unit_price']) }}</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
                <strong> Remarks </strong>
                {!! $model->remarks !!}
            </div>
        </div>
    </div>
</div>
