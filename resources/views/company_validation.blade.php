<!DOCTYPE html>
<html>
<head>

    <title>Laravel 6 Ajax Request example With Validation </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body>

<form action="" method="POST">
    <p id="message"></p>
    <p style="color:green" id="success"></p>

    <label class="field a-field a-field_a1">
    <input class="field__input a-field__input" placeholder="e.g. walton" id="name" name="name">
   
     <p class="name_error_text"></p>
  </label><br>
    <label class="field a-field a-field_a1">
    <input class="field__input a-field__input" placeholder="e.g. walton" id="address" name="address">

     <p class="address_error_text"></p>
  </label><br>
  <input type="button" value="Submit" id="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">
</form>


</body>

<script type="text/javascript">

   $(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     //Validation before submit
    $(".name_error_text").hide();
    $(".address_error_text").hide();

    var error_name = false;
    var error_address = false;

    $("#name").focusout(function () {
       check_name();
    });

    $("#address").focusout(function () {
       check_address();
    });

   function check_name(){
    $("#message").hide(); 
    var name_length = $("#name").val().length;
    if(name_length < 5){
         $(".name_error_text").html("Name should be atleat 5 characters");
         $(".name_error_text").show().addClass("danger");
         $("#message").hide();
         error_name = true;
      }else{
         $(".name_error_text").hide();
      }
    }

    function check_address(){
    $("#message").hide(); 
    var address_length = $("#address").val().length;
    if(address_length < 5){
         $(".address_error_text").html("Address should be atleast 5 characters");
         $(".address_error_text").show().addClass("danger");
         error_address = true;
         $("#message").hide();
      }else{
         $(".address_error_text").hide();
      }
    }

    //Submit Data
    $("#submit").click(function(e){

        e.preventDefault();

        var name = $("#name").val();
        var address = $("#address").val();
        var url = '{{ url('addcompany') }}';
        
    if (name.length < 5 || address.length < 5){

        check_name();
        check_address();
       
    }else {
 
        $.ajax({
           url:url,
           method:'POST',
           data:{
                  name:name, 
                  address:address
                },
           success:function(response){
              $("#success").html(response.message)
           },
        });
      }
   });

});
  
</script>
</html> 