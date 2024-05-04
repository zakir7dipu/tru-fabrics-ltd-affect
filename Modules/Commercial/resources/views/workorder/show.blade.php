<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('Reference No') }}
                                :</strong> {{$workOrder->reference_no}}
                        </li>

                        <li><strong>{{__('Work Order No')}}
                                :</strong>{{$workOrder->work_order_no}}
                        </li>
                        <li><strong>{{__('Garments Name')}}
                                :</strong> {{$workOrder->garments_name}}
                        </li>
                        <li><strong>{{__('Delivery Date')}}
                                :</strong> {{date('d M Y',strtotime($workOrder->delivery_date))}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Customer')}}
                                :</strong>{{isset($workOrder->customer->name)?$workOrder->customer->name:''}}</li>
                        <li><strong>{{__('Lab Dep Approval')}}:</strong> {{ucfirst($workOrder->lab_dep_approval)}}</li>
                        <li><strong>{{__('Shrinkage')}}:</strong> {{ucfirst($workOrder->shrinkage)}}</li>
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
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workOrder->workOrderItems as $key=>$item)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                        <td>{{isset($item->product->name)?$item->product->name:''}}
                            ( {{isset($item->product->sku)?$item->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->product) }}</td>
                        <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                        <td class="text-right">{{systemMoneyFormat($item->price)}}</td>
                        <td class="text-center">{{$item->qty}}</td>
                        <td class="text-right">{{systemMoneyFormat($item->sub_total)}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-right">Total</td>
                    <td class="text-center">{{$workOrder->workOrderItems->sum('qty')}}</td>
                    <td class="text-right">{{systemMoneyFormat($workOrder->workOrderItems->sum('sub_total'))}}</td>
                </tr>
                </tbody>
            </table>

            <div>
                <strong> Terms & Conditions: </strong>
                {!! $workOrder->terms_condition !!}
            </div>
        </div>
    </div>
</div>
