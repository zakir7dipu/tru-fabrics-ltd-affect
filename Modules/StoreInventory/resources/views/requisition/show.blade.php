<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('Reference No') }}
                                : </strong> {{$model->reference_no}}
                        </li>

                        <li><strong>{{__('Requisition Ref No')}}
                                : </strong> {{isset($model->requisition->reference_no)?$model->requisition->reference_no:''}}
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
                    <th>Request Qty</th>
                    <th>Issued Qty</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalReqItem = 0;
                @endphp
                @foreach($model->requisitionDeliveryItems as $key=>$item)
                    @php
                        $totalReqItem += $item->requisitionItem->qty;
                    @endphp
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->requisitionItem->product->category->name)?$item->requisitionItem->product->category->name:''}}</td>
                        <td>{{isset($item->requisitionItem->product->name)?$item->requisitionItem->product->name:''}}
                            ( {{isset($item->requisitionItem->product->sku)?$item->requisitionItem->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->requisitionItem->product) }}</td>
                        <td>{{ isset($item->requisitionItem->product->productUnit->unit_name)?$item->requisitionItem->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{$item->requisitionItem->qty}}</td>
                        <td class="text-center">{{$item->issued_qty}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right">Total</td>
                    <td class="text-center">{{$totalReqItem}}</td>
                    <td class="text-center">{{$model->requisitionDeliveryItems->sum('issued_qty')}}</td>
                </tr>
                </tbody>
            </table>

            <div>
                <strong> Remarks : </strong>
                {!! $model->remarks !!}
            </div>

        </div>
    </div>
</div>
