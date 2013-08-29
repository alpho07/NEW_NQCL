<div class ="content">
<a href = "<?php echo base_url().'request_management/add' ?>" ><span>Add New</span></a>
<table id = "requests">
	<thead>
		<tr>
		</tr>
	</thead>
	<tbody>
		<tr>
		</tr>
	</tbody>
</table>

</div>

<script type="text/javascript">
function getData(){
	if (typeof rtable == 'undefined') {
		var rtable = $('#requests').dataTable({
	"bJQueryUI": true,
	"aoColumns": [
	{"sTitle":"Reference Number","mData":"request_id"},
	{"sTitle":"Product Name","mData":"product_name"},
	{"sTitle":"Batch No.","mData":"Batch_no"},
	{"sTitle":"Client", "sClass":"client","mData":"Clients.Name"},
	{"sTitle":"Manufacturer","mData":"Manufacturer_Name"},
	{"sTitle":"Date of Manufacture","mData":"Manufacture_date"},
	{"sTitle":"Date of Expiry","mData":"exp_date"},
	{"sTitle":"Quantity","mData":null,
     "mRender":function(data, type, row){
     	return row.sample_qty + " " + row.Packaging.name;
     }},
	{"sTitle":"Edit","mData":"id"}
	],
	"aoColumnDefs": [{
		"aTargets": [8],
		"mData": "id",
		"mRender":function(data, type, full){
			return '<a class="edit" id = '+data+' >Edit</a>';
		},
	}],

	"bDeferRender":true,
	"bProcessing":true,
	"bDestroy":true,
	"bLengthChange":true,
	"iDisplayLength":16,
	"sAjaxDataProp": "",
	"sAjaxSource": '<?php echo site_url()."request_management/requests_list"?>',	
});
	}
else {
	rtable.fnDraw();
	}
}

$(document).ready(function(){
	$('.edit').live("click",function(e){
		e.preventDefault();
		var href = '<?php echo base_url()."request_management/edit_view" ?>' + $(this).attr('id')
		$.fancybox.open({
			href : href,
			type: 'iframe',
			autoSize: false,
			autoDimensions : false,
			width:400,
			height: 500,
			'beforeClose' : function(){
				getData();
			}
		});
		return(false);
	})
	getData();
})
</script>