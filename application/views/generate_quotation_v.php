<html>
<head></head>
<body>
<form id = "quotation">
<legend>Quotation&nbsp;&rarr;&nbsp;No.&nbsp;<?php $cnumber = "NDQ" . date('Y') . date('m') . ((int)$lastclientno[0]['max'] + 1) ; echo $cnumber; ?></legend>
<input type = "hidden" name = "client_number" value = "<?php echo $cnumber; ?>" />
<input type = "hidden" name = "quotation_date" value ="<?php echo date('y-m-d'); ?>" />
<?php //var_dump($lastclientno) ?>
<hr>
<div>&nbsp;</div>
<fieldset>
<legend class = "misc_title">Quotation Details</legend>	
<div id = "view_content">
<table>
<!--tr><td colspan = "4" ><hr></td></tr-->
<tr>
	<td><label>Client Name</label></td>
	<td><input type ="text" name = "client_name" class = "validate[required]" ></td>
	<td><label>Sample Name</label></td>
	<td><input type ="text" name = "sample_name" class="validate[required]" ></td>
</tr>
<tr>
	<td><label>Active Ingredients</label></td>
	<td><input type ="text" name = "active_ing" class = "validate[required]" ></td>
	<td><label>Dosage Form</label></td>
	<td><select name = "dosage_form" id = "dosage_form" class = "validate[required]" >
		<option value = " "></option>
		<?php foreach ($dosageforms as $dosageform) {?>	
		<option value="<?php echo $dosageform -> id ?>"><?php echo $dosageform -> name ?></option>
		<?php } ?>
		</select></td>
</tr>
<tr>
	<td><label>No. of Samples</label></td>
	<td><input type ="text" name = "samples_no" class = "validate[required]" ></td>
</tr>
</table>
</fieldset>
<fieldset>
<legend class = "misc_title">Tests</legend>
<table>
<!--tr><td colspan = "2" ><hr></td></tr-->
<tr>
<!--Accrodion-->
<td>
<div class="Accordion" id="sampleAccordion" tabindex="0">
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Wet Chemistry Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($wetchemistry as $wetchem) {
					echo "<tr id =" . $wetchem -> id . " ><td>" . $wetchem -> Name . "</td><td><input type=checkbox id=" . $wetchem -> Alias . " name=test[] value=" . $wetchem -> id. " title =" . $wetchem -> Test_type . " /></td></tr>";
				}
			?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Biological Analysis Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
				<?php

				foreach ($microbiologicalanalysis as $microbiology) {
					echo "<tr id =" . $microbiology -> id . "><td>" . $microbiology -> Name . "</td><td><input type=checkbox id=" . $microbiology -> Alias . " name=test[] value=" . $microbiology -> id . " title =" . $microbiology -> Test_type . " /></td></tr>";
				}
				?>
			</table>
		</div>
	</div>
	<div class="AccordionPanel">
		<div class="AccordionPanelTab"><b>Medical Devices Unit</b></div>
		<div class="AccordionPanelContent">
			<table>
			<?php

			foreach ($medicaldevices as $medical) {?>
			<?php echo "<tr id =" . $medical -> id ."><td>" . $medical -> Name . "</td><td><input type=checkbox id=" . $medical -> Alias . " name=test[] value=" . $medical -> id . " title =" . $medical -> Test_type . " /></td></tr>";
			?>

			<?php } ?>
			</table>
		 </fieldset>
		</div>
	</div>
</div>
</td>
</tr>
<tr><td><input type = "submit" class ="submit-button margin-left" value = "Save" /></td></tr>
</table>
<!-- End Accrodion-->	
</div>
</form>

<script language="JavaScript" type="text/javascript">
	
$('#quotation').validationEngine();

		var sampleAccordion = new Spry.Widget.Accordion("sampleAccordion");

			$(function() {
		$( "#country_of_origin" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('sample_controller/suggestions'); ?>",
				data: { term: $("#country_of_origin").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2,
                                    Delay : 200
		});
	});


		

		$(function() {


			$("#applicant_name").keydown(function(){
				$('#applicant_address, #contact_name, #contact_telephone, #appl_ref_no, #c_id').val('');	
				$('#client_type').text('');			
			})

			$('input[type="checkbox"][title ="2"]').live('click',function(){
				test_id = $(this).val();
				test_name = $(this).attr('id');
				if($(this).is(':checked')){
				$("<tr class ='"+test_id+"'><td><span class = 'misc_title smalltext'>Choose Method For.</span></td></tr>").insertBefore("[id =" +test_id+"]");					 	
					if(test_id == 5 ){
						if($('#dosage_form option[value ="3"]').is(':selected')){
						$("<tr class ='"+test_id+"'><td><label class = 'misc_title smalltext'>Do Stability Testing</label></td><td><input type = 'checkbox' name = 'stability_testing' /></td></tr>").insertBefore("[id =" +test_id+"]");					 	
						}
					}
				$.getJSON("<?php echo site_url('request_management/getTestMethods')?>" + "/" + test_id , function(methods){
				 	methodsArray = methods;
				 	for(var i =0; i < methodsArray.length; i++){
				 		$("<tr class = '"+methodsArray[i].test_id+"' id = 'lightbg' ><td><label>"+methodsArray[i].name+"</label></td><td><input type = 'checkbox' name = 'methods[]' value = '"+methodsArray[i].id+"' size ='"+methodsArray[i].test_id+"'' /></td></tr>").insertAfter("[id =" +methodsArray[i].test_id+"]"); 	
					}
		
				})
				}
				else{
					$("[class =" +test_id+"]").remove();
					$('input[name = "method_test[]"]').remove();
				}
			})

$('input[name="methods[]"]').live('click', function(){
						console.log(vid = $(this).attr("value"));
						console.log(cid = $(this).attr("size"));
						//console.log($(this).parent().parent().siblings("tr[class ="+cid+"][id ='lightbg']").remove());
						if($(this).is(':checked')){
						tid = $(this).attr("size");	
						$("<input type = 'hidden' name = 'method_test[]' value = '"+tid+"' />").insertAfter("[id ="+tid+"]");
								if(tid != 5 && tid != 2 ){
									if(cid == 1){	
										$("<tr class = 'id_mc' id = 'multico' data-spec = '"+cid+vid+"' ><td><label class = 'smalltext'>Multicomponent</label></td><td><input type ='checkbox' name='mc' id = 'id_mc' data-mc = 'multico' data-spec = '"+cid+vid+"' /></td></tr>").insertAfter("input[name='methods[]'][value =" +vid+"]");
										$("<tr class = 'id_mc' id = 'singleco' data-spec = '"+cid+vid+"' ><td><label class = 'smalltext'>Single Component</label></td><td><input type ='checkbox' name='Multicomponent[]' id = 'id_mc' value= '1' data-mc = 'singleco' data-spec = '"+cid+vid+"' /></td></tr>").insertAfter("input[name='methods[]'][value =" +vid+"]");
									    $("<input class = '"+vid+"' type = 'hidden' name = 'Multicomponentmid[]' value = '"+vid+"' id ='' size = '' title ='' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 
										$("<input class = '"+vid+"' type = 'hidden' name = 'mtid[]' value = '"+cid+"' id ='' size = '' title ='' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 

										$('[data-mc = "singleco"][data-spec = "'+cid+vid+'"]').live('click', function(){
											if($(this).is(':checked')){
												$('[id = "singleco"][data-spec = "'+cid+vid+'"]').show();
												$('[id = "multico"][data-spec = "'+cid+vid+'"]').hide();
											}
											else{
												$('[id = "singleco"][data-spec = "'+cid+vid+'"]').hide();
												$('[id = "multico"][data-spec = "'+cid+vid+'"]').show();
											}
										})

										$('[data-mc = "multico"][data-spec = "'+cid+vid+'"]').live('click', function(){
											if($(this).is(':checked')){
												$('[id = "singleco"][data-spec = "'+cid+vid+'"]').hide();
												$('[id = "multico"][data-spec = "'+cid+vid+'"]').show();
												if($("tr[class = "+vid+cid+"]").length < 1){
												$("<tr class = '"+vid+cid+"' id = 'multicoinput' ><td><label class = 'smalltext'>No. of Components</label></td><td><input type ='text' name='Multicomponent[]' id = 'id_mc' data-mc = 'multicoinput' data-mid = '"+vid+"' data-tid = '"+cid+"' data-id = '"+vid+cid+"' /></td></tr>").insertAfter("input[data-mc='multico'][data-spec = "+cid+vid+"]");	
												}
											}
											else{
												$("tr[class = "+vid+cid+"]").remove();
												$('[id = "singleco"][data-spec = "'+cid+vid+'"]').show();
												$('[id = "multico"][data-spec = "'+cid+vid+'"]').hide();
											}
										})

										$('[data-mc = "multicoinput"][data-mid = "'+vid+'"]').live('blur', function(){
											t_id = $(this).attr("data-cid");
											m_id = $(this).attr("data-mid");
											c_no = $(this).val();

											if(c_no <= 1){
												alert("Number of components should be greater than one");
												$(this).val('');
												var self = $(this);
												setTimeout(function(){
													self.focus();
												}, 1);
												
											}
											else{
											if($(this).val() && $("[data-id = '"+m_id+t_id+"']").length < 1 ){
											$("<tr class = 'analysisbundle smalltext' data-classid = '"+m_id+t_id+"' ><td><label>Same System</label><input type ='radio' name='analysistype[]' value = '1' data-meth = '"+m_id+"' data-id = '"+m_id+t_id+"' /></td></tr><tr class = 'analysisbundle smalltext' data-classid = '"+m_id+t_id+"'><td><label>Different System</label><input type ='radio' name='analysistype[]' value = '2' data-meth = '"+m_id+t_id+"' data-id = '"+m_id+t_id+"' id = 'othermethod' class = 'diffsys' href='#diffsys' /></td></tr>").insertAfter("input[name = 'Multicomponent[]'][data-mid = '"+m_id+"']");
											}
											else if(!$(this).val()){
												console.log($("tr[class = 'analysisbundle'][data-classid = '"+m_id+t_id+"']").remove());
												console.log($("tr[class = "+m_id+t_id+"]").remove());
											}
											}


										})

										$("input[name='analysistype[]']").live('click', function(){
										dtm = $(this).attr("data-meth");
										if($(this).is(':checked')){
										console.log(dtm)
										console.log($("<input type = 'hidden' name = 'analysistypemid[]' value = '"+dtm+"' />").insertAfter("tr[class = 'analysisbundle']"))
									}
								})

									}
									if(vid == 27){	
										if($(this).is(':checked')){
											$("<tr class = 'uow' id = 'uowtypes' ><td><label class = 'smalltext'>No. in Combi Pack</label><input type ='text' name='Multicomponent[]' id = 'uow_type'/></td></tr>").insertAfter("input[name='methods[]'][value =" +vid+"]");
											$("<input class = '"+vid+"' type = 'hidden' name = 'Multicomponentmid[]' value = '"+vid+"' id ='' size = '' title ='' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 
											$("<input class = '"+vid+"' type = 'hidden' name = 'mtid[]' value = '"+cid+"' id ='' size = '' title ='' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 

										}
									}

									if(vid == 28){
										if($(this).is(':checked')){
											$("<input class = '"+vid+"' type = 'hidden' name = 'Multicomponentmid[]' value = '1' id ='' size = '' title ='' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 
											$("<input class = '"+vid+"' type = 'hidden' name = 'mtid[]' value = '"+cid+"' id ='' size = '' title ='' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 											
										}

									}	
								}
								else{
									if(vid == 13){
										if($("input[name='methods[]'][value = '13']").is(':checked')){
										$("<tr class = 'aas'><td><label class = 'smalltext'>No. of Elements</label><input type ='text' name='aas_no' id = ''/></td></tr>").insertAfter("input[name='methods[]'][value =" +vid+"]");
										}
										else{
											console.log($('.aas').html());
										}
									}
									else {
									$("<input class = '"+vid+"' type = 'hidden' name = 'mtid[]' value = '"+cid+"' id ='' size = '' title ='' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 	
									$.getJSON("<?php echo site_url('request_management/getMethodTypes')?>" , function(multis){
									for(var i =0; i < multis.length; i++){
									//if(multis[i].id != 1 && tid != 2){  
									$("<tr class = '"+vid+"' data-ss ='"+multis[i].name+"' id = 'smalltext' ><td><label name = 'method_type[]'>"+multis[i].name+"</label></td><td><input type = 'checkbox' data-named = '"+multis[i].name+"' data-val = '"+multis[i].id+"' value = '"+multis[i].charge+"' id ='multics' data-cid = 'multics' name = '"+tid+"' title ='"+vid+"' /></td></tr>").insertAfter("input[name='methods[]'][value =" +vid+"]"); 
									$("<input class = '"+vid+"' type = 'hidden' name = '"+multis[i].name+"mid[]' value = '"+vid+"' id ='"+multis[i].charge+"'' size = '"+tid+"' title ='"+vid+"' />").insertAfter("input[name='methods[]'][value =" +vid+"]"); 
									console.log(vid);
									}
								})						
						}

					}
				}
						else{
							console.log($("tr[class = "+vid+"]").remove());
							console.log($('.aas, .uow, .id_mc').remove());
							console.log($("tr[class = "+vid+cid+"]").remove());
							console.log($("[data-id = "+vid+cid+"]").attr('checked', false));
						}
			
					})

				
			$('input[data-cid = "multics"]').live('click', function(){
					nme = $(this).attr("data-named");
					name =  $(this).attr("data-named") + "[]";
					testid = $(this).attr("name");
					console.log(methodid = $(this).parent().parent().attr("class"));
					method_tid = $(this).attr("data-val");
					var method_id = $(this).attr("title");
					charge = $(this).val()
					//alert(method_tid)
					
					if($(this).is(':checked')){

							if(charge !=1){
								$("<tr data-base= 'compno' class = '"+method_tid+method_id+"'><td><label>No. of Stages/Components</label><input type ='number' maxlength ='1' name='"+name+"' id = '"+method_tid+"' data-class2 = 'multiple' class = 'validate[required]' data-method = '"+method_id+"' data-tid = '"+testid+"'' /></td></tr>").insertAfter("input[id = 'multics'][data-val ="+method_tid+"][title = "+method_id+"]");
								console.log($('tr[class = "'+method_id+'"][data-ss = "Singlecomponent"]').hide());
							} else {
								$("<input type ='hidden' name='Multicomponent[]' id = '"+method_tid+"' data-class2 = 'multiple' class = 'validate[required]' data-method = '"+method_id+"' data-tid = '"+testid+"'' value = '"+charge+"' />").insertAfter("input[id = 'multics'][data-val = '"+method_tid+"'][title = '"+method_id+"']");
								console.log($('tr[class = "'+method_id+'"][data-ss = "Multicomponent"]').hide());
							}
							//$("<input type = 'hidden' name = 'charge[]' value = '' />").insertAfter("[id ="+tid+"]");
							$("<input type = 'hidden' name = 'testids[]' value = '"+testid+"' />").insertAfter("[id ="+tid+"]");
							$("<input type = 'hidden' name = 'methodids[]' value = '"+methodid+"' />").insertAfter("[id ="+tid+"]");
							}
					else{
						console.log($("tr[class = "+method_tid+method_id+"]").remove());
						console.log($('tr[class = "'+method_id+'"][data-ss = "Multicomponent"]').show());
						console.log($('tr[class = "'+method_id+'"][data-ss = "Singlecomponent"]').show());
						console.log($("tr[class = 'analysisbundle'][data-classid = '"+name+method_id+"']").remove());
						//console.log($("tr[data-base = 'compno']").remove());
					}

			
	
			$("[data-class2 = 'multiple'][data-method = '"+method_id+"'][name='"+name+"']").bind('blur',function(){
				var methdid = $(this).attr("data-method");
				var name2 = $(this).attr("name");
				var multino = $(this).val();
				var multi_id = $(this).attr("id");
				var data_tid = $(this).attr("data-tid");
				//console.log(methdid)
				//console.log(multino)
				console.log(name2+methdid);
			
				if($(this).val() <= 0){
					alert("Number of components should be greater than zero.");
					$(this).val('');
					var self = $(this);
					setTimeout(function(){
						self.focus();
					}, 1);
					
				}
				else{
				if($(this).val() && $("[data-id = '"+name2+methdid+"']").length < 1 ){
				$("<tr class = 'analysisbundle' data-classid = '"+name2+methdid+"' ><td><label>Same System</label><input type ='radio' name='analysistype[]' value = '1' data-meth = '"+methdid+"' data-id = '"+name2+methdid+"' /></td></tr><tr class = 'analysisbundle' data-classid = '"+name2+methdid+"'><td><label>Different System</label><input type ='radio' name='analysistype[]' value = '2' data-meth = '"+methdid+"' data-id = '"+name2+methdid+"' id = 'othermethod' class = 'diffsys' href='#diffsys' /></td></tr>").insertAfter("input[name = '"+name+"'][data-method = '"+methdid+"']");
				}
				else if(!$(this).val()){
					console.log($("tr[class = 'analysisbundle'][data-classid = '"+name2+methdid+"']").remove());
					console.log($("tr[class = "+multi_id+methdid+"]").remove());
					console.log($("[data-cid = 'multics'][value = '"+multi_id+"'][title = '"+methdid+"']").attr('checked', false));
				}
				}
				
			})

			$("input[name='analysistype[]']").live('click', function(){
				dtm = $(this).attr("data-meth");
				if($(this).is(':checked')){
					console.log(dtm)
					console.log($("<input type = 'hidden' name = 'analysistypemid[]' value = '"+dtm+"' />").insertAfter("tr[class = 'analysisbundle']"))
				}
					})

			$(".diffsys").live('click', function(){
				  $("#diffsys").fancybox({
    				'zoomSpeedIn': 300,
    				'zoomSpeedOut': 300,
   					'overlayShow': false
  				}); 
			})


			})


			$("#fullmonograph").change(function() {
				if($('#fullmonograph').is(':checked')) {
					document.getElementById("identification").checked = true;
					document.getElementById("dissolution").checked = true;
					document.getElementById("disintegration").checked = true;
					document.getElementById("friability").checked = true;
					document.getElementById("assay").checked = true;
					document.getElementById("uniformity").checked = true;
					document.getElementById("ph").checked = true;
					document.getElementById("contamination").checked = true;
					document.getElementById("sterility").checked = true;
					document.getElementById("endotoxin").checked = true;
					document.getElementById("integrity").checked = true;
					document.getElementById("viscosity").checked = true;
					document.getElementById("microbes").checked = true;
					document.getElementById("efficacy").checked = true;
					document.getElementById("melting").checked = true;
					document.getElementById("relativity").checked = true;
					document.getElementById("condom").checked = true;
					//document.getElementById("syringe").checked = true;
					document.getElementById("needle").checked = true;
					document.getElementById("glove").checked = true;
					document.getElementById("refractivity").checked = true;
				}
				
			});

		$('#date_m, #date_e').datepicker({
		changeYear:true,
		dateFormat:"dd-M-yy"
		});

$('#date_m').datepicker("option", "maxDate", '0');
$('#date_e').datepicker("option", "minDate", '0');

	$('#date_m').change(function(){
		date_m = $(this).datepicker('getDate');
		date_e_min = new Date(date_m.getTime());
		date_e_max = new Date(date_m.getTime());
		date_e_max.setDate(date_e_max.getDate() + 732)
		date_e_min.setDate(date_e_min.getDate() + 186); 
		$('#date_e').datepicker("option", "minDate", date_e_min);
		$('#date_e').datepicker("option", "maxDate", date_e_max);
	})

	$('#quotation').submit(function(e){
	e.preventDefault();
	var inputs = $("#quotation").find('input').not(':hidden').filter(function(){
return this.value === "";
});

if (inputs.length) {

//alert(inputs.length + " fields empty. Please fill to continue.");

}

else {

	$.ajax({
		type: 'POST',
		url: '<?php echo site_url()."quotation/save" ?>',
		data: $('#quotation').serialize(),
		dataType: "json",
		success:function(response){
			if(response.status === "success"){

				$('#add_success').slideUp(300).delay(200).fadeIn(400).fadeOut('fast');

				$('form').each(function(){

					this.reset();
				})

				
				requestdata = $.parseJSON(response.array);

				//window.location.href =  "<?php echo site_url() ?>quotation/listing/";
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
});
</script>

</body>
</html>