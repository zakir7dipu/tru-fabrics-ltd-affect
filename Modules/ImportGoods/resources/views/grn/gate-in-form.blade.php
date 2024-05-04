@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'GRN'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! Form::open(array('route' => 'grns.store','method'=>'POST',
                                                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}
                                <div class="row">
                                    <input type="hidden" name="type" value="in">
                                    <input type="hidden" name="proforma_invoice_id" value="{{$proformaInvoice->id}}">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('pi_no', 'PI No', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::text('pi_no', isset($proformaInvoice)?$proformaInvoice->pi_no:request()->old('pi_no'), [
                                                    'id' => 'pi_no',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter PI No',
                                                    'readonly'=>true
                                                ]) !!}
                                                {!! $errors->first('pi_no') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('reference_no', 'Reference No', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::text('reference_no', isset($referenceNo)?$referenceNo:request()->old('reference_no'), [
                                                    'id' => 'reference_no',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter Reference',
                                                    'required' => true,
                                                ]) !!}
                                                {!! $errors->first('reference_no') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('received_date', 'Received Date', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::date('received_date', date('Y-m-d'), [
                                                    'id' => 'received_date',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter Received Date'
                                                ]) !!}
                                                {!! $errors->first('received_date') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('supplier_name', 'Supplier Name', ['class' => 'col-form-label']) !!}
                                                {!! Form::text('supplier_name', isset($proformaInvoice)?$proformaInvoice->supplier->name .' ('.$proformaInvoice->supplier->code.')':'', [
                                                    'id' => 'supplier_name',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter Reference',
                                                    'readonly' => true,
                                                ]) !!}
                                                {!! $errors->first('supplier_name') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('invoice_no', 'Challan No', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::text('invoice_no', request()->old('invoice_no'), [
                                                    'id' => 'invoice_no',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter Reference',
                                                    'required' => true,
                                                ]) !!}
                                                {!! $errors->first('invoice_no') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('invoice_file', 'Challan File', array('class' => 'col-form-label')) !!}
                                                <br>
                                                <input type="file" name="invoice_file"
                                                       id="invoice_file"
                                                       class="btn btn-outline-info btn-sm">

                                                {!! $errors->first('invoice_file') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 style-scroll mt-2">
                                        <table class="table table-striped table-bordered miw-500 dac_table"
                                               cellspacing="0"
                                               width="100%" id="dataTable">
                                            <thead>
                                            <tr class="text-center">
                                                <th>Category</th>
                                                <th>Product</th>
                                                <th>UOM</th>
                                                <th>Qty</th>
                                                <th>Unit Price</th>
                                                <th>Prv.Rcv Qty</th>
                                                <th>Receiving Qty</th>
                                                <th>Left Qty</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalReceiveQty=0;
                                                $totalPrice=0;
                                            @endphp
                                            @if(isset($proformaInvoice->proformaItemsItems))
                                                @foreach($proformaInvoice->proformaItemsItems as $key=>$item)
                                                    @php
                                                        $leftQty=isset($item->grn_qty)?$item->grn_qty:$item->qty;
                                                        $receiveQty=0;

                                                        if ($item->grnReceivedProducts->count() > 0){
                                                            $receiveQty =  isset($item->grn_qty) && $item->grn_qty > 0  ? $item->grn_qty : 0;
                                                            $totalReceiveQty += $receiveQty;
                                                        }
                                                        $leftQty = $item->qty-$receiveQty;
                                                        $unitAmount = $leftQty*$item->unit_price;
                                                        $totalPrice += $unitAmount;
                                                    @endphp
                                                    @if($leftQty > 0)
                                                        <tr class="grnItemContent">
                                                            <td>{{isset($item->product->category)?$item->product->category->name:''}}</td>
                                                            <td>
                                                                {{isset($item->product->name)?$item->product->name:''}} {{ getProductAttributesFaster($item->product) }}
                                                                <input type="hidden" name="product_id[]"
                                                                       class="form-control"
                                                                       value="{{isset($item->product_id)?$item->product_id:0}}">
                                                            </td>
                                                            <td>
                                                                {{isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:''}}
                                                            </td>

                                                            <td class="text-center">
                                                                {{$item->qty}}
                                                                <input type="hidden" value="{{$leftQty}}"
                                                                       id="main_qty_{{isset($item->product_id)?$item->product_id:0}}">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                       name="unit_price[{{isset($item->product_id)?$item->product_id:0}}]"
                                                                       class="form-control text-right" min="0.0"
                                                                       id="unit_price_{{isset($item->product_id)?$item->product_id:0}}"
                                                                       value="{{$item->unit_price}}" readonly
                                                                       placeholder="0">
                                                            </td>
                                                            <td class="text-center"
                                                                id="pre_rcv_qty_{{isset($item->product_id)?$item->product_id:0}}">
                                                                {{$receiveQty}}
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="number"
                                                                       name="qty[{{isset($item->product_id)?$item->product_id:0}}]"
                                                                       class="form-control bg-white rcvQty" min="0"
                                                                       max="{{$leftQty}}"
                                                                       id="receive_qty_{{isset($item->product_id)?$item->product_id:0}}"
                                                                       data-id="{{isset($item->product_id)?$item->product_id:0}}"
                                                                       value="{{$leftQty}}" placeholder="0"
                                                                       oninput="this.value = Math.abs(this.value)">
                                                            </td>

                                                            <td class="text-center"
                                                                id="left_qty_{{isset($item->product_id)?$item->product_id:0}}"></td>

                                                            <input type="hidden"
                                                                   name="unit_amount[{{isset($item->product_id)?$item->product_id:0}}]"
                                                                   value="{{round($unitAmount,2)}}" required readonly
                                                                   class="form-control calculateSumOfSubtotal"
                                                                   id="sub_total_price_{{isset($item->product_id)?$item->product_id:0}}"
                                                                   placeholder="0">
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>


                                    @if(isset($gateOuts[0]))
                                        <div class="col-md-12 table-responsive style-scroll mt-2">
                                            <h4 class="mb-2 mt-4">#Replace Items</h4>
                                            <table class="table table-striped table-bordered miw-500 dac_table"
                                                   cellspacing="0"
                                                   width="100%" id="dataTable">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>Category</th>
                                                    <th>Product</th>
                                                    <th>UOM</th>
                                                    <th>Unit Price</th>
                                                    <th>Replace Qty</th>
                                                    <th>Prv.Rcv Qty</th>
                                                    <th>Receiving Qty</th>
                                                    <th>Left Qty</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $totalReceiveQty=0;
                                                    $totalPrice=0;
                                                @endphp
                                                @if(isset($gateOuts))
                                                    @foreach($gateOuts as $key=>$item)
                                                        @php
                                                            $leftQty = $item->qty-$item->received_qty;
                                                            $receiveQty = $item->received_qty;
                                                            $totalReceiveQty += $receiveQty;

                                                            $unitAmount = $leftQty*$item->unit_price;
                                                            $totalPrice += $unitAmount;
                                                        @endphp
                                                        @if($leftQty > 0)
                                                            <tr>
                                                                <td>{{isset($item->product->category)?$item->product->category->name:''}}</td>
                                                                <td>
                                                                    {{isset($item->product->name)?$item->product->name:''}} {{ getProductAttributesFaster($item->product) }}
                                                                </td>
                                                                <td>
                                                                    {{isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:''}}
                                                                </td>
                                                                <td>
                                                                    {{$item->unit_price}}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{$leftQty}}
                                                                </td>
                                                                <td class="text-center">
                                                                    {{$receiveQty}}
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="number"
                                                                           name="replace_qty[{{isset($item->id)?$item->id:0}}]"
                                                                           class="form-control bg-white rcvQty" min="0"
                                                                           max="{{$leftQty}}"
                                                                           id="replace_qty_{{isset($item->id)?$item->id:0}}"
                                                                           data-id="{{isset($item->id)?$item->id:0}}"
                                                                           value="{{$leftQty}}" placeholder="0"
                                                                           onchange="checkReplaceQty($(this))"
                                                                           onkeyup="checkReplaceQty($(this))"
                                                                           oninput="this.value = Math.abs(this.value)">
                                                                </td>

                                                                <td class="text-center"
                                                                    id="left_qty_{{isset($item->id)?$item->id:0}}"></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('note', 'Remarks', ['class' => 'col-form-label']) !!}
                                                {!! Form::textarea('note', request()->old('note'), [
                                                    'id' => 'note',
                                                    'class' => 'form-control',
                                                    'rows'=>'3',
                                                    'placeholder' => 'Enter Remarks'
                                                ]) !!}
                                                {!! $errors->first('note') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" value="{{round($totalPrice,2)}}" name="total_price" required
                                           readonly class="form-control" id="sumOfSubtotal" placeholder="0.00"
                                           step="0.0">

                                    <input type="hidden" value="{{round($totalPrice,2)}}" name="gross_price" readonly
                                           required
                                           class="form-control" id="grossPrice" placeholder="0.00">

                                    <div class="col-md-12 mt-4">
                                        {!! Form::submit('Proceed to Gate In', ['class' => 'btn btn-success pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                                        &nbsp;
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        "use strcit"

        const validateReceiveQty = (item, key) => {
            var PoQty = item.querySelectorAll('td')[3];
            var UnitPrice = item.querySelectorAll('td')[4];
            var PrvRcvQty = item.querySelectorAll('td')[5];
            var ReceivingQty = item.querySelectorAll('td')[6];
            var LeftQty = item.querySelectorAll('td')[7];
            var SubPrice = item.querySelector('.calculateSumOfSubtotal');

            ReceivingQty.onkeyup = function () {
                validateData();
            }

            ReceivingQty.onchange = function () {
                validateData();
            }

            function validateData() {
                if (PrvRcvQty.innerText.trim() === 0) {
                    ReceivingQty.querySelector('input').value > parseInt(PoQty.innerText.trim()) ? ReceivingQty.querySelector('input').value = parseInt(PoQty.innerText.trim()) : (ReceivingQty.querySelector('input').value === 0 ? ReceivingQty.querySelector('input').value = 0 : ReceivingQty.querySelector('input').value);
                } else {
                    ReceivingQty.querySelector('input').value > (parseInt(PoQty.innerText.trim()) - parseInt(PrvRcvQty.innerText.trim())) ? ReceivingQty.querySelector('input').value = (parseInt(PoQty.innerText.trim()) - parseInt(PrvRcvQty.innerText.trim())) : (ReceivingQty.querySelector('input').value < 0 ? ReceivingQty.querySelector('input').value = 0 : ReceivingQty.querySelector('input').value);
                }
                LeftQty.innerText = (parseInt(PoQty.innerText.trim()) - parseInt(PrvRcvQty.innerText.trim()) - ReceivingQty.querySelector('input').value);

                SubPrice.value = parseFloat(ReceivingQty.querySelector('input').value) * parseFloat(UnitPrice.querySelector('input').value);

                var TotalSubTotal = 0;
                $('.calculateSumOfSubtotal').each(function () {
                    TotalSubTotal += parseFloat($(this).val() !== "" ? $(this).val() : 0);
                });

                $('#sumOfSubtotal').val(parseFloat(TotalSubTotal));
                $('#grossPrice').val(parseFloat(TotalSubTotal));
            }

        }

        const getAllContent = () => {
            var contents = document.querySelectorAll('.grnItemContent');
            Array.from(contents).map((item, key) => {
                validateReceiveQty(item, key);
            })
        }
        getAllContent();

        function checkReplaceQty(element) {
            var value = (element.val() !== "" ? parseInt(element.val()) : 0);
            var min = parseInt(element.attr('min'));
            var max = parseInt(element.attr('max'));
            var replace = parseInt(element.parent().prev().prev().text());
            var prev = parseInt(element.parent().prev().text());

            if (value < min) {
                element.val(min);
                value = min;
            }

            if (value > max) {
                element.val(max);
                value = max;
            }

            element.parent().next().html((replace - value));
        }
    </script>
@endsection

