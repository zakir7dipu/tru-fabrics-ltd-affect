@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', [
                'item' => ['/' => languageValue(websiteSettings()->name), 'active' => 'Commercial'],
                'pTitle' => $title,
            ])

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-xl-8">
                                </div>
                                <div class="col-xl-4">
                                    <div class="text-xl-end mt-xl-0 mt-2">
                                        <a href="javascript:void(0)" class="btn btn-success mb-2"
                                           data-toggle="modal" title="Upload Opening Stock by xlsx file"
                                           id="uploadOptionFile"> <i class="mdi mdi-cloud-upload"></i> Upload
                                            Bulk Work Order</a>

                                        @if (isOptionPermitted('work-order-create'))
                                            <a href="{{ route('work-orders.create') }}" class="btn btn-info mb-2 me-2"
                                               data-toggle="tooltip" title="Add New"> <i
                                                    class="mdi mdi-plus
                                           me-1"></i>{{ translate('Add New') }}</a>
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
    <div class="modal fade bd-example-modal-xl" id="showUserDetailsModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title " id="myLargeModalLabel">{{ translate('Work Order Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>

                <div class="modal-body" id="dataBody">

                </div>
            </div>
        </div>
    </div>

    @include('commercial::workorder.xlsfile')
@endsection

@section('javascript')
    @include('yajra.js')
    <script>
        $('#uploadOptionFile').on('click', function () {
            $('#productUploadModal .modal-title').html('Upload Workorder Bulk Data');
            $('#productUploadModal').modal('show');
        });

        function showDetails(id) {

            $('#dataBody').empty().load('{{ url(Request()->route()->getPrefix() . '/work-orders') }}/' + id);
            $('#showUserDetailsModal').modal('show');
        }
    </script>
@endsection
