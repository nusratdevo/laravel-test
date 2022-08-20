

<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	//fetch all student
	fetchstudent();
	function fetchstudent(){
		$.ajax({
          url:"/fetch-students",
		  type:"GET",
		  dataType:"json",
		  success:function(response){
			//consol.log(response)
			$('tbody').html('');
			$.each('respnse.student',function(key,value){
               $('tbody').append('<tr><td>' +value.id+ 
				                 '</td><td>'  +value.name+
								  '</td><td>'   +value.course+
								  '</td><td>' +value.email+
								  '</td><td>' +value.phone+
								  '</td></tr>'
                                 
			   
			   );
			});

		  }
		});
	}


	$(document).on('click','.add-student', function(e){
		e.preventDefault();
		$(this).text("sending...");
		var data ={
             'name':$('.name').val(),
			 'course':$('.course').val(),
			 'email':$('.email').val(),
			 'phone':$('.phone').val()
		} 
		$.ajaxSetup({
			'headers':{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
          url:"/students",
		  type:"POST",
		  data:data,
		  dataType:"json",
		  success:function(response){
			//consol.log(response)

			if(response.status == 400){
				$("#save-magList").html("");
				$("#save-magList").addClass("alert alert-danger");

				$.each(response.error, function(key, err){
                  $('$save-magList').append('<li>' + err+ '</li>');
				});
				$('.add-student').text('save');
			}else{
				$('#success').addClass('alert alert-succss');
				$('#success').text('response.message');
				$('#addSudentModal').find('input').val('');
				$("#add-student").text('save');
				$("#addStudentModal").modal('hide');
				fetchStudent();

			}
		  }
		});

	});

	//edit function
	$(document).on('click','.edit-btn',function(e){
       e.preventDefault();
	   var id = #(this).val();
	   //alert(id);
	   $('#modal').modal('show');
	   $.ajax({
        url:"edit-student/"+id,
		type:"GET",
		success:function(respone){
			if(response.status == 404){
				$('#success-message').text('response.message');
				$("#edit-modal").modal('hide');
			}else{
				$("#name").val(response.student.name);
				$("#course").val(response.student.course);
				$("#email").val(response.student.email);
				$("#phone").val(response.student.phone);
				$("stu_id").val(response.student.id);
			}
		}
	   });
	});

});

</script>