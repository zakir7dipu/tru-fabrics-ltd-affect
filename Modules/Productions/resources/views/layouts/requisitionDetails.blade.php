<div class="col-md-12">
    <div class="card card-info">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th>SL</th>
                    <th>Reference No</th>
                    <th>Delivery Date</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>UOM</th>
                    <th>Request Qty</th>
                    <th>Issued Qty</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $grouped = collect($requisitionDeliveryItems)->groupBy('requisitionDelivery.reference_no');
                @endphp
                @foreach($grouped as $group_key => $group)
                @foreach($group as $key=>$item)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        @if($key == 0)
                            <td class="text-center"
                                rowspan="{{$item->requisitionDelivery->requisitionDeliveryItems->count()}}">{{isset($item->requisitionDelivery->reference_no)?$item->requisitionDelivery->reference_no:''}}</td>
                            <td class="text-center" rowspan="{{$item->requisitionDelivery->requisitionDeliveryItems->count()}}">{{date('d M Y',strtotime($item->requisitionDelivery->delivery_date))}}</td>
                        @endif


                        <td>{{isset($item->requisitionItem->product->category->name)?$item->requisitionItem->product->category->name:''}}</td>
                        <td>{{isset($item->requisitionItem->product->name)?$item->requisitionItem->product->name:''}}
                            ( {{isset($item->requisitionItem->product->sku)?$item->requisitionItem->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->requisitionItem->product) }}</td>
                        <td>{{ isset($item->requisitionItem->product->productUnit->unit_name)?$item->requisitionItem->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{$item->requisitionItem->qty}}</td>
                        <td class="text-center">{{$item->issued_qty}}</td>
                    </tr>
                @endforeach
                @endforeach
                <tr>
                    <td colspan="7" class="text-right">Total</td>
                    <td class="text-center">{{$requisitionDeliveryItems->sum('issued_qty')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
