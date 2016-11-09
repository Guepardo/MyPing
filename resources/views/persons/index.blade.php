@extends('layouts.master')

@section('title', 'Team')

@section('content')
<div class="container-fluid">
	<div class="block-header">
		<h2>Persons</h2>
	</div>

	<!-- Basic Examples -->
	<div class="row clearfix" id="body">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					
					{{-- Buttons --}}

					<button type="button" class="btn btn-success waves-effect btn-lg" v-on:click="newRegister">New Person</button>


					{{-- Buttons-end --}}
				</div>

				<div class="body">
					<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Created At</th>
								<th>Updated At</th>
								<th>Watching Sites</th>
								<th>Action</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Created At</th>
								<th>Updated At</th>
								<th>Watching Sites</th>
								<th>Action</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>

							@foreach($persons as $p)
							<tr>
								<td>{{ $p->id }}</td>
								<td>{{ $p->name}}</td>
								<td>{{ $p->created_at}}</td>
								<td>{{ $p->updated_at}}</td>
								<td>{{ count($p->sites) }}</td>

								<td>
									<a  v-on:click="editRegister({{$p->id}})" >
										<i class="material-icons">edit</i>
									</a>
								</td>
								
								<td>
									<a href="{{ '/p/delete/'.$p->id}}">
										<i class="material-icons">clear</i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{{-- Info for delete action  --}}
					@if (session('status'))
					<div class="alert alert-warning">
						{{ session('status') }}
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
				<h4 class="modal-title" id="defaultModalLabel">New Person</h4>
			</div>
			{{-- Form --}}

			<form v-on:submit.stop.prevent="register" id="form" >
				{{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}

				<div class="col-sm-12" style="padding:25px">
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="name" v-model="name" class="form-control" placeholder="Name" />
						</div>
					</div>
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="telegram_id" v-model="telegram_id" class="form-control" placeholder="Telegram Id" />
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
				</div>
			</form>
			{{-- Form-end --}}
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

<!-- Custom Css -->
<link href="css/style.css" rel="stylesheet">

<!-- Sweetalert Css -->
<link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.5/vue.js"></script>

<script type="text/javascript">
	//handle form
	// $('#form').submit(function(event){
	// 	var data = $(this).serializeArray(); 
		
	// 	$.post('/p/create',data). 
	// 	done(function(data){
	// 		swal({
	// 			title: 'Success!', 
	// 			text : 'Registred', 
	// 			type : 'success'
	// 		});

	// 		setTimeout(function(){
	// 			location.reload(); 
	// 		},1500); 

	// 	}).fail(function(data){
	// 		swal("Fail Alert!", "No hope");
	// 	})

	// 	event.preventDefault();
	// }); 


	var modal   = new Vue({
		el: '#novo_site', 

		data: {
			// person: {}, 
			name : '', 
			telegram_id: '', 
			id: -1
		}, 

		methods:{
			register: function(){
				var data = $('#form').serializeArray(); 
		
				$.post('/p/create',data). 
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
				}); 
			}, 

			populateModal: function(id){
				var self = this; 

				$.get('/p/get/'+ id).
				done(function(data){
					console.log(data); 
					if(data.status){
						self.name        = data.msg.name; 
						self.telegram_id = data.msg.telegram_id; 
						self.id    	     = data.msg.id; 
						$('#novo_site').modal({show : true}); 
					}
				}); 

			}
		}
	}); 

	var buttons = new Vue({
		el: '#body', 

		data:{

		},

		created: function(){

		}, 

		methods:{
			newRegister: function(){
				$('#novo_site').modal({show : true});  
			}, 

			editRegister: function(id){
				modal.populateModal(id); 
			}
		}
	}); 
</script>

@stop