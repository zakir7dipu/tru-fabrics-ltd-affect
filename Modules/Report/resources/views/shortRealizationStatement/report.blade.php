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
            <strong>Order Value</strong>
        </td>
        <td style="width: 5%">
            <strong>Gross Realized Value</strong>
        </td>

        <td style="width: 5%">
            <strong>Net Realized Value</strong>
        </td>

    </tr>
    @if($documentsStatements)
        @php
            $totalOrderValue = 0;
            $totalRealizationValue = 0;
            $totalShortValue = 0;
        @endphp
        @foreach($documentsStatements as $fgItem)
            @php
                //$workOrderValues = $fgItem->workOrder->workOrderItems->get(['qty',DB::raw('`qty`*`reporting_amount` as total')]);

                                $workOrderValue = $fgItem->workOrder->workOrderItems->sum('sub_total');

                                $totalOrderValue += $workOrderValue;
                                $totalRealizationValue += $fgItem->realized_value;
                                $totalShortValue += $fgItem->short_realized_amount;
            @endphp
            <tr>
                <td>{{date('M jS, y', strtotime($fgItem->created_at))}}</td>
                <td class="text-left">{{$fgItem->bill_no}}</td>
                <td class="text-left">{{$fgItem->workOrder->work_order_no}}</td>
                <td class="text-left">{{$fgItem->export_lc_no}}</td>
                <td class="text-center">{{systemMoneyFormat($workOrderValue,'$',2)}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->realized_value,'$',2)}}</td>
                <td class="text-center">{{systemMoneyFormat($fgItem->short_realized_amount,'$',2)}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-right">Total</td>
            <td class="text-center">{{number_format($totalOrderValue)}}</td>
            <td class="text-center">{{systemMoneyFormat($totalRealizationValue,'$',2)}}</td>
            <td class="text-center">{{systemMoneyFormat($totalShortValue,'$',2)}}</td>
        </tr>
    @endif
</table>
