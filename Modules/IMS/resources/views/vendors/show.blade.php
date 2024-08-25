<div class="form-group row">
    <div class="col-md-12">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <td>{{translate('Name')}}:</td>
                <td>{!!  $vendor->name !!}</td>
            </tr>

            <tr>
                <td>{{translate('Phone')}}:</td>
                <td> {!!  $vendor->phone !!}</td>
            </tr>
            <tr>
                <td>{{translate('Email')}}:</td>
                <td> {!!  $vendor->email !!}</td>
            </tr>
            <tr>
                <td>{{translate('Mobile No')}}:</td>
                <td> {!!  $vendor->mobile_no !!}</td>
            </tr>

            <tr>
                <td>{{translate('Trade License')}}:</td>
                <td> {!!  $vendor->trade !!}</td>
            </tr>
            <tr>
                <td>{{translate('Tin No')}}:</td>
                <td> {!!  $vendor->tin !!}</td>
            </tr>
            <tr>
                <td>{{translate('Website')}}:</td>
                <td> {!!  $vendor->website !!}</td>
            </tr>
            <tr>
                <td>{{translate('Agreement')}}:</td>
                <td> {!!  $vendor->agreement !!}</td>
            </tr>
            <tr>
                <td>{{translate('Term conditions')}}:</td>
                <td> {!!  $vendor->term_conditions !!}</td>
            </tr>
            <tr>
                <td>{{translate('Address')}}:</td>
                <td> {!!  $vendor->address !!}</td>
            </tr>
            <tr>
                <td>{{translate('Status')}}:</td>
                <td> {{ ucfirst( $vendor->status) }}</td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
