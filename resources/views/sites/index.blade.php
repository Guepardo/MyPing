@extends('layouts.master')

@section('title', 'Sites')

@section('content')
<div class="container-fluid">
	<div class="block-header">
		<h2>SITES</h2>
	</div>

	<!-- Basic Examples -->
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					
					{{-- Buttons --}}

					<button type="button" class="btn btn-success waves-effect btn-lg" data-toggle="modal" data-target="#novo_site">New Watch</button>


					{{-- Buttons-end --}}
				</div>

				<div class="body">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Created At</th>
								<th>Last Watch</th>
								<th>Periodicity</th>
								<th>Next Verification At</th>
								<th>Action</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Created At</th>
								<th>Last Watch</th>
								<th>Periodicity</th>
								<th>Next Verification At</th>
								<th>Action</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
					
							@foreach($sites as $s)
							<tr>
								<td>{{ $s->id }}</td>
								<td>{{ $s->label}}</td>
								<td>{{ $s->created_at}}</td>
								<td>{{ $s->last_seen or 'Not Watched Yet'}}</td>
								<td>{{ $s->priority->label}}</td>
								<td>{{ $s->next_verification}}</td>

								<td>
									<i class="material-icons">edit</i>
								</td>
								
								<td>
									<a href="{{ '/v/delete/'. $s->id}}">
									<i class="material-icons">clear</i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{-- Info for delete action --}}
					@if(session('status'))
						<div class="alert alert-warning">
							{{session('status')}}
						</div>
					@endif
					{{-- Info for delete action --}}
				</div>
			</div>
		</div>
	</div>
	<!-- #END# Basic Examples -->
</div>

{{-- Modal --}}
<!-- Modal Size Example -->
<div class="modal fade" id="novo_site" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">New Watch</h4>
			</div>
			{{-- Form --}}

			<form id="form" >
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="col-sm-12" style="padding:25px">
				<div class="form-group">
					<div class="form-line">
						<input type="text" name="label" class="form-control" placeholder="Label (nome curto do site)" />
					</div>
				</div>
				<div class="form-group">
					<div class="form-line">
						<input type="text" name="url" class="form-control" placeholder="Url (link para acesso do sistema)" />
					</div>
				</div>

				<p>
					<b>Watcher Periodicity</b>
				</p>
				<select class="form-control show-tick" name="priority_id">
					@foreach($priorities as $p )
						<option value="{{ $p->id}}"> {{$p->label}}</option>
					@endforeach
				</select>

				<hr>
				
				<p>
					<b>Who will be notified by Watcher</b>
				</p>
				<select class="form-control show-tick" multiple name="persons_id">
					@foreach($persons as $p)
						<option value="{{ $p->id}}"> {{$p->name}}</option>
					@endforeach

					@if(count($persons) <= 0)
						<option selected>Register a person fisrt</option>
					@endif
				</select>
			</div>
			
			{{-- Form-end --}}
			<div class="modal-footer">
				<button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- #END# Modal Size Example -->
{{-- Modal-end --}}
@stop

@section('css')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="plugins/animate-css/animate.css" rel="stylesheet" />

<!-- Preloader Css -->
<link href="plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />

<!-- Morris Chart Css-->
<link href="plugins/morrisjs/morris.css" rel="stylesheet" />

<!-- JQuery DataTable Css -->
<link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- Bootstrap Select Css -->
<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<!-- Sweetalert Css -->
<link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

<!-- Custom Css -->
<link href="css/style.css" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="css/themes/all-themes.css" rel="stylesheet" />
@stop

@section('js')
<!-- Jquery Core Js -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/pages/tables/jquery-datatable.js"></script>

<!-- Demo Js -->
<script src="js/demo.js"></script>

<script type="text/javascript">
		//handle form
	$('#form').submit(function(event){
		var data = $(this).serializeArray(); 
		
		$.post('/v/create',data). 
		done(function(data){
			 swal({
			 	title: 'Success!', 
			 	text : 'Registred', 
			 	type : 'success'
			 });

			 setTimeout(function(){
			 	location.reload(); 
			 },1500); 

		}).fail(function(data){
			 swal("Fail Alert!", "No hope");
		})

		event.preventDefault();
	})	
</script>
@stop