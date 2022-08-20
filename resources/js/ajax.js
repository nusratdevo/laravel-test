$(document).ready(function(){
   
	$.ajaxSetup({
       header:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});

  get_company_data();

  //get all company data

  function get_company_data(){
	$.ajax({
         url:'{{route("data")}}',
		 type: 'GET',
		 success:function(data){
			table_data_row(data.data);
		 }
	});
  }

  //Company Table Data
function table_data_row(data){
	var rows = '';
	$.each(data, function(key, value){
		rows = rows+'<tr>';
		rows = rows+ '<td>'+value.name+'</td>';
		rows = rows+ '<td>' +value.address+ '</td>';
		rows =rows + '<td data-id= "' +value.id+ '">';
		rows = rows+ '<a class="btn btn-sm btn-outline-danger py-0" id="editCompnay" data-id="'+value.id+'" data-toggle="modal" data-target="#modal-id">EDIT</a>';
		rows = rows+ '<a class="btn btn-sm btn-outline-danger py-2" id="deleteCompany" data-id ="'+value.id+'">DELETE</a>';
		rows = rows+'</td>';
		rows = rows+'</tr>';

	});

	$('tbody').html(rows);

}
//insert compny
  $('body').on('click', '#createNewCompany', function(e){

	e.preventDefault;
	$('#userCrudModal').html('Create Modal');
	$('#submit').val('Create Company');
	$('#modal-id').modal('show');
	$('#company_id').val('');
	$('#companydata').trigger('reset');

  });
     //Save Data into database
     $('body').on('click', '#submit', function(event){
       event.preventDefault();
	   var id = $('#company_id').val();
	   var name = $('#name').val();
	   var address = $('#address').val();

	   $.ajax({
      url:'{{route("store")}}',
	  type:'post',
	  dataType:'JSON',
	  data:{id:id,name:name,address:address},
	  success:function(data){
       $('#copanydata').trigger('reset');
       $('#modal-id').modal('hide');
	   Swal.fire({
		position:'top-end',
		icon:'success',
		title:'Success',
		showConfirmButton:false,
		timer:1500
	   })
	   get_company_data()
	  },
	  error:function(data){
		console.log('Error');
	  }
	   });
	 });

  //Edit Modal
  $("body").on('click', '#editCompany', function(event){
        var id = $(this).data('id');
		$.ajax({
           url:'{{route("company.update")}}',
		   type:'get',
            data:{id:id},
			success:function(data){
				$('#userCrudModal').html('EditModal');
				$('$submit').val('Edir Company');
				$('#modal-id').modal('show');
				$('#copmant_id').val('data.data.id');
				$('#name').val(data.data.name);
				$('#address').val('data.data.address');
			}
		});
  });

/// delete Company
$('body').on('click', '#deleteCompany',function(event){
   if(!confirm('DO YOU really Delete this')){
	return false;
   }

   event.preventDefault();
   var id =$(this).attr('data-id');
   $.ajax({
    url: 'url("/addcomapny")',
	type:'DELETE',
	data:{
		id:id
	},
	success:function(response){
		Swal.fire(
			'Remind!', 'Company Deleted','success'
		)
		gete_compay_data()
	}
   });
   return false;
});


});