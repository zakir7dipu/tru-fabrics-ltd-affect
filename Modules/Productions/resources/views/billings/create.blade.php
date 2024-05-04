@extends('layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Productions'],
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
                                        <a href="{{route('billings.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Billings List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Billings Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'billings.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('bill_no', 'Bill No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('bill_no', request()->old('bill_no'), [
                                                            'id' => 'bill_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Bill No',
                                                            'required'
                                                        ]) !!}
                                                        {!! $errors->first('bill_no') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('submit_date', 'Submit Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('submit_date', date('Y-m-d'), [
                                                            'id' => 'submit_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Submit Date'
                                                        ]) !!}
                                                        {!! $errors->first('submit_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('discrepancies_charge', 'Discrepancies Charge', ['class' => 'col-form-label']) !!}
                                                        {!! Form::text('discrepancies_charge', request()->old('discrepancies_charge'), [
                                                            'id' => 'discrepancies_charge',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Charge'
                                                        ]) !!}
                                                        {!! $errors->first('discrepancies_charge') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('realized_value', 'Realized Values', ['class' => 'col-form-label']) !!}
                                                        {!! Form::text('realized_value', request()->old('realized_value'), [
                                                            'id' => 'realized_value',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Value'
                                                        ]) !!}
                                                        {!! $errors->first('realized_value') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('work_order_id', 'Work Orders', array('class' => 'col-form-label')) !!}

                                                        <select name="work_order_id"
                                                                id="work_order_id"
                                                                class="form-control select2"
                                                                onchange="getWorkOrderItems($(this))">

                                                            @if(isset($workOrders))
                                                                <option value="{{null}}">Choose Work Order</option>
                                                                @foreach($workOrders as $key => $workOrder)
                                                                    <option
                                                                        value="{{ $workOrder->id }}">{{ $workOrder->reference_no }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        {!! $errors->first('work_order_id') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('finished_goods_delivery_id', 'Finished Goods Delivered Reference No ', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>

                                                        <select name="finished_goods_delivery_id[]"
                                                                id="finished_goods_delivery_id"
                                                                class="form-control select2" multiple>

                                                        </select>

                                                        {!! $errors->first('finished_goods_delivery_id') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('accept_date', 'Accept Date', ['class' => 'col-form-label']) !!}

                                                        {!! Form::date('accept_date', \request()->old('accept_date'), [
                                                            'id' => 'accept_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Accept Date'
                                                        ]) !!}
                                                        {!! $errors->first('accept_date') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('fg_files', 'Bills File', array('class' => 'col-form-label')) !!}
                                                        <br>
                                                        <input type="file" name="fg_files"
                                                               id="fg_files" class="btn btn-outline-success btn-sm">

                                                        {!! $errors->first('fg_files') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('status', 'Status', array('class' => 'col-form-label')) !!}
                                                        <br>

                                                        <select name="status" id="status" class="form-control select2">
                                                            @if(isset($statuss))
                                                                @foreach($statuss as $key => $value)
                                                                    <option
                                                                        value="{{ $key }}">{{ $value }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        {!! $errors->first('status') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('remarks', 'Remarks', ['class' => 'col-form-label']) !!}
                                                        {!! Form::textarea('remarks', request()->old('remarks'), [
                                                            'id' => 'remarks',
                                                            'class' => 'form-control',
                                                            'rows'=>'5',
                                                            'placeholder' => 'Enter Remarks'
                                                        ]) !!}
                                                        {!! $errors->first('remarks') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                {!! Form::submit('Submit Bills', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
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
        function getWorkOrderItems(element) {
            var workOrderId = $('#work_order_id').val();
            $('#finished_goods_delivery_id').html('<option value="">Please Wait...</option>').empty().load('{{URL::to(Request()->route()->getPrefix()."/billings/load-wo-wise-fg-references")}}/' + workOrderId);
        }
    </script>
@endsection
