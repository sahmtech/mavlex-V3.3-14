@extends('layouts.app')
@section('title', __( 'connector::lang.clients' ))

@section('vue')
<!-- Content Header (Page header) -->
<div class="main-container no-print">
                
				<!-- Sub Menu -->
				<div class="horizontal-scroll">
				@include('connector::layouts.nav')
				</div>
				<!-- Card Wrapper for dashboard content -->
				<div class="card-wrapper">
        <div class="overview-filter">
            <div class="title">
				<h1>
    	@lang('connector::lang.clients')
    	<small>@lang('business.dashboard')</small>
    </h1>
            </div>
            <div class="new-user">
            <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-toggle="modal" 
                    data-target="#create_client_modal">
                    <i class="fas fa-plus"></i> @lang( 'connector::lang.create_client' )</button>
            </div>
        </div>
@if(empty($is_demo))
<section class="content">
	@component('components.widget', ['class' => 'box-solid', 'title' => __( 'connector::lang.clients' )])

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="clients_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>@lang( 'user.name' )</th>
                        <th>@lang( 'connector::lang.client_secret' )</th>
                        <th>@lang( 'messages.action' )</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($clients as $client)
                		<tr>
                			<td>{{$client->id}}</td>
                			<td>{{$client->name}}</td>
                			<td>{{$client->secret}}</td>
                			<td>{!! Form::open(['url' => action([\Modules\Connector\Http\Controllers\ClientController::class, 'destroy'], [$client->id]), 'method' => 'delete', 'id' => 'create_client_form' ]) !!}<button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> @lang( 'messages.delete' )</button>{!! Form::close() !!}</td>
                		</tr>
                	@endforeach
                </tbody>
            </table>
        </div>
    @endcomponent
</section>
@else
<section>
    <div class="col-md-12 text-danger">
        <br/>
        @lang('lang_v1.disabled_in_demo')
    </div>
</section>
@endif



<!-- Create Client Modal -->
<div class="modal fade" id="create_client_modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action([\Modules\Connector\Http\Controllers\ClientController::class, 'store']), 'method' => 'post', 'id' => 'create_client_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'connector::lang.create_client' )</h4>
    </div>

    <div class="modal-body">

      <div class="form-group">
    {!! Form::label('name', __( 'user.name' ) . ':*') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'user.name' ) ]) !!}
  </div>

  @if(auth()->user()->can('superadmin'))
  <div class="form-group">
    {!! Form::label('business_id', __('business.business') . ':*') !!}
    {!! Form::select('business_id', $businesses, null, ['class' => 'form-control select2', 'required', 'placeholder' => __('messages.please_select')]) !!}
  </div>
  @endif
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
        </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
	$(document).ready( function(){
		clients_table = $('#clients_table').DataTable();
	});
</script>
@endsection