<html>
<div class ="content">
	<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Equipment Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/equipmentadd"; ?>">Add Equipment</a></legend>
	<div>&nbsp;</div>
<table id = "equip">
<thead>
<tr>
<th>Name</th>
<th>Serial No.</th>
<th>NQCL No.</th>
<th>Date Acquired</th>
<th>Date Of Calibration</th>
<th>Date of Next Calibration</th>
<th>Status</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php foreach($equipment as $equip) {?>	
<tr>
	<td><?php echo $equip -> name ?></td>
	<td><?php echo $equip -> serial_no ?></td>
	<td><?php echo $equip -> nqcl_no ?></td>
	<td><?php echo date('d-M-Y', strtotime($equip -> date_acquired)) ?></td>
	<td><?php echo date('d-M-Y', strtotime($equip -> date_of_calibration)) ?></td>
	<td><?php echo date('d-M-Y', strtotime($equip -> date_of_nxtcalibration)) ?></td>
	<td><?php echo $equip -> status ?></td>
	<td><a class = "edit" href="#equip<?php echo $equip -> id ?>">Edit</a></td>
</tr>
    <div class = " popupform hidden2" id = "equip<?php echo $equip -> id ?>" >
		<form id = "editequip<?php echo $equip -> id ?>" data-formid = "editequip" >
			<div>
				<legend>Edit. <?php echo $equip -> name ?></legend>
				<hr />
			</div>
			<div id = "add_success" class ="hidden2" >
				<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
			</div>	

			<div class = "clear">
				<div class = "left_align">
					<label for = "ename">Equipment Name</label>
				</div>
				<div class = "right_align">
					<input name = "ename" required value = "<?php  echo $equip -> name ?>"/>
				</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "esno">Equipment Serial No.</label>
					</div>
					<div class = "right_align">
						<input name = "esno" required value = "<?php  echo $equip -> serial_no ?>"/>
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "nqcl_no">NQCL No.</label>
					</div>
					<div class = "right_align">
						<input name = "nqcl_no" required value = "<?php  echo $equip -> nqcl_no ?>"/>
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "date-acq">Date Acquired</label>
					</div>
					<div class = "right_align">
						<input name = "date-acq" required value = "<?php echo date('d-M-y', strtotime($equip -> date_acquired)) ?>" readonly />
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "date-cal">Date of Calibration</label>
					</div>
					<div class = "right_align">
						<input name = "date-cal" required value = "<?php echo date('d-M-y', strtotime($equip -> date_of_calibration)) ?>" readonly />
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "date-nxtcal">Date of Next Calibration</label>
					</div>
					<div class = "right_align">
						<input name = "date-nxtcal" required value = "<?php echo date('d-M-Y', strtotime($equip -> date_of_nxtcalibration)) ?>" readonly />
					</div>
			</div>
			<div class = "clear">
					<div class = "left_align">
						<label for = "status">Status</label>
					</div>
					<div class = "right_align">
						<select id = "estatus<?php echo $equip -> id ?>">
							<option value = "In Use" >In Use</option>
							<option value = "Decommissioned" >Decommissioned</option>
						</select>
					</div>
			</div>
			<input type = "hidden" name = "dbestatus" id = "dbestatus<?php echo $equip -> id ?>" value = "<?php echo $equip -> status ?>" />
			<input type = "hidden" name = "dbid" value ="<?php echo $equip -> id ?>" />
			
			<div class = "clear" >
					<div class = "right_align">
						<input type = "submit" required value = "Update" class ="submit-button"  readonly />
					</div>
			</div>
		</form>
	</div>			

			<script type="text/javascript">
				$("#estatus<?php echo $equip -> id ?> option").each(function(){
						if($(this).val() == $("#dbestatus<?php echo $equip -> id ?>").val()){				
					$(this).attr("selected", "selected");
				}
			})
			</script>
<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">
	$(function(){

	$('#equip').dataTable({
		"bJQueryUI": true
	});

	$('.edit').fancybox();

	$('[name*="date"]').datepicker({
		changeYear:true,
	    dateFormat:"dd-M-yy"
	});

	$('[data-formid = "editequip"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/equipment_edit" ?>',
		data: $('[data-formid = "editequip"]').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				parent.$.fancybox.close();
				document.location.reload();	
			}
			else if(response.status === "error"){
					alert(response.message);
			}
		},
		error:function(){
		}
	})

})

	})
</script>
</html>