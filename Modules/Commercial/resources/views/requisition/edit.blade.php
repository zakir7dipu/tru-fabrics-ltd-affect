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
                                        {!! Form::model($requisition, [
                                            'route' => ['requisitions.update', $requisition->id],
                                            'method' => 'PUT',
                                            'class' => 'form-horizontal',
                                            'files' => true,
                                            ]) !!}


                                        <input type="hidden" name="is_bulk_item"
                                               value="{{isset($requisition->workOrderItem)?'no':'yes'}}">

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

                                            @if(isset($requisition->workOrderItem))

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
                                                                    @foreach($workOrders as $key => $workOrder)
                                                                        <option
                                                                            value="{{ $workOrder->id }}"
                                                                            {{$workOrder->id==$requisition->workOrderItem->work_order_id?'selected':''}}
                                                                            requisition-id="{{$requisition->id}}"
                                                                        >{{ $workOrder->work_order_no }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>

                                                            {!! $errors->first('work_order_id') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="type" value="workorder">
                                            @else
                                                <input type="hidden" name="type" value="bulk">
                                            @endif


                                            @if(isset($requisition->workOrderItem))
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

                                            <div class="col-md-12 table-responsive style-scroll mt-4 mb-2">

                                                <table class="table table-striped table-bordered miw-500 dac_table"
                                                       cellspacing="0"
                                                       width="100%" id="dataTable">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th width="20%">Product Category</th>
                                                        <th width="50%">Product Detail</th>
                                                        <th width="10%">UOM</th>
                                                        <th width="10%">Qty</th>
                                                        <th width="10%" class="text-center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="field_wrapper">
                                                    @php
                                                        $oldProductIds=[];
                                                    @endphp
                                                    @foreach($requisition->requisitionItems as $key=>$item)
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
                                                                            data-selected-sub-category="{{$item->product->category_id }}"
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
                                                                           step="any"
                                                                           class="form-control requisition-qty"
                                                                           required data-input="recommended"
                                                                           data-quantity="{{$item->qty}}"
                                                                           value="{{$item->qty}}"
                                                                    >
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
            var x = parseInt("{{ $requisition->requisitionItems->count() }}");
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
            var value = element.val();

            var subCategories = '<option value="0">Select Subcategory</option>';
            $.each(categories, function (index, val) {
                subCategories += '<option value="' + (val.id) + '" ' + (val.id == value ? 'selected' : '') + '>' + val.name + ' (' + (val.code) + ')</option>';
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

            var isBulkItem = '{{isset($requisition->workOrderItem)?'no':'yes'}}';

            if (subcategory_id.length === 0) {
                subcategory_id = 0;
            }
            $('#qty_' + incrementNumber).val($('#qty_' + incrementNumber).attr('data-quantity'));

            $.ajax({
                url: '{{URL::to(Request()->route()->getPrefix()."/requisitions/load-category-wise-product")}}/' + subcategory_id + '?selected=' + selected_product + '&products_id=' + selectedProductIds + '&is_bulk_item=' + isBulkItem,
                type: 'GET',
                data: {},
            })
                .done(function (response) {
                    $('#product_' + incrementNumber).html(response).change();
                });
        }

        function getUOM() {
            $.each($('.product'), function (index, val) {
                $(this).parent().parent().next().html($(this).find(':selected').attr('data-uom'));
            });
        }

        getWorkOrderItems($('#work_order_id'))

        function getWorkOrderItems(element) {
            let requisitionId = element.find(':selected').attr('requisition-id');

            $('#work_order_item_id').html('<option value="">Please Wait...</option>').load('{{URL::to(Request()->route()->getPrefix()."/requisitions/load-wo-wise-product")}}/' + element.find(':selected').val() + '?requisitionId=' + requisitionId);
        }
    </script>
@endsection
