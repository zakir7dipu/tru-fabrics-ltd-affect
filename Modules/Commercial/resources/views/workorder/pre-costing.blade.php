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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('yarn_cost', 'Yarn Cost', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('yarn_cost', request()->old('yarn_cost'), [
                                                            'id' => 'yarn_cost',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Enter Shrinkage'
                                                        ]) !!}
                                                        {!! $errors->first('yarn_cost') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('weaving_cost', 'Weaving Cost', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('weaving_cost', request()->old('weaving_cost'), [
                                                            'id' => 'weaving_cost',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Weaving cost'
                                                        ]) !!}
                                                        {!! $errors->first('weaving_cost') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('grey_cost_fabric', 'Gray Cost Fabric', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('grey_cost_fabric', request()->old('grey_cost_fabric'), [
                                                            'id' => 'grey_cost_fabric',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Gray cost fabric'
                                                        ]) !!}
                                                        {!! $errors->first('grey_cost_fabric') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('dyes_chemical', 'Dyes Chemical', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('dyes_chemical', request()->old('dyes_chemical'), [
                                                            'id' => 'dyes_chemical',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Dyes Chemical'
                                                        ]) !!}
                                                        {!! $errors->first('dyes_chemical') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('special_finish_cost', 'Special Finish Cost', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('special_finish_cost', request()->old('special_finish_cost'), [
                                                            'id' => 'special_finish_cost',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Special Finish Cost'
                                                        ]) !!}
                                                        {!! $errors->first('special_finish_cost') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('excess_less_cost', 'Excess Less Cost', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('excess_less_cost', request()->old('excess_less_cost'), [
                                                            'id' => 'excess_less_cost',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Excess Less Cost'
                                                        ]) !!}
                                                        {!! $errors->first('excess_less_cost') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('overhead_cost', 'Overhead Cost', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('overhead_cost', request()->old('overhead_cost'), [
                                                            'id' => 'overhead_cost',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Overhead Cost'
                                                        ]) !!}
                                                        {!! $errors->first('overhead_cost') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('allowance_percentage', 'Allowance Percentage %', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('allowance_percentage', request()->old('allowance_percentage'), [
                                                            'id' => 'allowance_percentage',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Allowance Percentage'
                                                        ]) !!}
                                                        {!! $errors->first('allowance_percentage') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('allowance_cost', 'Allowance Cost', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('allowance_cost', request()->old('allowance_cost'), [
                                                            'id' => 'allowance_cost',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Allowance Cost'
                                                        ]) !!}
                                                        {!! $errors->first('allowance_cost') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('commercial_percentage', 'Commercial Percentage %', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('commercial_percentage', request()->old('commercial_percentage'), [
                                                            'id' => 'commercial_percentage',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Commercial Percentage'
                                                        ]) !!}
                                                        {!! $errors->first('commercial_percentage') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('commercial_cost', 'Commercial Cost', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('commercial_cost', request()->old('commercial_cost'), [
                                                            'id' => 'commercial_cost',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Commercial Cost'
                                                        ]) !!}
                                                        {!! $errors->first('commercial_cost') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('net_sales_price', 'Net Sales Price', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('net_sales_price', request()->old('net_sales_price'), [
                                                            'id' => 'net_sales_price',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Net Sales Price'
                                                        ]) !!}
                                                        {!! $errors->first('net_sales_price') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('profit_loss_on_sales', 'Profit Loss on Sales', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('profit_loss_on_sales', request()->old('profit_loss_on_sales'), [
                                                            'id' => 'profit_loss_on_sales',
                                                            'class' => 'form-control mask-money',
                                                            'placeholder' => 'Profit Loss on Sales'
                                                        ]) !!}
                                                        {!! $errors->first('profit_loss_on_sales') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('yarn_con_wrap', 'Yarn Con Wrap', ['class' => 'col-form-label']) !!}--}}

                                            {{--                                                        {!! Form::text('yarn_con_wrap', request()->old('yarn_con_wrap'), [--}}
                                            {{--                                                            'id' => 'yarn_con_wrap',--}}
                                            {{--                                                            'class' => 'form-control',--}}
                                            {{--                                                            'placeholder' => 'Yarn Con Wrap'--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('yarn_con_wrap') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('yarn_con_weft', 'Yarn Con Weft', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        {!! Form::text('yarn_con_weft', request()->old('yarn_con_weft'), [--}}
                                            {{--                                                            'id' => 'yarn_con_weft',--}}
                                            {{--                                                            'class' => 'form-control',--}}
                                            {{--                                                            'placeholder' => 'Yarn Con Wrap'--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('yarn_con_weft') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}


                                            <input type="hidden" name="work_order_id" value="{{$workOrder->id}}">

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

@endsection
@section('javascript')
@endsection
