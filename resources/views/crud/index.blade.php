@extends('layout.php');
@section('content')
     <div class="container">
	   <div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" style="color:red" id="createCrud">Add Crud</a>

				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Address</th>
							<th width="200px">Action</th>
						</tr>
					</thead>
					<tbody>

					</tbody>

				</table>

				@includ('crud.modal')
			</div>
		</div>
	   </div>
	 </div>

@endsection

@push('ajax_crud')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/ajax.js"></script>