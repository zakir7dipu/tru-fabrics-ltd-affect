@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Finished Goods Received'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! Form::open(array('route' => 'productions.store','method'=>'POST',
                                                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}
                                <div class="row">

                                    <input type="hidden" name="work_order_id" value="{{$workOrder->id}}">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('work_order_ref_no', 'Work Order No', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::text('work_order_ref_no', isset($workOrder)?$workOrder->reference_no:request()->old('work_order_ref_no'), [
                                                    'id' => 'work_order_ref_no',
                                                    'class' => 'form-control',
                                                    'readonly'=>true
                                                ]) !!}
                                                {!! $errors->first('work_order_ref_no') !!}
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
                                                {!!  Form::label('finished_goods_file', 'Finished Goods File', array('class' => 'col-form-label')) !!}
                                                <br>
                                                <input type="file" name="finished_goods_file"
                                                       id="finished_goods_file"
                                                       class="btn btn-outline-info btn-sm">

                                                {!! $errors->first('finished_goods_file') !!}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 style-scroll mt-2">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Category</th>
                                                    <th>Product</th>
                                                    <th>UOM</th>
                                                    <th>Qty</th>
                                                    <th>Prv.Rcv Qty</th>
                                                    <th>Receiving Qty</th>
                                                    <th>Left Qty</th>
                                                    <th>Warehouse</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @if(isset($workOrder->workOrderItems))
                                                @foreach($workOrder->workOrderItems as $key=>$item)
                                                    @php
                                                        $leftQty=isset($item->qty)?$item->qty:$item->qty;
                                                        $receiveQty=0;

                                                        if ($item->finishedGoodItems->count() > 0){
                                                            $receiveQty =  isset($item->finishedGoodItems) && $item->finishedGoodItems->sum('qty') > 0  ? $item->finishedGoodItems->sum('qty') : 0;
                                                        }

                                                        $leftQty = $item->qty-$receiveQty;
                                                    @endphp
                                                    @if($leftQty > 0)
                                                        <tr class="grnItemContent">
                                                            <td>{{isset($item->product->category)?$item->product->category->name:''}}</td>
                                                            <td>
                                                                {{isset($item->product->name)?$item->product->name:''}} {{ getProductAttributesFaster($item->product) }}
                                                                <input type="hidden" name="work_order_item_id[]"
                                                                       class="form-control"
                                                                       value="{{isset($item->id)?$item->id:0}}">
                                                            </td>
                                                            <td>
                                                                {{isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:''}}
                                                            </td>

                                                            <td class="text-center">
                                                                {{$item->qty}}
                                                                <input type="hidden" value="{{$leftQty}}"
                                                                       id="main_qty_{{isset($item->id)?$item->id:0}}">
                                                            </td>
                                                            <td class="text-center"
                                                                id="pre_rcv_qty_{{isset($item->id)?$item->id:0}}">
                                                                {{$receiveQty}}
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="number"
                                                                       name="qty[{{isset($item->id)?$item->id:0}}]"
                                                                       class="form-control bg-white rcvQty" min="0"
                                                                       max="{{$leftQty}}"
                                                                       id="receive_qty_{{isset($item->id)?$item->id:0}}"
                                                                       data-id="{{isset($item->id)?$item->id:0}}"
                                                                       value="{{$leftQty}}" placeholder="0"
                                                                       oninput="this.value = Math.abs(this.value)">
                                                            </td>

                                                            <td class="text-center"
                                                                id="left_qty_{{isset($item->id)?$item->id:0}}"></td>
                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <select name="warehouse_id[{{$item->id}}]"
                                                                            id="warehouse_id_{{$item->id}}"
                                                                            class="form-control select2"
                                                                            required>

                                                                        @foreach($warehouses as $key=>$value)
                                                                            <option
                                                                                value="{{$value->id}}">{{ $value->name }}
                                                                                ({{$value->code}})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('remarks', 'Remarks', ['class' => 'col-form-label']) !!}
                                                {!! Form::textarea('remarks', request()->old('note'), [
                                                    'id' => 'remarks',
                                                    'class' => 'form-control',
                                                    'rows'=>'3',
                                                    'placeholder' => 'Enter Remarks'
                                                ]) !!}
                                                {!! $errors->first('remarks') !!}
                                            </div>
                                        </div>
                                    </div>

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
            var PrvRcvQty = item.querySelectorAll('td')[4];
            var ReceivingQty = item.querySelectorAll('td')[5];
            var LeftQty = item.querySelectorAll('td')[6];


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
