<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-unstyled mb0">
                        @if($proformaInvoice->mode_of_purchase=='import')
                            <li><strong>{{__('LC No')}}
                                    :</strong> {{$proformaInvoice->lc_no}}
                            </li>
                        @else
                            <li><strong>{{__('Invoice No')}}
                                    :</strong> {{$proformaInvoice->invoice_no}}
                            </li>
                        @endif
                        {{--                        <li><strong>{{__('Reference No') }}--}}
                        {{--                                :</strong> {{$proformaInvoice->pi_no}}--}}
                        {{--                        </li>--}}

                        <li><strong>{{__('Purchase Open Date')}}
                                :</strong> {{date('d-m-Y',strtotime($proformaInvoice->lc_date))}}
                        </li>
                        <li><strong>{{__('Date')}}
                                :</strong>{{date('d-m-Y',strtotime($proformaInvoice->pi_date))}}
                        </li>


                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-unstyled mb0 pull-right">
                        <li><strong>{{__('Mode Of Purchase')}}
                                :</strong> {{ucfirst($proformaInvoice->mode_of_purchase)}}
                        </li>
                        <li><strong>{{__('Supplier')}}
                                :</strong> {{isset($proformaInvoice->supplier->name)?$proformaInvoice->supplier->name:''}}
                        </li>
                        <li><strong>{{__('Status')}}:</strong> {{ucfirst($proformaInvoice->status)}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr class="text-center">
                    <th width="10%">Product Category</th>
                    <th width="30%">Product Detail</th>
                    <th width="10%">UOM</th>
                    <th width="10%">Qty</th>
                    <th width="10%">Unit Price</th>
                    <th width="15%">Total Price</th>
                    <th width="15%">Other Charges</th>
                    {{--                    <th>Total Price (With LC Charges)</th>--}}
                    {{--                    <th width="5%">Currency</th>--}}
                    {{--                    <th width="10%">C.Rate</th>--}}
                    {{--                    <th width="10%">C.Value</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($proformaInvoice->proformaItemsItems as $key=>$item)
                    @php
                        $unit_price = getLcItemUnitPrice($item, $proformaInvoice);
                    @endphp
                    <tr>
                        <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                        <td>{{isset($item->product->name)?$item->product->name:''}}
                            ({{isset($item->product->sku)?$item->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->product) }}</td>
                        <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                        <td class="text-center">{{$item->qty}}</td>
                        <td class="text-right">{{systemMoneyFormat($item->unit_price*$item->currency_convert_rate,'$',2)}}</td>
                        <td class="text-right">{{systemMoneyFormat($item->total_price*$item->currency_convert_rate,'$',2)}}</td>
                        <td class="text-right">{{ systemMoneyFormat($unit_price['lc_unit_price'], '$',2) }}</td>
                        {{--                        <td class="text-right">{{ systemMoneyFormat($item->qty*$unit_price['unit_price'],'$') }}</td>--}}
                        {{--                        <td class="text-center">{{$item->currency->short_code}}</td>--}}
                        {{--                        <td class="text-center">{{$item->currency_convert_rate}}</td>--}}
                        {{--                        <td class="text-center">{{systemMoneyFormat($item->total_price,$item->currency->symbol)}}</td>--}}
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div>
                <strong> Remarks: </strong>
                {!! $proformaInvoice->remarks !!}
            </div>

            <div>
                <strong style="color: red"> Note: </strong>
                Unit price is showing without any charges.
            </div>
        </div>
    </div>
</div>
