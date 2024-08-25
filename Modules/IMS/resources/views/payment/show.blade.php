<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Title')}}:</td>
                <td>{!!  $paymentTerm->title !!}</td>
            </tr>

            <tr>
                <td>{{translate('Percentage')}}:</td>
                <td> {!!  $paymentTerm->percentage !!}</td>
            </tr>
            <tr>
                <td>{{translate('Days')}}:</td>
                <td> {!!  $paymentTerm->days !!}</td>
            </tr>
            <tr>
                <td>{{translate('Type')}}:</td>
                <td> {!!  $paymentTerm->type !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst( $paymentTerm->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
