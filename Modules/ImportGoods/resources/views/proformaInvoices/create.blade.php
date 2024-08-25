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
                                        {{--                                           data-toggle="modal" data-target="#uploadExcel"><i class="mdi mdi-upload"></i>&nbsp;Upload--}}
                                        {{--                                            Excel--}}
                                        {{--                                        </a>--}}

                                        <a href="{{route('proforma-invoices.index')}}" class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Purchase List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Purchase Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(array('route' => 'proforma-invoices.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}

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
                                                   value="{{isset($sku)?$sku:request()->old('pi_no')}}">


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {!!  Form::label('pi_date', 'Date', ['class' => 'col-form-label']) !!}
                                                        <span class="text-danger">*</span>
                                                        {!! Form::date('pi_date', date('Y-m-d'), [
                                                            'id' => 'pi_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter PI Date'
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
                                                        {!! Form::date('lc_date', date('Y-m-d'), [
                                                            'id' => 'lc_date',
                                                            'class' => 'form-control',
                                                            'placeholder' => 'Enter Purchase Date'
                                                        ]) !!}
                                                        {!! $errors->first('lc_date') !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 style-scroll mt-3">
                                                <table class="table table-striped table-bordered"
                                                       width="100%">
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
                                                        <td class="product-uom text-center">

                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <input type="number"
                                                                       name="qty[]"
                                                                       min="1"
                                                                       id="qty_1"
                                                                       class="form-control requisition-qty"
                                                                       aria-label="Large"
                                                                       aria-describedby="inputGroup-sizing-sm"
                                                                       required data-input="recommended"
                                                                       oninput="this.value = Math.abs(this.value)"
                                                                       data-quantity=""
                                                                       data-id='1'
                                                                       onchange="calculateUnitPrice($(this))"
                                                                       onkeyup="calculateUnitPrice($(this))"
                                                                >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-md mb-3 d-">
                                                                <input type="number" name="unit_price[]"
                                                                       id="unit_price_1"
                                                                       class="form-control mask-money calculateUnitPrice"
                                                                       required data-input="recommended"
                                                                       data-unit-price=""
                                                                       step="any"
                                                                       data-id='1'
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
                                                                        id="currency_id_1" name="currency_id[]"
                                                                        onchange="getCurrencyDefault()">
                                                                    @foreach($currenciesModel as $data)
                                                                        <option
                                                                            value="{{$data->id}}"
                                                                            data-default="{{$data->is_default}}">{{$data->short_code}}
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
                                                                       class="form-control mask-money cRate"
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
                currencies += '<option data-default="' + (value.is_default) + '"  value="' + (value.id) + '">' + value.short_code + ' (' + (value.symbol) + ')</option>';
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
                    '                                                    <input type="number" name="qty[]" min="1"  id="qty_' + x + '" class="form-control requisition-qty" aria-label="Large" aria-describedby="inputGroup-sizing-sm" oninput="this.value = Math.abs(this.value)" onchange="calculateUnitPrice($(this))" data-id="' + x + '" onkeyup="calculateUnitPrice($(this))" required data-quantity="">\n' +
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
                    '                                                    <input type="number" name="sub_total_price[]" id="total_price_' + x + '" class="form-control mask-money total_price_' + x + '" aria-label="Large" aria-describedby="inputGroup-sizing-sm" step="any" readonly required data-quantity="">\n' +
                    '                                                </div>\n' +
                    '                                            </td>\n'
                    + '                                                <td><div class="input-group input-group-md mb-3 d-">'
                    +
                    '                                          <select name="currency_id[]" id="currency_id_' + x + '" data-increment="' + x + '" onchange="getCurrencyDefault()" class="form-control select2 currency" required>' + (currencies) + '</select>\n' +
                    '</div>\n' +
                    '                                            </td>\n' +
                    '\n' +
                    '                                            <td>\n' +
                    '                                                <div class="input-group input-group-md mb-3 d-">\n' +
                    '                                                    <input type="number" name="currency_convert_rate[]" id="currency_convert_rate_' + x + '" class="form-control mask-money" aria-label="Large" aria-describedby="inputGroup-sizing-sm" step="any" required data-quantity="">' +
                    '\n' +
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
                //         thousands: '', decimal: '.', allowZero: false, allowEmpty: true
                //     });

                // $('#unit_price_' + x, wrapper).on('change', function (e) {
                //     var productQty = parseFloat($('#qty_' + x, wrapper).val());
                //     var productUnitPrice = parseFloat($('#unit_price_' + x, wrapper).val());
                //
                //     if (productQty !== null && productUnitPrice !== null) {
                //         $('.total_price_' + x, wrapper).val(parseFloat(productQty * productUnitPrice))
                //     }
                // })

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

            var subCategories = '<option value="">Select One</option>';
            $.each(categories, function (index, val) {
                subCategories += '<option value="' + (val.id) + '">' + val.name + '</option>';
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

            $('#product_' + incrementNumber).html('<option value="">Please Wait...</option>').load('{{URL::to(Request()->route()->getPrefix()."/proforma-invoices/load-category-wise-product")}}/' + subcategory_id + '?selected=' + ($('#product_' + incrementNumber).attr('data-product-id')) + '&products_id=' + selectedProductIds);
        }

        function getUOM() {
            $.each($('.product'), function (index, val) {
                $(this).parent().parent().next().html($(this).find(':selected').attr('data-uom'));
                //$(this).parent().parent().next().next().next().find('input').val($(this).find(':selected').attr('data-unit-price'));
            });
        }

        getCurrencyDefault()

        function getCurrencyDefault() {
            $.each($('.currency'), function (index, val) {
                $(this).parent().parent().next().find('input').val($(this).find(':selected').attr('data-default'));
            });
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
