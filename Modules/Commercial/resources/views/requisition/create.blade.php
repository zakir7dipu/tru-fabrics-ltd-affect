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
                                        'class'=>'formInputValidation','files'=>true,'id'=>'ProductsForm')) !!}

                                        <input type="hidden" name="is_bulk_item"
                                               value="{{request()->has('bulk-requisition')?'yes':'no'}}">

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
                                                        {!!  Form::label('requisition_no', 'Requisition No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('requisition_no', request()->old('requisition_no'), [
                                                            'id' => 'requisition_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Requisition No',
                                                            'required'
                                                        ]) !!}
                                                        {!! $errors->first('requisition_no') !!}
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
                                                        {!!  Form::label('department_id', 'Departments', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::Select('department_id',$departments,Request::old('department_id'),['id'=>'department_id', 'class'=>'form-control select2','required'=>true]) !!}
                                                        {!! $errors->first('department_id') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            @if(!request()->has('bulk-requisition'))
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
                                                                            value="{{ $workOrder->id }}">{{ $workOrder->work_order_no }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>

                                                            {!! $errors->first('work_order_id') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                            @if(!request()->has('bulk-requisition'))
                                                <div class="col-md-4">
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
                                                <input type="hidden" name="type" value="workorder">

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            {!!  Form::label('finish_type', 'Fabric Type', array('class' => 'col-form-label')) !!}

                                                            {!! Form::Select('finish_type',requisitionFinishType(),Request::old('finish_type'),['id'=>'finish_type', 'class'=>'form-control select2']) !!}
                                                            {!! $errors->first('finish_type') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <input type="hidden" name="type" value="bulk">
                                            @endif
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
                                            <div class="col-md-12 mt-4 mb-2">

                                                <table class="table table-striped table-bordered miw-500 dac_table"
                                                       cellspacing="0"
                                                       width="100%" id="dataTable">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th width="20%">Product Category</th>
                                                        <th width="40%">Product Detail</th>
                                                        <th width="10%">UOM</th>
                                                        <th width="20%">Qty</th>
                                                        <th width="10%" class="text-center">#</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="field_wrapper">
                                                    <tr>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <select name="sub_category_id[]"
                                                                        id="sub_category_id_1"
                                                                        style="width: 100%"
                                                                        class="form-control subcategory select2"
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
                                                                        data-input="recommended"
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
                                                                <input type="number" name="qty[]" min="0"
                                                                       id="qty_1"
                                                                       step="any"
                                                                       class="form-control requisition-qty"
                                                                       required data-input="recommended"
                                                                       data-quantity="">
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
                                                            'rows'=>'3',
                                                            'placeholder' => 'Enter Remarks'
                                                        ]) !!}
                                                        {!! $errors->first('remarks') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <input type="hidden" name="where_to_go" id="where_to_go" value="index">
                                                <button type="button"
                                                        class="btn btn-primary rounded pull-right save-button"
                                                        onclick="submitRequisition('index');" style="margin-left: 5px">
                                                    <i
                                                        class="mdi mdi-plus"></i>{{ __('Save Requisition') }}</button>
                                                <button type="button"
                                                        class="btn btn-info rounded pull-right save-new-button"
                                                        onclick="submitRequisition('back');"><i
                                                        class="mdi mdi-plus"></i>{{ __('Save & New Requisition') }}
                                                </button>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group" id="showSavedData">

                                                </div>
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
                    '                                                    <input type="number" name="qty[]" min="0"  id="qty_' + x + '" class="form-control requisition-qty" step="any" required data-quantity="">\n' +
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
            var isBulkItem = '{{request()->has('bulk-requisition')?'yes':'no'}}';

            changeSelectedProductIds();

            var subcategory_id = $('#sub_category_id_' + incrementNumber).val();
            if (subcategory_id.length === 0) {
                subcategory_id = 0;
            }
            $('#qty_' + incrementNumber).val($('#qty_' + incrementNumber).attr('data-quantity'));

            $('#product_' + incrementNumber).html('<option value="">Please Wait...</option>').load(`{{URL::to(Request()->route()->getPrefix()."/requisitions/load-category-wise-product")}}/${subcategory_id}?selected=${$('#product_' + incrementNumber).attr('data-product-id')}&products_id=${selectedProductIds}&is_bulk_item=${isBulkItem}`);
        }

        function getUOM() {
            $.each($('.product'), function (index, val) {
                $(this).parent().parent().next().html($(this).find(':selected').attr('data-uom'));
            });
        }

        function getWorkOrderItems(element) {
            var workOrderId = $('#work_order_id').val();
            $('#work_order_item_id').html('<option value="">Please Wait...</option>').load('{{URL::to(Request()->route()->getPrefix()."/requisitions/load-wo-wise-product")}}/' + workOrderId);
        }

        function formInputValidation() {
            let activeSection = document.querySelector(".formInputValidation");
            let inputs = activeSection.querySelectorAll("input");
            let textareas = activeSection.querySelectorAll("textarea");

            let inputBoxAlert = []
            inputs.forEach(input => {
                if (input.getAttribute('data-input') === "recommended" && input.value === "") {
                    inputBoxAlert.push({
                        name: input.getAttribute('name')
                    })
                }
            })

            textareas.forEach(input => {
                if (input.getAttribute('data-input') === "recommended" && input.value === "") {
                    inputBoxAlert.push({
                        name: input.getAttribute('name')
                    })
                }
            })

            if (inputBoxAlert.length > 0) {
                inputBoxAlert.forEach(item => {
                    toastr.error(`${item.name.replaceAll("[]", "")} can't empty. Please fill that input field.`, 'Error!')
                });
                return false;
            }

            return true;
        }

        function submitRequisition(where_to_go) {
            $('#where_to_go').val(where_to_go);

            var error_count = 0;

            if ($('#reference_no').val() == "") {
                error_count++;
                toastr.error("Please Enter Reference No");
            }
            if ($('#requisition_no').val() == "") {
                error_count++;
                toastr.error("Please Enter Requisition No");
            }

            if ($('.subcategory').find(':selected').val() == "") {
                error_count++;
                toastr.error("Please Choose Category");
            }

            $.each($('.requisition-products'), function (index, val) {
                if ($(this).val() == "" || parseInt($(this).val()) <= 0) {
                    error_count++;
                    toastr.error("Please choose Product");
                }
            });

            $.each($('.requisition-qty'), function (index, val) {
                if ($(this).val() == "" || parseInt($(this).val()) < 0) {
                    error_count++;
                    toastr.error("Please write Product Quantity");
                }
            });

            if (error_count == 0) {
                if (where_to_go == 'back') {
                    let form = $('#ProductsForm');

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: new FormData(form[0]),
                    })
                        .done(function (response) {

                            toastr.success(response.message);
                            $('#reference_no').val(response.sku);
                            $('#showSavedData').html(response.appendData);
                        })
                        .fail(function (response) {
                            var errors = '<ul class="pl-3">';
                            $.each(response.responseJSON.errors, function (index, val) {
                                errors += '<li>' + val[0] + '</li>';
                            });
                            errors += '</ul>';
                            toastr.errors(errors);

                        });
                } else {
                    $('#ProductsForm').submit();
                }
            }
        }
    </script>
@endsection
