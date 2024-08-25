<table class="table table-bordered table-striped table-hover">
    <tbody>
    <tr>
        <td>{{translate('Date')}}:</td>
        <td>{{date('d M Y', strtotime($costingChart->date))}}</td>
    </tr>

    </tbody>
</table>
<table class="table table-bordered" style="width: 100% !important;overflow: auto !important">
    <thead>
    <tr class="text-center">
        <th style="width: 200px">Process Name</th>
        @foreach($gsmRanges as $range)
            <th style="width: 150px!important;"><small>{{$range->min_value.'-'.$range->max_value}}</small></th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($productionProcess as $process)
        <tr>
            <td>{{$process->name}}
                <input type="hidden" name="process_id[]"
                       value="{{$process->id}}">
            </td>
            @foreach($gsmRanges as $range)

                <td>
                    <small>{{ $costingChart->costingChartItems->where('process_id', $process->id)->where('gsm_range_id', $range->id)->sum('value') }}</small>
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>

    <div class="row mt-3">
        <div class="col-md-12">
            <table>
                <tbody>
                <tr>
                    <td><strong>Remarks:</strong></td>
                </tr>
                <tr>
                    <td>
                        <p>{{ $costingChart->remarks }}</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="table mt-5">
        <tbody>
        @include('ims::overheadCosting.authors')
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-8 pl-3">
            <div class="row">
                <div class="col-md-3 pt-2">
                    <a class="btn btn-sm btn-block btn-success mt-1"
                       href="{{ url('admin/overhead-costings/'.$costingChart->id.'?print') }}" target="_blank"><i
                            class="mdi mdi-printer"></i>&nbsp;Print</a>
                </div>
                <div class="col-md-9">
                    @include('ims::overheadCosting.buttons', [
                        'title' => $title,
                        'url' => url('admin/overhead-costings/'.$costingChart->id),
                        'searchHide' => true,
                        'clearHide' => true,
                    ])
                </div>
            </div>
        </div>
    </div>

</table>
