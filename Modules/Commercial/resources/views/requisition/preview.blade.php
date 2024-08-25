<div class="col-md-12">
    <div class="panel panel-info">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th>WO No</th>
                    <th>Wo Item</th>
                    <th>Product Category</th>
                    <th>Product Detail</th>
                    <th>UOM</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requisitions as $key=>$item)
                    <tr>
                        <td>{{isset($item->requisition->workOrderItem->workOrder->work_order_no)?$item->requisition->workOrderItem->workOrder->work_order_no:''}}</td>
                        <td>{{isset($item->requisition->workOrderItem->product->name)?$item->requisition->workOrderItem->product->name .getProductAttributesFaster($item->requisition->workOrderItem->product):''}}</td>
                        <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                        <td>{{isset($item->product->name)?$item->product->name:''}}
                            ( {{isset($item->product->sku)?$item->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->product) }}</td>
                        <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{$item->qty}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-right">Total</td>
                    <td class="text-center">{{$requisitions->sum('qty')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

