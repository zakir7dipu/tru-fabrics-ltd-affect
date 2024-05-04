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
                                        @if (isOptionPermitted('material-requisition-create'))
                                            <a href="{{ route('requisitions.create') }}" class="btn btn-info mb-2 me-2"
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
            $('#dataBody').empty().load('{{ url(Request()->route()->getPrefix() . '/requisitions') }}/' + id);
            $('#showUserDetailsModal').modal('show');
        }

        function showWoDetails(id) {
            $('.bd-example-modal-xl .modal-title').html('Work Order Details');
            $('#dataBody').empty().load('{{ url(Request()->route()->getPrefix() . '/work-orders') }}/' + id);
            $('#showUserDetailsModal').modal('show');
        }

        function sendToStore(button) {
            swal({
                title: "Are you sure ?",
                text: "Once you sent, You can not recover this data and related files.",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Send",
                        value: true,
                        visible: true,
                        closeModal: true
                    },
                },
            }).then((value) => {
                if(value){
                    $.ajax({
                        type: 'get',
                        url: button.attr('data-src'),
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        dataType: 'json',
                        success:function (response) {
                            if(response.success){
                                notification('success', response.message)
                                reloadDatatable();
                            }else{
                                notification('error', response.message);
                                return;
                            }
                        },
                    });
                }
            });
        }
    </script>
@endsection
