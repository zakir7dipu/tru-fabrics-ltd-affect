<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin-top: 1.20in;
            margin-bottom: 1.20in;
            header: page-header;
            footer: page-footer;
            background-image-resize: 6;
        }

        html, body, p {
            font-size: 10px !important;
            color: #000000;
        }

        table {
            width: 100% !important;
            border-spacing: 0px !important;
            margin-top: 10px !important;
            margin-bottom: 15px !important;
        }

        table caption {
            color: #000000 !important;
        }

        table td {
            padding-top: 1px !important;
            padding-bottom: 1px !important;
            padding-left: 7px !important;
            padding-right: 7px !important;
        }

        .table-non-bordered {
            padding-left: 0px !important;
        }

        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered td {
            border: 1px solid #000000;
            padding: 5px;
        }

        .table-bordered tr:first-child td {
            border-top: 0;
        }

        .table-bordered tr td:first-child {
            border-left: 0;
        }

        .table-bordered tr:last-child td {
            border-bottom: 0;
        }

        .table-bordered tr td:last-child {
            border-right: 0;
        }

        .mt-0 {
            margin-top: 0;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .image-space {
            white-space: wrap !important;
            padding-top: 45px !important;
        }

        .break-before {
            page-break-before: always;
            break-before: always;
        }

        .break-after {
            break-after: always;
        }

        .break-inside {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .break-inside-auto {
            page-break-inside: auto;
            break-inside: auto;
        }

        .space-top {
            margin-top: 10px;
        }

        .space-bottom {
            margin-bottom: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
<htmlpageheader name="page-header">
    {{--    <div class="row mb-3 print-header">--}}
    {{--        <div class="col-md-12" style="width: 100%;float:left;padding-top: 135px">--}}
    {{--            <h2><strong>{{ $title }}</strong></h2>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</htmlpageheader>

<htmlpagefooter name="page-footer">

    <table class="table-bordered">
        <tbody>
        <tr>
            <td colspan="2" style="text-align: right;border: none !important">
                <small>Page {PAGENO} of {nb}</small>
            </td>
        </tr>
        </tbody>
    </table>
</htmlpagefooter>
<div class="container">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td colspan="4">
                <center>
                    <h3>TRU FABRICS LTD</h3>
                    <h6>Noapara, Tarabo, Rupgonj, Narayongon</h6>
                </center>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <center>
                    <h3>Cost Sheet</h3>
                </center>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <tr>
                        <td>Work Order No:</td>
                        <td colspan="3">{{$model->work_order_no}}</td>
                    </tr>
                    <tr>
                        <td>Delivery Date:</td>
                        <td colspan="3">{{date('d M Y', strtotime($model->delivery_date))}}</td>
                    </tr>
                    @foreach($model->workOrderItems as $item)
                        <tr>
                            <td>Product</td>
                            <td>{{$item->product->name}} </td>
                            <td>Order Qty: {{$item->qty}} </td>
                            <td>Unit: {{$item->product->productUnit->unit_name}} </td>
                        </tr>
                        <tr>
                            <td>Attribute</td>
                            <td colspan="3"> {{getProductAttributesFaster($item->product)}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Customer:</td>
                        <td colspan="3">{{$model->customer->name}}</td>
                    </tr>
                    <tr>
                        <td>Buyer:</td>
                        <td colspan="3">{{$model->garments_name}}</td>
                    </tr>
                    <tr>
                        <td>A/C Holder:</td>
                        <td colspan="3">{{$model->account_holder}}</td>
                    </tr>
                    <tr>
                        <td>Process:</td>
                        <td colspan="3">{{$model->process->name}}</td>
                    </tr>
                    <tr>
                        <td>Finish Type:</td>
                        <td colspan="3">{{$model->finish_type}}</td>
                    </tr>
                    <tr>
                        <td>Lab Dep Approval:</td>
                        <td colspan="3">{{$model->lab_dep_approval}}</td>
                    </tr>
                    <tr>
                        <td>Fabric Composition:</td>
                        <td colspan="3">{{$model->fabric_composition}}</td>
                    </tr>
                    <tr>
                        <td>Shrinkage:</td>
                        <td colspan="3">{{$model->shrinkage}}</td>
                    </tr>
                </table>
            </td>

            <td colspan="2">
                <table>
                    <tr>
                        <td>{{$model->workOrderItems->pluck('product.name')->implode(', ')}} </td>
                        <td>{{$issuedQty}} </td>
                        <td>{{$model->workOrderItems[0]->product->productUnit->unit_name}} </td>
                    </tr>
                    <tr>
                        <td>Yarn Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">0</td>
                    </tr>
                    <tr>
                        <td>Weaving Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">0</td>
                    </tr>
                    <tr>
                        <td>Gray Fabric Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">{{systemMoneyFormat($grayTotalCost/$model->workOrderItems->sum('qty'))}}</td>
                    </tr>
                    <tr>
                        <td>Dyes & Chemical Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">{{systemMoneyFormat($dyesChemicalTotalCost/$model->workOrderItems->sum('qty'))}}</td>
                    </tr>
                    <tr>
                        <td>Special Finish Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">-</td>
                    </tr>
                    <tr>
                        <td>Excess/Less Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">-</td>
                    </tr>
                    <tr>
                        <td>Overhead Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">{{systemMoneyFormat($postOverHeadCost)}}</td>
                    </tr>
                    <tr>
                        <td>Others Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">{{systemMoneyFormat($postOtherCost)}}</td>
                    </tr>
                    <tr>
                        <td>Commercial Cost per {{$workOrderUnit}}
                        </td>
                        <td colspan="2">{{systemMoneyFormat($postCommercialCost)}}</td>
                    </tr>
                    <tr>
                        <td>Actual Cost per {{$workOrderUnit}}</td>
                        <td colspan="2">{{systemMoneyFormat($postActualCost)}}</td>
                    </tr>
                    <tr>
                        <td>Net Sales Price per {{$workOrderUnit}}</td>
                        <td colspan="2">{{systemMoneyFormat($postNetSalesPrice)}}</td>
                    </tr>

                    <tr>
                        <td>Profit Loss on Sale per {{$workOrderUnit}}</td>
                        <td colspan="2">{{systemMoneyFormat($profitLossOnPrice)}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>

        </tr>

        </tbody>
    </table>

    <table style="margin-top: 50px">
        <tbody>
        <tr>
            <td style="width: 30%;border-top: none !important" class="text-center pl-4 pr-4">
                <strong></strong>
                <hr class="mt-0 pt-0 mb-0 pb-0" style="border-top: 2px solid black">
                Account Manager
            </td>
            <td style="width: 30%;border-top: none !important" class="text-center pl-4 pr-4">
                <strong></strong>
                <hr class="mt-0 pt-0 mb-0 pb-0" style="border-top: 2px solid black">
                Director (MKT)
            </td>
            <td style="width: 30%;border-top: none !important" class="text-center pl-4 pr-4">
                <strong></strong>
                <hr class="mt-0 pt-0 mb-0 pb-0" style="border-top: 2px solid black">
                Deputy Managing Director
            </td>
            <td style="width: 30%;border-top: none !important" class="text-center pl-4 pr-4">
                <strong></strong>
                <hr class="mt-0 pt-0 mb-0 pb-0" style="border-top: 2px solid black">
                Finance Department
            </td>
        </tr>
        </tbody>
    </table>

</div>
</body>
</html>
