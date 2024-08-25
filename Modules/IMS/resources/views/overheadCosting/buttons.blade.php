<div class="row pt-2 pl-3">
    @if(!isset($searchHide) || !$searchHide)
        <div class="col-md-4 pt-1 pl-0">
            <button class="btn btn-sm btn-block btn-success report-button" type="submit"><i class="mdi mdi-search-web"></i>&nbsp;Search</button>
        </div>
    @endif

    @if(!isset($clearHide) || !$clearHide)
        <div class="col-md-4 pt-1 pl-0">
            <a class="btn btn-sm btn-block btn-danger" href="{{ explode('?', $url)[0] }}"><i class="mdi mdi-reload"></i>&nbsp;Clear</a>
        </div>
    @endif

    <div class="col-md-{{ !(!isset($searchHide) || !$searchHide) ? 4 : 2 }} pt-1 pl-0">
        <button class="btn btn-sm btn-block btn-success" type="button" onclick="viewPDFReport('{{ isset($url) ? $url : '' }}')"><i class="mdi mdi-file-pdf-box"></i>&nbsp;PDF</button>
    </div>

</div>

