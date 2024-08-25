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
                                        <a href="{{route('work-orders.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Work Orders List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Work Orders Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'work-orders.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('reference_no', 'Pre Cost Reference No', ['class' => 'col-form-label']) !!}
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
                                                        {!!  Form::label('work_order_no', 'Work Order No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::text('work_order_no', request()->old('work_order_no'), [
                                                            'id' => 'work_order_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Work Order No'
                                                        ]) !!}
                                                        {!! $errors->first('work_order_no') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            {{--                                            <div class="col-md-3">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('export_lc_no', 'Export LC No', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        <span class="text-danger">*</span>--}}
                                            {{--                                                        {!! Form::text('export_lc_no', request()->old('export_lc_no'), [--}}
                                            {{--                                                            'id' => 'export_lc_no',--}}
                                            {{--                                                            'class' => 'form-control',--}}
                                            {{--                                                            'placeholder' => 'Enter export LC No'--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('export_lc_no') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('wo_open_date', 'WO Issue Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('wo_open_date', \request()->old('wo_open_date'), [
                                                            'id' => 'wo_open_date',
                                                            'required' => true,
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Work Order Date'
                                                        ]) !!}
                                                        {!! $errors->first('wo_open_date') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('delivery_date', 'Estimated Delivery Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('delivery_date', \request()->old('delivery_date'), [
                                                            'id' => 'delivery_date',
                                                            'required' => true,
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Delivery Date'
                                                        ]) !!}
                                                        {!! $errors->first('delivery_date') !!}
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('customer_id', 'Customer', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::Select('customer_id',$customers,Request::old('customer_id'),['id'=>'customer_id', 'class'=>'form-control select2']) !!}
                                                        {!! $errors->first('customer_id') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('garments_name', 'Buyer Name', ['class' => 'col-form-label']) !!}

                                                        {!! Form::text('garments_name', request()->old('garments_name'), [
                                                            'id' => 'garments_name',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Buyer Name'
                                                        ]) !!}
                                                        {!! $errors->first('garments_name') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('account_holder', 'Account Holder Name', ['class' => 'col-form-label']) !!}
                                                        {!! Form::text('account_holder', request()->old('account_holder'), [
                                                            'id' => 'account_holder',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Account Holder Name'
                                                        ]) !!}
                                                        {!! $errors->first('account_holder') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('process_id', 'Production Process', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::Select('process_id',$productProcess,Request::old('process_id'),['id'=>'process_id', 'class'=>'form-control select2','required'=>true]) !!}
                                                        {!! $errors->first('process_id') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('lab_dep_approval', 'Lab Dep Approval', ['class' => 'col-form-label']) !!}

                                                        {!! Form::text('lab_dep_approval', request()->old('lab_dep_approval'), [
                                                            'id' => 'lab_dep_approval',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Lab Dep Approval'
                                                        ]) !!}
                                                        {!! $errors->first('lab_dep_approval') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('shrinkage', 'Shrinkage', ['class' => 'col-form-label']) !!}

                                                        {!! Form::text('shrinkage', request()->old('shrinkage'), [
                                                            'id' => 'shrinkage',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Shrinkage'
                                                        ]) !!}
                                                        {!! $errors->first('shrinkage') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('hand_feel', 'Hand Feel', array('class' => 'col-form-label')) !!}

                                                        {!! Form::Select('hand_feel',handFeels(),Request::old('hand_feel'),['id'=>'hand_feel', 'class'=>'form-control select2']) !!}
                                                        {!! $errors->first('hand_feel') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('finish_type', 'Finish Type', array('class' => 'col-form-label')) !!}

                                                        {!! Form::Select('finish_type',finishTypes(),Request::old('finish_type'),['id'=>'finish_type', 'class'=>'form-control select2']) !!}
                                                        {!! $errors->first('finish_type') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('fabric_composition', 'Fabric Composition', ['class' => 'col-form-label']) !!}

                                                        {!! Form::text('fabric_composition', request()->old('fabric_composition'), [
                                                            'id' => 'fabric_composition',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Fabric Composition'
                                                        ]) !!}
                                                        {!! $errors->first('fabric_composition') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('wo_file', 'Work Order File', array('class' => 'col-form-label')) !!}
                                                        <br>
                                                        <input type="file" name="wo_file"
                                                               id="wo_file" class="form-control">

                                                        {!! $errors->first('wo_file') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4 mb-2">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th width="10%">Product Category</th>
                                                        <th width="20%">Product Detail</th>
                                                        <th width="5%">UOM</th>
                                                        <th width="15%">Qty</th>
                                                        <th width="15%">Unit Price</th>
                                                        <th width="15%">Total</th>
                                                        <th width="10%">Currency</th>
                                                        <th width="15%">C.Rate <p>(1USD=?)</p></th>
                                                        <th width="5%" class="text-center">#</th>
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
                                                                        onchange="getUOM()" data-product-id=""
                                                                        required>
                                                                    <option value="{{ null }}"
                                                                            data-uom="">{{ __('Select Product') }}</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="product-uom text-center"></td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <input type="number" name="qty[]" min="0"
                                                                       id="qty_1"
                                                                       class="form-control requisition-qty"
                                                                       step="any"

                                                                       data-quantity=""
                                                                       data-id='1'
                                                                       onchange="calculateUnitPrice($(this))"
                                                                       onkeyup="calculateUnitPrice($(this))"
                                                                >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <input type="text" name="unit_price[]"
                                                                       id="unit_price_1"
                                                                       class="form-control mask-money"
                                                                       required data-input="recommended"
                                                                       data-unit-price=""
                                                                       data-id='1'
                                                                       step="any"
                                                                       onchange="calculateUnitPrice($(this))"
                                                                       onkeyup="calculateUnitPrice($(this))"
                                                                >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <input type="number" name="sub_total_price[]"
                                                                       id="total_price_1"
                                                                       class="form-control mask-money total_price_1"
                                                                       required data-input="recommended"
                                                                       data-unit-price=""
                                                                       step="any"
                                                                       readonly
                                                                >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <select class="form-control select2 currency"
                                                                        id="currency_id_1" name="currency_id[]">
                                                                    @foreach($currenciesModel as $data)
                                                                        <option
                                                                            value="{{$data->id}}">{{$data->short_code}}
                                                                            ({{$data->symbol}})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <input type="number" name="currency_convert_rate[]"
                                                                       id="currency_convert_rate_1"
                                                                       step="any"
                                                                       class="form-control mask-money"
                                                                       required>
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
                                                        {!!  Form::label('terms_condition', 'Terms & Conditions', ['class' => 'col-form-label']) !!}
                                                        {!! Form::textarea('terms_condition', request()->old('terms_condition'), [
                                                            'id' => 'terms_condition',
                                                            'class' => 'form-control',
                                                            'rows'=>'5',
                                                            'placeholder' => 'Enter Terms & condition'
                                                        ]) !!}
                                                        {!! $errors->first('terms_condition') !!}
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

            var currencies = '';
            $.each(<?php echo json_encode($currenciesModel); ?>, function (key, value) {
                currencies += '<option value="' + (value.id) + '">' + value.short_code + ' (' + (value.symbol) + ')</option>';
            });

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
                    '                                                    <select name="product_id[]" onchange="getUOM()" id="product_' + x + '" data-increment="' + x + '" class="form-control select2 product requisition-products" data-product-id="" required>\n' +
                    '                                                        <option value="{{ null }}">{{ __("Select Product") }}</option>\n' +
                    '                                                    </select>\n' +
                    '                                                </div>\n' +
                    '\n' +
                    '                                            </td>\n' +
                    '<td class="product-uom text-center"></td>' +
                    '                                            <td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="number" name="qty[]" min="0"  id="qty_' + x + '" class="form-control requisition-qty" step="any" onchange="calculateUnitPrice($(this))" data-id="' + x + '" onkeyup="calculateUnitPrice($(this))" required data-quantity="">\n' +
                    '                                                </div>\n' +
                    '                                            </td>\n'
                    +
                    '                                            <td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="number" name="unit_price[]" id="unit_price_' + x + '" class="form-control mask-money" step="any" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required data-quantity="" onchange="calculateUnitPrice($(this))" data-id="' + x + '" onkeyup="calculateUnitPrice($(this))"  >\n' +
                    '                                                </div>\n' +
                    '                                            </td>\n'
                    + '<td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="number" name="sub_total_price[]" id="total_price_' + x + '" class="form-control mask-money total_price_' + x + '" step="any" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required data-quantity="">\n' +
                    '                                                </div>\n' +
                    '                                            </td>' +
                    '                                                <td><div class="input-group input-group-md mb-3 d-">'
                    +
                    '                                                    <select name="currency_id[]" id="currency_id_' + x + '" data-increment="' + x + '" class="form-control select2 currency" required>' + (currencies) + '</select>\n' +
                    '</div>\n' +
                    '                                            </td>\n' +
                    '\n' +
                    '                                            <td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="number" name="currency_convert_rate[]" id="currency_convert_rate_' + x + '" step="any" class="form-control mask-money" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required data-quantity="">\n' +
                    '                                                </div>\n' +
                    '                                            </td>\n' +
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
                $('#currency_id_' + x, wrapper).select2();
                generateSubCategories($('#sub_category_id_' + x, wrapper))
                // $('.mask-money').maskMoney(
                //     {
                //         thousands: '', decimal: '.', allowZero: true, allowEmpty: true
                //     });

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

            $.each($('.currency'), function (index, val) {
                // generateCurrency($(this))
            });
        }

        function generateCurrency(element) {
            var currencies = <?php echo json_encode($currenciesModel); ?>;
            console.log(currencies);
            var item = '';
            $.each(currencies, function (key, value) {
                item += '<option value="' + (value.id) + '">' + value.short_code + ' (' + (value.symbol) + ')</option>';
            });

            console.log(item);

            element.html(item).change();
        }

        function generateSubCategories(element) {
            var category = $('#category_id').find(':selected');
            var categories = <?php echo json_encode($categories); ?>;


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

            $('#product_' + incrementNumber).html('<option value="">Please Wait...</option>').load('{{URL::to(Request()->route()->getPrefix()."/work-orders/load-category-wise-product")}}/' + subcategory_id + '?selected=' + ($('#product_' + incrementNumber).attr('data-product-id')) + '&products_id=' + selectedProductIds);
        }

        function getUOM() {
            $.each($('.product'), function (index, val) {
                $(this).parent().parent().next().html($(this).find(':selected').attr('data-uom'));
                $(this).parent().parent().next().next().next().find('input').val($(this).find(':selected').attr('data-unit-price'));
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

        function calculateUnitPrice(element) {

            var incrementNumber = element.attr('data-id');

            var productQty = parseFloat($('#qty_' + incrementNumber).val()) !== null ? parseFloat($('#qty_' + incrementNumber).val()) : 0;
            var productUnitPrice = parseFloat($('#unit_price_' + incrementNumber).val()) !== null ? parseFloat($('#unit_price_' + incrementNumber).val()) : 0;

            if (productQty !== null && productUnitPrice !== null) {
                $('#total_price_' + incrementNumber).val(parseFloat(productQty * productUnitPrice))
            }
        }
    </script>
@endsection
