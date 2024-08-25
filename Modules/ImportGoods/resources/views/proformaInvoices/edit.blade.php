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
                                        {{--                                        <a class="btn btn-success mb-2 me-2 text-white" title="Upload Excel"--}}
                                        {{--                                           data-toggle="modal" data-target="#uploadExcel"><i class="las la-upload"></i>&nbsp;Upload--}}
                                        {{--                                            Excel--}}
                                        {{--                                        </a>--}}

                                        <a href="{{route('proforma-invoices.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Purchase"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Purchase Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::model($proformaInvoice, [
                                            'route' => ['proforma-invoices.update', $proformaInvoice->id],
                                            'method' => 'PUT',
                                            'class' => 'form-horizontal',
                                            'files' => true,
                                            ]) !!}

                                        <div class="row">
                                            {{--                                            <div class="col-md-2">--}}
                                            {{--                                                <div class="form-group">--}}
                                            {{--                                                    <div class="form-line">--}}
                                            {{--                                                        {!!  Form::label('pi_no', 'Reference No', ['class' => 'col-form-label']) !!}--}}
                                            {{--                                                        <span class="text-danger">*</span>--}}
                                            {{--                                                        {!! Form::text('pi_no', isset($sku)?$sku:request()->old('pi_no'), [--}}
                                            {{--                                                            'id' => 'pi_no',--}}
                                            {{--                                                            'class' => 'form-control',--}}
                                            {{--                                                            'placeholder' => 'Enter Reference No'--}}
                                            {{--                                                        ]) !!}--}}
                                            {{--                                                        {!! $errors->first('pi_no') !!}--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                            <input type="hidden" name="pi_no"
                                                   value="{{isset($proformaInvoice)?$proformaInvoice->pi_no:request()->old('pi_no')}}">

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('pi_date', 'Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('pi_date', Request::old('pi_date'), [
                                                            'id' => 'pi_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter date'
                                                        ]) !!}
                                                        {!! $errors->first('pi_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('mode_of_purchase', 'Mode Of Purchase', array('class' => 'col-form-label')) !!}
                                                        {!! Form::Select('mode_of_purchase',array('import'=>'Import','native'=>'Native'),Request::old('mode_of_purchase'),['id'=>'mode_of_purchase', 'class'=>'form-control select2','onchange'=> 'showHideLcInvoice()']) !!}
                                                        {!! $errors->first('mode_of_purchase') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 lc-no-section">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('lc_no', 'LC No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>

                                                        {!! Form::text('lc_no', request()->old('lc_no'), [
                                                            'id' => 'lc_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter LC Reference No'
                                                        ]) !!}
                                                        {!! $errors->first('lc_no') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 invoice-no-section" style="display: none">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('invoice_no', 'Local Invoice No', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>

                                                        {!! Form::text('invoice_no', request()->old('invoice_no'), [
                                                            'id' => 'invoice_no',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Local Invoice No'
                                                        ]) !!}
                                                        {!! $errors->first('invoice_no') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('lc_date', 'Purchase Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('lc_date', Request::old('lc_date'), [
                                                            'id' => 'lc_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter lc_date'
                                                        ]) !!}
                                                        {!! $errors->first('lc_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 style-scroll mt-2">

                                                <table class="table table-striped table-bordered miw-500 dac_table"
                                                       cellspacing="0"
                                                       width="100%" id="dataTable">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th width="15%">Product Category</th>
                                                        <th width="18%">Product Detail</th>
                                                        <th width="5%">UOM</th>
                                                        <th width="12%">Qty</th>
                                                        <th width="15%">Price</th>
                                                        <th width="15%">Total</th>
                                                        <th width="10%">Currency</th>
                                                        <th width="15%">C.Rate <p>(1 USD =?)</p></th>
                                                        <th width="5%" class="text-center">#</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="field_wrapper">
                                                    @php
                                                        $oldProductIds=[];
                                                    @endphp
                                                    @foreach($proformaInvoice->proformaItemsItems as $key=>$item)
                                                        <tr>
                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <select name="sub_category_id[]"
                                                                            id="sub_category_id_{{$key+1}}"
                                                                            style="width: 100%"
                                                                            class="form-control subcategory select2"
                                                                            onchange="getProduct($(this))">

                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td class="product-td">
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <select name="product_id[]" id="product_{{$key+1}}"
                                                                            class="form-control product requisition-products select2"
                                                                            onchange="getUOM()"
                                                                            data-selected-product="{{ $item->product_id }}"
                                                                            data-selected-sub-category="{{ $item->product->category_id }}"
                                                                            required>
                                                                        <option value="{{ null }}"
                                                                                data-uom="">{{ __('Select Product') }}</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td class="product-uom text-center">{{isset($item->product->productUnit->unit_name)?$item->product->productUnit->unit_name:''}}</td>
                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <input type="number" name="qty[]" min="0"
                                                                           id="qty_{{$key+1}}"
                                                                           class="form-control requisition-qty"
                                                                           step="any"
                                                                           required data-input="recommended"

                                                                           data-quantity="{{$item->qty}}"
                                                                           value="{{$item->qty}}"
                                                                           data-id='{{$key+1}}'
                                                                           onchange="calculateUnitPrice($(this))"
                                                                           onkeyup="calculateUnitPrice($(this))"
                                                                    >
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <input type="text" name="unit_price[]"
                                                                           id="unit_price_{{$key+1}}"
                                                                           class="form-control mask-money"
                                                                           required data-input="recommended"
                                                                           data-unit-price=""
                                                                           value="{{$item->unit_price}}"
                                                                           data-id='{{$key+1}}'
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
                                                                           required
                                                                           step="any"
                                                                           readonly
                                                                           value="{{$item->total_price}}"
                                                                    >
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <select class="form-control select2 currency"
                                                                            id="currency_id_1"
                                                                            onchange="getCurrencyDefault()"
                                                                            name="currency_id[]">
                                                                        @foreach($currenciesModel as $data)
                                                                            <option
                                                                                data-default="{{$data->is_default}}"
                                                                                value="{{$data->id}}" {{$data->id==$item->currency_id?'selected':''}}>{{$data->short_code}}
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
                                                                           required
                                                                           value="{{$item->currency_convert_rate}}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0);" id="remove_{{$key+1}}"
                                                                   class="remove_button btn btn-sm btn-danger"
                                                                   title="Remove"
                                                                   style="color:#fff;">
                                                                    <i class="mdi mdi-trash-can"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                                <a href="javascript:void(0);"
                                                   class="add_button btn btn-sm btn-success pull-right"
                                                   style="margin-right:17px;" title="Add More Product">
                                                    <i class="mdi mdi-plus"></i>
                                                </a>
                                            </div>

                                            <input type="hidden" name="status" value="approved">

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('supplier_id', 'Suppliers', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::Select('supplier_id',$suppliers,Request::old('supplier_id'),['id'=>'supplier_id', 'class'=>'form-control select2']) !!}
                                                        {!! $errors->first('supplier_id') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('payment_term_id', 'Payment Terms', array('class' => 'col-form-label')) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::Select('payment_term_id',$paymentTerms,Request::old('payment_term_id'),['id'=>'payment_term_id', 'class'=>'form-control select2']) !!}
                                                        {!! $errors->first('payment_term_id') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('pi_file', 'Reference File', array('class' => 'col-form-label')) !!}
                                                        <br>
                                                        <input type="file" name="pi_file"
                                                               id="pi_file" class="btn btn-outline-success btn-sm">

                                                        {!! $errors->first('pi_file') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('instructions_file', 'Instructions File', array('class' => 'col-form-label')) !!}
                                                        <br>
                                                        <input type="file" name="instructions_file"
                                                               id="instructions_file"
                                                               class="btn btn-outline-info btn-sm">

                                                        {!! $errors->first('instructions_file') !!}
                                                    </div>
                                                </div>
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
                                                {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right font-10 m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
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

        var selectedProductIds = ["{{ implode(",",$oldProductIds) }}"];

        function changeSelectedProductIds() {
            selectedProductIds = [];
            $('.product').each(function () {
                selectedProductIds.push($(this).val());
            })
        }

        $(document).ready(function () {

            var form = $('#addRequisitionForm');

            var maxField = 200;
            var addButton = $('.add_button');
            var x = parseInt("{{ $proformaInvoice->proformaItemsItems->count()+1 }}");
            var wrapper = $('.field_wrapper');

            getSubCategories();
            var currencies = '';
            $.each(<?php echo json_encode($currenciesModel); ?>, function (key, value) {
                currencies += '<option data-default="' + (value.is_default) + '" value="' + (value.id) + '">' + value.short_code + ' (' + (value.symbol) + ')</option>';
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
                    '                                                    <select name="product_id[]" onchange="getUOM()" id="product_' + x + '" class="form-control select2 product requisition-products" data-product-id="" required>\n' +
                    '                                                        <option value="{{ null }}">{{ __("Select Product") }}</option>\n' +
                    '                                                    </select>\n' +
                    '                                                </div>\n' +
                    '\n' +
                    '                                            </td>\n' +
                    '<td class="product-uom text-center"></td>' +
                    '                                            <td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="number" name="qty[]" step="any" id="qty_' + x + '" class="form-control requisition-qty"  onchange="calculateUnitPrice($(this))" data-id="' + x + '" onkeyup="calculateUnitPrice($(this))" required data-quantity="">\n' +
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
                    '                                                    <input type="number" name="sub_total_price[]" id="total_price_' + x + '" class="form-control  mask-money total_price_' + x + '" step="any" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required data-quantity="">\n' +
                    '                                                </div>\n' +
                    '                                            </td>\n'
                    + '                                                <td><div class="input-group input-group-md mb-3 d-">'
                    +
                    '                                                    <select name="currency_id[]" id="currency_id_' + x + '" data-increment="' + x + '" onchange="getCurrencyDefault()" class="form-control select2 currency" required>' + (currencies) + '</select>\n' +
                    '</div>\n' +
                    '                                            </td>\n' +
                    '\n' +
                    '                                            <td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="text" name="currency_convert_rate[]" id="currency_convert_rate_' + x + '" step="any" class="form-control mask-money" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required data-quantity="">\n' +
                    '                                                </div>\n' +
                    '                                            </td>\n' +
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
        }

        function generateSubCategories(element) {
            var category = $('#category_id').find(':selected');
            var categories = <?php echo json_encode($categories); ?>;
            var value = element.val();

            var subCategories = '<option value="0">Select Subcategory</option>';
            $.each(categories, function (index, val) {
                subCategories += '<option value="' + (val.id) + '" ' + (val.id == value ? 'selected' : '') + '>' + val.name + '</option>';
            });

            element.html(subCategories).change();
        }


        $(document).ready(function () {
            var wrapper = $('.field_wrapper');
            $(wrapper).on('change', '.product', function (e) {
                changeSelectedProductIds();
                var incrementNumber = $(this).attr('id').split("_")[1];
                $(this).parent().parent().parent().find('.subcategory').val(parseInt($(this).find(':selected').attr('data-sub-category-id'))).select2();
            });
        });


        function getProduct(element) {

            changeSelectedProductIds();

            var incrementNumber = element.attr('id').split("_")[3];
            var subcategory_id = $('#sub_category_id_' + incrementNumber).val();
            var selected_category = $('#product_' + incrementNumber).attr('data-selected-sub-category');
            var selected_product = $('#product_' + incrementNumber).attr('data-selected-product');

            if (subcategory_id.length === 0) {
                subcategory_id = 0;
            }
            $('#qty_' + incrementNumber).val($('#qty_' + incrementNumber).attr('data-quantity'));

            $.ajax({
                url: '{{URL::to(Request()->route()->getPrefix()."/proforma-invoices/load-category-wise-product")}}/' + subcategory_id + '?selected=' + selected_product + '&products_id=' + selectedProductIds,
                type: 'GET',
                data: {},
            })
                .done(function (response) {
                    $('#product_' + incrementNumber).html(response).change();
                });
        }

        getUOM();

        function getUOM() {
            $.each($('.product'), function (index, val) {
                $(this).parent().parent().next().html($(this).find(':selected').attr('data-uom'));
            });
        }


        function getCurrencyDefault() {
            // $.each($('.currency'), function (index, val) {
            //     $(this).parent().parent().next().find('input').val($(this).find(':selected').attr('data-default'));
            // });
        }

        showHideLcInvoice();

        function showHideLcInvoice() {
            if ($('#mode_of_purchase').val() === 'native') {
                $('.lc-no-section').hide();
                document.getElementById('lc_no').value = null;
                document.getElementById('lc_no').required = false;

                $('.invoice-no-section').show();
                document.getElementById('invoice_no').required = true;

            } else {
                $('.lc-no-section').show();
                document.getElementById('lc_no').required = true;

                $('.invoice-no-section').hide();
                document.getElementById('invoice_no').value = null;

                document.getElementById('invoice_no').required = false;
            }
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
