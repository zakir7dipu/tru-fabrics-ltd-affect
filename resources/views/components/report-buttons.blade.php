<div class="row pt-2 pl-3">
    @if(!isset($searchHide) || !$searchHide)
        <div class="col-md-4 pt-1 pl-0">
            <button class="btn btn-sm btn-block btn-success report-button" type="submit"><i
                    class="mdi mdi-search-web"></i>&nbsp;Search
            </button>
        </div>
    @endif

    @if(!isset($clearHide) || !$clearHide)
        <div class="col-md-4 pt-1 pl-0">
            <a class="btn btn-sm btn-block btn-danger" href="{{ explode('?', $url)[0] }}"><i class="mdi mdi-reload"></i>&nbsp;Clear</a>
        </div>
    @endif

    <div class="col-md-{{ !(!isset($searchHide) || !$searchHide) ? 4 : 2 }} pt-1 pl-0">
        <button class="btn btn-sm btn-block btn-success" type="button"
                onclick="viewPDFReport('{{ isset($url) ? $url : '' }}')"><i class="mdi mdi-file-pdf-box"></i>&nbsp;PDF
        </button>
    </div>

    @php
        $normalExcel = isset($normalExcel) && $normalExcel ? true : false;
    @endphp
    @if($normalExcel)
        <div class="col-md-{{ !(!isset($searchHide) || !$searchHide) ? 4 : 2 }} pt-1 pl-0">
            <button class="btn btn-sm btn-block btn-primary" type="button"
                    onclick="viewExcelReport('{{ isset($url) ? $url : '' }}')"><i class="mdi mdi-file-excel"></i>&nbsp;Excel
            </button>
        </div>
    @else
        <div class="col-md-{{ !(!isset($searchHide) || !$searchHide) ? 4 : 2 }} pt-1 pl-0">
            <button class="btn btn-sm btn-block btn-primary" type="button"
                    onclick="exportReportToExcel('{{ $title }}')"><i class="mdi mdi-file-excel"></i>&nbsp;Excel
            </button>
        </div>
    @endif

</div>

@section('javascript')
    <script type="text/javascript">

        $(document).ready(function () {
            var form = $('#report-form');
            var button = $('.report-button');

            var from = "{{ request()->has('from') }}";
            if (from === 1) {
                loadReport(form, button);
            }

            form.on('submit', function (e) {
                form.attr('formtarget', '_parent');
                e.preventDefault();

                loadReport(form, button)
            });
        });

        function loadReport(form, button) {
            $('#report_type').val('report');

            button.prop('disabled', true).html('<i class="mdi mdi-spin"></i>&nbsp;Please Wait...');
            $('.report-view').html('<h3 class="text-center"><strong>Please Wait...</strong></h3>').show();
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serializeArray(),
            })
                .done(function (response) {
                    button.prop('disabled', false).html('<i class="la la-search"></i>&nbsp;Search');
                    $('.report-view').html(response);
                })
                .fail(function (response) {
                    button.prop('disabled', false).html('<i class="la la-search"></i>&nbsp;Search');
                    $('.report-view').html(response).hide();
                });
        }
    </script>
@endsection

