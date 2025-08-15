@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | Business')

@section('content')<div class="main-container no-print">
                
    <!-- Sub Menu -->
   
    <div class="horizontal-scroll">
    @include('superadmin::layouts.nav')
    </div>
    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
    
    <!-- Content Header (Page header) -->
    <div class="overview-filter">
    <div class="title">
    <h1>@lang( 'superadmin::lang.all_business' )

    </h1>
		<p>@lang( 'superadmin::lang.manage_business' )</p>
	</div>
    <div class="filter">
                <div class="new-user">
                <a href="{{action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'create'])}}" 
                    class="btn btn-block btn-primary">
                	<i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                </div>
                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
    </div>
            
    </div>
    @component('components.filters', ['title' => __('report.filters')])
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('package_id',  __('superadmin::lang.packages') . ':') !!}
                {!! Form::select('package_id', $packages, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('subscription_status',  __('superadmin::lang.subscription_status') . ':') !!}
                {!! Form::select('subscription_status', $subscription_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('is_active',  __('sale.status') . ':') !!}
                {!! Form::select('is_active', ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('last_transaction_date',  __('superadmin::lang.last_transaction_date') . ':') !!}
                {!! Form::select('last_transaction_date', $last_transaction_date, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('no_transaction_since',  __('superadmin::lang.no_transaction_since') . ':') !!}
                {!! Form::select('no_transaction_since', $last_transaction_date, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); !!}
            </div>
        </div>
    @endcomponent
<!-- Main content -->
<section class="content">
   
	<div class="box box-solid">
        <div class="box-body">
            @can('superadmin')
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="superadmin_business_table">
                        <thead>
                            <tr>
                                <th>
                                    @lang('superadmin::lang.registered_on')
                                </th>
                                <th>@lang( 'superadmin::lang.business_name' )</th>
                                <th>@lang('business.owner')</th>
                                <th>@lang('business.email')</th>
                                <th>@lang('superadmin::lang.owner_number')</th>
                                <th>@lang( 'superadmin::lang.business_contact_number' )</th>
                                <th>@lang('business.address')</th>
                                <th>@lang( 'sale.status' )</th>
                                <th>@lang( 'superadmin::lang.current_subscription' )</th>
                                <th>@lang( 'business.created_by' )</th>
                                <th>@lang( 'superadmin::lang.action' )</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            @endcan
        </div>
    </div>

</section>
<!-- /.content -->
    </div>
    </div>
    
@endsection

@section('javascript')

<script type="text/javascript">
    $(document).ready( function(){
        superadmin_business_table = $('#superadmin_business_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index'])}}",
                data: function(d) {
                    d.package_id = $('#package_id').val();
                    d.subscription_status = $('#subscription_status').val();
                    d.is_active = $('#is_active').val();
                    d.last_transaction_date = $('#last_transaction_date').val();
                    d.no_transaction_since = $('#no_transaction_since').val();
                },
            },
            aaSorting: [[0, 'desc']],
            columns: [
                { data: 'created_at', name: 'business.created_at' },
                { data: 'name', name: 'business.name' },
                { data: 'owner_name', name: 'owner_name', searchable: false},
                { data: 'owner_email', name: 'u.email' },
                { data: 'contact_number', name: 'u.contact_number' },
                { data: 'business_contact_number', name: 'business_contact_number' },
                { data: 'address', name: 'address' },
                { data: 'is_active', name: 'is_active', searchable: false },
                { data: 'current_subscription', name: 'p.name' },
                { data: 'biz_creator', name: 'biz_creator', searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        $('#package_id, #subscription_status, #is_active, #last_transaction_date, #no_transaction_since').change( function(){
            superadmin_business_table.ajax.reload();
        });
    });
    $(document).on('click', 'a.delete_business_confirmation', function(e){
        e.preventDefault();
        swal({
            title: LANG.sure,
            text: "Once deleted, you will not be able to recover this business!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>

@endsection