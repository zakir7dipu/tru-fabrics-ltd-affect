<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-4">
                    <ul class="list-unstyled mb0">
                        <li><strong>{{__('Purchase Reference No') }}
                                :</strong> {{$grn->proformaInvoice->pi_no}}
                        </li>

                        <li><strong>{{__('PI Date')}}
                                :</strong>{{date('d-m-Y',strtotime($grn->proformaInvoice->pi_date))}}
                        </li>
                        @if($grn->proformaInvoice->mode_of_purchase=='import')
                            <li><strong>{{__('LC No')}}
                                    :</strong> {{$grn->proformaInvoice->lc_no}}
                            </li>
                        @else
                            <li><strong>{{__('Native Invoice No')}}
                                    :</strong> {{$grn->proformaInvoice->invoice_no}}
                            </li>
                        @endif

                        <li>
                            <strong> {{$grn->proformaInvoice->mode_of_purchase=='import'?'LC Data':'Invoice Date'}}
                                :</strong> {{date('d-m-Y',strtotime($grn->proformaInvoice->lc_date))}}
                        </li>

                        <li><strong>{{__('Supplier')}}
                                :</strong> {{isset($grn->proformaInvoice->supplier->name)?$grn->proformaInvoice->supplier->name:''}}
                        </li>
                    </ul>
                </div>
                <div class="col-4">
                    <ul class="list-unstyled mb0 pull-right">

                        <li><strong>{{__('Reference No')}}
                                :</strong> {{isset($grn->reference_no)?$grn->reference_no:''}}
                        </li>
                        <li><strong>{{__('Challan No')}}
                                :</strong> {{isset($grn->invoice_no)?$grn->invoice_no:''}}
                        </li>

                        <li><strong>{{__('Challan Date')}}
                                :</strong> {{date('d-m-Y',strtotime($grn->challan_date))}}
                        </li>
                        <li><strong>{{__('Received Date')}}
                                :</strong> {{date('d-m-Y',strtotime($grn->received_date))}}
                        </li>
                        <li><strong>{{__('Status')}}:</strong> {{ucfirst($grn->status)}}</li>
                    </ul>
                </div>
                <div class="col-4">
                    <ul class="list-unstyled mb0 pull-right">

                        <li><strong>{{__('Vendor Name')}}
                                :</strong> {{isset($grn->vendor)?$grn->vendor->name:''}}
                        </li>
                        <li><strong>{{__('Truck No')}}
                                :</strong> {{isset($grn->truck_no)?$grn->truck_no:''}}
                        </li>
                        <li><strong>{{__('Driver Name')}}
                                :</strong> {{isset($grn->driver_name)?$grn->driver_name:''}}
                        </li>
                        <li><strong>{{__('Driver No')}}
                                :</strong> {{isset($grn->driver_phone)?$grn->driver_phone:''}}
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
                    <th>Product Detail</th>
                    <th>UOM</th>
                    <th>Qty</th>
                    <th>UOM Type</th>
                    <th>UOM Qty</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                    <th>Other Charges</th>
                    {{--<th>Total Price (With LC & GRN Cost)</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($grn->goodReceivedNoteItems as $key=>$item)
                    @php
                        $unit_price = getGrnItemUnitPrice($item, $grn);
                    @endphp
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                        <td>{{isset($item->product->name)?$item->product->name:''}}
                            ( {{isset($item->product->sku)?$item->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->product) }}</td>
                        <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td class="text-center">{{ $item->uom_type }}</td>
                        <td class="text-center">{{ $item->uom_qty }}</td>
                        <td class="text-center">{{ systemMoneyFormat($item->unit_price,'$',2) }}</td>
                        <td class="text-center">{{ systemMoneyFormat($item->qty*$item->unit_price, '$',2) }}</td>
                        <td class="text-center">{{ systemMoneyFormat($unit_price['purchaseCharges'], '$',2) }}</td>
                        {{--<td class="text-center">{{ systemMoneyFormat($item->qty*$unit_price['unit_price'], '$') }}</td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div>
                <strong> Remarks: </strong>
                {!! $grn->note !!}
            </div>
        </div>
    </div>
</div>
