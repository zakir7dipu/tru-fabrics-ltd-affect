@php
    $totalFGDeliveryQty = 0;
    $totalFGDeliveryValue = 0;
    $totalFGReturnUnitPrice=0;
    $totalFGReturnQty=0;

    foreach ($model->finishedGoodsDeliveries as $key=> $item) {
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

<table class="table table-bordered">

    <tr style="text-align: center">
        <td style="text-align: left"><strong>WO Number:</strong></td>
        <td>{{$model->work_order_no}}</td>
        <td></td>
        <td style="text-align: left"><strong>Buyer</strong></td>
        <td>{{$model->garments_name}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>WO Date:</strong></td>
        <td>{{date('d M Y', strtotime($model->wo_open_date))}}</td>
        <td></td>
        <td style="text-align: left"><strong>Customer</strong></td>
        <td>{{$model->customer->name}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Account Holder</strong></td>
        <td>{{$model->account_holder}}</td>
        <td></td>
        <td style="text-align: left"><strong>WO Quantity</strong></td>
        <td>{{systemMoneyFormat($model->workOrderItems->sum('qty'),'',0)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Composition</strong></td>
        <td>{{$model->fabric_composition}}</td>
        <td></td>
        <td style="text-align: left"><strong>Lab Dep Approval</strong></td>
        <td>{{$model->lab_dep_approval}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Construction</strong></td>
        <td>
            @foreach($model->workOrderItems as $key => $item)
                {{ $key > 0 ? ', ':'' }} {{getSingleProductAttributesFaster($item->product,'Construction')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Shrinkage</strong></td>
        <td>{{$model->shrinkage}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Color</strong></td>
        <td>
            @foreach($model->workOrderItems as $key=> $item)
                {{ $key > 0 ? ', ':'' }}{{getSingleProductAttributesFaster($item->product,'Color')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Process Type</strong></td>
        <td>{{$model->process->name}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Width</strong></td>
        <td>
            @foreach($model->workOrderItems as  $key=>$item)
                {{ $key > 0 ? ', ':'' }} {{getSingleProductAttributesFaster($item->product,'Width')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Finish Type</strong></td>
        <td>{{$model->finish_type}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Weave</strong></td>
        <td>
            @foreach($model->workOrderItems as $key=> $item)
                {{ $key > 0 ? ', ':'' }} {{getSingleProductAttributesFaster($item->product,'Weave')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>Last Delivery Date</strong></td>
        <td>{{$model->finishedGoodsDeliveries->sortByDesc('delivered_date')->first()->delivered_date?date('M jS, y', strtotime($model->finishedGoodsDeliveries->sortByDesc('delivered_date')->first()->delivered_date)):''}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>GSM</strong></td>
        <td>
            @foreach($model->workOrderItems as  $key=> $item)
                {{ $key > 0 ? ($key <= 1 ?',':', '):'' }} {{getSingleProductAttributesFaster($item->product,'GSM')}}
            @endforeach
        </td>
        <td></td>
        <td style="text-align: left"><strong>WO Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($model->workOrderItems->sum('sub_total'), '$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Export LC Number</strong></td>
        <td>{{$model->finishedGoodsDocs[0]->export_lc_no}}</td>
        <td></td>
        <td style="text-align: left"><strong>Total Delivery Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($totalFGDeliveryValue,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Bill ID Number</strong></td>
        <td>{{$model->finishedGoodsDocs[0]->bill_no}}</td>
        <td></td>
        <td style="text-align: left"><strong>Gross Realised Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($model->finishedGoodsDocs[0]->realized_value,'$',2)}}</td>

    </tr>
    <tr style="text-align: center">
        <td style="text-align: left"><strong>Delivery Quantity</strong></td>
        <td>{{systemMoneyFormat($totalFGDeliveryQty,'',0)}}</td>
        <td></td>
        <td style="text-align: left"><strong>Net Realised Value</strong></td>
        <td style="text-align: right">{{systemMoneyFormat($model->finishedGoodsDocs[0]->short_realized_amount,'$',2)}}</td>
    </tr>
</table>

<table class="table table-bordered">
    <tr style="text-align: center">
        <td colspan="5" style="text-align: left"><strong>Cost Calculation</strong></td>
    </tr>
    <tr style="text-align: center">
        <td style="text-align: center"><strong>Particulars</strong></td>
        <td style="text-align: center"><strong>Used Qty</strong></td>
        <td style="text-align: center"><strong>UOM</strong></td>
        <td style="text-align: center"><strong>Unit Price</strong></td>
        <td style="text-align: center"><strong>Amount</strong></td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Grey</strong></td>
        <td class="text-center">{{systemMoneyFormat($issuedQty,'',0)}}</td>
        <td class="text-center">Yds</td>
        <?php
        $grayUnits = $grayTotalCost / $model->workOrderItems->sum('qty');

        ?>
        <td class="text-right">{{systemMoneyFormat($grayUnits,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($issuedQty*$grayCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Dyes & Chemical</strong></td>
        <td class="text-center">{{systemMoneyFormat($issuedDyesChemicalQty,'',3)}}</td>
        <td class="text-center">Kg</td>
        <td class="text-right">{{systemMoneyFormat($dyesChemicalTotalCost/$model->workOrderItems->sum('qty'),'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($dyesChemicalTotalCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Overhead Cost</strong></td>
        <td class="text-center"></td>
        <td></td>
        <td class="text-right">{{systemMoneyFormat($postOverHeadCost,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($postOverHeadCost*$model->workOrderItems->sum('qty'),'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Commercial Cost</strong></td>
        <td class="text-center"></td>
        <td></td>
        <td class="text-right">{{systemMoneyFormat($postTotalCommercialCost/$model->workOrderItems->sum('qty'),'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($postTotalCommercialCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left"><strong>Other Cost</strong></td>
        <td class="text-center"></td>
        <td></td>
        <td class="text-right">{{systemMoneyFormat($postOtherCost,'$',2)}}</td>
        <td class="text-right">{{systemMoneyFormat($totalOtherCost,'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td class="text-left" colspan="4"><strong>Total Cost</strong></td>
        @php

            $sumOfGrayCost = $issuedQty*$grayCost;
            $sumOfDyesCost = $dyesChemicalTotalCost;
            $sumOfOverHedCost = $postOverHeadCost*$model->workOrderItems->sum('qty');
            $sumOfOtherCost = $totalOtherCost;

            $grandTotal = $sumOfGrayCost+$sumOfDyesCost+$sumOfOverHedCost+$postTotalCommercialCost+$sumOfOtherCost;
        @endphp
        <td class="text-right">{{systemMoneyFormat($grandTotal,'$',2)}}</td>
    </tr>

    <tr style="text-align: center">
        <td colspan="4" style="text-align: left"><strong>Profit/Loss</strong></td>
        <td class="text-right">{{systemMoneyFormat(($model->workOrderItems->sum('sub_total')-$grandTotal),'$',2)}}</td>
    </tr>
    <tr style="text-align: center">
        <td colspan="4" style="text-align: left"><strong>Profit/Loss Per Unit </strong></td>
        <td class="text-right">{{systemMoneyFormat(($model->workOrderItems->sum('sub_total')-$grandTotal)/$model->workOrderItems->sum('qty'),'$',2)}}</td>
    </tr>
</table>

