<html>
<div class ="content">
		<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Columns Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/columnsadd"; ?>">Add Columns</a></legend>
	<div>&nbsp;</div>
<table id = "cols">
<thead>
<tr>
<th>Type</th>
<th>Serial No.</th>
<th>Column Number</th>
<th>Column Dimensions</th>
<th>Manufacturer</th>
<th>Date Received</th>
<th>Status</th>
<th>Issue</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php foreach($columns as $column) {?>	
<tr>
	<td><?php echo $column -> column_type ?></td>
	<td><?php echo $column -> serial_no ?></td>
	<td><?php echo $column -> column_no ?></td>
	<td><?php echo $column -> column_dimensions ?></td>
	<td><?php echo $column -> manufacturer ?></td>
	<td><?php echo date('d-M-y', strtotime($column -> date_received)) ?></td>
	<td><?php echo $column -> status ?></td>
	<td><a <?php if($column -> status != "Issued"){echo " class = 'issue' href = '#issuecol" . $column -> id . "'"; } else{ echo " class = 'issued' href = '#issuedcol" . $column -> id ."'";} ?> rel = "<?php echo $column -> serial_no ?>" >
		<?php if($column -> status != "Issued"){echo "Issue"; } else{ echo "Issued";} ?></a></td>
	<td><a class = "edit" href="#col<?php echo $column -> id ?>">Edit</a></td>
</tr>
<?php //if($column -> status != "Issued") echo "issue"; else{ echo "Issued" } ?>
<div class = " popupform hidden2" id = "col<?php echo $column -> id ?>" >
		<form id = "editcol<?php echo $column -> id ?>" data-formid = "editcol" >
			<div>
				<legend>Edit. <?php echo $column -> type ?>&nbsp;<?php echo $column -> serial_no ?></legend>
				<hr />
			</div>
			<div id = "add_success" class ="hidden2" >
				<span class = "misc-title small-text padded" ><?php print_r($_POST) ?></span>
			</div>	

			<div class = "clear">
				<div class = "left_align">
					<label for = "type">Type</label>
				</div>
				<div class = "right_align">
					<textarea name = "type" required ><?php  echo $column -> column_type ?></textarea>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "serial_no">Serial No.</label>
				</div>
				<div class = "right_align">
					<input name = "serial_no" required value = "<?php  echo $column -> serial_no ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "col_no">Column No.</label>
				</div>
				<div class = "right_align">
					<input name = "col_no" required value = "<?php  echo $column -> column_no ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "column_dimensions">Dimensions</label>
				</div>
				<div class = "right_align">
					<input name = "column_dimensions" required value = "<?php  echo $column -> column_dimensions ?>"/>
				</div>
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "manufacturer">Manufacturer</label>
				</div>
				<div class = "right_align">
					<input name = "manufacturer" required value = "<?php  echo $column -> manufacturer ?>"/>
				</div>
			</div>
			<input type = "hidden" name = "dbid" value = "<?php echo $column -> id ?>" />
			<input type = "hidden" name ="date_r" id = "colstatus<?php echo $column -> id ?>" value ="<?php echo date('d-M-y') ?>" />
			<div class = "clear" >
				<div class = "right_align">
					<input type = "submit" value = "Save" class = "submit-button" />
				</div>
			</div>
			     <input type = "hidden" id = "colstatus<?php echo $column -> id ?>" value ="<?php echo $column -> status ?>" />
			</div>
		</form>
	</div>
	
	<div class = "popup hidden2" id = "issuecol<?php echo $column -> id ?>" >
		<form id = "issuecol<?php echo $column -> id ?>" data-formid = "issuecol" >
			<div>
				<legend><span class= "misc_title">Issue</span> <?php echo $column -> type ?>|&nbsp;|&nbsp;<?php echo $column -> serial_no ?>&nbsp;|&nbsp;<?php echo $column -> column_no ?></legend>
				<hr />
			</div>
			<div class = "clear">
				<div class = "left_align">
					<label for = "type">Analyst</label>
				</div>
				<div class = "right_align">
					<select name = "analyst_id" required >
						<option value = " ">&nbsp;</option>
						<?php foreach($analysts as $analyst) { ?>
							<option value = "<?php echo $analyst['id'] ?>"><?php echo $analyst['fname'] . " " . $analyst['lname'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>  
			<input type = "hidden" name = "column_id" value = "<?php echo $column -> id ?>" />
			<div class = "clear" >
				<div class = "right_align" >
					<input type = "submit" value ="Issue" class ="submit-button" />
				</div>
			</div>
		</form>	
	</div>

	<div class = "popup hidden2" id = "issuedcol<?php echo $column -> id ?>" >
			<div>
				<legend><span class= "misc_title">Issue</span> <?php echo $column -> column_type ?>|&nbsp;|&nbsp;<?php echo $column -> serial_no ?>&nbsp;|&nbsp;<?php echo $column -> column_no ?></legend>
				<hr />
			</div>
			<?php $cid =  $column -> id;
				$issued = Column_issue::getIssued($cid);
				$analyst_names = User::getAnalyst3($issued[0]['analyst_id']);
			?>
			<div class = "clear">
					<p><?php echo $analyst_names[0]['fname'] . " " . $analyst_names[0]['lname']; ?></p>
			</div>  
			<div class = "clear" >
					<p><?php echo date('d-M-Y', strtotime($issued[0]['issue_date']))  ?></p>
				</div>
			</div>	
	</div>

<script type="text/javascript">
		$(function(){
				$('form[id = "issuecol<?php echo $column -> id ?>"]').submit(function(e){
					e.preventDefault();
					$.ajax({
					type: 'POST',
					url: '<?php echo site_url() . "inventory/column_issue" ?>',
					data: $('form[id = "issuecol<?php echo $column -> id ?>"]').serialize(),
					dataType: "json",
					success:function(response){
					if(response.status === "success"){
						$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
						parent.$.fancybox.close();
						document.location.reload();
						//$('.issue').text("Issued");
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


<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">

$(function(){   

$('.edit').fancybox();	
$('.issue').fancybox();
$('.issued').fancybox();

var cols = $('#cols').dataTable({
	"bJQueryUI": true,
	"bdeferRender":true
});

var cols;

/*$('.issues').click(function(e){
e.preventDefault();
var nTr = this.parentNode.parentNode;
			
			if($(this).text() == 'Issue'){
				
			   $(this).text("Cancel");
				
				alert("Under Construction");
				
				var id = $(this).attr("id");
				var type = $(this).attr("rel");
			
				$.post("<?php echo site_url('column_management/issue') ?>" + "/" + id + "/" + type  , function(issue){
					
					cols.fnOpen(nTr, issue, 'issue');
				})
				
				
			}
			
			
			else{
				
				$(this).text("Issued");
				
				
				cols.fnClose(nTr);
				
			}
			
			
		})*/

 	$('[data-formid = "editcol"]').submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url() . "inventory/column_edit" ?>',
		data: $('[data-formid = "editcol"]').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');
				//console.log(parent.$.fancybox.close());
				//document.location.reload();	
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