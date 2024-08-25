<table class="table table-bordered">

    <tr style="text-align: center">
        <td style="width: 8%">
            <strong>Date</strong>
        </td>

        <td style="width: 10%">
            <strong>Bill Id No</strong>
        </td>
        <td style="width: 8%">
            <strong>Work Order No</strong>
        </td>
        <td style="width: 8%">
            <strong>Export LC No</strong>
        </td>

        <td style="width: 5%">
            <strong>Delivery Qty</strong>
        </td>
        <td style="width: 5%">
            <strong>Delivery Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
        </td>
        <td style="width: 5%">
            <strong>Total Amount</strong>
        </td>
        <td style="width: 5%">
            <strong>Submission Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Accepted Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Maturity Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Realised Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Gross Realised </strong>
        </td>
        <td style="width: 5%">
            <strong>Net Realised</strong>
        </td>

    </tr>
    @if($documentsStatements)
        @php
            $totalDeliveryQty = 0;

            $totalUnitPrice = 0;
            $totalValue = 0;
            $realizedValue = 0;
            $shortRealizedValue = 0;
        @endphp
        @foreach($documentsStatements as $fgItem)
            @php
                $ids =  $fgItem->finishedGoodDocsDelivery->pluck('finished_goods_delivery_id')->all();

                $deliveryQty = $finishedGoodsDelivery->whereIn('finished_goods_delivery_id',$ids)->sum('delivery_qty');
                $deliveryModel = $finishedGoodsDelivery->whereIn('finished_goods_delivery_id',$ids)->first();

                $returns = \Modules\Productions\app\Models\FinishedGoodDeliveryItemReturn::whereHas('finishedGoodDeliveryItem', function ($query) use($ids){
                    return $query->whereIn('finished_goods_delivery_id', $ids);
                })->sum('quantity');

                $deliveryQty = $deliveryQty-$returns;

                $totalDeliveryQty +=$deliveryQty;
                $totalUnitPrice += isset($deliveryModel->workOrderItem->reporting_amount)?$deliveryModel->workOrderItem->reporting_amount:0;
                $totalValue += ($deliveryQty*$deliveryModel->workOrderItem->reporting_amount);
                $realizedValue += $fgItem->realized_value;
                $shortRealizedValue += $fgItem->short_realized_amount;
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->created_at))}}</td>
                <td class="text-left">{{$fgItem->bill_no}}</td>
                <td class="text-left">{{$fgItem->workOrder->work_order_no}}</td>
                <td class="text-left">{{$fgItem->export_lc_no}}</td>

                <td class="text-center">{{number_format($deliveryQty)}}</td>
                <td class="text-center">{{date('M jS, y', strtotime($deliveryModel->finishedGoodDelivery->delivered_date))}}</td>
                <td class="text-center">{{systemMoneyFormat($deliveryModel->workOrderItem->reporting_amount,'$',2)}}</td>
                <td class="text-center">{{$deliveryModel->workOrderItem->product->productUnit->unit_name}}</td>
                <td class="text-center">{{systemMoneyFormat($deliveryQty*$deliveryModel->workOrderItem->reporting_amount,'$',2)}}</td>
                <td class="text-center">{{$fgItem->submit_date?date('M jS, y', strtotime($fgItem->submit_date)):''}}</td>
                <td class="text-center">{{$fgItem->accept_date?date('M jS, y', strtotime($fgItem->accept_date)):''}}</td>
                <td class="text-center">{{$fgItem->maturity_date?date('M jS, y', strtotime($fgItem->maturity_date)):''}}</td>
                <td class="text-center">{{$fgItem->realization_date?date('M jS, y', strtotime($fgItem->realization_date)):''}}</td>
                <td class="text-right">{{systemMoneyFormat($fgItem->realized_value,'$',2)}}</td>
                <td class="text-right">{{systemMoneyFormat($fgItem->short_realized_amount,'$',2)}}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="4" class="text-right">Total</td>
            <td class="text-center">{{number_format($totalDeliveryQty)}}</td>
            <td class="text-center"></td>
            <td class="text-center">{{systemMoneyFormat($totalUnitPrice,'$',2)}}</td>
            <td class="text-center"></td>
            <td class="text-center">{{systemMoneyFormat($totalValue,'$',2)}}</td>
            <td class="text-center" colspan="4"></td>
            <td class="text-center">{{systemMoneyFormat($realizedValue,'$',2)}}</td>
            <td class="text-center">{{systemMoneyFormat($shortRealizedValue,'$',2)}}</td>
        </tr>
    @endif
</table>
