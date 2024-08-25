<table class="table table-bordered">
    <tr>
        <td colspan="3"></td>
        <td colspan="4" style="text-align: center">
            <strong>FG Store Receiving</strong>
        </td>
        <td colspan="4" style="text-align: center">
            <strong>FG Delivery</strong>
        </td>
        <td colspan="4" style="text-align: center">
            <strong>Balance in FG Store</strong>
        </td>
    </tr>
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
            <strong>Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
        </td>
        <td style="width: 10%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 10%">
            <strong>Amount</strong>
        </td>

        <td style="width: 5%">
            <strong>Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
        </td>
        <td style="width: 10%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 10%">
            <strong>Amount</strong>
        </td>

        <td style="width: 5%">
            <strong>Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
        </td>
        <td style="width: 10%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 10%">
            <strong>Amount</strong>
        </td>

    </tr>
    @if($finishedGoodItems)
        @php
            $thisTotalFreshQty=0;
            $thisUnitPrice=0;
            $thisTotalFreshValue=0;
            $thisTotalDeliveryQty=0;
            $thisTotalDeliveryValue=0;
            $thisBalanceQty=0;
            $thisBalanceValue=0;
        @endphp
        @foreach($finishedGoodItems as $fgItem)
            @php

                $freshQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->sum('qty');

                $totalDeliveryQty = $fgItem->finishedGoodDelivery->sum('qty');
                $finalQty = $freshQty-$totalDeliveryQty;

                $thisTotalFreshQty +=$freshQty;
                $thisUnitPrice += $fgItem->workOrderItem->reporting_amount;
                $thisTotalFreshValue += ($freshQty*$fgItem->workOrderItem->reporting_amount);

                $thisTotalDeliveryQty +=$totalDeliveryQty;
                $thisTotalDeliveryValue += ($totalDeliveryQty*$fgItem->workOrderItem->reporting_amount);

                $thisBalanceQty +=$finalQty;
                $thisBalanceValue += ($finalQty*$fgItem->workOrderItem->reporting_amount);
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->finishedGoods->received_date))}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->name}}  {{getProductAttributesFaster($fgItem->workOrderItem->product)}}</td>
                <td class="text-left">{{$fgItem->finishedGoods->workOrder->work_order_no}}</td>

                <td class="text-center">{{number_format($freshQty)}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->productUnit->unit_name??$fgItem->workOrderItem->product->productUnit->unit_name}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{systemMoneyFormat($freshQty*$fgItem->workOrderItem->reporting_amount,'$')}}</td>

                <td class="text-center">{{number_format($totalDeliveryQty)}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->productUnit->unit_name??$fgItem->workOrderItem->product->productUnit->unit_name}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{systemMoneyFormat($totalDeliveryQty*$fgItem->workOrderItem->reporting_amount,'$')}}</td>

                <td class="text-center">{{number_format($finalQty)}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->productUnit->unit_name??$fgItem->workOrderItem->product->productUnit->unit_name}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->workOrderItem->reporting_amount,'$')}}</td>
                <td class="text-center">{{systemMoneyFormat($finalQty*$fgItem->workOrderItem->reporting_amount,'$')}}</td>

            </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-right">Total</td>
            <td class="text-center">{{number_format($finishedGoodItems->count())}}</td>

            <td class="text-center">{{number_format($thisTotalFreshQty)}}</td>
            <td></td>
            <td class="text-center">{{systemMoneyFormat($thisUnitPrice,'$')}}</td>
            <td class="text-center">{{systemMoneyFormat($thisTotalFreshValue,'$')}}</td>

            <td class="text-center">{{number_format($thisTotalDeliveryQty)}}</td>
            <td></td>
            <td class="text-center">{{systemMoneyFormat($thisUnitPrice,'$')}}</td>
            <td class="text-center">{{systemMoneyFormat($thisTotalDeliveryValue,'$')}}</td>

            <td class="text-center">{{number_format($thisBalanceQty)}}</td>
            <td></td>
            <td class="text-center">{{systemMoneyFormat($thisUnitPrice,'$')}}</td>
            <td class="text-center">{{systemMoneyFormat($thisBalanceValue,'$')}}</td>

        </tr>
    @endif
</table>
