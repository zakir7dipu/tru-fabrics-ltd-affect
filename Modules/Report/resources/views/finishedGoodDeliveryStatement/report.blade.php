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
        <td style="width: 8%">
            <strong>Export LC</strong>
        </td>

        <td style="width: 5%">
            <strong>Total Quantity</strong>
        </td>
        <td style="width: 5%">
            <strong>Finish Type</strong>
        </td>
        <td style="width: 5%">
            <strong>Process Type</strong>
        </td>
        <td style="width: 5%">
            <strong>GSM</strong>
        </td>

        <td style="width: 5%">
            <strong>Color</strong>
        </td>
        <td style="width: 5%">
            <strong>Customer</strong>
        </td>
        <td style="width: 5%">
            <strong>Buyer</strong>
        </td>
        <td style="width: 5%">
            <strong>Delivery Challan</strong>
        </td>
    </tr>
    @if($finishedGoodDeliveries)
        @foreach($finishedGoodDeliveries as $delivery)
            <tr>
                <td>{{date('M jS, y', strtotime($delivery->delivered_date))}}</td>
                <td class="text-left">{{$delivery->workOrder->workOrderItems->pluck('product.name')->implode(', ')}}</td>
                <td class="text-left">{{$delivery->workOrder->work_order_no}}</td>
                <td class="text-left">{{$delivery->workOrder->finishedGoodsDocs->pluck('export_lc_no')->implode(', ')}}</td>
                <td class="text-center">{{$delivery->finishedGoodDeliveryItems->sum('delivery_qty')}}</td>
                <td class="text-left">{{ucfirst($delivery->workOrder->finish_type)}}</td>
                <td class="text-left">{{ucfirst($delivery->workOrder->process->name)}}</td>
                <td class="text-left">
                    @foreach($delivery->workOrder->workOrderItems as $item)
                        {{getSingleProductAttributesFaster($item->product,'GSM')}}
                    @endforeach
                </td>
                <td class="text-left">
                    @foreach($delivery->workOrder->workOrderItems as $item)
                        {{getSingleProductAttributesFaster($item->product,'Color')}}
                    @endforeach
                </td>
                <td class="text-left">{{ucfirst($delivery->workOrder->customer->name)}}</td>
                <td class="text-left">{{ucfirst($delivery->workOrder->garments_name)}}</td>
                <td class="text-left">{{ucfirst($delivery->challan_no)}}</td>
            </tr>
        @endforeach
    @endif
</table>
