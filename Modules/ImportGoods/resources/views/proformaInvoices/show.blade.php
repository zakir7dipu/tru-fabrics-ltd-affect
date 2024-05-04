<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-unstyled mb0">
                        <li><strong>{{__('PI No') }}
                                :</strong> {{$proformaInvoice->pi_no}}
                        </li>

                        <li><strong>{{__('PI Date')}}
                                :</strong>{{date('d-m-Y',strtotime($proformaInvoice->pi_date))}}
                        </li>
                        <li><strong>{{__('LC No')}}
                                :</strong> {{$proformaInvoice->lc_no}}
                        </li>
                        <li><strong>{{__('LC Date')}}
                                :</strong> {{date('d-m-Y',strtotime($proformaInvoice->lc_date))}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-unstyled mb0 pull-right">

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
                @foreach($proformaInvoice->proformaItemsItems as $key=>$item)
                    <tr>
                        <td class="text-center">{{$key+1}}</td>
                        <td>{{isset($item->product->category->name)?$item->product->category->name:''}}</td>
                        <td>{{isset($item->product->name)?$item->product->name:''}}
                            ( {{isset($item->product->sku)?$item->product->sku:''}}
                            ) {{ getProductAttributesFaster($item->product) }}</td>
                        <td>{{ isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:'' }}</td>
                        <td class="text-right">{{systemMoneyFormat($item->unit_price)}}</td>
                        <td class="text-center">{{$item->qty}}</td>
                        <td class="text-right">{{systemMoneyFormat($item->total_price)}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-right">Total</td>
                    <td class="text-center">{{$proformaInvoice->proformaItemsItems->sum('qty')}}</td>
                    <td class="text-right">{{systemMoneyFormat($proformaInvoice->proformaItemsItems->sum('total_price'))}}</td>
                </tr>
                </tbody>
            </table>

            <div>
                <strong> Remarks: </strong>
                {!! $proformaInvoice->remarks !!}
            </div>
        </div>
    </div>
</div>
