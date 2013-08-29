<div id="main_wrapper"> 
    <head>
        <style type="text/css">
            table{
                border: #000000 1px solid;
                padding: 0px;
            }
            td{
                border: #000000 1px solid;
            }
            input[type=text]{
                text-align: center;
            }
            span#complies{
                font-family: sans-serif;
                color: white;
                background-color: blue;
                font-weight: bold;

            }
            span#dcomply{
                font-family: sans-serif;
                color: white;
                background-color: red;
                font-weight: bold;
            }
            span.span11{
                background-color: #F93;
                color: #F93;                
                width: 10px;
            }
            span.span12{
                background-color: #33ff33;
                color:#33ff33;
                width: 10px;
            }
            span.span13{
                background-color: #E0E2FF;
                color:#E0E2FF;
                width: 10px;
            }
            #dialog{
                display: none;
            }

        </style>
        <script type="text/javascript">
            $(document).ready(function() {
                repeat_no =<?php echo $repeat_no; ?>;
                if (repeat_no === 1) {
                    prompt_dialog();
                }

                else if (repeat_no === 2) {
                    new Messi('This test has already been repeated. ' + repeat_no + ' times and is now marked as an OOS Sample, I\'ll take you Home', {title: '<?php echo $labref; ?> : OOS Sample Notification', titleClass: 'anim error', modal: true, buttons: [{id: 0, label: 'Lets Go!', val: 'X'}], callback: function(val) {

                            if (val === 'X')
                                window.location.href = "<?php echo base_url() . 'analyst_controller/' ?>";
                        }});
                    //window.location.href = "<?php echo base_url() . 'analyst_controller/' ?>";

                }
                $('#Export').click(function() {
                    var bad = 0;
                    $('#capsForm :text').each(function()
                    {
                        if ($.trim(this.value) === "" || $.trim(this.value) === "NaN")
                            bad++;
                    });
                    if (bad > 0) {
                        $.prompt(bad + ' value(s) are missing, ensure all fields are filled and that deviations have been calculated if they\n\
                                have not been calculated');
                    }
                    else {
                        dataString2 = $('#capsForm').serialize();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>wkstest/exportCapsToExcel/<?php echo $labrefuri; ?>",
                            data: dataString2,
                            success: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url(); ?>uniformity/save_capsule_weights/<?php echo $labrefuri; ?>",
                                    data: dataString2,
                                    success: function() {
                                        $.prompt("Saving Success!, Do you want to repeat this test?", {
                                            title: "Repeat Request",
                                            buttons: {"Yes, I want to repeat": true, "No, Lets proceed": false},
                                            submit: function(e, v, m, f) {
                                                // use e.preventDefault() to prevent closing when needed or return false. 
                                                // e.preventDefault(); 
                                                repeat_no =<?php echo $repeat_no; ?>;
                                                if (v === true) {
                                                    if (repeat_no === 2) {
                                                        new Messi('This test has already been repeated. ' + repeat_no + ' times and is now marked as an OOS, I\'ll take you Home', {title: '<?php echo $labref; ?> :OOS Sample Notification', titleClass: 'info', buttons: [{id: 0, label: 'Close', val: 'X'}]});
                                                    } else {
                                                        $('input:text').val('');
                                                        $("#com").attr("value", "");
                                                        $('span').css('display', 'none');
                                                        prompt_dialog();

                                                    }

                                                } else {
                                                    $.prompt("Proceeding to Assay!");
                                                    window.location.href = "<?php echo base_url() . 'assay/assay_page/' . $labref; ?>";
                                                }

                                                console.log("Value clicked was: " + v);
                                            }
                                        });
                                        // alert('Data Saved to the database and exported to the database');
                                        // window.location.href="<?php echo base_url() . 'assay/assay_page/' . $labref; ?>";
                                    },
                                    error: function() {
                                        $.prompt('An internal problem has been experienced, data could not be exported!');
                                    }

                                });
                            },
                            error: function() {
                                $.prompt('An internal problem has been experienced, data could not be exported!');
                            }

                        });
                    }

                });

                $('#sendit').click(function() {
                    var data = $('#reason').serialize();
                    $.ajax({
                        type: 'post',
                        url: '<?php echo base_url() . 'tabs/postRepeatReason/' . $labref; ?>',
                        data: data,
                        success: function(data) {
                            alert(data);
                        },
                        error: function() {

                        }


                    })

                    $('#dialog').trigger('close');
                });
                $('#cancelit').click(function() {
                    window.location.href = "<?php echo base_url() . 'analyst_controller'; ?>";
                });

                function prompt_dialog() {
                    $("#dialog").lightbox_me({
                        closeClick: false,
                        centered: true
                    });
                }

            });

        </script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/jquery.validate.css?1500" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>stylesheets/style1.css?1500" />
        <link type='text/css' href='<?php echo base_url(); ?>stylesheets/css/zebra_dialog.css' rel='stylesheet' media='screen' />


        </script>

        <script src="<?php echo base_url(); ?>javascripts/jquery.validate.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>javascripts/jquery.validation.functions.js?1500" type="text/javascript">
        </script>
        <script src="<?php echo base_url(); ?>javascripts/nqcl.js?1500" type="text/javascript">
        </script>
        <script type='text/javascript' src='<?php echo base_url(); ?>javascripts/zebra_dialog.js'></script>

    </head>
    <body  >
        <h1>Capsule/Sachet/Vials Uniformity of Weight</h1>
        <p>
    <center><legend><h2>Sample: <?php echo $labref; ?> </h2></legend></center>
</p>
<div id="Individual_box">
    <p><h3><?php echo "WORKSHEET NO.: " . $labref; ?></h3></p>

    <?php echo form_open('uniformity/save_capsule_weights/' . $labrefuri, array('id' => 'capsForm')); ?>
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="dave-table">
        <!--input type="button" id="Export" value="Export Data to Excel"/-->
        <p>The colored fields are required</p>
        <input type="hidden" id="labrefuri" value="<?php echo $labrefuri; ?>"/>
        <tr>
            <td width="45" height="53"><div align="center">No.</div></td>
            <td width="144" align="center" valign="middle"><p align="center">Capsules/Sachets/Vials  (mg)</p></td>
            <td width="155">Empty Capsule/ Sachet/Vial  (mg)</td>
            <td width="147" align="center" valign="middle">Capsule/Sachet/Vial Content (mg)</td>
            <td width="138" valign="middle"><label id="Refresh" class="submit-button">Refresh</label><label id="calculate" class="submit-button">Calculate % deviation</label></td>

        </tr>
        <tr>
            <td><div align="center">1</div></td>
            <td><input type="text" id="utcsv1" name="tcsv1" size="25" class="unum" required value="" tabindex="1"/></td>
            <td><input type="text" id="uecsv1" name="ecsv1" size="25" class="unum1" value="" required tabindex="2"/></td>
            <td><input type="text" id="ucsvc1" name="csvc1" size="25" class="unum2" value="" readonly="readonly" /></td>
            <td><input type="text" id="udfm1"name=" dfm1" size="25" class="unum3" value="" readonly="readonly"/></td>
            <td><span id="span11" style="display:none" class="span11">A</span><span id="span12" style="display:none"  class="span12">N</span><span id="span13" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">2</div></td>
            <td><input type="text" id="utcsv2" name="tcsv2" class="unum" size="25" required value="" tabindex="3"/></td>
            <td><input type="text" id="uecsv2" name="ecsv2" class="unum1" size="25" required value="" tabindex="4"/>
            <td><input type="text" id="ucsvc2" name="csvc2"  class="unum2"size="25"readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm2" name=" dfm2" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span21" size="25" style="display:none" class="span11">A</span><span id="span22" style="display:none" size="25"  class="span12">N</span><span id="span13" style="display:none"  class="span23">O</span></td>
        </tr>
        <tr>
            <td><div align="center">3</div></td>
            <td><input type="text" id="utcsv3" name="tcsv3"  class="unum" size="25" required value="" tabindex="5"/></td>
            <td><input type="text" id="uecsv3" name="ecsv3" class="unum1" size="25" required value="" tabindex="6"/></td>
            <td><input type="text"  id="ucsvc3" name="csvc3" class="unum2" size="25" readonly="readonly" value="" /></td>
            <td><input type="text" id="udfm3" name=" dfm3" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span31" size="25" style="display:none" class="span11">A</span><span id="span32" style="display:none" size="25"  class="span12">N</span><span id="span33" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">4</div></td>
            <td><input type="text" id="utcsv4" name="tcsv4" class="unum" size="25" required value="" tabindex="7"/></td>
            <td><input type="text" id="uecsv4" name="ecsv4" class="unum1" size="25" required value="" tabindex="8"/></td>
            <td><input type="text" id="ucsvc4" name="csvc4" class="unum2" size="25" readonly="readonly"value=""  /></td>
            <td><input type="text" id="udfm4" name=" dfm4" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span41" size="25" style="display:none" class="span11">A</span><span id="span42" style="display:none" size=" 25" class="span12">N</span><span id="span43" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">5</div></td>
            <td><input type="text" id="utcsv5" name="tcsv5" size="25" class="unum" required value="" tabindex="9"/></td>
            <td><input type="text" id="uecsv5" name="ecsv5" size="25"  class="unum1" required value=""  tabindex="10"/></td>
            <td><input type="text" id="ucsvc5" name="csvc5" class="unum2" size="25" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm5" name=" dfm5" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span51" size="" style="display:none" class="span11">A</span><span id="span52" style="display:none" size=""  class="span12">N</span><span id="span53" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">6</div></td>
            <td><input type="text" id="utcsv6" name="tcsv6" size="25" class="unum" required value="" tabindex="11"/></td>
            <td><input type="text" id="uecsv6" name="ecsv6" size="25" class="unum1" required value="" tabindex="12"/></td>
            <td><input type="text" id="ucsvc6" name="csvc6" size="25" class="unum2" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm6" name=" dfm6" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span61" size="" style="display:none" class="span11">A</span><span id="span62" style="display:none" size=""  class="span12">N</span><span id="span63" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">7</div></td>
            <td><input type="text" id="utcsv7" name="tcsv7" size="25" class="unum" required value="" tabindex="13"/></td>
            <td><input type="text" id="uecsv7" name="ecsv7" size="25" class="unum1" required value="" tabindex="14"/></td>
            <td><input type="text" id="ucsvc7" name="csvc7" size="25" class="unum2" readonly="readonly"  value=""/></td>
            <td><input type="text" id="udfm7" name=" dfm7" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span71" size="" style="display:none" class="span11">A</span><span id="span72" style="display:none" size=""  class="span12">N</span><span id="span73" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">8</div></td>
            <td><input type="text" id="utcsv8" name="tcsv8" size="25" class="unum"  required value="" tabindex="15"/></td>
            <td><input type="text"  id="uecsv8" name="ecsv8" size="25" class="unum1" required value="" tabindex="16"/></td>
            <td><input type="text" id="ucsvc8" name="csvc8" size="25" class="unum2"  readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm8" name=" dfm8" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span81" size="" style="display:none" class="span11">A</span><span id="span82" style="display:none" size=""  class="span12">N</span><span id="span83" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">9</div></td>
            <td><input type="text" id="utcsv9" name="tcsv9" size="25" class="unum"  required value="" tabindex="17"/></td>
            <td><input type="text"  id="uecsv9" name="ecsv9" size="25" class="unum1" required value="" tabindex="18"/></td>
            <td><input type="text" id="ucsvc9" name="csvc9" size="25" class="unum2"  readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm9" name=" dfm9" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span91" size="" style="display:none" class="span11">A</span><span id="span92" style="display:none" size=""  class="span12">N</span><span id="span93" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">10</div></td>
            <td><input type="text" id="utcsv10"  name="tcsv10" class="unum" size="25" required value="" tabindex="19"/></td>
            <td><input type="text" id="uecsv10" name="ecsv10"  class="unum1" size="25" required value="" tabindex="20"/></td>
            <td><input type="text" id="ucsvc10"  name="csvc10" class="unum2" size="25" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm10" name=" dfm10" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span101" size="" style="display:none" class="span11">A</span><span id="span102" style="display:none" size=""  class="span12">N</span><span id="span103" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">11</div></td>
            <td><input type="text" id="utcsv11" name="tcsv11" class="unum" size="25" required value="" tabindex="21"/></td>
            <td><input type="text" id="uecsv11" name="ecsv11"class="unum1"  size="25" required value="" tabindex="22"/></td>
            <td><input type="text" id="ucsvc11"name="csvc11" class="unum2" size="25" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm11" name=" dfm11" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span111" size="" style="display:none" class="span11">A</span><span id="span112" style="display:none" size=""  class="span12">N</span><span id="span113" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">12</div></td>
            <td><input type="text" id="utcsv12" name="tcsv12" class="unum" size="25" required value="" tabindex="23"/></td>
            <td><input type="text" id="uecsv12" name="ecsv12" class="unum1" size="25" required value="" tabindex="24"/></td>
            <td><input type="text" id="ucsvc12" name="csvc12" class="unum2" size="25" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm12" name=" dfm12" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span121" size="" style="display:none" class="span11">A</span><span id="span122" style="display:none" size=""  class="span12">N</span><span id="span123" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">13</div></td>
            <td><input type="text" id="utcsv13"  name="tcsv13" size="25" class="unum" required value="" tabindex="25"/></td>
            <td><input type="text" id="uecsv13" name="ecsv13" size="25" required class="unum1" value="" tabindex="26"/></td>
            <td><input type="text" id="ucsvc13" name="csvc13" size="25" class="unum2" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm13" name=" dfm13" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span131" size="" style="display:none" class="span11">A</span><span id="span132" style="display:none" size=""  class="span12">N</span><span id="span133" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">14</div></td>
            <td><input type="text" id="utcsv14" name="tcsv14" size="25" required class="unum" value="" tabindex="27"/></td>
            <td><input type="text" id="uecsv14" name="ecsv14" size="25" required class="unum1" value="" tabindex="28" ></td>
            <td><input type="text" id="ucsvc14" name="csvc14" size="25" class="unum2" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm14" name=" dfm14" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span141" size="" style="display:none" class="span11">A</span><span id="span142" style="display:none" size=""  class="span12">N</span><span id="span143" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">15</div></td>
            <td><input type="text" id="utcsv15" name="tcsv15" size="25" required class="unum" value="" tabindex="29"/></td>
            <td><input type="text" id="uecsv15" name="ecsv15" size="25" required class="unum1" value="" tabindex="30"/></td>
            <td><input type="text" id="ucsvc15" name="csvc15" size="25" class="unum2" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm15" name=" dfm15" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span151" size="" style="display:none" class="span11">A</span><span id="span152" style="display:none" size=""  class="span12">N</span><span id="span153" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">16</div></td>
            <td><input type="text" id="utcsv16" name="tcsv16" size="25" required class="unum" value="" tabindex="31"/></td>
            <td><input type="text" id="uecsv16" name="ecsv16" size="25" required class="unum1"value="" tabindex="32"/></td>
            <td><input type="text"  id="ucsvc16" name="csvc16" size="25" class="unum2" readonly="readonly" value="" /></td>
            <td><input type="text" id="udfm16" name=" dfm16" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span161" size="" style="display:none" class="span11">A</span><span id="span162" style="display:none" size=""  class="span12">N</span><span id="span163" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">17</div></td>
            <td><input type="text" id="utcsv17"name="tcsv17" size="25" required class="unum" value="" tabindex="33"/></td>
            <td><input type="text" id="uecsv17" name="ecsv17" size="25" required class="unum1" value="" tabindex="34"/></td>
            <td><input type="text" id="ucsvc17" name="csvc17" size="25" class="unum2" readonly="readonly" value="" /></td>
            <td><input type="text" id="udfm17" name=" dfm17" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span171" size="" style="display:none" class="span11">A</span><span id="span172" style="display:none" size=""  class="span12">N</span><span id="span173" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">18</div></td>
            <td><input type="text" id="utcsv18" name="tcsv18" size="25" class="unum" required value=""tabindex="35"/></td>
            <td><input type="text" id="uecsv18" name="ecsv18" size="25" class="unum1" required value="" tabindex="36"/></td>
            <td><input type="text" id="ucsvc18" name="csvc18" size="25" class="unum2" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm18" name=" dfm18" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span181" size="" style="display:none" class="span11">A</span><span id="span182" style="display:none" size=""  class="span12">N</span><span id="span183" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">19</div></td>
            <td><input type="text"id="utcsv19" name="tcsv19" size="25" required class="unum" value="" tabindex="37"/></td>
            <td><input type="text" id="uecsv19" name="ecsv19" size="25" required class="unum1" value="" tabindex="38"/></td>
            <td><input type="text" id="ucsvc19" name="csvc19" size="25" class="unum2" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm19" name=" dfm19" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span191" size="" style="display:none" class="span11">A</span><span id="span192" style="display:none" size=""  class="span12">N</span><span id="span193" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">20</div></td>
            <td><input type="text"id="utcsv20"  name="tcsv20" size="25" required class="unum" value="" tabindex="39"/></td>
            <td><input type="text" id="uecsv20" name="ecsv20" size="25" required class="unum1" value="" tabindex="40"/></td>
            <td><input type="text" id="ucsvc20" name="csvc20" size="25" class="unum2" readonly="readonly" value=""/></td>
            <td><input type="text" id="udfm20" name=" dfm20" size="25" class="unum3" readonly="readonly" value=""/></td>
            <td><span id="span201" size="" style="display:none" class="span11">A</span><span id="span202" style="display:none" size="" class="span12">N</span><span id="span203" style="display:none"  class="span13">O</span></td>
        </tr>
        <tr>
            <td><div align="center">Total</div></td>
            <td><input type="text" class="utotal" id="utotals" name="utotals"/></td>
        <input type="hidden" id="utotalss" name="totalss" />

        <td><span class="utotal1" id="utotals1"></span></td>            
        <input type="hidden" id="utotalss1" name="totalss1" />


        <td><strong><input type="text"class="utotal2" id="utotals2" name="totalss2"/></strong></td>

        <td><span class="utotal3" id="utotals3"></span></td>
        <input type="hidden" id="utotalss3" name="totalss3"/>
        </tr>
        <tr>
            <td><div align="center">Average</div></td>
            <td><input type="text" class="uav" id="uav1" name="uav1"/></td>                
            <td><span class="uav1"  id="uav2" ></span></td>
            <td><input type="text" class="uav2" id="uav3" name="uav3"/></td>
            <td></td>
        </tr>
        <input type="hidden" name="capsStatus" id="capStatus"/>
        <td colspan="5"> <strong>Sample:</strong> <span id="complies" style="display:none">Complies</span><span id="dcomply" style="display:none">Does not comply</span></td>
    </table>
    <p>  
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><label for="comment">comments:</label> </strong>                 
    </p><div align="center"><textarea name="comment" cols="90" id="com"></textarea></div>
    <p><input type="button" value="Save Weights" class="submit-button" id="Export"></input></p>
    </form>
</div>  
<div id="dialog" title="Basic dialog" style="display: none; background-color: #E5E5FF; margin:10px;">
    <p><form name="" id="reason">
        <h4>State the reason for repeating this test below</h4>
        <p>
            <textarea cols="45" rows="5" name="why" id="why_repeat" required></textarea>
            <br/>
            <input type="button" value="submit" id="sendit" /><input type="button" value="cancel" id="cancelit"/>
    </form></p>
</div>
</body>
<script>
    $(document).ready(function(){
          $('form').dumbFormState({ 
persistPasswords : false, // default is false, recommended to NOT do this
persistLocal : true, // default is false, persists in sessionStorage or to localStorage
skipSelector : null, // takes jQuery selector of items you DO NOT want to persist 
autoPersist : true // true by default, false will only persist on form submit
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
    </script>
