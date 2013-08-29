<!DOCTYPE html>
<html lang = "en">
<body>

<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>	

<form id = "refsubs_a">	

<legend><a href="<?php echo site_url('inventory/refSublist'); ?>">Reference Substances List</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Reference Substance</span>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd_i"; ?>">Add Reference Substance to Inventory</a></legend>

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "name">Name</label></td>
			<td>
			<input type = "text" name ="name" class = "validate[required]"/>
			</td>
			<!--td><label for = "s_type">Standard Type</label></td>
			<td>
			<select name ="s_type" class ="validate[required">
			<option id ="" selected ></option>
			<option id ="WRS" value ="Working" >Working</option>
			<option id ="PRS" value ="Primary" >Primary</option>
			</select>
			</td-->
		</tr>
		<tr>
			<td><input name ="save" type = "submit" value = "Save" class = "submit-button"/></td>
		</tr>
	</tbody>
</table>
</form>
</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	

});

$("#refsubs_a").validationEngine();


$('#refsubs_a').submit(function(e){
	e.preventDefault();
var name = $("#refsubs_a").find('input').filter(function(){
return this.value === "";
});

var s_type = $("#refsubs_a").find('select').filter(function(){
return this.value === "";
});

if (name.length || s_type.length ) {

alert(s_type.length);

}

else {

	$.ajax({
		type: 'POST',
		url: 'refSub_save/',
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