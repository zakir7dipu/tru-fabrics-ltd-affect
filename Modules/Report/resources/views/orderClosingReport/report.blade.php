<table class="table table-bordered">

    <tr style="text-align: center">
        <td style="width: 8%">
            <strong>WO No</strong>
        </td>
        <td style="width: 8%">
            <strong>Export LC No</strong>
        </td>
        <td style="width: 10%">
            <strong>Bill ID No</strong>
        </td>
        <td style="width: 5%">
            <strong>Customer</strong>
        </td>
        <td style="width: 5%">
            <strong>Buyer</strong>
        </td>
        <td style="width: 8%">
            <strong>Product</strong>
        </td>
        <td style="width: 5%">
            <strong>Order Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>Delivery Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
        </td>
        <td style="width: 5%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 5%">
            <strong>Negotiation Value</strong>
        </td>
        <td style="width: 5%">
            <strong>Last Delivery Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Docs. Sub. Date</strong>
        </td>
        <td style="width: 5%">
            <strong>ACPT. Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Maturity Date</strong>
        </td>
        <td style="width: 5%">
            <strong>Discrepancy / Short Realization</strong>
        </td>

        <td style="width: 5%">
            <strong>Gross Realization Value</strong>
        </td>
        <td style="width: 5%">
            <strong>Bank Charge AIT</strong>
        </td>
        <td style="width: 5%">
            <strong>Net Realization</strong>
        </td>
    </tr>
    @if($documentsStatements)

        @foreach($documentsStatements as $fgItem)
            @php
                $workOrderValue = $fgItem->workOrder->workOrderItems->sum('sub_total');

            $totalFGDeliveryQty = 0;
            $totalFGDeliveryValue = 0;
            $totalFGReturnUnitPrice=0;

            $totalFGReturnQty=0;

            foreach ($fgItem->workOrder->finishedGoodsDeliveries as $key=> $item) {
                if ($key==0){
                    $totalFGReturnUnitPrice = $item->finishedGoodDeliveryItems[0]->unit_price;
                }

                $totalFGDeliveryQty += $item->finishedGoodDeliveryItems->sum('delivery_qty');

                $totalFGDeliveryValue += $item->finishedGoodDeliveryItems->sum('total');

                foreach ($item->finishedGoodDeliveryItems as $findFGreturnItem){
                    $totalFGReturnQty += $findFGreturnItem->returns->sum('quantity');
                }
            }

            $totalFGDeliveryQty = $totalFGDeliveryQty-$totalFGReturnQty;
            $totalFGDeliveryValue= $totalFGDeliveryValue - ($totalFGReturnQty*$totalFGReturnUnitPrice);

            @endphp
            <tr>
                <td class="text-left">{{$fgItem->workOrder->work_order_no}}</td>
                <td class="text-left">{{$fgItem->export_lc_no}}</td>
                <td class="text-left">{{$fgItem->bill_no}}</td>
                <td class="text-left">{{ucfirst($fgItem->workOrder->customer->name)}}</td>
                <td class="text-left">{{ucfirst($fgItem->workOrder->garments_name)}}</td>
                <td class="text-left">{{$fgItem->workOrder->workOrderItems->pluck('product.name')->implode(', ')}}</td>
                <td class="text-center">{{number_format($fgItem->workOrder->workOrderItems->sum('qty'))}}</td>

                <td class="text-center">{{number_format($totalFGDeliveryQty)}}</td>

                <td class="text-center">{{$fgItem->workOrder->workOrderItems[0]->product->productUnit->unit_name}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->workOrder->workOrderItems->sum('reporting_amount')/$fgItem->workOrder->workOrderItems->count(),'$')}}</td>
                <td class="text-center">{{systemMoneyFormat($workOrderValue,'$',2)}}</td>

                <td class="text-center">{{$fgItem->workOrder->finishedGoodsDeliveries->sortByDesc('delivered_date')->first()->delivered_date?date('M jS, y', strtotime($fgItem->workOrder->finishedGoodsDeliveries->sortByDesc('delivered_date')->first()->delivered_date)):''}}</td>

                <td class="text-center">{{$fgItem->submit_date?date('M jS, y', strtotime($fgItem->submit_date)):''}}</td>
                <td class="text-center">{{$fgItem->accept_date?date('M jS, y', strtotime($fgItem->accept_date)):''}}</td>
                <td class="text-center">{{$fgItem->maturity_date?date('M jS, y', strtotime($fgItem->maturity_date)):''}}</td>

                <td class="text-center">{{systemMoneyFormat($fgItem->discrepancies_charge,'$',2)}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->realized_value,'$',2)}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->bank_charge_ait,'$',2)}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->short_realized_amount,'$',2)}}</td>
            </tr>
        @endforeach

    @endif
</table>
