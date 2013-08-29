<html>
<div class ="content">

<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<span class ="link_highlight">Reagents List</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/reagentadd"; ?>">Add Reagents</a>
&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/reagentsadd";?>">Add Reagents to Inventory</a></legend>
<div>&nbsp;</div>

<table id = "rgents">
<thead>
<tr>

<th>Name</th>
<th>Edit</th>
<!--th>Code</th-->


</tr>
</thead>
<tbody>
<?php foreach($reagent as $rgnt) {?>	
<tr>
	<td><?php echo $rgnt -> name ?></td>
	<td><a class = "edit" href="#rgnt<?php echo $rgnt -> id ?>">Edit</a></td>
</tr>

	<div class = " popupform hidden2" id = "rgnt<?php echo $rgnt -> id ?>" >
	<form id = "editrgnt<?php echo $rgnt -> id ?>" data-formid = "editrgnt" >
		<div>
			<legend>Edit. <?php echo $refs -> name ?></legend>
			<hr />
		</div>
		<div id = "add_success" class ="hidden2" >
			<span class = "misc-title small-text padded" >&#10003;<?php print_r($_POST) ?></span>
		</div>	
		<div class = "clear">
			<div class = "left_align">
				<label for = "refname">Substance Name</label>
			</div>
			<div class = "right_align">
				<input name = "refname" required value = "<?php  echo $refs -> name ?>"/>
			</div>
		</div>
		<div class = "clear">
			<div class = "right_align">
				<input type = "submit" class = "submit-button" name = "submit_ref" required value = "Update"  />
			</div>
		</div>		


<?php }?>
</tbody>
</table>
</div>

<script type="text/javascript">
$('#rgents').dataTable({
	"bJQueryUI": true
});
</script>
</html>