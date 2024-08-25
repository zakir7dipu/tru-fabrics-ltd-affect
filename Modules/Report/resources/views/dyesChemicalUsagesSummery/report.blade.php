<table class="table table-bordered">
    <tr>
        <td colspan="3"></td>
        <td colspan="6" style="text-align: center">
            <strong>Received</strong>
        </td>
        <td colspan="5" style="text-align: center">
            <strong>Usage</strong>
        </td>
        <td colspan="4" style="text-align: center">
            <strong>Balance</strong>
        </td>
    </tr>

    <tr>
        <td style="width: 10%">
            <strong>Date</strong>
        </td>
        <td style="width: 10%">
            <strong>Import LC No/Bill No</strong>
        </td>
        <td style="width: 10%">
            <strong>Product Name</strong>
        </td>

        <td style="width: 5%">
            <strong>QTY</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM Type</strong>
        </td>
        <td style="width: 5%">
            <strong>UOM Qty</strong>
        </td>
        <td style="width: 10%">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 10%">
            <strong>Amount</strong>
        </td>



        <td style="width: 5%">
            <strong>QTY</strong>
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
        <td style="width: 10%">
            <strong>WorkOrder No</strong>
        </td>

        <td style="width: 5%">
            <strong>QTY</strong>
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
    @if($inventories)
        @foreach($inventories as $value)
            @php
                //$unit_price = getGrnItemUnitPrice($value->grnItem, $value->grnItem->goodReceivedNote);
                $balance = $value->qty-$value->requisitionDeliveryItems->sum('issued_qty');
                $workOrders = $value->requisitionDeliveryItems->unique('requisitionDelivery.requisition.workOrderItem.workOrder.work_order_no')->pluck('requisitionDelivery.requisition.workOrderItem.workOrder.work_order_no')->all();

                $workOrderDC = $dyesChemicalUses->where('requisitionDeliveryItem.stock_inventory_id',$value->id)->pluck('dyesChemicalUse.workOrderItem.workOrder.work_order_no')->all();

                $mergeArr = array_merge($workOrders,$workOrderDC);

            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($value->grnItem->goodReceivedNote->received_date))}}</td>
                <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->lc_no??$value->grnItem->goodReceivedNote->proformaInvoice->lc_no}}</td>
                <td>{{$value->product->name}}  {{getProductAttributesFaster($value->product)}}</td>
                <td class="text-center">{{number_format($value->qty)}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-center">{{$value->grnItem->uom_type}}</td>
                <td class="text-center">{{isset($value->grnItem->uom_qty)? ($value->grnItem->uom_qty>0?$value->grnItem->uom_qty:''):''}}</td>
                <td class="text-right">{{systemMoneyFormat($value->grnItem->unit_price,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($value->qty*$value->grnItem->unit_price, '$')}}</td>

                <td class="text-center">{{number_format($value->requisitionDeliveryItems->sum('issued_qty'))}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-right">{{systemMoneyFormat($value->grnItem->unit_price,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($value->requisitionDeliveryItems->sum('issued_qty')*$value->grnItem->unit_price, '$')}}</td>
                <td class="text-left">
                    @if($mergeArr)
                        @foreach(array_values(array_unique($mergeArr)) as $item)
                            {{$item}},
                        @endforeach
                    @endif

                </td>

                <td class="text-center">{{number_format($balance)}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-right">{{systemMoneyFormat($value->grnItem->unit_price,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($balance*$value->grnItem->unit_price, '$')}}</td>

            </tr>
        @endforeach
    @endif
</table>
