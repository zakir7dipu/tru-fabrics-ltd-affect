<table class="table table-bordered">

    <tr style="text-align: center">
        <td style="width: 8%">
            <strong>Date</strong>
        </td>

        <td style="width: 10%">
            <strong>Product Name</strong>
        </td>
        <td style="width: 8%">
            <strong>Work Order No</strong>
        </td>

        <td style="width: 5%">
            <strong>Total Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 5%">
            <strong>Total Amount</strong>
        </td>
        <td style="width: 5%">
            <strong>Aging (Day's)</strong>
        </td>

    </tr>
    @if($finishedGoodItems)
        @php
            $totalInspectionQty = 0;
            $totalUnitPrice = 0;
            $totalValue = 0;
            $totalDayes = 0;
        @endphp
        @foreach($finishedGoodItems as $fgItem)
            @php

                $freshQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->sum('qty');
                $totalDeliveryQty = $fgItem->finishedGoodDelivery->sum('qty');
                $finalQty = $freshQty-$totalDeliveryQty;

                $totalInspectionQty +=$finalQty;
                $totalUnitPrice += $fgItem->workOrderItem->reporting_amount;
                $totalValue += ($finalQty*$fgItem->workOrderItem->reporting_amount);

                $datetime1 = new DateTime($fgItem->finishedGoods->received_date);
                $datetime2 = new DateTime(date('Y-m-d'));
                $interval = $datetime1->diff($datetime2);
                $days = $interval->format('%a');

                $totalDayes +=$days;
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->finishedGoods->received_date))}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->name}}  {{getProductAttributesFaster($fgItem->workOrderItem->product)}}</td>
                <td class="text-left">{{$fgItem->finishedGoods->workOrder->work_order_no}}</td>

                <td class="text-center">{{number_format($finalQty)}}</td>

                <td class="text-center">{{systemMoneyFormat($fgItem->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{systemMoneyFormat($finalQty*$fgItem->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{$days}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-right">Total</td>
            <td class="text-center">{{number_format($finishedGoodItems->count())}}</td>
            <td class="text-center">{{number_format($totalInspectionQty)}}</td>
            <td class="text-center">{{systemMoneyFormat($totalUnitPrice,'$')}}</td>
            <td class="text-center">{{systemMoneyFormat($totalValue,'$')}}</td>
            <td class="text-center">{{$totalDayes}}</td>
        </tr>
    @endif
</table>
