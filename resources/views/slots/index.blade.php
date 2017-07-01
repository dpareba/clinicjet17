@extends('layouts.master')
@section('title')
| Today's Appointments
@stop
@section('pageheading')
Today's Tokens		
@stop
@section('subpageheading')
View/Search Patients with Token Numbers
@stop
@section('content')
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
				<li><a href="#timeline" data-toggle="tab">Timeline</a></li>
				<li><a href="#settings" data-toggle="tab">Settings</a></li>
			</ul>
		</div>
	</div>
</div>
@stop
{{-- .row --}}
