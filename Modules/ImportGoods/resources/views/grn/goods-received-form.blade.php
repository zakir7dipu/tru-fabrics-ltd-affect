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
                        <div class="card-header">
                            # Gate In
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! Form::open(array('route' => 'grns.search.pi','method'=>'POST',
                                                                        'class'=>'','files'=>false,'id'=>'ProductsForm')) !!}
                                <div class="row">
                                    <input type="hidden" name="type" value="in">
                                    <div class="col-md-5 offset-md-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!!  Form::label('pi_no', 'Search Reference / LC / Invoice No', ['class' => 'col-form-label']) !!}
                                                <span class="text-danger">*</span>
                                                {!! Form::text('pi_no', isset($sku)?$sku:request()->old('pi_no'), [
                                                    'id' => 'pi_no',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Search Reference / LC / Invoice No'
                                                ]) !!}
                                                {!! $errors->first('pi_no') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        {!! Form::submit('Proceed to Gate In', ['class' => 'btn btn-success','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                                        &nbsp;
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--            <div class="row">--}}
            {{--                <div class="col-12">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-header">--}}
            {{--                            # Gate Out--}}
            {{--                        </div>--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="table-responsive">--}}
            {{--                                {!! Form::open(array('route' => 'grns.create','method'=>'POST',--}}
            {{--                                                                        'class'=>'','files'=>false,'id'=>'ProductsForm')) !!}--}}
            {{--                                <input type="hidden" name="type" value="out">--}}
            {{--                                <div class="row">--}}
            {{--                                    <div class="col-md-5 offset-md-2">--}}
            {{--                                        <div class="form-group">--}}
            {{--                                            <div class="form-line">--}}
            {{--                                                {!!  Form::label('pi_no', 'PI No', ['class' => 'col-form-label']) !!}--}}
            {{--                                                <span class="text-danger">*</span>--}}
            {{--                                                {!! Form::text('pi_no', isset($sku)?$sku:request()->old('pi_no'), [--}}
            {{--                                                    'id' => 'pi_no',--}}
            {{--                                                    'class' => 'form-control',--}}
            {{--                                                    'placeholder' => 'Enter PI No'--}}
            {{--                                                ]) !!}--}}
            {{--                                                {!! $errors->first('pi_no') !!}--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="col-md-3 mt-4">--}}
            {{--                                        {!! Form::submit('Proceed to Gate Out', ['class' => 'btn btn-warning m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}--}}
            {{--                                        &nbsp;--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}

            {{--                                {!! Form::close() !!}--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>

@endsection

