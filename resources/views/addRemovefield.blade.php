<!DOCTYPE html>
<html>
<head>
    <title>Laravel - Dynamically Add or Remove input fields using JQuery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>


<div class="container">
    <h2 align="center">Laravel - Dynamically Add or Remove input fields using JQuery</h2>  
    <div class="form-group">
         <form name="add_name" id="add_name">  


            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>


            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>


            <div class="table-responsive">  
                <table class="table table-bordered" id="dynamic_field">  
                    <tr>  
                        <td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td>  
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                    </tr>  
                </table>  
                <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
            </div>


         </form>  
    </div> 
</div>
 <script type="text/javascript">
 $(document).ready(function(){
	var postURL = "<?php echo url('addmore');?>"
	var i =1;

	$('#add').click(function(){
     i++
	 $('$dynamic_field').append('<tr id="row'+i+'" class="dynamic_added"><td><input type="text" name="name[]" class="form-control name_list"/></td><td><button id="'+i+'" name="remove" class="btn btn-danger btn-remove">X</button><td/></tr>')
	});
     $(document).on('click', '.btn_remove', function(){
		var but_id = ($this).attr('id');
		$('#row'+btn_id+'').remove();
	 });

	 $.ajaxSetup({
       header:{
		'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
	 });

      $('#submit').click(function(){
		$ajax({
         url:postURL,
		 type:"POST",
		 data:$('#add_name').serialize(),
		 success:function(data){
			if(data.error){
				printErrorMsg(data.error);
			}else{
				i=1;
				$('.dynamic_field').remove();
				$('#add_name')[0].reset();
				$('.print-success-msg').find('ul').html('');
				$('.prin-eror-msg').css('display', 'none');
				$('.print-error-msg').find('ul').append('<li>Record inserted successfully</li>')
			}
		 }
		});

		function printErrorMsg(msg){
			$('.prit-error=msg').find('ul').html('');
			$('.print-error-msg').css('dislpay', 'block');
			$('.print-success-msg').css('display', 'none');
			$.each('msg', function(key, value){
             $('.print-error-msg').find('ul').append('<li>' +value+ '</li>');
			});
		}
	  })




 });

 </script>


</body>
</html>