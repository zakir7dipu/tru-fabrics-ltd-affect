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
                                        <a class="btn btn-success mb-2 me-2 text-white" title="Upload Excel"
                                           data-toggle="modal" data-target="#uploadExcel"><i class="las la-upload"></i>&nbsp;Upload
                                            Excel
                                        </a>

                                        <a href="{{route('overhead-costings.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title=" Overhead Costing List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Overhead Costing')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::model($costingChart, [
                                            'route' => ['overhead-costings.update', $costingChart->id],
                                            'method' => 'PUT',
                                            'class' => 'form-horizontal',
                                            'files' => false,
                                            ]) !!}


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    {!!  Form::label('date', 'Date', ['class' => 'col-form-label']) !!}
                                                    <span class="text-danger">*</span>
                                                    {!! Form::date('date', date('Y-m-d'), [
                                                        'id' => 'date',
                                                        'class' => 'form-control',
                                                        'placeholder' => ''
                                                    ]) !!}
                                                    {!! $errors->first('date') !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2 table-responsive"
                                             style="height: 100%; overflow:auto">
                                            <table class="table table-bordered"
                                                   cellspacing="0" style="width: 2500px; overflow:scroll">
                                                <thead>
                                                <tr class="text-center">
                                                    <th style="width: 200px">Process Name</th>
                                                    @foreach($gsmRanges as $range)
                                                        <th style="width: 150px!important;">{{$range->min_value.'-'.$range->max_value}}</th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($productionProcess as $process)
                                                    <tr>
                                                        <td>{{$process->name}}
                                                            <input type="hidden" name="process_id[]"
                                                                   value="{{$process->id}}">
                                                        </td>
                                                        @foreach($gsmRanges as $range)

                                                            <td>
                                                                <input type="number" class="form-control"
                                                                       min="1" max="500"
                                                                       name="gsm_range_id[{{$process->id}}][{{$range->id}}]"
                                                                       value="{{ $costingChart->costingChartItems->where('process_id', $process->id)->where('gsm_range_id', $range->id)->sum('amount') }}"
                                                                >
                                                            </td>

                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
                                            {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                                            &nbsp;
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
