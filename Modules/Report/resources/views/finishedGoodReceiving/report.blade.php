<table class="table table-bordered">
    <tr>
        <td colspan="6"></td>
        <td colspan="3" style="text-align: center">
            <strong>Fresh Quantity</strong>
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
            <strong>Fresh</strong>
        </td>
        <td style="width: 5%">
            <strong>(B-GRA)</strong>
        </td>
        <td style="width: 5%">
            <strong>S/P Fresh</strong>
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
            $totalFreshInspectionQty = 0;
            $totalBGRAInspectionQty = 0;
            $totalSPInspectionQty = 0;
            $totalUnitPrice = 0;
            $totalValue = 0;
        @endphp
        @foreach($finishedGoodItems as $fgItem)
            @php
                $freshQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->where('grade','fresh')->sum('qty');

                $freshBGRAQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->where('grade','b-gra')->sum('qty');

                $freshSpQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->where('grade','sp-fresh')->sum('qty');

                $totalFreshQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->sum('qty');

                $totalInspectionQty +=$totalFreshQty;
                $totalFreshInspectionQty += $freshQty;
                $totalBGRAInspectionQty += $freshBGRAQty;
                $totalSPInspectionQty += $freshSpQty;
                $totalUnitPrice += $fgItem->workOrderItem->reporting_amount;
                $totalValue += ($totalFreshQty*$fgItem->workOrderItem->reporting_amount);

            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->finishedGoods->received_date))}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->name}}  {{getProductAttributesFaster($fgItem->workOrderItem->product)}}</td>
                <td class="text-center">{{$fgItem->uom_type}}</td>
                <td class="text-center">{{isset($fgItem->uom_qty)? ($fgItem->uom_qty>0?$fgItem->uom_qty:''):''}}</td>
                <td class="text-left">{{$fgItem->finishedGoods->workOrder->work_order_no}}</td>

                <td class="text-center">{{number_format($totalFreshQty)}}</td>
                <td class="text-center">{{number_format($freshQty)}}</td>
                <td class="text-center">{{number_format($freshBGRAQty)}}</td>
                <td class="text-center">{{number_format($freshSpQty)}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{systemMoneyFormat($totalFreshQty*$fgItem->workOrderItem->reporting_amount,'$')}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-right">Total</td>
            <td class="text-center">{{number_format($finishedGoodItems->count())}}</td>
            <td class="text-center">{{number_format($totalInspectionQty)}}</td>
            <td class="text-center">{{number_format($totalFreshInspectionQty)}}</td>
            <td class="text-center">{{number_format($totalBGRAInspectionQty)}}</td>
            <td class="text-center">{{number_format($totalSPInspectionQty)}}</td>
            <td class="text-center">{{systemMoneyFormat($totalUnitPrice,'$')}}</td>
            <td class="text-center">{{systemMoneyFormat($totalValue,'$')}}</td>
        </tr>
    @endif
</table>
