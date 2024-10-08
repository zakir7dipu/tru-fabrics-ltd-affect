@foreach($requisitions as $requisition)
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="col-lg-12">
                <div class="invoice-details mt25 row">
                    <div class="well col-6">
                        <ul class="list-styled mb0">
                            <li><strong>{{__('Reference No') }}
                                    : </strong> {{$requisition->reference_no}}
                            </li>

                            <li><strong>{{__('Requisition No') }}
                                    : </strong> {{$requisition->requisition_no}}
                            </li>

                            <li><strong>{{__('Requisition Date')}}
                                    : </strong>{{date('d M Y',strtotime($requisition->requisition_date))}}
                            </li>

                            @if(isset($requisition->workOrderItem->workOrder))
                                <li><strong>{{__('WorkOrder No')}}
                                        : </strong> {{isset($requisition->workOrderItem->workOrder->work_order_no)?$requisition->workOrderItem->workOrder->work_order_no:''}}
                                </li>
                            @endif
                            <li><strong>{{__('Department') }}
                                    : </strong> {{isset($requisition->department->name)?$requisition->department->name:''}}
                            </li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-styled mb0 pull-right">
                            <li><strong>{{__('Fabric Type') }}
                                    : </strong> {{isset($requisition->finish_type)?$requisition->finish_type:''}}
                            </li>
                            @if(isset($requisition->workOrderItem->workOrder))
                                <li><strong>{{__('Finished Good')}}
                                        : </strong>{{isset($requisition->workOrderItem->product->name)?$requisition->workOrderItem->product->name .getProductAttributesFaster($requisition->workOrderItem->product):''}}
                                </li>
                                <li><strong>{{__('Delivery Date')}}
                                        : </strong> {{date('d M Y',strtotime(isset($requisition->workOrderItem->workOrder->delivery_date)?$requisition->workOrderItem->workOrder->delivery_date:''))}}
                                </li>
                            @endif

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
                        <th>Product Detail</th>
                        <th>UOM</th>
                        <th>Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requisition->requisitionItems as $key=>$item)
                        <tr>
                            <td class="text-center">{{$key+1}}</td>
                            <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                            <td>{{isset($item->product->name)?$item->product->name:''}}
                                ( {{isset($item->product->sku)?$item->product->sku:''}}
                                ) {{ getProductAttributesFaster($item->product) }}</td>
                            <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                            <td class="text-center">{{$item->qty}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right">Total</td>
                        <td class="text-center">{{$requisition->requisitionItems->sum('qty')}}</td>
                    </tr>
                    </tbody>
                </table>

                <div>
                    <strong> Remarks : </strong>
                    {!! $requisition->remarks !!}
                </div>
                <div>
                    <strong>Terms & Conditions : </strong>
                    {!! isset($requisition->workOrderItem->workOrder->terms_condition)?$requisition->workOrderItem->workOrder->terms_condition:'' !!}
                </div>
            </div>
        </div>
    </div>
@endforeach
