<div class="btn-group mt-2" style="width: 100%">
    <a style="width: 20%" class="btn btn-md btn-success" title="Search" onclick="$('#type').val('search');$('#report-form').attr('target', '_parent');$('#report-form').submit()">
        <i class="mdi mdi-search-web"></i>
    </a>
    <a style="width: 20%" class="btn btn-md btn-info" title="Print" onclick="$('#type').val('print');$('#report-form').attr('target', '_blank');$('#report-form').submit()">
        <i class="mdi mdi-cloud-print"></i>
    </a>
    <a style="width: 20%" class="btn btn-md btn-primary" title="PDF" onclick="$('#type').val('pdf');$('#report-form').attr('target', '_parent');$('#report-form').submit()">
        <i class="mdi mdi-file-pdf-box"></i>
    </a>
    <a style="width: 20%" class="btn btn-md btn-dark" title="Excel" onclick="$('#type').val('excel');$('#report-form').attr('target', '_parent');$('#report-form').submit()">
        <i class="mdi mdi-file-excel"></i>
    </a>
    <a style="width: 20%" class="btn btn-md btn-danger" title="Reset" href="{{ $url }}">
        <i class="mdi mdi-lock-reset"></i>
    </a>
</div>