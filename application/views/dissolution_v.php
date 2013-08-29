
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' />
        <link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/styleassay.css" type="text/css" media="screen"/>
        <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>


        <style type="text/css">
            table{
                border:none;
                width:400px;
                margin:auto;
                border:2px double #000 ;
            }
            td{
                border:#000 solid 1px;
            }
            input[type=text]{
                text-align:center;
                margin:auto;
                width: 50px

            }
            input[type=text]{
                text-align:center;	
                width: 50px

            }
            .stage{
                width:50px;
            }
            span.workingweight12{

                margin-right: 100px;
                width: 25px

            }
            input#DM,#workingmgml1,#tcreading,#tcmean,
            #conc,#dmgml1,#dmgml{
                width: 200px;
            }
            select#apparatus{
                width: 150px;
                margin-right: 40px;
            }
            td{
                margin:auto;
                text-align:center;

            }
            td#b{
                border:thin #000;
            }

            div#a{
                text-align:center;
            }
            td#x{
                text-align:right;
            }
            p{
                margin:0 auto;
            }
            div#a table{
                width:330px;
                border:#000000 1px solid;
                margin:auto;
                text-align: center;
            }
            table#we td, th{
                border:#000000 1px solid;
                margin:0px;	
            }
            input.dissolution-class[type=text]{
                width:250px;
                height:20px;
                text-align: center;
            }
            p#show,#hide{
                float: left;

            }
            p#show:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            p#hide:hover{
                text-decoration: underline;
                font-weight: bold;
                color: blue;

            }
            .active_ingredient[type=text]{
                width: 250px;
            }
            #multi[type=text]{
                width: 250px;
            }

            .waiting-circles{ padding: 0; display: inline-block; 
                              position: relative; width: 60px; height: 60px;}
            .waiting-circles-element{ margin: 0 2px 0 0; background-color: #e4e4e4; 
                                      border: solid 1px #f4f4f4;
                                      width: 10px; height: 10px; display: inline-block; 
                                      -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;}
            .waiting-circles-play-0{ background-color: #9EC45F; }
            .waiting-circles-play-1{ background-color: #aEd46F; }
            .waiting-circles-play-2{ background-color: #bEe47F; }
            
        </style>
        <script type="text/javascript">
            showNotification({
                type : "information",
                message: "Hi! Dissolution Area!.",
                autoClose: true, 
                duration: 2
            });
                $(document).ready(function(){
          $('form').dumbFormState({ 
                    persistPasswords : false, // default is false, recommended to NOT do this
                    persistLocal : true, // default is false, persists in sessionStorage or to localStorage
                    skipSelector : null, // takes jQuery selector of items you DO NOT want to persist 
                    autoPersist : true // true by default, false will only persist on form submit
                    });  
    $('#waiting4').waiting({ 
	className: 'waiting-circles', 
	elements: 8, 
	radius: 20, 
	auto: true 
    });
    });
    
      function generate(type) {
  
     var today = new Date();
    var cHour = today.getHours();
    var cMin = today.getMinutes();
    var cSec = today.getSeconds();
    var time=cHour+ ":" + cMin+ ":" +cSec ;
  
  var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();

var output = ((''+day).length<2 ? '0' : '') + day + '/' +
    ((''+month).length<2 ? '0' : '') + month + '/' +    
	d.getFullYear();
  	var n = noty({
  		text: type,
  		type: type,
      dismissQueue: true,
  		layout: 'topCenter',
  		theme: 'defaultTheme',
		timeout: 5000,
		text:'Work Autosaved Temporarily: '+output+ '\t' +time 
  	});
  	console.log('html: '+n.options.id);
      }

      function generateAll() {

          generate('information');

      }

      $(document).ready(function() {

          setInterval(generateAll, 20000);

      });
    
    
            $(document).ready(function() {
             loadComponents();   
        /*$(function() {
                    $("#dialog-confirm").dialog({
                        resizable: false,
                        height: 200,
                        width: 300,
                        modal: true,
                        buttons: {
                            "Yes": function() {
                                $(this).dialog("close");
                            },
                            "No": function() {
                                $('input.stdabc').val("");
                                $(this).dialog("close");
                            }
                        }
                    });
                });*/


                $("#workingvf1,#workingp11,#workingvf2,#workingp12,#workingvf3,#workingp13,#workingvf4").change('live', function()
                {

                    var a1 = ($('#workingvf1').val());
                    var b1 = ($('#workingp11').val());
                    var c1 = ($('#workingvf2').val());
                    var d1 = ($('#workingp12').val());
                    var e1 = ($('#workingvf3').val());
                    var f1 = ($('#workingp13').val());
                    var g1 = ($('#workingvf4').val());



                    $('#v11').val(a1);
                    $('#v2').val(a1);


                    $('#standardp1').val(b1);
                    $('#standardp2').val(b1);

                    $('#standardvf').val(c1);
                    $('#standardvf1').val(c1);

                    $('#p20').val(d1);
                    $('#p21').val(d1);

                    $('#vf3').val(e1);
                    $('#vf23').val(e1);

                    $('#p211').val(f1);
                    $('#p22').val(f1);

                    $('#vf4').val(g1);
                    $('#vf24').val(g1);
                });
       
                $('#addassay').hide();
                $('#finish').hide()
                $('#Export').click(function(){        
                    dataString2=$('#dissForm').serialize();        
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>wkstest/sendDissolutionDataToExcel/<?php echo $labref; ?>",
                        data: dataString2,
                        success: function() {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>dissolution/save_dissolution_data/<?php echo $labref; ?>",
                                data: dataString2,
                                success: function() {
                                    showNotification({
                                        message: "The data has been successfully saved! ",
                                        type: "success", 
                                        autoClose: true, 
                                        duration: 5
                                    });
                                    $('#Export').hide();
                                    $('#finish').hide();
                                    $('#addassay').show();
                                },
                                error: function(){
                                    showNotification({
                                        message: "Oops! an error occurred.",
                                        type: "error", 
                                        autoClose: true, 
                                        duration: 5 
                                    });
                                }                        
                            });
                        }          
                
                    });
                });
                
      function loadComponents(){
       var select=$('#activeIngredient').empty();
        $.ajax({
              type:"GET",
              url:"<?php echo base_url(); ?>dissolution/loadComponents/<?php echo $labref; ?>",
              dataType:"json",
              success:function(data){
                select.append("<option value="+">Select A.Ingr</option>");
                $.each(data, function(i,r){                   
                    var opt=(r.name);
                    select.append("<option value="+opt+">"+opt+"</option>");
                });
              },
               error:function(){
           
               }
            });
            
            }
            $('#activeIngredient').change(function(){
            component=$('#activeIngredient').val();
            var select=$('#repeat').empty();

            $.ajax({
              type:"GET",
              url:"<?php echo base_url(); ?>dissolution/getdata/<?php echo $labref; ?>/"+component,
              dataType:"json",
              success:function(data){
               select.append("<option value="+">Select No.</option>");
                $.each(data, function(i,r){
                    var opt=(r.repeat_status);
                    select.append("<option value="+opt+">"+opt+"</option>")
                });
              },
               error:function(){
           
               }
            });  
           });
           
            $('#activeIngredient,#repeat').change(function(){
            component=$('#activeIngredient').val();
            repeat=$('#repeat').val();

             $.ajax({
              type:"GET",
              url:"<?php echo base_url(); ?>dissolution/getAB/<?php echo $labref; ?>/"+component+"/"+repeat,
              dataType:"json",
              success:function(data){
              console.log('alphy');         
               
//               
             $.ajax({
              type:"GET",
              url:"<?php echo base_url(); ?>dissolution/getAB/<?php echo $labref; ?>/"+component+"/"+repeat,
              dataType:"json",
              success:function(data){
               $('#number').val(data[0].weight);
               $('#number1').val(data[1].weight);
               
               $('#v11').val(data[0].vf1);
               $('#v2').val(data[1].vf1);
               
               $('#standardp1').val(data[0].pippette1);
               $('#standardp2').val(data[1].pippette1);
               
               $('#standardvf').val(data[0].vf2);
               $('#standardvf1').val(data[1].vf2);
               
               $('#p20').val(data[0].pipette2);
               $('#p21').val(data[1].pipette2);
               
               $('#vf3').val(data[0].vf3);
               $('#vf23').val(data[1].vf3);
               
               $('#p211').val(data[0].pipette3);
               $('#p22').val(data[1].pipette3);
               
               $('#vf4').val(data[0].vf4);
               $('#vf24').val(data[1].vf4);
               
               $('#dmgml').val(data[0].concetration);
               $('#dmgml1').val(data[1].concetration);
               
//                $.each(data, function(i,r){
//                    var opt=(r.repeat_status);
//                    
//                });
              },
               error:function(){
           
               }
            });  
//                    
//                });
              },
               error:function(){
           
               }
            });      
        
        
        
           });
           
            
            });

            $(document).ready(function()
            {

                $("#workingvf1,#workingp11,#workingvf2,#number,#number1,#workingp12,#workingvf3").live('change', function() {
                    var answer = 0;
                    var answer2 = 0;
                    var weighta = parseFloat($('#number').val());
                    var weightb = parseFloat($('#number1').val());


                    var a = parseFloat($('#v11').val());
                    var b = parseFloat($('#standardp1').val());
                    var c = parseFloat($('#standardvf').val());
                    var d = parseFloat($('#p20').val());
                    var e = parseFloat($('#vf3').val());
                    var f = parseFloat($('#p211').val());
                    var g = parseFloat($('#vf4').val());

                    answer = ((weighta / a) * (b / c) * (d / e) * (f / g));

                    var v2 = parseFloat($('#v2').val());
                    var p2 = parseFloat($('#standardp2').val());
                    var vf2 = parseFloat($('#standardvf1').val());
                    var p21 = parseFloat($('#p21').val());
                    var vf23 = parseFloat($('#vf23').val());
                    var p22 = parseFloat($('#p22').val());
                    var vf24 = parseFloat($('#vf24').val());

                    answer2 = ((weightb / v2) * (p2 / vf2) * (p21 / vf23) * (p22 / vf24));



                    $('#dmgml').val(answer.toFixed(6));
                    $('#dmgml1').val(answer2.toFixed(6));
                    // $('#mgml').val(answer.toFixed(2));
                });
            });
            $(document).ready(function(){
                $('#addassay').click(function(){
                    $('input[type=number],input[type=text],#workingvf1,#workingp11,#workingvf2,#number,#number1,#workingp12,#workingvf3').each(function() {
                        $(this).val('');
                    });
                    $(this).hide();
                    $('#Export').show(); 
                    $('#finish').show();
                    $('form').dumbFormState('remove'); 
                });
            
                $('#finish').click(function(){
                    window.location.href='<?php echo base_url() ?>analyst_controller';
                });
            
            
            });
        
            $(document).ready(function(){
                $("#disstage").attr("disabled", "disabled");
                $("#disstage").hide();
                $("#l1").hide();
                $("#multi").click(function() {
                    if ($("#multi").is(":checked", true)) {
                        $("#disstage").attr("disabled", false);
                        $("#disstage").show();
                        $("#l1").show();
                
                    } else {
                        $("#disstage").attr("disabled", "disabled");
                        $("#disstage").hide();
                        $("#l1").hide();
                
                    }
                });                                                              
                var counter=1;   
                var stage1='ACID';
                var stage2='BUFFER';
        
                $('#disstage').val(stage1);       
        
                $(' #addassay').click(function(){
                    $('input.stage,input.dissolution-class').each(function() {
                        $(this).val('');
                    });
                    counter++;
                    if(counter==2){
                        $('#disstage').val(stage2);
                    }else{
                        counter=1;
                        $('#disstage').val(stage1);  
                    }
                });
            });

        </script>

    </head>

    <body>
        <?php foreach ($assayweight as $weight)
            ; ?>     


        <!--DISSOLUTION CONDITIONS -->
        <?php $attributes = array('id' => 'dissForm'); ?>
<?php echo form_open('dissolution/save_dissolution_data/' . $labref, $attributes); ?>       

        <div class="multistaged">
            <input type="checkbox" id="multi">Enable Multistaged</input>
        </div>
        <center><p><strong><h3><label id="l1">Stage:</label> <input type="text" name="distage" id="disstage" readonly/></h3></strong></p>

            <center>Component Name:<select name="heading" id="activeIngredient" > 
                    <option value="">-Select A.Ingr-</option>
                </select>&nbsp;&nbsp;Repeat:<select name="repeat" id="repeat" >               
            </select><span class='activeIngredient'><a href="<?php echo base_url().'assay/worksheet/'.$labref.'/2'?>">No, I don't want a Repeat!</a></span></center>
            <p><center><h3><u>1. Tablets/Capsule Weights</u></h3></center></p>       
            <div id="a">


                <table width="332" border="0" cellpadding="1" cellspacing="0" id="we">
                    <tr>
                        <th width="133">No</th>
                        <th width="220">Tablets/Capsule Weights(mg)</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><input type="text" name="tc1" id="tc1" class="dissolution-class" required/></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><input type="text" name="tc2" id="tc2" class="dissolution-class" required/></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><input type="text" name="tc3" id="tc3" class="dissolution-class" required/></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><input type="text" name="tc4" id="tc4" class="dissolution-class" required/></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><input type="text" name="tc5" id="tc5" class="dissolution-class" required/></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><input type="text" name="tc6" id="tc6" class="dissolution-class" required/></td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>                      
                            <input type="text" name="tcreading" id="tcreading"  readonly/>

                        </td>
                    </tr>
                    <tr>
                        <td><strong>Average</strong></td>

                        <td>
                            <input type="text" name="tcmean" id="tcmean" readonly />
                        </td>
                    </tr>
                </table>
                <center>
                    <p><strong></p></strong> </span>
                    <input type="hidden" name="tcreading1" id="tcreading"  />
                    </p></center>
            </div>
            <hr />
            <center><h3><header><u>2. Dissolution Conditions</u></header></h3></center>
            <div id="dissolutio">
                <table width="355" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="2">Tablets/Capsules</td>
                    </tr>
                    <tr>
                        <td width="201">&nbsp;</td>
                        <td width="191">n Run</td>
                    </tr>
                    <tr>
                        <td>Dissolution Medium</td>
                        <td><span class="workingweight12">
                                <input type="text" name="DM" placeholder="HCL" value="" id="DM" required="required" />
                            </span></td>
                    </tr>
                    <tr>
                        <td>Volume Used</td>
                        <td><span class="workingweight12">
                                <input type="text" name="R2" placeholder="900" value="" id="R2" required="required" />&nbsp;<span>mL</span>
                            </span></td>
                    </tr>
                    <tr>
                        <td>Apparatus</td>
                        <td><select name="apparatus" id="apparatus">
                                <option value="">--Select Apparatus--</option>
                                <option value=1>1</option>
                                <option value=2>2</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Rotations Per Minute</td>
                        <td><span class="workingweight12">
                                <input type="text" name="Rm" placeholder="e.g 100" value="" id="Rm" required="required" />&nbsp;<span>rpm</span>
                            </span></td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td><span class="workingweight12">
                                <input type="text" name="R3" placeholder="e.g 30" value="" id="R3" required="required"  />&nbsp;<select id="time">
                                    <option value="">-Select-</option>
                                    <option value="">Hrs</option>
                                    <option value="">Mins</option>
                                </select>
                            </span></td>
                    </tr>
                </table>

            </div>
            <hr />
            <center><h3><u>3. Subsequent Dillution</u></h3></center></p>
            <div id="subsequent">
                <table id="assay">

                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td colspan="2"><input type="checkbox" name="ena" id="ena" />
                            <label for="ena">Add</label></td>
                        <td colspan="2"><input type="checkbox" name="ena2" id="ena2" />
                            <label for="ena2">Add</label></td>
                        <td colspan="2" ><input type="checkbox" name="ena3" id="ena3" />
                            <label for="ena3">Add</label></td>
                        <td colspan="2"><input type="checkbox" name="ena4" id="ena4" />
                            <label for="ena4">Add</label></td>
                        <td   >&nbsp;</td>


                    </tr>
                    <tr id="test1">
                        <td>&nbsp;</td>

                        <td>Label Claim (mg)</td>
                        <td><span>Volume Used</span></td>
                        <td><span>Pipette</span></td>
                        <td><span>Vf</span></td>
                        <td>Pipette2</td>
                        <td>Vf2</td>
                        <td>Pipette3</td>
                        <td>Vf3</td>
                        <td>Pipette4</td>
                        <td>Vf4</td>
                        <td><span>Concentration</span></td>





                    </tr>


                    <!--=======================SUBSEQUENT  DISSOLUTIONS AFTER DISSOLUTIONS===============================-->	

                    <tr>
                        <td class="workingweight" ><strong>Desired Concetration</strong></td>
                        <td class="labelclaim" ><input type="text" name="labelclaim" placeholder="e.g 20mg" value="" id="labelclaim" required /></td>
                        <td class ="vf1" >
                            <input type="text" name="vu" placeholder="e.g 20mg" value="" id="vu" readonly />
                        </td>
                        <td class="workingp1" >
                            <select name="workingp1" id="workingp1"  required >
                                <option value="1"></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </td>
                        <td class="workingv1">
                            <select name="workingv" id="workingv" required >
                                <option value="1"></option>
                                <option value="1">1</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>

                        </td>
                        <td class="conc" ><span class="workingp1">
                                <select name="workingp2" id="workingp2"  required="required" >
                                    <option value="1"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="8">8</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </span></td>
                        <td class="conc" ><span class="workingv1">
                                <select name="workingv2" id="workingv2" required="required" >
                                    <option value="1"></option>
                                    <option value="1">1</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                            </span></td>
                        <td class="conc" ><span class="workingp1">
                                <select name="workingp3" id="workingp3"  required="required" >
                                    <option value="1"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="8">8</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </span></td>
                        <td class="conc" ><span class="workingv1">
                                <select name="workingv3" id="workingv3" required="required" >
                                    <option value="1"></option>
                                    <option value="1">1</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                            </span></td>
                        <td class="conc" ><span class="workingp1">
                                <select name="workingp4" id="workingp4"  required="required" >
                                    <option value="1"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="8">8</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </span></td>
                        <td class="conc" ><span class="workingv1">
                                <select name="workingv4" id="workingv4" required="required" >
                                    <option value="1"></option>
                                    <option value="1">1</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="250">250</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                </select>
                            </span></td>

                        <td class="conc" ><input type="text" name="conc" placeholder="e.g 20mg" value="" id="conc" readonly /></td>                   
                    </tr>
                </table>
            </div>
            <hr />
            <p></p>
            <div id="sample"> 
                <p><center><h3><u>4. Standard Preparation for Dissolution</u></h3></center></p>
                <table id="assay">               
                    <tr>
                        <td rowspan="2">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2"><input type="checkbox" name="dill1" id="dill1" />
                            Add</td>
                        <td colspan="2"><input type="checkbox" name="dill2" id="dill2" />
                            Add</td>
                        <td colspan="2"><input type="checkbox" name="dill3" id="dill3" />
                            Add</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr id="test">
                        <td><span>Weight</span></td>
                        <td><span>Vf1</span></td>
                        <td><span>Pipette</span></td>
                        <td><span>Vf2</span></td>
                        <td><span>Pipette2</span></td>
                        <td><span>Vf3</span></td>
                        <td><span>Pipette3</span></td>
                        <td><span>Vf4</span></td>
                        <td><span>Concentration</span></td>

                    </tr>


                    <!--========================SAMPLE PREPARATION FOR DISSOLUTIONS==============================-->	

                    <tr>
                        <td class="workingweight" ><strong>Desired Weight</strong></td>
                        <td class="workingweight" ><input type="text" name="workingweight" placeholder="e.g 20mg" value="" id="workingweight" readonly/></td>

                        <td class="workingvf1" >                          
                            <select name="workingvf1" id="workingvf1" required >
                                <option value="1"></option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>
                        </td>


                        <td class="workingpipette1" >
                            <select name="workingp11" id="workingp11"  required >
                                <option value="1"></option>
                                <option value="1"></option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </td>
                        <td class="workingvf2">
                            <select name="workingvf2" id="workingvf2" required >
                                <option value="1"></option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>
                        </td>
                        <td class="workingpipette2" >
                            <select name="workingp12" id="workingp12"  required >
                                <option value="1"></option>
                                <option value="1"></option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </td>
                        <td class="workingvf3">
                            <select name="workingvf3" id="workingvf3" required >
                                <option value="1"></option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>
                        </td>

                        <td class="workingpipette2" >
                            <select name="workingp13" id="workingp13"  required >
                                <option value="1"></option>
                                <option value="1"></option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </td>
                        <td class="workingvf4">
                            <select name="workingvf4" id="workingvf4" required >
                                <option value="1"></option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>
                        </td>

                        <td class="mgml11"><input type="text" name="workingmgml" placeholder="e.g 0.04mg/ml" id ="workingmgml1" readonly  /></td>
                    </tr>


                    <!----================================================================================================================-->


                    <tr>
                        <td colspan="8" class="weight" width="10" >&nbsp;</td>
                    </tr>
                    <tr>
                        <input type="button" id="clear1" value="clear"/>
                        <td class="weight" ><strong>Standard A</strong></td>
                        <td class="weight" ><input type="text" name="u_weightA"  id="number"  value="<?php echo $assayweight['0']->weight; ?>" class="stdabc"/></td>
                        <td class ="vf1" >
                            <input type="text" name="v11" id="v11" readonly/>
                        </td>
                        <td class="pipette13333" >
                            <input type="text" name="standardp1" id="standardp1"  readonly/>

                        </td>
                        <td class="vf2111">
                            <input type="text" name="standardvf" id="standardvf" readonly/>

                        </td>
                        <td class="pipette2" >
                            <input type="text" name="p20" id="p20"  readonly/>

                        </td>
                        <td class="vf3">
                            <input type="text" name="vf3" id="vf3" readonly/>

                        </td>

                        <td class="pipette2" >
                            <input type="text" name="p211" id="p211"  readonly/>

                        </td>
                        <td class="vf3">
                            <input type="text" name="vf4" id="vf4" readonly/>

                        </td>

                        <td class="mgml"><input type="text" name="dmgml" placeholder="e.g 0.04mg/ml" id ="dmgml" value="" required readonly /></td>
                    </tr>

                    <tr>
                        <td class="weight" ><strong>Standard B</strong></td>
                        <td class="weight" ><input type="text" name="u_weightB" value="<?php echo $assayweight['1']->weight; ?>" id ="number1" class="stdabc" /></td>
                        <td class ="vf111" ><input type="text"  id="v2" name="v2" size="15"/></td>
                        <td class="pipette11111" ><input type="text" id="standardp2" name="standardp2" size="15" readonly/></td>
                        <td class="vf22222">
                            <input type="text" required id="standardvf1" name="standardvf1" size="15" readonly/> 
                        </td>

                        <td class="pipette21" >
                            <input type="text" id="p21" name="p21" size="15" readonly/> 
                        </td>
                        <td class="vf23">
                            <input type="text" required id="vf23" name="vf23" size="15" readonly/> 
                        </td>

                        <td class="pipette21" >
                            <input type="text" id="p22" name="p22" size="15" readonly/> 
                        </td>
                        <td class="vf23">
                            <input type="text" required id="vf24" name="vf24" size="15" readonly/> 
                        </td>

                        <td class="mgml1"><input type="text" name="dmgml1" placeholder="e.g 0.04mg/ml" value="" id="dmgml1" required readonly /></td>
                    </tr>



                </table>
            </div>
            <div>
                <p></p>
                <hr />
                <br />
                <p><center><h2>Preparation Procedure</h1></h2></center>
                    <hr />
                    <div><center><textarea name="procedure" cols="100" rows="5" placeholder="please describe the procedure you have used" required="true"></textarea></center></div>
                </p>
            </div>

            <p>
               <div id="waiting4"></div> 
                <input type="button" value="Save" class="submit-button" id="Export"/>
                <input type="button" type="submit" value="+Add New Active Ingredient" id="addassay">
                    <input type="button" id="finish" value="FINISHED" class="submit-button"/>
            </p>

      

                        </form>
                        </div>        
                        </body>
                        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/assay.min.js"></script>
                        <script type='text/javascript' src='<?php echo base_url(); ?>javascripts/zebra_dialog.js'></script>
                        <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/dissolution.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#workingp11").attr("disabled", "disabled");
                                $("#workingvf2").attr("disabled", "disabled");
                                $("#workingp12").attr("disabled", "disabled");
                                $("#workingvf3").attr("disabled", "disabled");
                                $("#workingp13").attr("disabled", "disabled");
                                $("#workingvf4").attr("disabled", "disabled");
                                $("#workingv").attr("disabled", "disabled");
                                $("#workingp1").attr("disabled", "disabled");
                                                        
                                $("#workingv2").attr("disabled", "disabled");
                                $("#workingp2").attr("disabled", "disabled");

                                $("#workingv3").attr("disabled", "disabled");
                                $("#workingp3").attr("disabled", "disabled");

                                $("#workingv4").attr("disabled", "disabled");
                                $("#workingp4").attr("disabled", "disabled");

                                //Sample assay preparation
                                $("#sp1").attr("disabled", "disabled");
                                $("#svf2").attr("disabled", "disabled");
                                $("#pipette2").attr("disabled", "disabled");
                                // $("#vf3").attr("disabled","disabled");
                                $("#pipette3").attr("disabled", "disabled");
                                $("#vf41").attr("disabled", "disabled");

                                //********************************************************
                                //standard preparation
                                //*******************************************************

                                //$(".dillution1").css("display","none");
                                $("#dill1").click(function() {
                                    if ($("#dill1").is(":checked", true)) {
                                        // $(".dillution1").show();
                                        $("#workingp11").attr("disabled", false);
                                        $("#workingvf2").attr("disabled", false);



                                    } else {
                                        // $(".dillution1").hide();
                                        $("#workingp11").attr("disabled", "disabled");
                                        $("#workingvf2").attr("disabled", "disabled");
                                        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

                                    }
                                });
                                $("#dill2").click(function() {
                                    if ($("#dill2").is(":checked", true)) {
                                        // $(".dillution1").show();
                                        $("#workingp12").attr("disabled", false);
                                        $("#workingvf3").attr("disabled", false);



                                    } else {
                                        // $(".dillution1").hide();
                                        $("#workingp12").attr("disabled", "disabled");
                                        $("#workingvf3").attr("disabled", "disabled");
                                        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

                                    }
                                });
                                $("#dill3").click(function() {
                                    if ($("#dill3").is(":checked", true)) {
                                        // $(".dillution1").show();
                                        $("#workingp13").attr("disabled", false);
                                        $("#workingvf4").attr("disabled", false);



                                    } else {
                                        // $(".dillution1").hide();
                                        $("#workingp13").attr("disabled", "disabled");
                                        $("#workingvf4").attr("disabled", "disabled");
                                        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

                                    }

                                });


                                $("#ena").click(function() {
                                    if ($("#ena").is(":checked", true)) {
                                        // $(".dillution1").show();
                                        $("#workingp1").attr("disabled", false);
                                        $("#workingv").attr("disabled", false);



                                    } else {
                                        // $(".dillution1").hide();
                                        $("#workingp1").attr("disabled", "disabled");
                                        $("#workingv").attr("disabled", "disabled");
                                        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

                                    }
                                });
                                                            
                                $("#ena2").click(function() {
                                    if ($("#ena2").is(":checked", true)) {
                                        // $(".dillution1").show();
                                        $("#workingp2").attr("disabled", false);
                                        $("#workingv2").attr("disabled", false);



                                    } else {
                                        // $(".dillution1").hide();
                                        $("#workingp2").attr("disabled", "disabled");
                                        $("#workingv2").attr("disabled", "disabled");
                                        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

                                    }
                                });
                                                            
                                $("#ena3").click(function() {
                                    if ($("#ena3").is(":checked", true)) {
                                        // $(".dillution1").show();
                                        $("#workingp3").attr("disabled", false);
                                        $("#workingv3").attr("disabled", false);



                                    } else {
                                        // $(".dillution1").hide();
                                        $("#workingp3").attr("disabled", "disabled");
                                        $("#workingv3").attr("disabled", "disabled");
                                        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

                                    }
                                });
                                                            
                                $("#ena4").click(function() {
                                    if ($("#ena4").is(":checked", true)) {
                                        // $(".dillution1").show();
                                        $("#workingp4").attr("disabled", false);
                                        $("#workingv4").attr("disabled", false);



                                    } else {
                                        // $(".dillution1").hide();
                                        $("#workingp4").attr("disabled", "disabled");
                                        $("#workingv4").attr("disabled", "disabled");
                                        // $('#workingp1').val($('#workingp1').find("option").first().val());                            

                                    }
                                });

                            });
                                                    


                            $("#savedissolution1").click(function() {
                                jQuery(function() {

                                    $.Zebra_Dialog('<strong>Dissolution</strong>, would you like to save and move to the next stage or just save?', {
                                        'type': 'question',
                                        'title': 'Dissolution Stage Request',
                                        'buttons': [
                                            {caption: 'Move', callback: function() {
                                                    window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";
                                                }},
                                            {caption: 'Save', callback: function() {
                                                    window.location.href = "<?php echo base_url(); ?>dissolution/save_weights";
                                                }},
                                            {caption: 'Save & Move', callback: function() {
                                                    window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";
                                                }},
                                            {caption: 'Cancel', callback: function() {
                                                }}
                                        ]
                                    })

                                })
                            })
                            $(document).ready(function() {
                                $('p#show').hide();
                                $('p#hide').click(function() {
                                    $('div#a').slideUp();
                                    $('p#show').show();
                                    $(this).hide();
                                });
                                $('p#show').click(function() {
                                    $('div#a').slideDown();
                                    $(this).hide();
                                    $('p#hide').show();
                                });
                            });

                            $(document).ready(function() {
                                $('#dialog').hide();
                                $('#distest').click(function(){
                                    $.fx.speeds._default = 1000;

                                    $("#dialog").dialog({
                                        autoOpen: true,
                                        show: "blind",
                                        hide: "explode",
                                        modal: true
                                    });

                                });

                                $('#d').click(function() {
                                    $("#dialog").dialog("close");
                                })
                                $('#d1').click('change', function() {
                                    window.location.href = "<?php echo base_url(); ?>dissolution/multidissolution/";
                                    $(this).dialog("close");
                                })
                                $('#d2').click('change', function() {
                                    window.location.href = "<?php echo base_url(); ?>dissolution/multistaged";
                                    $(this).dialog("close");
                                })
                                $("#distest").click(function() {
                                    $("#dialog").dialog("open");
                                    return false;
                                });


                            });
                        </script>
                        </html>

                        </html>
