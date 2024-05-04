<div class="col-md-12">
    <div class="panel panel-info">
        <div class="col-lg-12">
            <div class="invoice-details mt25 row">
                <div class="well col-6">
                    <ul class="list-unstyled mb0">
                        <li><strong>{{__('PI No') }}
                                :</strong> {{$grn->proformaInvoice->pi_no}}
                        </li>

                        <li><strong>{{__('PI Date')}}
                                :</strong>{{date('d-m-Y',strtotime($grn->proformaInvoice->pi_date))}}
                        </li>
                        <li><strong>{{__('LC No')}}
                                :</strong> {{$grn->proformaInvoice->lc_no}}
                        </li>
                        <li><strong>{{__('LC Date')}}
                                :</strong> {{date('d-m-Y',strtotime($grn->proformaInvoice->lc_date))}}
                        </li>
                        <li><strong>{{__('Supplier')}}
                                :</strong> {{isset($grn->proformaInvoice->supplier->name)?$grn->proformaInvoice->supplier->name:''}}
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-unstyled mb0 pull-right">
                        <li><strong>{{__('Invoice No')}}
                                :</strong> {{isset($grn->invoice_no)?$grn->invoice_no:''}}
                        </li>
                        <li><strong>{{__('Reference No')}}
                                :</strong> {{isset($grn->reference_no)?$grn->reference_no:''}}
                        </li>
                        <li><strong>{{__('Received Date')}}
                                :</strong> {{date('d-m-Y',strtotime($grn->received_date))}}
                        </li>
                        <li><strong>{{__('Status')}}:</strong> {{ucfirst($grn->status)}}</li>
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
                    <th>Qty</th>
                </tr>
                </thead>
                <tbody>
                @foreach($grn->goodReceivedNoteItems as $key=>$item)
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
                    <td class="text-center">{{$grn->goodReceivedNoteItems->sum('qty')}}</td>
                </tr>
                </tbody>
            </table>

            <div>
                <strong> Remarks: </strong>
                {!! $grn->note !!}
            </div>
        </div>
    </div>
</div>
