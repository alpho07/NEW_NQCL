<table id = "issue">
	<form id = "issues" >
			<thead>
				<tr>
				<th>Serial No.</th>	
				<th>Analsyt</th>
				<th>Issue</th>
				</tr>	
			</thead>
			<tbody>
				<tr class = "centertext">
					<td id = "column_name"><?php echo $this -> uri -> segment(4); ?></td>
					<td><select name ="analyst" class ="validate[required]">
						<option value = ""></option>
						<?php foreach($analysts as $analyst){?>
							<option value ="<?php echo $analyst ['id']; ?>" ><?php echo $analyst ['fname']. " " . $analyst ['lname']; ?></option>
						<?php } ?>
					</select></td>
					<td><input type ="submit" class ="submit-button" value ="Issue" /></td>	
				</tr>	
			</tbody>
		</form>
	</table>

<script type="text/javascript">

$('#issues').validationEngine();


$('#issue').dataTable({
	"bSortable" : false,
	"sDom": 't'
})

$('#issues').submit(function(e){
	e.preventDefault();
var inputs = $("#issues").find('select').filter(function(){
return this.value === "";
});

alert(inputs.length);

if (!inputs.length) {

alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: 'columns_issue_save/',
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

</html>