<!DOCTYPE html>
<html lang = "en">
<body>
<div class = "content">

<hr id ="line1" class = "hidden2">

<div class = "content2">

<div id = "add_success" class ="hidden2" ><span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span><!--span class ="smalltext misc-title" >&nbsp;Successfully Added</span--></div>	

<form id ="reagents">

<legend><a href="<?php echo site_url()."inventory/reagentslist"; ?>">Reagents Inventory</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Add Reagents to Inventory</span>&nbsp;|&nbsp;
<a href="<?php echo site_url()."inventory/reagentadd";?>">Add Reagents</a>
</legend>

<table>
	<tr><td colspan = 4><hr></td></tr>
	<thead></thead>
	<tbody>
		<tr>
			<td><label for = "Name">Name</label></td>
			<td><select name ="name" class ="validate[required]">
				<option value = "" ></option>
				<?php foreach($rgs as $rg){?>
				<option value = "<?php echo $rg -> name  ?>" ><?php echo $rg -> name  ?></option>
				<?php } ?>
			</select></td>
			<td><label for = "manufacturer">Manufacturer</label></td>
			<td><input name ="manufacturer" type = "text" class ="validate[required]" placeholder ="e.g BD" /></td>
		</tr>
		<tr>
			<td><label for = "batch_no">Batch No.</label></td>
			<td><input name ="batch_no" type = "text" class ="validate[required]" placeholder ="e.g NDQA.." /></td>
			<td><label for = "quantity">Quantity</label></td>
			<td><input name ="no_of_units" type = "text" class ="validate[required]" placeholder ="e.g 20" title ="If 10 bottles, enter 10, if 20 packets, 20 e.t.c" />
			
		</tr>
		<tr>
			<td><label for = "unit">Packaging</label></td>
			<td><input name ="quantity" type = "text" title = "Unit of measure of single unit" class ="validate[required]" placeholder ="e.g 300" />
			<select name ="qunit"  >
			  <option value = "mg" >g</option>
			  <option value = "mL" >L</option>
			</select>	
			</td>
			<td>
			<select name ="packaging" >
			  <option value = "Bottles" >Bottles</option>
			  <option value = "Packets" >Packets</option>
			</select>
			</td>
		</tr>
		<tr>
			<td><label for = "reorder_l">Reorder Level</label></td>
			<td><input name ="reorder_l" title = "e.g 10  will mean 10 Bottles/Packets depending on what selected above " type = "text" class ="validate[required,custom[onlyLetterNumber]]" placeholder ="e.g 5" />
			</td>
		</tr>

			<tr>

			<td><label for = "manufacturer">Date Received</label></td>
			<td><input name ="date_r" type = "text" id = "date_r" class ="validate[required]" placeholder ="e.g 2010-09-07" /></td>


			<td><label for = "date_e">Date of Expiry</label></td>
			<td><input name ="date_e" type = "text" id = "date_e" class ="validate[required]" placeholder ="e.g 2010-10-08" /></td>

			
	
			</td>
			
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
	dateFormat:"dd-M-yy"
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
		url: 'reagents_save/',
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