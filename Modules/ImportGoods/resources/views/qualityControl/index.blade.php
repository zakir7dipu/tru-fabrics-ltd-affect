@extends('layouts.master')
@section('css')
    @include('yajra.css')
@endsection
@section('content')

    <div class="content">
        <div class="container-fluid">
            @include('components.breadcrumb', ['item' => ['/'=>languageValue(websiteSettings()->name),'active'=>'Factory'],
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
                    <h4 class="modal-title " id="myLargeModalLabel">{{translate('Proforma Invoice Details')}}</h4>
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
        function showGrnDetails(id) {
            $('#dataBody').empty().load('{{url("admin/factory/grns")}}/' + id);
            $('#showUserDetailsModal .modal-title').html('Grn Details');
            $('#showUserDetailsModal').modal('show');
        }

        function notification(status, message) {
            swal({
                icon: status,
                text: message,
                dangerMode: true,
                buttons: {
                    cancel: false,
                    confirm: {
                        text: "OK",
                        value: true,
                        visible: true,
                        closeModal: true
                    },
                },
            });
        }

        function completeGetOut(button) {
            swal({
                title: "Are you sure ?",
                text: "Once you get out the product, You can not recover this data and related files.",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: {
                        text: "Get Out",
                        value: true,
                        visible: true,
                        closeModal: true
                    },
                },
            }).then((value) => {
                if (value) {
                    $.ajax({
                        type: 'get',
                        url: button.attr('data-src'),
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                notification('success', response.message)
                                button.remove();
                            } else {
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
