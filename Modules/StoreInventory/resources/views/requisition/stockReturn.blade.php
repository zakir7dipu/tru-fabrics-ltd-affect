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
                                        <a href="{{route('requisition-list.delivered.list',$model->requisition->id)}}"
                                           class="btn btn-info mb-2 me-2"
                                           data-toggle="tooltip" title="Requisition Delivered List"> <i class="mdi mdi-text
                                           me-1"></i>{{translate('Back To Lists')}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-styled mb0">
                                                    @if(isset($model->requisition->workOrderItem))
                                                        <li><strong>{{__('Work Order No')}}
                                                                : </strong> {{isset($model->requisition->workOrderItem->workOrder->work_order_no)?$model->requisition->workOrderItem->workOrder->work_order_no:''}}
                                                        </li>
                                                    @endif
                                                    <li><strong>{{__('Requisition No')}}
                                                            : </strong> {{isset($model->requisition->requisition_no)?$model->requisition->requisition_no:''}}
                                                    </li>
                                                    <li><strong>{{__('Received By')}}
                                                            : </strong>{{isset($model->received_by)?$model->received_by:''}}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-styled mb0 pull-right">
                                                    <li><strong>{{__('Delivery Date')}}
                                                            : </strong>{{date('d M Y',strtotime($model->delivery_date))}}
                                                    </li>
                                                    <li><strong>{{__('Delivered By')}}
                                                            : </strong>{{isset($model->deliverdBy->name)?$model->deliverdBy->name:''}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        {!! Form::open(array('route' => 'stock.return.store','method'=>'POST',
                                        'class'=>'','files'=>true,'id'=>'ProductsForm')) !!}
                                        <div class="col-md-12 table-responsive style-scroll mt-4 mb-2">

                                            <table class="table table-striped table-bordered miw-500 dac_table"
                                                   cellspacing="0"
                                                   width="100%" id="dataTable">
                                                <thead>
                                                <tr class="text-center">
                                                    <th width="15%">Product Category</th>
                                                    <th width="35%">Product Detail</th>
                                                    <th width="10%">UOM</th>
                                                    <th width="10%">Raw Material Request Qty</th>
                                                    <th width="10%">Raw Material Issued Qty</th>
                                                    <th width="10%">Return Qty</th>
                                                </tr>
                                                </thead>
                                                <tbody class="field_wrapper">
                                                @if($model->requisitionDeliveryItems)
                                                    @foreach($model->requisitionDeliveryItems as $key=>$item)
                                                        <tr>
                                                            <td>{{isset($item->requisitionItem->product->category->name)?$item->requisitionItem->product->category->name:''}}</td>
                                                            <td>{{isset($item->requisitionItem->product->name)?$item->requisitionItem->product->name:''}}
                                                                ( {{isset($item->requisitionItem->product->sku)?$item->requisitionItem->product->id:''}}
                                                                ) {{ getProductAttributesFaster($item->requisitionItem->product) }}</td>
                                                            <td>{{ isset($item->requisitionItem->product->productUnit->unit_name)?$item->requisitionItem->product->productUnit->unit_name:'' }}</td>
                                                            <td class="text-center">{{$item->requisitionItem->qty}}</td>
                                                            <td class="text-center">{{$item->issued_qty}}</td>
                                                            <td>
                                                                <div class="input-group input-group-md mb-3 d-">
                                                                    <input type="number" name="qty[{{$item->id}}]"
                                                                           min="0"
                                                                           id="qty_1"
                                                                           max="{{$item->issued_qty}}"
                                                                           step="any"
                                                                           class="form-control requisition-qty mask-money"
                                                                           data-input="recommended"
                                                                           onchange="checkDeliveryQuantity($(this))"
                                                                           onkeyup="checkDeliveryQuantity($(this))">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right m-t-15','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
                                        </div>
                                        {!! Form::close() !!}

                                        <div class=" col-md-12 mt-5 table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Category</th>
                                                    <th>Product</th>
                                                    <th>UOM</th>
                                                    <th>Raw Material Request Qty</th>
                                                    <th>Raw Material Issued Qty</th>
                                                    <th>Raw Material Return Qty</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($floorReturns as $key=>$item)
                                                    <tr>
                                                        <td class="text-center">{{$key+1}}</td>
                                                        <td>{{isset($item->requisitionDeliveryItem->requisitionItem->product->category->name)?$item->requisitionDeliveryItem->requisitionItem->product->category->name:''}}</td>
                                                        <td>{{isset($item->requisitionDeliveryItem->requisitionItem->product->name)?$item->requisitionDeliveryItem->requisitionItem->product->name:''}}
                                                            ( {{isset($item->requisitionDeliveryItem->requisitionItem->product->sku)?$item->requisitionDeliveryItem->requisitionItem->product->id:''}}
                                                            ) {{ getProductAttributesFaster($item->requisitionDeliveryItem->requisitionItem->product) }}</td>
                                                        <td>{{ isset($item->requisitionDeliveryItem->requisitionItem->product->productUnit->unit_name)?$item->requisitionDeliveryItem->requisitionItem->product->productUnit->unit_name:'' }}</td>
                                                        <td class="text-center">{{$item->requisitionDeliveryItem->requisitionItem->qty}}</td>
                                                        <td class="text-center">{{$item->requisitionDeliveryItem->issued_qty+$item->return_qty}}</td>
                                                        <td class="text-center">{{$item->return_qty}}</td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
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
                {{--"use strict";--}}
                {{--var selectedProductIds = [];--}}

                {{--function changeSelectedProductIds() {--}}
                {{--    selectedProductIds = [];--}}
                {{--    $('.product').each(function () { //--}}
                {{--        selectedProductIds.push($(this).val());--}}
                {{--    })--}}
                {{--}--}}

                {{--$(document).ready(function () {--}}

                {{--    var form = $('#addRequisitionForm');--}}

                {{--    var maxField = 200;--}}
                {{--    var addButton = $('.add_button');--}}
                {{--    var x = 1;--}}
                {{--    var wrapper = $('.field_wrapper');--}}

                {{--    getSubCategories();--}}

                {{--    $(addButton).click(function () {--}}

                {{--        x++;--}}

                {{--        var fieldHTML = '<tr>\n' +--}}
                {{--            '                                            <td>\n' +--}}
                {{--            '\n' +--}}
                {{--            '                                                <div class="input-group input-group-md mb-3 d-">\n' +--}}
                {{--            '                                                    <select name="sub_category_id[]" style="width: 100%" id="sub_category_id_' + x + '" class="form-control select2 subcategory" onchange="getProduct($(this))" required></select>\n' +--}}
                {{--            '                                                </div>\n' +--}}
                {{--            '\n' +--}}
                {{--            '                                            </td>\n' +--}}

                {{--            '                                            <td class="product-td">\n' +--}}
                {{--            '\n' +--}}
                {{--            '                                                <div class="input-group input-group-md mb-3 d-">\n' +--}}
                {{--            '                                                    <select name="product_id[]" onchange="getUOM($(this))" id="product_' + x + '" class="form-control select2 product requisition-products" data-product-id="" required>\n' +--}}
                {{--            '                                                        <option value="{{ null }}">{{ __("Select Product") }}</option>\n' +--}}
                {{--            '                                                    </select>\n' +--}}
                {{--            '                                                </div>\n' +--}}
                {{--            '\n' +--}}
                {{--            '                                            </td>\n' +--}}
                {{--            '<td class="product-uom text-center"></td>' +--}}
                {{--            '<td class="request-qty text-center"></td>' +--}}
                {{--            '<td class="issuing-qty text-center"></td>' +--}}
                {{--            '                                            <td>\n' +--}}
                {{--            '                                                <div class="input-group input-group-md mb-3 d-">\n' +--}}
                {{--            '                                                    <input type="number" name="qty[]" min="0" max="0"  id="qty_' + x + '" class="form-control requisition-qty mask-money" step="any" required data-quantity="" onchange="checkDeliveryQuantity($(this))" onkeyup="checkDeliveryQuantity($(this))">\n' +--}}
                {{--            '                                                </div>\n' +--}}
                {{--            '                                            </td>\n'--}}
                {{--            +--}}
                {{--            '\n' +--}}
                {{--            '                                            <td>\n' +--}}
                {{--            '                                                <a href="javascript:void(0);" id="remove_' + x + '" class="remove_button btn btn-sm btn-danger" title="Remove" style="color:#fff;">\n' +--}}
                {{--            '                                                    <i class="mdi mdi-trash-can"></i>\n' +--}}
                {{--            '                                                    \n' +--}}
                {{--            '                                                </a>\n' +--}}
                {{--            '                                            </td>\n' +--}}
                {{--            '\n' +--}}
                {{--            '                                        </tr>';--}}

                {{--        $(wrapper).append(fieldHTML);--}}
                {{--        $('#sub_category_id_' + x, wrapper).select2();--}}
                {{--        $('#product_' + x, wrapper).select2();--}}
                {{--        generateSubCategories($('#sub_category_id_' + x, wrapper))--}}
                {{--        // $('.mask-money').maskMoney(--}}
                {{--        //     {--}}
                {{--        //         thousands: '', decimal: '.', allowZero: true, allowEmpty: true--}}
                {{--        //     });--}}

                {{--    });--}}

                {{--    $(wrapper).on('click', '.remove_button', function (e) {--}}
                {{--        e.preventDefault();--}}
                {{--        if (x > 1) {--}}
                {{--            x--;--}}

                {{--            var incrementNumber = $(this).attr('id').split("_")[1];--}}
                {{--            var productVal = $('#product_' + incrementNumber).val()--}}

                {{--            const index = selectedProductIds.indexOf(productVal);--}}
                {{--            if (index > -1) {--}}
                {{--                selectedProductIds.splice(index, 1);--}}
                {{--            }--}}
                {{--            $(this).parent('td').parent('tr').remove();--}}
                {{--        }--}}
                {{--    });--}}

                {{--});--}}

                {{--$(document).ready(function () {--}}
                {{--    $.each($('.subcategory'), function (index, val) {--}}
                {{--        getProduct($(this));--}}
                {{--    });--}}

                {{--    var wrapper = $('.field_wrapper');--}}
                {{--    $(wrapper).on('change', '.product', function (e) {--}}
                {{--        changeSelectedProductIds();--}}
                {{--        var incrementNumber = $(this).attr('id').split("_")[1];--}}
                {{--        $(this).parent().parent().parent().find('.subcategory').val(parseInt($(this).find(':selected').attr('data-sub-category-id'))).select2();--}}
                {{--    });--}}

                {{--});--}}

                {{--function getSubCategories() {--}}
                {{--    $.each($('.subcategory'), function (index, val) {--}}
                {{--        generateSubCategories($(this));--}}
                {{--    });--}}
                {{--}--}}

                {{--function generateSubCategories(element) {--}}
                {{--    var category = $('#category_id').find(':selected');--}}
                {{--    var categories = <?php echo json_encode($categories); ?>;--}}

                {{--    var subCategories = '<option value="">Select Subcategory</option>';--}}
                {{--    $.each(categories, function (index, val) {--}}
                {{--        subCategories += '<option value="' + (val.id) + '">' + val.name + ' (' + (val.code) + ')</option>';--}}
                {{--    });--}}

                {{--    element.html(subCategories).change();--}}
                {{--}--}}

                {{--function getProduct(element) {--}}
                {{--    var incrementNumber = element.attr('id').split("_")[3];--}}

                {{--    changeSelectedProductIds();--}}

                {{--    var subcategory_id = $('#sub_category_id_' + incrementNumber).val();--}}
                {{--    if (subcategory_id.length === 0) {--}}
                {{--        subcategory_id = 0;--}}
                {{--    }--}}

                {{--    var reqDeliveryId = <?php echo json_encode($model->id) ?>--}}

                {{--    $('#product_' + incrementNumber).html('<option value="">Please Wait...</option>').load(`{{URL::to("admin/store/load-category-wise-product")}}/${subcategory_id}?selected=${$('#product_' + incrementNumber).attr('data-product-id')}&products_id=${selectedProductIds}&requisition_delivery_id=${reqDeliveryId}`);--}}
                {{--}--}}

                {{--function getUOM(element) {--}}
                {{--    element.parent().parent().next().html(element.find(':selected').attr('data-uom'));--}}
                {{--    element.parent().parent().next().next().html(element.find(':selected').attr('data-requestQty'));--}}
                {{--    element.parent().parent().next().next().next().html(element.find(':selected').attr('data-issuedQty'));--}}
                {{--    element.parent().parent().parent().find('.requisition-qty').attr('max', parseFloat(element.find(':selected').attr('data-issuedQty')));--}}
                {{--    element.parent().parent().parent().find('.requisition-qty').val(parseFloat(element.find(':selected').attr('data-issuedQty')));--}}

                {{--}--}}


                function checkDeliveryQuantity(element) {
                    var value = parseFloat(element.val());
                    var max = parseFloat(element.attr('max'));
                    var min = parseFloat(element.attr('min'));

                    if (value > max) {
                        element.val(max);
                    }

                    if (value < min) {
                        element.val(min);
                    }
                }
            </script>
@endsection
