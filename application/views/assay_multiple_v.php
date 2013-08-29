<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>stylesheets/styleassay.css" type="text/css" media="screen"/>
    <link href="<?php echo base_url(); ?>stylesheets/jquery_notification.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/jquery_notification_v.1.js"></script>
    <style type="text/css">
        input#mgml1,#workingmgml,
        #mgml,#smgml2,#smgml,#smgml3,#smgml1{
            /*            width: 150px;*/
        }
    </style>
    <script type="text/javascript">
        showNotification({
            type: "information",
            message: "Hi!, Assay Area!.",
            autoClose: true,
            duration: 2
        });

        $(document).ready(function() {
            $('form').dumbFormState({
                persistPasswords: false, // default is false, recommended to NOT do this
                persistLocal: true, // default is false, persists in sessionStorage or to localStorage
                skipSelector: null, // takes jQuery selector of items you DO NOT want to persist 
                autoPersist: true // true by default, false will only persist on form submit
            });


        });

        function generate(type) {

            var today = new Date();
            var cHour = today.getHours();
            var cMin = today.getMinutes();
            var cSec = today.getSeconds();
            var time = cHour + ":" + cMin + ":" + cSec;

            var d = new Date();

            var month = d.getMonth() + 1;
            var day = d.getDate();

            var output = (('' + day).length < 2 ? '0' : '') + day + '/' +
                    (('' + month).length < 2 ? '0' : '') + month + '/' +
                    d.getFullYear();
            var n = noty({
                text: type,
                type: type,
                dismissQueue: true,
                layout: 'topCenter',
                theme: 'defaultTheme',
                timeout: 5000,
                text:'Work Autosaved Temporarily: ' + output + '\t' + time
            });
            console.log('html: ' + n.options.id);
        }

        function generateAll() {

            generate('information');

        }

        $(document).ready(function() {

            setInterval(generateAll, 20000);

        });


        //SAVE AND ADD ACTIVE INGREDIENT======================================================================
        $(document).ready(function() {
            loadComponents();
            //loadRepeatComponents();
            // $("div#sampleassay").hide();
            $('#addassay').hide();
            $('#finish').hide();
            $('#Export').click(function() {
                $(this).prop('value', 'Processing....');
                $(this).prop('disabled', 'disabled');
                $('#Export_r').hide();
                postData = $('#assayFormMultiple').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>wkstest/exportTabsToExcel_t/<?php echo $labref; ?>",
                    data: postData,
                    success: function(data) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>assay/save_assay_multiple/<?php echo $labref; ?>",
                            data: postData,
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
                                loadComponents();
                                $('form').dumbFormState('remove');
                            },
                            error: function() {
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
                return false;
            });

            function loadComponents() {
                var select = $('#activeIngredient').empty();
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>assay/loadComponents/<?php echo $labref; ?>",
                    dataType: "json",
                    success: function(data) {

                        $.each(data, function(i, r) {
                            var opt = (r.name);
                            select.append("<option value=" + opt + ">" + opt + "</option>")
                        });
                    },
                    error: function() {

                    }
                });

            }
            function loadRepeatComponents() {
                var select = $('#activeIngredient').empty();
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url(); ?>assay/loadRepeatComponents/<?php echo $labref; ?>",
                    dataType: "json",
                    success: function(data) {

                        $.each(data, function(i, r) {
                            var opt = (r.name);
                            select.append("<option value=" + opt + ">" + opt + "</option>")
                        });
                    },
                    error: function() {

                    }
                });

            }

            //SAVE AND REPEAT==================================================================================== 
            $('#Export_r').click(function() {
                $(this).prop('value', 'Processing....');
                $(this).prop('disabled', 'disabled');
                $('#Export').hide();
                postData = $('#assayFormMultiple').serialize();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>wkstest/exportTabsToExcel_t/<?php echo $labref; ?>",
                    data: postData,
                    success: function(data) {
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>assay/save_assay_multiple/<?php echo $labref; ?>",
                            data: postData,
                            success: function() {
                                loadRepeatComponents();
                                $('.activeIngredient').show();
                                $('#Export_r').prop('value', 'Save');
                                $('#Export_r').prop('disabled', false);
                                $('form').dumbFormState('remove');
                                showNotification({
                                    message: "The data has been successfully saved! ",
                                    type: "success",
                                    autoClose: true,
                                    duration: 5

                                });


                                $('input[type=number],input[type=text],#workingvf1,#workingp1,#workingvf2,#svf1,#svf2,#sp1,#apparatus').each(function() {
                                    $(this).val('');
                                });


                            },
                            error: function() {
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
                return false;
            });
            //========================================================================================================  



            $('#addassay').click(function() {
                $('input[type=number],input[type=text],#workingvf1,#workingp1,#workingvf2,#svf1,#svf2,#sp1,#apparatus').each(function() {
                    $(this).val('');

                });
                $(this).hide();
                $('#Export').show();
                $('#Export_r').show();
                $('#finish').show();
                $('#Export').prop('value', 'Save Data & Add Active Ingredient');
                $('#Export').prop('disabled', false);
                // $('.activeIngredient').show();
                loadComponents();
                //loadRepeatComponents();
            });

            $('#finish').click(function() {
                window.location.href = '<?php echo base_url() ?>analyst_controller';
            });


        });



    </script>
</head>
<style> 
    input#activeIngredient{
        width: 250px;
        text-align: center;
        font-weight: bold;
    }
    .activeIngredient{
        display: none;
    }
</style>
<body>
    <p><h3><<<a href='<?php echo base_url() . 'analyst_controller/'; ?>'>Return To Analyst Home</a></h3> <center><legend><h2>Sample: <?php echo $labref; ?> </h2></legend></center></p>
</p>
<hr /> 
<h4>NB: If you want to use predefined weight, use this <a href='<?php echo base_url() . 'assay/assayMultiplePetition/' . $labref; ?>'> worksheet</a></h4>     
<center><h2>Standard Preparation for Assay</h2></center>
<hr />
<!--input type="button" value="Export to excel" id="Export"/-->
<div id="contentassay">
    <div> 
        <?php $attributes = array('id' => 'assayFormMultiple'); ?>
        <?php echo form_open('assay/save_assay_multiple/' . $labref, $attributes); ?>


        <legend>Multiple Assay Data Details</legend>
        <table id="assay">

            <thead>Active Ingredient Name</thead><br /><br>

            <select name="heading" id="activeIngredient" >               
            </select><span class='activeIngredient'><a href="<?php echo base_url() . 'assay/worksheet/' . $labref . '/6' ?>">No, I don't want a Repeat!</a></span>



            <p>
            <div> <input type="hidden" name="potency" id="potency" /></div>

            <table id="assay">              

                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th colspan="2"><form name="form1" method="post" action="">
                            <input type="checkbox" name="dill1" id="dill1">
                            <label for="dill1"></label>
                            Add
                        </form></th>
                    <th colspan="2"><input type="checkbox" name="dill2" id="dill2">
                        <label for="dill2"></label>
                        Add </th>
                    <th colspan="2"><input type="checkbox" name="dill3" id="dill3">
                        <label for="dill3"></label>
                        Add </th>
                    <th>&nbsp;</th>
                </tr>
                <tr id="test">

                    <th><span>&nbsp;</span></th>

                    <th><span>Weight</span></th>
                    <th><span>Vf1</span></th>
                    <th><span>Pipette1</span></th>
                    <th><span>Vf2</span></th>
                    <th><span class="vf3head">Pipette2</span></th>
                    <th><span class="vf3head">Vf3</span></th>
                    <th><span class="vf3head4">Pipette3</span></th>
                    <th><span class="vf3head4">Vf4</span></th>
                    <th><span>Concentration</span></th>

                </tr>


                <!--======================================================-->	

                <tr>
                    <td class="workingweight" ><strong>Desired Weight</strong></td>
                    <td class="workingweight" ><input type="text" name="workingweight" placeholder="e.g 20mg" value="" id="workingnumber" required /></td>
                    <td class ="vf1" >
                        <select name="workingvf1" id="workingvf1" required width="30">
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
                    <td class="dillution1" >
                        <select name="workingpipette1" id="workingp1"  required >
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
                    <td class="dillution1">
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
                    <td class="vf3head" >
                        <select name="workingpipette2" id="workingp2"  required >                            
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
                    <td class="vf3head">
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

                    <td class="vf3head4" >
                        <select name="workingp3" id="workingp3"  required >                            
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
                    <td class="vf3head4">
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
                    <td class="mgml11"><input type="text" name="workingmgml" placeholder="e.g 0.04mg/ml" id ="workingmgml" value=""   class="concetrate"/></td>
                </tr>


                <!----================================================================================================================-->


                <tr>
                    <td colspan="6" class="weight" width="7" >&nbsp;</td>
                </tr>
                <tr>
                    <td class="weight" ><strong>Standard A</strong></td>
                    <td class="weight" ><input type="text" name="u_weight" placeholder="e.g 20mg" value="" id="number" required tabindex="1" /></td>
                    <td class ="vf1" >
                        <input type="text" name="vf1" id="vf1" readonly/>
                    </td>
                    <td class="dillution1" >
                        <input type="text" name="pipette1" id="p1"  readonly/>

                    </td>
                    <td class="dillution1">
                        <input type="text" name="vf2" id="vf2" readonly/>

                    </td>
                    <td class="vf3head" >
                        <input type="text" name="p2" id="p2"  readonly/>
                    </td>
                    <td class="vf3head">
                        <input type="text" name="vf31" id="vf31" readonly/>
                    </td>

                    <td class="vf3head4" >
                        <input type="text" name="p321" id="p321"  readonly/>
                    </td>
                    <td class="vf3head">
                        <input type="text" name="vf32" id="vf32" readonly/>
                    </td>

                    <td class="mgml"><input type="text" name="mgml" placeholder="e.g 0.04mg/ml" id ="mgml" value="" required readonly  class="concetrate"/></td>
                </tr>

                <tr>
                    <td class="weight" ><strong>Standard B</strong></td>
                    <td class="weight" ><input type="text" name="u_weight1" placeholder="e.g 20mg" value="" id ="number1" required  tabindex="2"/></td>
                    <td class ="vf111" >
                        <input type="text" required id="vf11" name="vf11" size="15" readonly/> 
                    </td>
                    <td class="dillution1" >
                        <input type="text" required id="p11" name="ppt" size="15" readonly/> 
                    </td>
                    <td class="dillution1">
                        <input type="text" required id="vf22" name="vf22" size="15" readonly/> 
                    </td>
                    <td class="vf3head" >
                        <input type="text" required id="ppt1" name="ppt1" size="15" readonly/> 
                    </td>
                    <td class="vf3head">
                        <input type="text" required id="vf33" name="vf33" size="15" readonly/> 

                    <td class="vf3head4" >
                        <input type="text" required id="ppt2" name="ppt2" size="15" readonly/> 
                    </td>
                    <td class="vf3head4">
                        <input type="text" required id="vf34" name="vf34" size="15" readonly/> 

                    </td>
                    <td class="mgml1"><input type="text" name="mgml1" placeholder="e.g 0.04mg/ml" value="" id="mgml1" required readonly  class="concetrate"/></td>
                </tr>



            </table>


            <div id="sampleassay">

                <p></p>
                <hr/>
                <center><h2>Sample Assay Preparation</h2></center>
                <hr />    	
                <div>
                    <h3><label for="tabs_caps_average">Tablet or Capsule Weight: </label></h3>
                    <select name="tabs_caps_average" id="tabs_caps_average" >
                        <option value="">select average</option>
                        <option value="1">Not Available</option>
                        <?php foreach ($unassay as $assay): ?>                    
                            <?php echo '<option value=' . $assay->average . '>' . $assay->average . '</option>'; ?>                    
                        <?php endforeach; ?>
                    </select>
                    <table id ="sample">		
                        <tr>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th colspan="2"><input type="checkbox" name="dillstd1" id="dillstd1">
                                <label for="dillstd1"></label></th>
                            <th colspan="2"><input type="checkbox" name="dillstd2" id="dillstd2">
                                <label for="dillstd2"></label></th>
                            <th colspan="2"><input type="checkbox" name="dillstd3" id="dillstd3">
                                <label for="dillstd3"></label></th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                        <tr id="test">
                            <th>                     </th>
                            <th>Powder Weight</th>

                            <th><span>API Weight</span></th>
                            <th><span>Vf1</span></th>
                            <th><span>Pipette1</span></th>
                            <th><span>Vf2</span></th>
                            <th><span class="vf3head">Pipette2</span></th>
                            <th> <span class="vf3head">vf3</span></th>
                            <th><span class="vf3head">Pipette3</span></th>
                            <th> <span class="vf3head">vf4</span></th>
                            <th><span>Concentration</span></th>
                            <th>Label Claim(mg)</th>		
                        </tr>




                        <tr>
                            <td class="weight" ><strong>Desired Weight</strong></td>
                            <td class="weight" ><input type="text" name="pwnumber" placeholder="325mg" value="" id="pwnumber" readonly /></td>
                            <td class="weight" ><input type="text" name="aiweight" placeholder="e.g 20mg" value="" id="aiweight"  /></td>
                            <td class ="vf1" >
                                <select name="svf1" id="svf1" required width="30">
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
                            <td class="dillution1" >
                                <select name="sp1" id="sp1"  required >
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
                                    <option value="90">90</option>
                                    <option value="100">100</option>
                                </select>
                            </td>
                            <td class="dillution1">
                                <select name="svf2" id="svf2" required >
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
                            <td class="vf3head"><select name="pipette2" id="pipette2" required value="1">
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
                                    <option value="90">90</option>
                                    <option value="100">100</option>
                                </select></td>
                            <td class="vf3head"><select name="vf3" id="vf3" required value="1">
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
                                </select></td>
                            <td class="vf3head4"><select name="pipette3" id="pipette3" required value="1">
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
                                    <option value="90">90</option>
                                    <option value="100">100</option>
                                </select></td>
                            <td class="vf3head4"><select name="vf41" id="vf41" required value="1">
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
                                </select></td>
                            <td class="mgml"><input type="text" name="smgml" placeholder="0.04mg/ml" id ="smgml" value="" required readonly  class="concetrate"/></td>
                            <td class="mgml"><input type="text" name="labelclaim" placeholder="0.04mg/ml" id ="labelclaim" value="" required  /></td>
                        </tr>

                        <tr>
                            <td colspan="9" class="weight" >&nbsp;</td>
                        <tr>
                            <td class="weight" ><strong>Sample A</strong></td>
                            <td class="weight" ><input type="text" name="sampleA" placeholder="e.g 20mg"  id="sampleA" required /></td>
                            <td class="weight" ><input type="text" name="aweightA" placeholder="e.g 20mg"  id ="aweightA" readonly/></td>
                            <td class ="vf111" >
                                <input type="text" required id="svf11" name="svf11" size="15" readonly/> 
                            </td>
                            <td class="dillution1" >
                                <input type="text" required id="sp11" name="sp11" size="15" readonly/> 
                            </td>
                            <td class="dillution1">
                                <input type="text" required readonly id="svf12" name="svf12" size="15"/> 
                            </td>
                            <td class="vf3head"><input type="text" required id="spf1" name="spf1" size="15"  readonly /></td>
                            <td class="vf3head"><input type="text" required id="svf13" name="svf13" size="15"  readonly /></td>

                            <td class="vf3head4"><input type="text" required id="spf21" name="spf21" size="15" readonly /></td>
                            <td class="vf3head4"><input type="text" required id="svf14" name="svf14" size="15"  readonly /></td>
                            <td class="mgml1"><input type="text" name="smgml1" placeholder="e.g 0.04mg/ml" value="" id="smgml1" required readonly  class="concetrate"/></td>
                            <td rowspan="3" class="mgml1">&nbsp;</td>




                        <tr>
                            <td class="weight" ><strong>Sample B</strong></td>
                            <td class="weight" ><input type="text" name="sampleB" placeholder="e.g 20mg" value="" id="sampleB" required /></td> 
                            <td class="weight" ><input type="text" name="aweightB" placeholder="e.g 20mg" value="" id ="aweightB" readonly /></td>

                            <td class ="vf111" >

                                <input type="text" required id="svf111" name="vf111" size="15" readonly/> 
                            </td>
                            <td class="dillution1" >
                                <input type="text" required id="sp112" name="sp112" size="15" readonly/> 
                            </td>
                            <td class="dillution1">
                                <input type="text" readonly required id="svf22" name="svf22" size="15"/> 
                            </td>
                            <td class="vf3head"><input type="text" required id="spf2" name="spf2" size="15"  readonly /></td>
                            <td class="vf3head"><input type="text" required id="svf23" name="svf23" size="15"  readonly /></td>

                            <td class="vf3head4"><input type="text" required id="spf33" name="spf33" size="15"  readonly /></td>
                            <td class="vf3head4"><input type="text" required id="svf241" name="svf241" size="15"  readonly /></td>

                            <td class="mgml1"><input type="text" name="smgml2" placeholder="e.g 0.04mg/ml" value="" id="smgml2" readonly  class="concetrate"/></td>
                        </tr>


                        <tr>
                            <td class="weight" ><strong>Sample C</strong></td>
                            <td class="weight" ><input type="text" name="sampleC" placeholder="e.g 20mg" value="" id="sampleC" required /></td> 
                            <td class="weight" ><input type="text" name="aweightC" placeholder="e.g 20mg" value="" id ="aweightC" readonly/></td>
                            <td class ="vf3" >

                                <input type="text" required id="svf3" name="svf3" size="15" readonly/> 
                            </td>
                            <td class="dillution1" >
                                <input type="text" required id="ssp3" name="ssp3" size="15" readonly/> 
                            </td>
                            <td class="dillution1">
                                <input type="text" readonly required id="svf33" name="svf33" size="15"/> 
                            </td>
                            <td class="vf3head"><input type="text" required id="spf3" name="spf3" size="15" readonly /></td>
                            <td class="vf3head"><input type="text" required id="svf24" readonly name="svf24" size="15" /></td>

                            <td class="vf3head4"><input type="text" required id="spf4" name="spf4" size="15" readonly /></td>
                            <td class="vf3head4"><input type="text" required id="svf25" name="svf25" size="15" readonly /></td>

                            <td class="mgml3"><input type="text" name="smgml3" placeholder="e.g 0.04mg/ml" value="" id="smgml3" required readonly  class="concetrate"/></td>
                        </tr>



                    </table>
                    <p>
                    <p></p>
                    <p></p>
                    <hr />
                    <br />
                    <p><center><h2>Preparation Procedure</h1></h2></center>
                    <hr />
                    <div><center><textarea name="procedure" cols="100" rows="5" placeholder="please describe the procedure you have used"></textarea></center></div>
                    </p>




                    <p class="submit">
                        <input type="button" id="Export" value="Save Data & Add Active Ingredient" class=""/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="Export_r" value="Save & Repeat" class=""/><br />
                        <input type="button" type="submit" value="+Add New Active Ingredient" id="addassay">
                        <input type="button" id="finish" value="FINISHED"/>
                    </p>
                </div>
            </div>
            </form>
            <script type="text/javascript" src="<?php echo base_url(); ?>javascripts/assay.min.js"></script>
    </div>

</div>
</div>
</body>

<script>
    $(document).ready(function() {

        // $("div#sampleassay").hide();
        //standard preparation
        $("#workingp1").attr("disabled", "disabled");
        $("#workingvf2").attr("disabled", "disabled");
        $("#workingp2").attr("disabled", "disabled");
        $("#workingvf3").attr("disabled", "disabled");
        $("#workingp3").attr("disabled", "disabled");
        $("#workingvf4").attr("disabled", "disabled");

        //Sample assay preparation
        $("#sp1").attr("disabled", "disabled");
        $("#svf2").attr("disabled", "disabled");
        $("#pipette2").attr("disabled", "disabled");
        $("#vf3").attr("disabled", "disabled");
        $("#pipette3").attr("disabled", "disabled");
        $("#vf41").attr("disabled", "disabled");

        //********************************************************
        //standard preparation
        //*******************************************************

        //$(".dillution1").css("display","none");
        $("#dill1").click(function() {
            if ($("#dill1").is(":checked", true)) {
                // $(".dillution1").show();
                $("#workingp1").attr("disabled", false);
                $("#workingvf2").attr("disabled", false);



            } else {
                // $(".dillution1").hide();
                $("#workingp1").attr("disabled", "disabled");
                $("#workingvf2").attr("disabled", "disabled");
                // $('#workingp1').val($('#workingp1').find("option").first().val());                            

            }
        });
        $("#dill2").click(function() {
            if ($("#dill2").is(":checked", true)) {
                // $(".dillution1").show();
                $("#workingp2").attr("disabled", false);
                $("#workingvf3").attr("disabled", false);



            } else {
                // $(".dillution1").hide();
                $("#workingp2").attr("disabled", "disabled");
                $("#workingvf3").attr("disabled", "disabled");
                // $('#workingp1').val($('#workingp1').find("option").first().val());                            

            }
        });
        $("#dill3").click(function() {
            if ($("#dill3").is(":checked", true)) {
                // $(".dillution1").show();
                $("#workingp3").attr("disabled", false);
                $("#workingvf4").attr("disabled", false);



            } else {
                // $(".dillution1").hide();
                $("#workingp3").attr("disabled", "disabled");
                $("#workingvf4").attr("disabled", "disabled");
                // $('#workingp1').val($('#workingp1').find("option").first().val());                            

            }

        });


        //********************************************************
        //sample preparation preparation
        //*******************************************************

        //$(".dillution1").css("display","none");
        $("#dillstd1").click(function() {
            if ($("#dillstd1").is(":checked", true)) {
                // $(".dillution1").show();
                $("#sp1").attr("disabled", false);
                $("#svf2").attr("disabled", false);



            } else {
                // $(".dillution1").hide();
                $("#sp1").attr("disabled", "disabled");
                $("#svf2").attr("disabled", "disabled");
                // $('#workingp1').val($('#workingp1').find("option").first().val());                            

            }
        });
        $("#dillstd2").click(function() {
            if ($("#dillstd2").is(":checked", true)) {
                // $(".dillution1").show();
                $("#pipette2").attr("disabled", false);
                $("#vf3").attr("disabled", false);



            } else {
                // $(".dillution1").hide();
                $("#pipette2").attr("disabled", "disabled");
                $("#vf3").attr("disabled", "disabled");
                // $('#workingp1').val($('#workingp1').find("option").first().val());                            

            }
        });
        $("#dillstd3").click(function() {
            if ($("#dillstd3").is(":checked", true)) {
                // $(".dillution1").show();
                $("#pipette3").attr("disabled", false);
                $("#vf41").attr("disabled", false);



            } else {
                // $(".dillution1").hide();
                $("#pipette3").attr("disabled", "disabled");
                $("#vf41").attr("disabled", "disabled");
                // $('#workingp1').val($('#workingp1').find("option").first().val());                            

            }

        });
    });
</script>

</html>