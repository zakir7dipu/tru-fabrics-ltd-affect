<table class="table table-bordered">
    <tr>
        <td colspan="4"></td>
        <td colspan="3" style="text-align: center">
            <strong>Fresh Quantity</strong>
        </td>
        <td colspan="2" style="text-align: center">
            <strong>Reject Quantity</strong>
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
            <strong>D/F</strong>
        </td>
        <td style="width: 5%">
            <strong>W/F</strong>
        </td>
    </tr>
    @if($finishedGoodItems)
        @foreach($finishedGoodItems as $fgItem)
            @php

                $freshQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->where('grade','fresh')->sum('qty');

                $freshBGRAQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->where('grade','b-gra')->sum('qty');

                $freshSpQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','fresh')->where('grade','sp-fresh')->sum('qty');

                $rejectDfQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','reject')->where('grade','d-f')->sum('qty');

                $rejectWfQty = $finishedGoodItemInspections->where('finished_good_item_id', $fgItem->id)
                ->where('inspection','reject')->where('grade','w-f')->sum('qty');

            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->finishedGoods->received_date))}}</td>
                <td class="text-left">{{$fgItem->workOrderItem->product->name}}  {{getProductAttributesFaster($fgItem->workOrderItem->product)}}</td>
                <td class="text-left">{{$fgItem->finishedGoods->workOrder->work_order_no}}</td>

                <td class="text-center">{{number_format($fgItem->qty)}}</td>
                <td class="text-center">{{number_format($freshQty)}}</td>
                <td class="text-center">{{number_format($freshBGRAQty)}}</td>
                <td class="text-center">{{number_format($freshSpQty)}}</td>
                <td class="text-center">{{number_format($rejectDfQty)}}</td>
                <td class="text-center">{{number_format($rejectWfQty)}}</td>
            </tr>
        @endforeach
    @endif
</table>
