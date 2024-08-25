<table class="table table-bordered">
    <tr>
        <td colspan="3"></td>
        <td colspan="4" style="text-align: center">
            <strong>Opening</strong>
        </td>
        <td colspan="6" style="text-align: center">
            <strong>In Ward</strong>
        </td>
        <td colspan="4" style="text-align: center">
            <strong>Out Ward</strong>
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
    @php
        $array = [];
    @endphp
    @if(isset($inventories))
        @foreach($inventories as $value)
            @php
                $opening_count = $openings->where('product_id', $value->product_id)->count();
                $opening_qty = $openings->where('product_id', $value->product_id)->sum('qty');
                $opening_total_unit_price = $openings->where('product_id', $value->product_id)->sum('grnItem.unit_price');
                $opening_unit_price = $opening_count > 0 && $opening_total_unit_price > 0 ? $opening_total_unit_price/$opening_count : 0;
                $opening_total = $opening_unit_price*$opening_qty;

                $opening_qty += isset($array[$value->product_id]['qty']) ? $array[$value->product_id]['qty'] : 0;
                $opening_unit_price += isset($array[$value->product_id]['unit_price']) ? $array[$value->product_id]['unit_price'] : 0;
                $opening_total += isset($array[$value->product_id]['total']) ? $array[$value->product_id]['total'] : 0;

                $delivery_count = $deliveries->where('stock_inventory_id', $value->id)->count();
                $delivery_qty = $deliveries->where('stock_inventory_id', $value->id)->sum('issued_qty');
                $delivery_total_unit_price = $deliveries->where('stock_inventory_id', $value->id)->sum('stockInventory.grnItem.unit_price');
                $delivery_unit_price = $delivery_count > 0 && $delivery_total_unit_price > 0 ? $delivery_total_unit_price/$delivery_count : 0;
                $delivery_total = $delivery_unit_price*$delivery_qty;

                $balance_qty = $opening_qty+$value->qty-$delivery_qty;
                $balance_unit_price = ($opening_unit_price+$value->grnItem->unit_price) > 0 ? ($opening_unit_price+$value->grnItem->unit_price)/($opening_unit_price == 0 || $value->grnItem->unit_price == 0 ? 1 : 2) : 0;
                $balance_total = $balance_unit_price*$balance_qty;

                $array[$value->product_id] = [
                    'qty' => $balance_qty,
                    'unit_price' => $balance_unit_price,
                    'total' => $balance_total,
                ];
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($value->grnItem->goodReceivedNote->received_date))}}</td>
                <td>{{$value->grnItem->goodReceivedNote->proformaInvoice->lc_no??$value->grnItem->goodReceivedNote->proformaInvoice->lc_no}}</td>
                <td>{{$value->product->name}}  {{getProductAttributesFaster($value->product)}}</td>

                <td class="text-center">{{$opening_qty}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-right">{{systemMoneyFormat($opening_unit_price,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($opening_total, '$')}}</td>

                <td class="text-center">{{number_format($value->qty)}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-center">{{$value->grnItem->uom_type}}</td>
                <td class="text-center">{{isset($value->grnItem->uom_qty)? ($value->grnItem->uom_qty>0?$value->grnItem->uom_qty:''):''}}</td>
                <td class="text-right">{{systemMoneyFormat($value->grnItem->unit_price,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($value->qty*$value->grnItem->unit_price, '$')}}</td>

                <td class="text-center">{{$delivery_qty}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-right">{{systemMoneyFormat($delivery_unit_price,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($delivery_total, '$')}}</td>

                <td class="text-center">{{$balance_qty}}</td>
                <td>{{$value->product->productUnit->unit_name}}</td>
                <td class="text-right">{{systemMoneyFormat($balance_unit_price,'$')}}</td>
                <td class="text-right">{{systemMoneyFormat($balance_total, '$')}}</td>
            </tr>
        @endforeach
    @endif
</table>
