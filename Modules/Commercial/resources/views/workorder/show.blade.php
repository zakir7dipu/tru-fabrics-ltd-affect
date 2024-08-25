<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-styled mb0">
                        <li><strong>{{__('WO Issues Date')}}
                                :</strong> {{date('d M Y',strtotime($workOrder->wo_open_date))}}
                        </li>
                        <li><strong>{{__('Pre-Cost Number') }}
                                :</strong> {{$workOrder->reference_no}}
                        </li>

                        <li><strong>{{__('Work Order No')}}
                                :</strong>{{$workOrder->work_order_no}}
                        </li>
                        <li><strong>{{__('Delivery Date')}}
                                :</strong> {{date('d M Y',strtotime($workOrder->delivery_date))}}
                        </li>
                        <li><strong>{{__('Account Holder Name')}}:</strong> {{ucfirst($workOrder->account_holder)}}</li>
                        {{--                        <li><strong>{{__('Fabric Composition')}}:</strong> {{ucfirst($workOrder->fabric_composition)}}--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-styled mb0 pull-right">
                        <li><strong>{{__('Customer')}}
                                :</strong>{{isset($workOrder->customer->name)?$workOrder->customer->name:''}}</li>
                        <li><strong>{{__('Buyer Name')}}
                                :</strong> {{$workOrder->garments_name}}
                        </li>
                        {{--                        <li><strong>{{__('Lab Dep Approval')}}:</strong> {{ucfirst($workOrder->lab_dep_approval)}}</li>--}}
                        {{--                        <li><strong>{{__('Shrinkage')}}:</strong> {{ucfirst($workOrder->shrinkage)}}</li>--}}
                        <li><strong>{{__('Process')}}:</strong> {{ucfirst($workOrder->process->name)}}</li>
                        <li><strong>{{__('Finish Type')}}:</strong> {{ucfirst($workOrder->finish_type)}}</li>
                        <li><strong>{{__('Hand Feel')}}:</strong> {{ucfirst($workOrder->hand_feel)}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th width="5%">SL</th>
                    <th width="15%">Product Category</th>
                    <th width="30%">Product Detail</th>
                    <th width="5%">UOM</th>
                    <th width="15%">Unit Price</th>
                    <th width="15%">Qty</th>
                    <th>Total Price</th>
                    {{--                    <th width="5%">Currency</th>--}}
                    {{--                    <th width="10%">C.Rate</th>--}}
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
                        <td class="text-right">{{systemMoneyFormat($item->reporting_amount,'$')}}</td>
                        <td class="text-center">{{$item->qty}}</td>
                        <td class="text-right">{{systemMoneyFormat($item->reporting_amount*$item->qty,'$')}}</td>
                        {{--                        <td class="text-center">{{$item->currency->short_code}}</td>--}}
                        {{--                        <td class="text-center">{{systemMoneyFormat($item->currency_convert_rate)}}</td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div>
                <strong> Terms & Conditions: </strong>
                {!! $workOrder->terms_condition !!}
            </div>
        </div>
    </div>
</div>
