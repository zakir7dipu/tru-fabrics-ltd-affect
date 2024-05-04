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
                                        <a href="{{route('requisitions.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Requisition List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Requisition Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'requisitions.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('reference_no', 'Reference No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('reference_no', isset($sku)?$sku:request()->old('reference_no'), [
                                                            'id' => 'reference_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Reference No'
                                                        ]) !!}
                                                        {!! $errors->first('reference_no') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('requisition_date', 'Requisition Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('requisition_date', date('Y-m-d'), [
                                                            'id' => 'requisition_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Requisition Date'
                                                        ]) !!}
                                                        {!! $errors->first('requisition_date') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('work_order_id', 'Work Orders', array('class' => 'col-form-label')) !!}

                                                        <select name="work_order_id"
                                                                id="work_order_id"
                                                                style="width: 100%"
                                                                class="form-control select2"
                                                                onchange="getWorkOrderItems($(this))">

                                                            @if(isset($workOrders))
                                                                <option value="{{null}}">Choose Work Order</option>
                                                                @foreach($workOrders as $key => $workOrder)
                                                                    <option
                                                                        value="{{ $workOrder->id }}">{{ $workOrder->reference_no }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>

                                                        {!! $errors->first('work_order_id') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('requisition_file', 'Requisition File', array('class' => 'col-form-label')) !!}
                                                        <br>
                                                        <input type="file" name="requisition_file"
                                                               id="wo_file" class="btn btn-outline-success btn-sm">

                                                        {!! $errors->first('requisition_file') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('work_order_item_id', 'Work Order Wise Product', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>

                                                        <select name="work_order_item_id"
                                                                id="work_order_item_id"
                                                                style="width: 100%"
                                                                class="form-control select2">

                                                        </select>

                                                        {!! $errors->first('work_order_id') !!}
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12 mt-4 mb-2">

                                                <table class="table table-striped table-bordered miw-500 dac_table"
                                                       cellspacing="0"
                                                       width="100%" id="dataTable">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th width="20%">Category</th>
                                                        <th width="50%">Product</th>
                                                        <th width="10%">UOM</th>
                                                        <th width="10%">Qty</th>
                                                        <th width="10%" class="text-center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="field_wrapper">
                                                    <tr>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <select name="sub_category_id[]"
                                                                        id="sub_category_id_1"
                                                                        style="width: 100%"
                                                                        class="form-control subcategory select-2"
                                                                        onchange="getProduct($(this))">

                                                                    @if(isset($categories[0]))
                                                                        @foreach($categories as $key => $category)
                                                                            <option
                                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="product-td">
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <select name="product_id[]" id="product_1"
                                                                        class="form-control product requisition-products select2"
                                                                        onchange="getUOM()" data-product-id=""
                                                                        required>
                                                                    <option value="{{ null }}"
                                                                            data-uom="">{{ __('Select Product') }}</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="product-uom text-center">

                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <input type="number" name="qty[]" min="1"
                                                                       max="99999999"
                                                                       id="qty_1"
                                                                       class="form-control requisition-qty"
                                                                       aria-label="Large"
                                                                       aria-describedby="inputGroup-sizing-sm"
                                                                       onKeyPress="if(this.value.length==6) return false;"
                                                                       min="1"
                                                                       required data-input="recommended"
                                                                       oninput="this.value = Math.abs(this.value)"
                                                                       data-quantity=""
                                                                >
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <a href="javascript:void(0);" id="remove_1"
                                                               class="remove_button btn btn-sm btn-danger"
                                                               title="Remove"
                                                               style="color:#fff;">
                                                                <i class="mdi mdi-trash-can"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <a href="javascript:void(0);"
                                                   class="add_button btn btn-sm btn-success pull-right"
                                                   style="margin-right:17px;" title="Add More Product">
                                                    <i class="mdi mdi-plus"></i>
                                                </a>
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
    </div>

@endsection
@section('javascript')

    <script type="text/javascript">

        "use strict";
        var selectedProductIds = [];

        function changeSelectedProductIds() {
            selectedProductIds = [];
            $('.product').each(function () { //
                selectedProductIds.push($(this).val());
            })
        }

        $(document).ready(function () {

            var form = $('#addRequisitionForm');

            var maxField = 200;
            var addButton = $('.add_button');
            var x = 1;
            var wrapper = $('.field_wrapper');

            getSubCategories();

            $(addButton).click(function () {

                x++;

                var fieldHTML = '<tr>\n' +
                    '                                            <td>\n' +
                    '\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <select name="sub_category_id[]" style="width: 100%" id="sub_category_id_' + x + '" class="form-control select2 subcategory" onchange="getProduct($(this))" required></select>\n' +
                    '                                                </div>\n' +
                    '\n' +
                    '                                            </td>\n' +

                    '                                            <td class="product-td">\n' +
                    '\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <select name="product_id[]" onchange="getUOM()" id="product_' + x + '" class="form-control select2 product requisition-products" data-product-id="" required>\n' +
                    '                                                        <option value="{{ null }}">{{ __("Select Product") }}</option>\n' +
                    '                                                    </select>\n' +
                    '                                                </div>\n' +
                    '\n' +
                    '                                            </td>\n' +
                    '<td class="product-uom text-center"></td>' +
                    '                                            <td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="number" name="qty[]" min="1" max="9999" onKeyPress="if(this.value.length==6) return false;" id="qty_' + x + '" class="form-control requisition-qty" aria-label="Large" aria-describedby="inputGroup-sizing-sm" oninput="this.value = Math.abs(this.value)" required data-quantity="">\n' +
                    '                                                </div>\n' +
                    '                                            </td>\n'
                    +
                    '\n' +
                    '                                            <td>\n' +
                    '                                                <a href="javascript:void(0);" id="remove_' + x + '" class="remove_button btn btn-sm btn-danger" title="Remove" style="color:#fff;">\n' +
                    '                                                    <i class="mdi mdi-trash-can"></i>\n' +
                    '                                                    \n' +
                    '                                                </a>\n' +
                    '                                            </td>\n' +
                    '\n' +
                    '                                        </tr>';

                $(wrapper).append(fieldHTML);
                $('#sub_category_id_' + x, wrapper).select2();
                $('#product_' + x, wrapper).select2();
                generateSubCategories($('#sub_category_id_' + x, wrapper))
                $('.mask-money').maskMoney(
                    {
                        thousands: '', decimal: '.', allowZero: true, allowEmpty: true
                    });

            });

            $(wrapper).on('click', '.remove_button', function (e) {
                e.preventDefault();
                if (x > 1) {
                    x--;

                    var incrementNumber = $(this).attr('id').split("_")[1];
                    var productVal = $('#product_' + incrementNumber).val()

                    const index = selectedProductIds.indexOf(productVal);
                    if (index > -1) {
                        selectedProductIds.splice(index, 1);
                    }
                    $(this).parent('td').parent('tr').remove();
                }
            });

        });

        $(document).ready(function () {
            $.each($('.subcategory'), function (index, val) {
                getProduct($(this));
            });

            var wrapper = $('.field_wrapper');
            $(wrapper).on('change', '.product', function (e) {
                changeSelectedProductIds();

                var incrementNumber = $(this).attr('id').split("_")[1];
                $('#qty_' + incrementNumber).val($('#qty_' + incrementNumber).attr('data-quantity'));

                $(this).parent().parent().parent().find('.subcategory').val(parseInt($(this).find(':selected').attr('data-sub-category-id'))).select2();
            });

        });

        function getSubCategories() {
            $.each($('.subcategory'), function (index, val) {
                generateSubCategories($(this));
            });
        }

        function generateSubCategories(element) {
            var category = $('#category_id').find(':selected');
            var categories = <?php echo json_encode($categories); ?>;
            console.log(categories);
            var subCategories = '<option value="">Select Subcategory</option>';
            $.each(categories, function (index, val) {
                subCategories += '<option value="' + (val.id) + '">' + val.name + ' (' + (val.code) + ')</option>';
            });

            element.html(subCategories).change();
        }


        function getProduct(element) {
            var incrementNumber = element.attr('id').split("_")[3];

            changeSelectedProductIds();

            var subcategory_id = $('#sub_category_id_' + incrementNumber).val();
            if (subcategory_id.length === 0) {
                subcategory_id = 0;
            }
            $('#qty_' + incrementNumber).val($('#qty_' + incrementNumber).attr('data-quantity'));

            $('#product_' + incrementNumber).html('<option value="">Please Wait...</option>').load('{{URL::to(Request()->route()->getPrefix()."/requisitions/load-category-wise-product")}}/' + subcategory_id + '?selected=' + ($('#product_' + incrementNumber).attr('data-product-id')) + '&products_id=' + selectedProductIds);
        }

        function getUOM() {
            $.each($('.product'), function (index, val) {
                $(this).parent().parent().next().html($(this).find(':selected').attr('data-uom'));
            });
        }

        function uploadExcelFile() {
            var excel_form = $('#excel-upload-form');
            var excel_button = $('.excel-upload-button');
            var excel_button_content = excel_button.html();

            excel_button.prop('disabled', true).html("<i class='las la-spinner la-spin'></i>&nbsp;Please wait...");

            $.ajax({
                url: excel_form.attr('action'),
                type: excel_form.attr('method'),
                dataType: 'json',
                processData: false,
                contentType: false,
                data: new FormData(excel_form[0]),
            })
                .done(function (response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }

                    excel_button.prop('disabled', false).html(excel_button_content);
                })
                .fail(function (response) {
                    var errors = '<ul class="">';
                    $.each(response.responseJSON.errors, function (index, val) {
                        errors += '<li class="text-white">' + val[0] + '</li>';
                    });
                    errors += '</ul>';
                    toastr.error(errors);

                    excel_button.prop('disabled', false).html(excel_button_content);
                });
        }

        function getWorkOrderItems(element) {
            var workOrderId = $('#work_order_id').val();
            $('#work_order_item_id').html('<option value="">Please Wait...</option>').load('{{URL::to(Request()->route()->getPrefix()."/requisitions/load-wo-wise-product")}}/' + workOrderId);
        }
    </script>
@endsection
