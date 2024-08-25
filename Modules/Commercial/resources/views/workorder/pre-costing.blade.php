@extends('layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Commercial'],
            'pTitle' => $title.' of '. $workOrder->reference_no])


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="{{route('work-orders.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Work Orders List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Work Orders Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        @if(isset($preCosting))
                                            {!! Form::model($preCosting, [
                                            'route' => ['pre-costing.update', $preCosting->id],
                                            'method' => 'PUT',
                                            'class' => 'form-horizontal',
                                            'files' => true,
                                            ]) !!}

                                        @else
                                            {!! Form::open(array('route' => 'pre-costing.store','method'=>'POST',
                                           'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}
                                        @endif

                                        <div class="row">
                                            <div class="form-group row">
                                                <label for="yarn_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Yarn Cost per ')}} {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>

                                                <div class="col-3">
                                                    {!! Form::number('yarn_cost', request()->old('yarn_cost'), [
                                                        'id' => 'yarn_cost',
                                                        'class' => 'form-control mask-money',
                                                        'placeholder' => '0',
                                                        'step'=>'any'
                                                    ]) !!}
                                                    {!! $errors->first('yarn_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="weaving_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Weaving Cost per')}} {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('weaving_cost', request()->old('weaving_cost'), [
                                                        'id' => 'weaving_cost',
                                                        'class' => 'form-control mask-money',
                                                        'placeholder' => 'Weaving cost',
                                                        'step'=>'any'
                                                    ]) !!}
                                                    {!! $errors->first('weaving_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="grey_cost_fabric"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Grey Cost per')}} {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>

                                                <div class="col-3">
                                                    {!! Form::number('grey_cost_fabric', request()->old('grey_cost_fabric'), [
                                                        'id' => 'grey_cost_fabric',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Grey cost per (Yds/Meter)'
                                                    ]) !!}
                                                    {!! $errors->first('grey_cost_fabric') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="dyes_chemical"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Dyes Chemical per ')}} {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">

                                                    {!! Form::number('dyes_chemical', request()->old('dyes_chemical'), [
                                                        'id' => 'dyes_chemical',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Dyes chemical per (Yds/Meter)'
                                                    ]) !!}
                                                    {!! $errors->first('dyes_chemical') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="special_finish_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Special Finish Cost per ')}} {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">

                                                    {!! Form::number('special_finish_cost', request()->old('special_finish_cost'), [
                                                        'id' => 'special_finish_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Special Finish Cost'
                                                    ]) !!}
                                                    {!! $errors->first('special_finish_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="excess_less_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Excess/Less Cost per ')}} {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">

                                                    {!! Form::number('excess_less_cost', request()->old('excess_less_cost'), [
                                                        'id' => 'excess_less_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Excess/Less cost'
                                                    ]) !!}
                                                    {!! $errors->first('excess_less_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="overhead_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Overhead Cost per ')}}{{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('overhead_cost', isset($preCosting)? request()->old('overhead_cost') : $overHeadCost, [
                                                        'id' => 'overhead_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Overhead Cost'
                                                    ]) !!}
                                                    {!! $errors->first('overhead_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="allowance_percentage"
                                                       class="col-4 col-form-label text-right"><strong>Allowance
                                                        Percentage %
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">

                                                    {!! Form::number('allowance_percentage', request()->old('allowance_percentage'), [
                                                        'id' => 'allowance_percentage',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Allowance Percentage'
                                                    ]) !!}
                                                    {!! $errors->first('allowance_percentage') !!}
                                                </div>

                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="allowance_cost"
                                                       class="col-4 col-form-label text-right"><strong>Allowance
                                                        Cost per {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('allowance_cost', request()->old('allowance_cost'), [
                                                        'id' => 'allowance_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Allowance Cost'
                                                    ]) !!}
                                                    {!! $errors->first('allowance_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="commercial_percentage"
                                                       class="col-4 col-form-label text-right"><strong>Commercial
                                                        Percentage (%)
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('commercial_percentage', request()->old('commercial_percentage'), [
                                                        'id' => 'commercial_percentage',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Commercial Percentage'
                                                    ]) !!}
                                                    {!! $errors->first('commercial_percentage') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="commercial_cost"
                                                       class="col-4 col-form-label text-right"><strong>Commercial
                                                        Cost per {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('commercial_cost', request()->old('commercial_cost'), [
                                                        'id' => 'commercial_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Commercial Cost'
                                                    ]) !!}
                                                    {!! $errors->first('commercial_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="commercial_cost"
                                                       class="col-4 col-form-label text-right"><strong>Sales
                                                        Commission per {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('sales_commission', request()->old('sales_commission'), [
                                                        'id' => 'sales_commission',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Sales Commission'
                                                    ]) !!}
                                                    {!! $errors->first('sales_commission') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="actual_cost"
                                                       class="col-4 col-form-label text-right"><strong>Actual
                                                        Cost per {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('actual_cost', request()->old('actual_cost'), [
                                                        'id' => 'actual_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Actual Cost'
                                                    ]) !!}
                                                    {!! $errors->first('actual_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="net_sales_price"
                                                       class="col-4 col-form-label text-right"><strong>Net Sales Price
                                                        per {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('net_sales_price', request()->old('net_sales_price'), [
                                                        'id' => 'net_sales_price',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Net Sales Price',
                                                        'onkeyup'=>'calculateProfitLoss()',
                                                        'onchange'=>'calculateProfitLoss()',
                                                    ]) !!}
                                                    {!! $errors->first('net_sales_price') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="net_sales_price"
                                                       class="col-4 col-form-label text-right"><strong>Profit/Loss on
                                                        Sale per {{$workOrderUnit}}
                                                    </strong><span class="text-danger">*</span></label>
                                                <div class="col-3">
                                                    {!! Form::number('profit_loss_on_sales', request()->old('profit_loss_on_sales'), [
                                                        'id' => 'profit_loss_on_sales',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any',
                                                        'placeholder' => 'Profit/Loss on Sales'
                                                    ]) !!}
                                                    {!! $errors->first('profit_loss_on_sales') !!}
                                                </div>
                                            </div>

                                            <input type="hidden" name="work_order_id" value="{{$workOrder->id}}">

                                            <div class="form-group row mt-3">
                                                <div class="col-md-3 offset-md-5">
                                                    {!! Form::submit('Save changes', ['class' => 'btn btn-primary center m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                                                </div>
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
        calculateProfitLoss();

        function calculateProfitLoss() {
            var netSalePrice = $('#net_sales_price').val();
            var actualCost = $('#actual_cost').val();

            if (netSalePrice !== null && actualCost !== null) {
                var profitLoss = parseFloat(netSalePrice - actualCost);
                $('#profit_loss_on_sales').val(profitLoss.toFixed(3));
            }
        }
    </script>
@endsection
