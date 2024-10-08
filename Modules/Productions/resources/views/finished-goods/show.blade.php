<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('Reference No') }}
                                :</strong> {{$finishedGood->reference_no}}
                        </li>

                        <li><strong>{{__('Received Date')}}
                                :</strong> {{date('d M Y',strtotime($finishedGood->received_date))}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Work Order No')}}
                                :</strong>{{$finishedGood->workOrder->work_order_no}}
                        </li>
                        <li><strong>{{__('Customer')}}
                                :</strong>{{isset($finishedGood->workOrder->customer->name)?$finishedGood->workOrder->customer->name:''}}
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
                    <th>Product Category</th>
                    <th width="40%">Product Detail</th>
                    <th>UOM</th>
                    <th>Qty</th>
                    <th>Warehouse</th>
                    <th>FG Received</th>
                    <th>UOM Type</th>
                    <th>UOM QTY</th>
                </tr>
                </thead>
                <tbody>
                @foreach($finishedGood->finishedGoodItems as $key=>$item)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->workOrderItem->product->category->name)?$item->workOrderItem->product->category->name:''}}</td>
                        <td>{{isset($item->workOrderItem->product->name)?$item->workOrderItem->product->name:''}}
                            ( {{isset($item->workOrderItem->product->sku)?$item->workOrderItem->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->workOrderItem->product) }}</td>
                        <td>{{ isset($item->workOrderItem->product->productUnit->unit_name)?$item->workOrderItem->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{number_format($item->qty)}}</td>
                        <td class="text-center">{{$item->warehouse->name}}</td>
                        <td class="text-center">{{date('d-M-Y', strtotime($item->fg_received_date))}}</td>
                        <td class="text-center">{{$item->uom_type}}</td>
                        <td class="text-center">{{$item->uom_qty}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">Total</td>
                    <td>{{number_format($finishedGood->finishedGoodItems->sum('qty'))}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>

            <div>
                <strong> Remarks </strong>
                {!! $finishedGood->remarks !!}
            </div>
        </div>
    </div>
</div>
