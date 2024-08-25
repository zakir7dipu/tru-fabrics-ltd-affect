<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin-top: 1.3in;
            margin-bottom: 0.5in;
            header: page-header;
            footer: page-footer;
            background-image-resize: 6;
        }

        html, body, p {
            font-size: 12px !important;
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

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }
    </style>
</head>

<body>
<htmlpageheader name="page-header">
    <div class="row mb-3 print-header">
        <div class="col-md-8" style="width: 70%;float:left;padding-top: 20px">
            <h2><strong>{{ $title }}</strong></h2>
            <p>
                <strong>TRU FABRICS LTD</strong>
                <br>
                House # 15/B, Road # 08, Gulshan-1, Dhaka-1212, Bangladesh.
                <br>
                {{isset($datePeriod)?$datePeriod:''}}
            </p>
        </div>
        <div class="col-md-4 text-right" style="width: 30%;float:left;padding-top: 30px">
            <img src="{{ websiteSettings()->default_user_cover }}" alt="logo"
                 style="float: right !important;height: 15mm; width:  35mm; margin: 0;background: white!important;"/>
        </div>
    </div>
</htmlpageheader>

<htmlpagefooter name="page-footer">
    <table class="table-bordered">
        <tbody>
        <tr>
            <td style="border: none !important;width: 80%">{{ $title }} Printed by <strong>{{ auth()->user()->name  }}</strong></td>
            <td style="text-align: right;border: none !important;width: 20%">
                <small>Page {PAGENO} of {nb}</small>
            </td>
        </tr>
        </tbody>
    </table>
</htmlpagefooter>

<div class="container">
    @yield('content')
</div>
</body>
</html>
