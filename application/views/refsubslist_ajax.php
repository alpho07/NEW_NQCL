<legend><a href="<?php echo site_url()."inventory/"; ?>">Inventory Home</a>&nbsp;&larr;&nbsp;<a href="<?php echo site_url()."inventory/refSublist"; ?>">Reference Substances List</a>&nbsp;|&nbsp;<span class ="link_highlight">Reference Substances Inventory</span>&nbsp;&rarr;&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd"; ?>">Add Reference Substance</a>&nbsp;|&nbsp;<a href="<?php echo site_url()."inventory/refSubsadd_i"; ?>">Add Reference Substance to Inventory</a></legend>
<div>&nbsp;</div>
<table id = "refsubs">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
$('#refsubs').dataTable({
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"Name","mData":"name"},
	{"sTitle":"Standard Type","mData":"standard_type"},
	{"sTitle":"Source","mData":"source"},
	{"sTitle":"Batch No.","mData":"batch_no"},
	{"sTitle":"NQCL No.","mData":"rs_code"},
	{"sTitle":"Date Received","mData":"date_received"},
	{"sTitle":"Effective Date","mData":"effective_date"},
	{"sTitle":"Date of Expiry","mData":"date_of_expiry"},
	{"sTitle":"Date of Restandardisation","mData":"date_of_restandardisation"},
	{"sTitle":"Potency","mData":"potency"},
	{"sTitle":"Potency Unit","mData":"potency_unit"},
	{"sTitle":"Weight/Volume","mData":"init_mass"},
	{"sTitle":"Weight/Vol. Unit","mData":"init_mass_unit"},
	{"sTitle":"Status","mData":"status"},
	{"sTitle":"Restandardisation Status","mData":"restandardisation_status"},
	{"sTitle":"Application","mData":"application"}
	],
	"bDeferRender":true,
	"bProcessing":true,
	"bServerside":true,
	"bAutoWidth":true,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."inventory/crslist"?>'
});
</script>