<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin-top: 1.20in;
            margin-bottom: 1.20in;
            header: page-header;
            footer: page-footer;
            background-image-resize: 6;
        }

        html, body, p {
            font-size: 10px !important;
            color: #000000;
        }

        table {
            width: 100% !important;
            border-spacing: 0px !important;
            margin-top: 10px !important;
            margin-bottom: 15px !important;
        }

        table caption {
            color: #000000 !important;
        }

        table td {
            padding-top: 1px !important;
            padding-bottom: 1px !important;
            padding-left: 7px !important;
            padding-right: 7px !important;
        }

        .table-non-bordered {
            padding-left: 0px !important;
        }

        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered td {
            border: 1px solid #000000;
            padding: 5px;
        }

        .table-bordered tr:first-child td {
            border-top: 0;
        }

        .table-bordered tr td:first-child {
            border-left: 0;
        }

        .table-bordered tr:last-child td {
            border-bottom: 0;
        }

        .table-bordered tr td:last-child {
            border-right: 0;
        }

        .mt-0 {
            margin-top: 0;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .image-space {
            white-space: wrap !important;
            padding-top: 45px !important;
        }

        .break-before {
            page-break-before: always;
            break-before: always;
        }

        .break-after {
            break-after: always;
        }

        .break-inside {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .break-inside-auto {
            page-break-inside: auto;
            break-inside: auto;
        }

        .space-top {
            margin-top: 10px;
        }

        .space-bottom {
            margin-bottom: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
<htmlpageheader name="page-header">
    {{--    <div class="row mb-3 print-header">--}}
    {{--        <div class="col-md-12" style="width: 100%;float:left;padding-top: 135px">--}}
    {{--            <h2><strong>{{ $title }}</strong></h2>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</htmlpageheader>

<htmlpagefooter name="page-footer">

    <table class="table-bordered">
        <tbody>
        <tr>
            <td colspan="2" style="text-align: right;border: none !important">
                <small>Page {PAGENO} of {nb}</small>
            </td>
        </tr>
        </tbody>
    </table>
</htmlpagefooter>
<div class="container">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td colspan="{{$gsmRanges->count()+1}}">
                <center>
                    <h3>TRU FABRICS LTD</h3>
                    <h6>Noapara, Tarabo, Rupgonj, Narayongon</h6>
                    <h3>Applicable for the Month of {{date('M y', strtotime($costingChart->date))}}</h3>
                </center>
            </td>
        </tr>
        <tr>
            <td style="width: 200px"><strong>Process Name</strong></td>

            @foreach($gsmRanges as $range)
                <td style="width: 150px!important;"><small>{{$range->min_value.'-'.$range->max_value}}</small></td>
            @endforeach
        </tr>

        @foreach($productionProcess as $process)
            <tr>
                <td>{{$process->name}}
                </td>
                @foreach($gsmRanges as $range)
                    <td>
                        <small>{{ $costingChart->costingChartItems->where('process_id', $process->id)->where('gsm_range_id', $range->id)->sum('value') }}</small>
                    </td>
                @endforeach
            </tr>
        @endforeach

        <tr>
            <td colspan="6">
                <h3>NOTE : ALL SPANDEX FABRICS EXTRA ADD WILL BE 2 TK</h3>
            </td>
        </tr>
        </tbody>
    </table>

    <table style="margin-top: 50px">
        <tbody>
        @include('ims::overheadCosting.authors')
        </tbody>
    </table>

</div>
</body>
</html>
