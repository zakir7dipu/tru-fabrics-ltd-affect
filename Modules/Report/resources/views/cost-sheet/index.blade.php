@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Cost Sheet'],
            'pTitle' => $title])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4># Cost Sheet (Pre-Cost & Post-Cost) Generate Based On Work Order</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-md-4 offset-md-4">
                                        {!!  Form::label('work_order_id', 'Choose Work Orders', array('class' => 'col-form-label')) !!}

                                        <select name="work_order_id"
                                                id="work_order_id"
                                                style="width: 100%"
                                                class="form-control select2"
                                                onchange="window.open('{{ url('admin/pre-post-cost-compares') }}?work_order_id='+$('#work_order_id').val(), '_parent')"
                                        >

                                            @if(isset($workOrders))
                                                <option value="{{null}}">Choose Work Order</option>
                                                @foreach($workOrders as $key => $workOrder)
                                                    <option
                                                        value="{{ $workOrder->id }}" {{ $workOrder->id == \request()->get('work_order_id') ? 'selected' : '' }}>{{ $workOrder->work_order_no }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    @if(request()->get('work_order_id') &&  !empty($model))

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h4>#Pre Cost of {{$model->work_order_no}}</h4></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group row">
                                                <label for="yarn_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Yarn Cost per')}} {{$workOrderUnit}}
                                                    </strong></label>

                                                <div class="col-6">
                                                    {!! Form::number('yarn_cost', $model->preCosting->yarn_cost?? request()->old('yarn_cost'), [
                                                        'id' => 'yarn_cost',
                                                        'class' => 'form-control mask-money',
                                                        'placeholder' => 'Enter Shrinkage',
                                                        'step'=>'any','readonly',
                                                        'readonly'
                                                    ]) !!}
                                                    {!! $errors->first('yarn_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="weaving_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Weaving Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('weaving_cost', $model->preCosting->weaving_cost?? request()->old('weaving_cost'), [
                                                        'id' => 'weaving_cost',
                                                        'class' => 'form-control mask-money',
                                                        'placeholder' => 'Weaving cost',
                                                        'step'=>'any','readonly'
                                                    ]) !!}
                                                    {!! $errors->first('weaving_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="grey_cost_fabric"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Grey Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>

                                                <div class="col-6">
                                                    {!! Form::number('grey_cost_fabric',$model->preCosting->grey_cost_fabric?? request()->old('grey_cost_fabric'), [
                                                        'id' => 'grey_cost_fabric',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Grey Cost'
                                                    ]) !!}
                                                    {!! $errors->first('grey_cost_fabric') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="dyes_chemical"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Dyes & Chemical Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">

                                                    {!! Form::number('dyes_chemical', $model->preCosting->dyes_chemical?? request()->old('dyes_chemical'), [
                                                        'id' => 'dyes_chemical',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Dyes & Chemical'
                                                    ]) !!}
                                                    {!! $errors->first('dyes_chemical') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="special_finish_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Special Finish Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">

                                                    {!! Form::number('special_finish_cost', $model->preCosting->special_finish_cost?? request()->old('special_finish_cost'), [
                                                        'id' => 'special_finish_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Special Finish Cost'
                                                    ]) !!}
                                                    {!! $errors->first('special_finish_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="excess_less_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Excess/Less Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">

                                                    {!! Form::number('excess_less_cost', $model->preCosting->excess_less_cost?? request()->old('excess_less_cost'), [
                                                        'id' => 'excess_less_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Excess/Less cost'
                                                    ]) !!}
                                                    {!! $errors->first('excess_less_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="overhead_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Overhead Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('overhead_cost', $model->preCosting->overhead_cost?? request()->old('overhead_cost'), [
                                                        'id' => 'overhead_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Overhead Cost'
                                                    ]) !!}
                                                    {!! $errors->first('overhead_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="allowance_percentage"
                                                       class="col-4 col-form-label text-right"><strong>Allowance
                                                        Percentage %
                                                    </strong></label>
                                                <div class="col-6">

                                                    {!! Form::number('allowance_percentage', $model->preCosting->allowance_percentage?? request()->old('allowance_percentage'), [
                                                        'id' => 'allowance_percentage',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Allowance Percentage'
                                                    ]) !!}
                                                    {!! $errors->first('allowance_percentage') !!}
                                                </div>

                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="allowance_cost"
                                                       class="col-4 col-form-label text-right"><strong>Allowance
                                                        Cost per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('allowance_cost',$model->preCosting->allowance_cost?? request()->old('allowance_cost'), [
                                                        'id' => 'allowance_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Allowance Cost'
                                                    ]) !!}
                                                    {!! $errors->first('allowance_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="commercial_percentage"
                                                       class="col-4 col-form-label text-right"><strong>Commercial
                                                        Percentage (%)
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('commercial_percentage',$model->preCosting->commercial_percentage?? request()->old('commercial_percentage'), [
                                                        'id' => 'commercial_percentage',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Commercial Percentage'
                                                    ]) !!}
                                                    {!! $errors->first('commercial_percentage') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="commercial_cost"
                                                       class="col-4 col-form-label text-right"><strong>Commercial
                                                        Cost per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('commercial_cost',$model->preCosting->commercial_cost?? request()->old('commercial_cost'), [
                                                        'id' => 'commercial_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Commercial Cost'
                                                    ]) !!}
                                                    {!! $errors->first('commercial_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="commercial_cost"
                                                       class="col-4 col-form-label text-right"><strong>Sales Commission per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('sales_commission',$model->preCosting->sales_commission?? request()->old('sales_commission'), [
                                                        'id' => 'sales_commission',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Sales Commission'
                                                    ]) !!}
                                                    {!! $errors->first('sales_commission') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="actual_cost"
                                                       class="col-4 col-form-label text-right"><strong>Actual
                                                        Cost per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('actual_cost',$model->preCosting->actual_cost?? request()->old('actual_cost'), [
                                                        'id' => 'actual_cost',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Actual Cost'
                                                    ]) !!}
                                                    {!! $errors->first('actual_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="net_sales_price"
                                                       class="col-4 col-form-label text-right"><strong>Net Sales Price per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('net_sales_price',$model->preCosting->net_sales_price?? request()->old('net_sales_price'), [
                                                        'id' => 'net_sales_price',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Net Sales Price'
                                                    ]) !!}
                                                    {!! $errors->first('net_sales_price') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="net_sales_price"
                                                       class="col-4 col-form-label text-right"><strong>Profit/Loss on
                                                        Sale per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('profit_loss_on_sales',$model->preCosting->profit_loss_on_sales?? request()->old('profit_loss_on_sales'), [
                                                        'id' => 'profit_loss_on_sales',
                                                        'class' => 'form-control mask-money',
                                                        'step'=>'any','readonly',
                                                        'placeholder' => 'Profit/Loss on Sales'
                                                    ]) !!}
                                                    {!! $errors->first('profit_loss_on_sales') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h4>#Post Cost {{$model->work_order_no}}</h4></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group row">
                                                <label for="post_yarn_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Yarn Cost per')}} {{$workOrderUnit}}
                                                    </strong></label>

                                                <div class="col-6">
                                                    {!! Form::number('post_yarn_cost', 0?? request()->old('post_yarn_cost'), [
                                                        'id' => 'post_yarn_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'placeholder' => 'Enter cost',
                                                        'step'=>'any',
                                                        'min'=>0
                                                    ]) !!}
                                                    {!! $errors->first('post_yarn_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="post_weaving_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Weaving Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_weaving_cost', 0?? request()->old('post_weaving_cost'), [
                                                        'id' => 'post_weaving_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'placeholder' => 'Enter cost',
                                                        'step'=>'any',
                                                        'min'=>0
                                                    ]) !!}
                                                    {!! $errors->first('post_weaving_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="gray_fabric_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Grey Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_gray_fabric_cost', systemMoneyFormat($grayTotalCost/$model->workOrderItems->sum('qty'))?? request()->old('post_gray_fabric_cost'), [
                                                        'id' => 'post_gray_fabric_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'placeholder' => 'Enter cost',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($grayTotalCost/$model->workOrderItems->sum('qty')),
                                                    ]) !!}
                                                    {!! $errors->first('post_gray_fabric_cost') !!}
                                                </div>
                                            </div>
                                            <div class="form-group row mt-3">
                                                <label for="post_dyes_and_chemical_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Dyes & Chemical Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_dyes_and_chemical_cost', systemMoneyFormat($dyesChemicalTotalCost/$model->workOrderItems->sum('qty'))?? request()->old('post_gray_fabric_cost'), [
                                                        'id' => 'post_dyes_and_chemical_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'placeholder' => 'Enter cost',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($dyesChemicalTotalCost/$model->workOrderItems->sum('qty')),
                                                    ]) !!}
                                                    {!! $errors->first('post_dyes_and_chemical_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="post_special_finish_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Special Finish Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">

                                                    {!! Form::number('post_special_finish_cost', 0??request()->old('post_special_finish_cost'), [
                                                        'id' => 'post_special_finish_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'step'=>'any',
                                                        'placeholder' => 'Enter Cost'
                                                    ]) !!}
                                                    {!! $errors->first('post_special_finish_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="post_excess_less_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Excess/Less Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_excess_less_cost',0?? request()->old('post_excess_less_cost'), [
                                                        'id' => 'post_excess_less_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'step'=>'any',
                                                        'placeholder' => 'Excess/Less cost'
                                                    ]) !!}
                                                    {!! $errors->first('post_excess_less_cost') !!}

                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="post_overhead_cost"
                                                       class="col-4 col-form-label text-right"><strong>{{translate('Overhead Cost per ')}}{{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_overhead_cost', systemMoneyFormat($postOverHeadCost)?? request()->old('post_overhead_cost'), [
                                                        'id' => 'post_overhead_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($postOverHeadCost),
                                                        'placeholder' => 'Overhead Cost'
                                                    ]) !!}
                                                    {!! $errors->first('post_overhead_cost') !!}

                                                </div>
                                            </div>
                                            <div class="form-group row mt-3">
                                                <label for="others_cost"
                                                       class="col-4 col-form-label text-right"><strong>Others
                                                        Cost per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('others_cost', systemMoneyFormat($postOtherCost)?? request()->old('others_cost'), [
                                                        'id' => 'others_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($postOtherCost),
                                                        'placeholder' => 'Enter Cost'
                                                    ]) !!}
                                                    {!! $errors->first('others_cost') !!}

                                                </div>
                                            </div>
                                            <div class="form-group row mt-3">
                                                <label for="post_commercial_cost"
                                                       class="col-4 col-form-label text-right"><strong>Commercial
                                                        Cost per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_commercial_cost', systemMoneyFormat($postCommercialCost)?? request()->old('post_commercial_cost'), [
                                                        'id' => 'post_commercial_cost',
                                                        'class' => 'form-control mask-money calculatePostCost',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($postCommercialCost),
                                                        'placeholder' => 'Commercial Cost'
                                                    ]) !!}
                                                    {!! $errors->first('post_commercial_cost') !!}

                                                </div>
                                            </div>
                                            <div class="form-group row mt-3">
                                                <label for="post_actual_cost"
                                                       class="col-4 col-form-label text-right"><strong>Actual
                                                        Cost per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_actual_cost', systemMoneyFormat($postActualCost)?? request()->old('actual_cost'), [
                                                        'id' => 'post_actual_cost',
                                                        'class' => 'form-control mask-money ',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($postActualCost),
                                                        'placeholder' => 'Actual Cost',
                                                        'readonly'
                                                    ]) !!}
                                                    {!! $errors->first('post_actual_cost') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="post_net_sales"
                                                       class="col-4 col-form-label text-right"><strong>Net Sales Price per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_net_sales', systemMoneyFormat($postNetSalesPrice)?? 0, [
                                                        'id' => 'post_net_sales',
                                                        'class' => 'form-control mask-money ',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($postNetSalesPrice),
                                                        'placeholder' => 'Net Sales Cost',
                                                        'readonly'
                                                    ]) !!}
                                                    {!! $errors->first('post_net_sales') !!}
                                                </div>
                                            </div>

                                            <div class="form-group row mt-3">
                                                <label for="post_profit_on_sale"
                                                       class="col-4 col-form-label text-right"><strong>Profit/Loss on
                                                        Sale per {{$workOrderUnit}}
                                                    </strong></label>
                                                <div class="col-6">
                                                    {!! Form::number('post_profit_on_sale', systemMoneyFormat($profitLossOnPrice)?? request()->old('post_profit_on_sale'), [
                                                        'id' => 'post_profit_on_sale',
                                                        'class' => 'form-control mask-money ',
                                                        'step'=>'any',
                                                        'min'=>0,
                                                        'max'=>systemMoneyFormat($profitLossOnPrice),
                                                        'placeholder' => 'Net Sales Cost',
                                                        'readonly'
                                                    ]) !!}
                                                    {!! $errors->first('post_profit_on_sale') !!}
                                                </div>
                                            </div>

                                            <div class="from-group row mt-3">
                                                <div class="col-4">
                                                    <a class="btn btn-sm btn-block btn-success mt-1"
                                                       onclick="window.open('{{ url('admin/pre-post-cost-compares') }}?work_order_id='+$('#work_order_id').val()+'&print', '_blank')"
                                                       target="_blank"><i class="mdi mdi-printer"></i>&nbsp;Print</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">

        calculatePostCost();

        function calculatePostCost() {
            var actualCost = 0;
            $('.calculatePostCost').each(function () {
                actualCost += parseFloat($(this).val());
            })
            $('#post_actual_cost').val(actualCost.toFixed(4));
            var postNetSales = $('#post_net_sales').val();
            var profitLoss = postNetSales - actualCost;
            $('#post_profit_on_sale').val(profitLoss.toFixed(4));

        }

        $('.calculatePostCost').on('change', function () {
            calculatePostCost();
        });
    </script>;

@endsection
