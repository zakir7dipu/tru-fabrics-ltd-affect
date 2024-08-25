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
                    <h4 class="modal-title" id="myLargeModalLabel">{{ translate('Requisition Details') }}</h4>
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
        function showDetails(id) {
            $('.bd-example-modal-xl .modal-title').html('Requisition Details');
            $('#dataBody').empty().load('{{ url('admin/commercial/requisitions') }}/' + id);
            $('#showUserDetailsModal').modal('show');
        }

        function showWoDetails(id) {
            $('.bd-example-modal-xl .modal-title').html('Work Order Details');
            $('#dataBody').empty().load('{{ url('admin/commercial/work-orders') }}/' + id);
            $('#showUserDetailsModal').modal('show');
        }

        function showReqDetails(element) {
            let code = element.attr('data-code');
            $('.bd-example-modal-xl .modal-title').html('Requisition Details');
            $('#dataBody').empty().load('{{ url('admin/commercial/requisition-wise-details') }}/' + code);
            $('#showUserDetailsModal').modal('show');
        }

    </script>
@endsection
