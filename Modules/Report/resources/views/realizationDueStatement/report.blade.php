<table class="table table-bordered">

    <tr style="text-align: center">
        <td style="width: 8%">
            <strong>Date</strong>
        </td>

        <td style="width: 10%">
            <strong>Bill ID No</strong>
        </td>
        <td style="width: 8%">
            <strong>Work Order No</strong>
        </td>
        <td style="width: 8%">
            <strong>Export LC No</strong>
        </td>
        <td style="width: 5%">
            <strong>Delivery Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Delivery Qty</strong>
        </td>
        <td style="width: 5%">
            <strong>Total Amount</strong>
        </td>
        <td style="width: 5%">
            <strong>Documents Submission Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Acceptance Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Maturity Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Realization Due age (Days)</strong>
        </td>

    </tr>
    @if($documentsStatements)
        @php
            $totalDeliveryQty = 0;
            $totalValue = 0;

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
                $totalValue += ($deliveryQty*$deliveryModel->workOrderItem->reporting_amount);

                   $datetime1 = new DateTime($fgItem->maturity_date);
                   $datetime2 = new DateTime(date('Y-m-d'));
                   $interval = $datetime1->diff($datetime2);
                   $days = $interval->format('%a');
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->created_at))}}</td>
                <td class="text-left">{{$fgItem->bill_no}}</td>
                <td class="text-left">{{$fgItem->workOrder->work_order_no}}</td>
                <td class="text-left">{{$fgItem->export_lc_no}}</td>

                <td class="text-center">{{date('M jS, y', strtotime($deliveryModel->finishedGoodDelivery->delivered_date))}}</td>
                <td class="text-center">{{number_format($deliveryQty)}}</td>
                <td class="text-center">{{systemMoneyFormat($deliveryQty*$deliveryModel->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{$fgItem->submit_date?date('M jS, y', strtotime($fgItem->submit_date)):''}}</td>
                <td class="text-center">{{$fgItem->accept_date?date('M jS, y', strtotime($fgItem->accept_date)):''}}</td>
                <td class="text-center">{{$fgItem->maturity_date?date('M jS, y', strtotime($fgItem->maturity_date)):''}}</td>

                <td class="text-center">{{$days}}</td>

            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-right">Total</td>
            <td class="text-center">{{number_format($totalDeliveryQty)}}</td>
            <td class="text-center">{{systemMoneyFormat($totalValue,'$')}}</td>
            <td class="text-center" colspan="5"></td>
        </tr>
    @endif
</table>
