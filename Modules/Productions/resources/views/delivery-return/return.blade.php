@extends('layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Commercial'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('finished-goods-deliveries.index')}}"
                                           class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Finished Goods List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Back To Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-styled mb0">
                                                    <li><strong>{{__('FG Challan No') }}
                                                            :</strong> {{$fgDelivery->challan_no}}
                                                    </li>
                                                    <li><strong>{{__('Work Order No')}}
                                                            :</strong>{{$fgDelivery->workOrder->work_order_no}}
                                                    </li>
                                                    <li><strong>{{__('Delivered Date')}}
                                                            :</strong> {{date('d M Y',strtotime($fgDelivery->delivered_date))}}
                                                    </li>
                                                    <li><strong>{{__('Customs Charge No of UP Ref No')}}
                                                            :</strong> {{$fgDelivery->custom_charge_ref_no}}
                                                    </li>
                                                    <li><strong>{{__('Customs Charge Amount')}}
                                                            :</strong> {{systemMoneyFormat($fgDelivery->custom_charge,'$',2)}}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-styled mb0 pull-right">
                                                    <li><strong>{{__('Vendor')}}
                                                            :</strong> {{ucfirst(isset($fgDelivery->vendor->name)?$fgDelivery->vendor->name:'')}}
                                                    </li>
                                                    <li><strong>{{__('Truck No')}}
                                                            :</strong> {{ucfirst($fgDelivery->truck_no)}}</li>
                                                    <li><strong>{{__('Driver Name')}}
                                                            :</strong> {{ucfirst($fgDelivery->driver_name)}}</li>
                                                    <li><strong>{{__('Driver Phone')}}
                                                            :</strong> {{ucfirst($fgDelivery->driver_phone)}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body ">
                                        {!! Form::open(array('route' => 'fg.delivery.return.store','method'=>'POST',
                                       'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}
                                        <div class="row">
                                            <input type="hidden" name="reference_no"
                                                   value="{{ isset($sku)?$sku:request()->old('reference_no')}}">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('datetime', 'Return Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('datetime', date('Y-m-d'), [
                                                            'id' => 'datetime',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Date',
                                                            'required'=>true
                                                        ]) !!}
                                                        {!! $errors->first('datetime') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('challan_no', 'Challan No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('challan_no', request()->old('challan_no'), [
                                                            'id' => 'challan_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Challan No',
                                                            'required'=>true
                                                        ]) !!}
                                                        {!! $errors->first('challan_no') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('truck_no', 'Truck No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('truck_no', request()->old('truck_no'), [
                                                            'id' => 'truck_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter truck no',
                                                            'required' => true,
                                                        ]) !!}
                                                        {!! $errors->first('truck_no') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('driver_name', 'Driver Name', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('driver_name', request()->old('driver_name'), [
                                                            'id' => 'driver_name',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter driver name',
                                                            'required' => true,
                                                        ]) !!}
                                                        {!! $errors->first('driver_name') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('driver_phone', 'Driver Phone', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('driver_phone', request()->old('driver_phone'), [
                                                            'id' => 'driver_phone',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter driver phone no',
                                                            'required' => true,
                                                        ]) !!}
                                                        {!! $errors->first('driver_phone') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('attachments', 'Return File', array('class' => 'col-form-label', 'id'=>'return_file')) !!}
                                                        <br>
                                                        <input type="file" name="attachments"
                                                               id="return_file" class="form-control">

                                                        {!! $errors->first('attachments') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th>SL</th>
                                                            <th>Product Category</th>
                                                            <th width="40%">Product Detail</th>
                                                            <th>UOM</th>
                                                            <th>Delivered Qty</th>
                                                            <th width="15%">Return Qty</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($fgDelivery->finishedGoodDeliveryItems as $key=>$item)
                                                            <tr>
                                                                <td class="text-center">{{$key+1}}</td>
                                                                <td>{{isset($item->workOrderItem->product->category->name)?$item->workOrderItem->product->category->name:''}}</td>
                                                                <td>{{isset($item->workOrderItem->product->name)?$item->workOrderItem->product->name:''}}
                                                                    ( {{isset($item->workOrderItem->product->sku)?$item->workOrderItem->product->sku:''}}
                                                                    ) {{ getProductAttributesFaster($item->workOrderItem->product) }}</td>
                                                                <td>{{ isset($item->workOrderItem->product->productUnit->unit_name)?$item->workOrderItem->product->productUnit->unit_name:'' }}</td>
                                                                <td class="text-center">{{$item->delivery_qty - $item->returns->sum('quantity')}}</td>
                                                                <td class="text-center">
                                                                    <input type="number"
                                                                           name="quantity[{{$item->id}}]"
                                                                           id="quantity{{$item->id}}"
                                                                           class="form-control quantity text-right"
                                                                           min="0"
                                                                           max="{{$item->delivery_qty}}"
                                                                           step="any"
                                                                           onchange="checkReturnQuantity($(this))"
                                                                           onkeyup="checkReturnQuantity($(this))">
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('comments', 'Remarks', ['class' => 'col-form-label']) !!}
                                                        {!! Form::textarea('comments', request()->old('remarks'), [
                                                            'id' => 'comments',
                                                            'class' => 'form-control',
                                                            'rows'=>'5',
                                                            'placeholder' => 'Enter Remarks'
                                                        ]) !!}
                                                        {!! $errors->first('comments') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
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
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        function checkReturnQuantity(element) {
            var value = parseFloat(element.val());
            var max = parseFloat(element.attr('max'));
            var min = parseFloat(element.attr('min'));

            if (value > max) {
                element.val(max);
            }

            if (value < min) {
                element.val(min);
            }
        }
    </script>
@endsection
