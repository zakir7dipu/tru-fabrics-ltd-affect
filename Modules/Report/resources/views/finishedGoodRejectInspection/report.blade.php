<table class="table table-bordered">
    <tr>
        <td colspan="6"></td>
        <td colspan="2" style="text-align: center">
            <strong>Reject Quantity</strong>
        </td>
        <td colspan="2" style="text-align: center">
            <strong></strong>
        </td>
    </tr>
    <tr style="text-align: center">
        <td style="width: 8%">
            <strong>Date</strong>
        </td>

        <td style="width: 10%">
            <strong>Product Name</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM Type</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM Qty</strong>
        </td>
        <td style="width: 8%">
            <strong>Work Order No</strong>
        </td>

        <td style="width: 5%">
            <strong>Total Quantity</strong>
        </td>

        <td style="width: 5%">
            <strong>D/F</strong>
        </td>
        <td style="width: 5%">
            <strong>W/F</strong>
        </td>
        <td style="width: 5%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 5%">
            <strong>Total Amount</strong>
        </td>

    </tr>
    @if($finishedGoodItems)
        @php
            $totalInspectionQty = 0;

            $totalDFInspectionQty = 0;
            $totalWFInspectionQty = 0;

            $totalUnitPrice = 0;
            $totalValue = 0;
        @endphp
        @foreach($finishedGoodItems as $fgItem)
            @php

                $rejectDfQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','reject')->where('grade','d-f')->sum('qty');

                $rejectWfQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','reject')->where('grade','w-f')->sum('qty');

                $totalRejectQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','reject')->sum('qty');

                $totalInspectionQty +=$totalRejectQty;

                $totalDFInspectionQty += $rejectDfQty;
                $totalWFInspectionQty += $rejectWfQty;

                $totalUnitPrice += $fgItem->workOrderItem->reporting_amount;
                $totalValue += ($totalRejectQty*$fgItem->workOrderItem->reporting_amount);

            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->finishedGoods->received_date))}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->name}}  {{getProductAttributesFaster($fgItem->workOrderItem->product)}}</td>
                <td class="text-center">{{$fgItem->uom_type}}</td>
                <td class="text-center">{{isset($fgItem->uom_qty)? ($fgItem->uom_qty>0?$fgItem->uom_qty:''):''}}</td>
                <td class="text-left">{{$fgItem->finishedGoods->workOrder->work_order_no}}</td>
                <td class="text-left">{{$fgItem->finishedGoods->workOrder->work_order_no}}</td>

                <td class="text-center">{{number_format($totalRejectQty)}}</td>
                <td class="text-center">{{number_format($rejectDfQty)}}</td>
                <td class="text-center">{{number_format($rejectWfQty)}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{systemMoneyFormat($totalRejectQty*$fgItem->workOrderItem->reporting_amount,'$')}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-right">Total</td>
            <td class="text-center">{{number_format($finishedGoodItems->count())}}</td>
            <td class="text-center">{{number_format($totalInspectionQty)}}</td>
            <td class="text-center">{{number_format($totalDFInspectionQty)}}</td>
            <td class="text-center">{{number_format($totalWFInspectionQty)}}</td>
            <td class="text-center">{{systemMoneyFormat($totalUnitPrice,'$')}}</td>
            <td class="text-center">{{systemMoneyFormat($totalValue,'$')}}</td>
        </tr>
    @endif
</table>
