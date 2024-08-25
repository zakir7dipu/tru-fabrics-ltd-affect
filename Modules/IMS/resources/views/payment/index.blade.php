@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'CMS'],
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
                                        @if(isOptionPermitted('payment-term-create'))
                                            <a href="{{route('payment-terms.create')}}" class="btn btn-info me-2"
                                               data-toggle="tooltip" title="Add Payment Terms"> <i class="mdi mdi-plus
                                           me-1"></i>{{translate('Add Payment Terms')}}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @include('yajra.datatable')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-md" id="showUserDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title " id="myLargeModalLabel">{{translate('Payment Term')}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="modal-body" id="dataBody">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @include('yajra.js')
    <script>

        $('#uploadFile').on('click', function () {
            $('#supplierUploadModal').modal('show');
        });

        function showDetails(userId) {
            $('#dataBody').empty().load('{{url(Request()->route()->getPrefix()."/payment-terms")}}/' + userId);
            $('#showUserDetailsModal').modal('show');
        }
    </script>
@endsection
