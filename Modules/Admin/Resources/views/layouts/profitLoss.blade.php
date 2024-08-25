@php
    $sumOfGrayCost = $issuedQty*$grayCost;
    $sumOfOverHedCost = $postOverHeadCost*$model->workOrderItems->sum('qty');
    $grandTotal = $sumOfGrayCost+$dyesChemicalTotalCost+$sumOfOverHedCost+$postTotalCommercialCost+$totalOtherCost;

    $label = ['Gray','Dyes & Chemical','Overhead Cost','Commercial Cost','Other Cost'];
    $labelAmount = [
        $sumOfGrayCost,
        $dyesChemicalTotalCost,
        $sumOfOverHedCost,
        $postTotalCommercialCost,
        $totalOtherCost,
    ];
@endphp

<div class="row">
    <div class="col-md-5">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="mdi mdi-pulse widget-icon"></i>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Greige Stock Position">
                    Profit/Loss On Sale
                </h5>
                <p class="mb-0 text-muted">
                    <span class="text-success me-2 font-18">
                        <i class="mdi mdi-currency-usd"></i>
                        <strong> {{systemMoneyFormat(($model->workOrderItems->sum('sub_total')-$grandTotal),'$')}}</strong>
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-7" id="profitChart">

    </div>
</div>

<script src="{{ url('backend') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script type="text/javascript">
    var options = {
        series: <?php echo json_encode($labelAmount); ?>,
        chart: {
            width: 380,
            type: 'pie',
        },
        labels: <?php echo json_encode($label); ?>,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#profitChart"), options);
    chart.render();
</script>
