@extends('layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Request;
    @endphp
    <div class="content">
        <div class="container-fluid">

            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Payment Term'],
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
                                        <a href="{{route('payment-terms.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Payment Terms"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Payment Terms')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        {!! Form::model($paymentTerm, [
                                            'route' => ['payment-terms.update', $paymentTerm->id],
                                            'method' => 'PUT',
                                            'class' => 'form-horizontal',
                                            'files' => false,
                                            ]) !!}

                                        @include('ims::payment._form')

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

