<!DOCTYPE html>
<html lang = "en">
<body>
<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>	

<form id ="reagents">

<legend><a href="<?php echo site_url()."inventory/reagentlist"; ?>">Reagents List</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Reagents</span>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/reagentsadd";?>">Add Reagents to Inventory</a></legend>

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "Name">Name</label></td>
			<td><input name ="name" type = "text" class ="validate[required]" placeholder ="e.g Paracetamol" /></td>
			<!--td><label for = "description">Description</label></td>
			<td><textarea name ="description" type = "text" class ="validate[required]" placeholder ="e.g One Litre Bottles" ></textarea></td-->
		</tr>
		<tr>
			<td><input name ="save" type = "submit" value = "Save" class = "submit-button"/></td>
		</tr>
	</tbody>	
	
</table>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){

});

$("#reagents").validationEngine();

$('input[name*="date"]').datepicker({
	changeYear:true,
	dateFormat:"yy-mm-dd"
});



$('#reagents').submit(function(e){
	e.preventDefault();
var inputs = $("#reagents").find('input').filter(function(){
return this.value === "";
});

if (inputs.length) {

//alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: 'reagent_save/',
		data: $('form').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');

				$('form').each(function(){

					this.reset();
				})
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

}

})

</script>

</body>
</html>