<html>
    <head>
        <title>Sample Details to excel</title>
        <script>
            $(function() {
                $("#DateCompleted").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'd-M-y'
                });

            });

            $(document).ready(function() {
                var nda = 'No data available';
                $(".worksheetInfoData[value='']").val(nda)
                $(".worksheetInfoData[value='']").css("color", "red")
                $(".worksheetInfoData[value='']").attr("disabled", "disabled");




                $('#Export').click(function() {

                    dataString2 = $('#sampleForm').serialize();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>wkstest/getDataToExcel/<?php echo $labref . "/" . $r . "/" . $c; ?>",
                        data: dataString2,
                        success: function() {
                            alert("Successfully Exported to Excel Worksheet");
                            //window.location.href="workbooks/<?php echo $labref . "/" . $labref . ".xlsx"; ?>"
                            $('#Export').attr('disabled', 'disabled');
                            alert('Click the Download Worksheet link at the top left to download the worksheet and carry out sample data calculations');
                        },
                        error: function() {
                            alert('An internal problem has been experienced, data could not be exported!');
                        }

                    });

                });
            });




        </script>
        <style type="text/css">
            fieldset#SampleAssay{
                width: 480px;
            }
            .peaks{
                float: right;
                width:200px;
            }

            fieldset.weight{
                width:200px;
                margin-left:10px;
                float:left;
            }
            fieldset.tabscaps{
                width:190px;
                margin-left:10px;
                float:left;  
            }

            fieldset.dissoultion{
                width:200px;
                margin-left:10px;
                float:left;
            }
            label{
                font-weight: bold;
                margin-bottom: 3px;
                display:block;
                margin: 5px;
            }
            intput[type=text]{
                margin-top: 2px;
                display: block;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <?php $attributes = array('id' => 'sampleForm'); ?>
        <?php echo form_open('' . $labref . '/' . $r, $attributes); ?>
        <p><h3><<<a href='<?php echo base_url() . 'analyst_labreference/'; ?>'>Download Worksheet</a></h3> <center><legend><h2>Sample: <?php echo $labref; ?> Component Name: <?php echo $component_name[0]->component; ?> </h2></legend></center></p>
<input type="hidden" name="head" value="<?php echo $component_name[0]->component; ?>"/>
<p>Components No.:</p>
<?php
foreach ($no_of_pages as $pages):
    echo anchor('sample_requests/samples/' . $labref . '/' . $r . '/' . $pages, '<strong>' . $pages . " " . '</strong>');
endforeach;
?>


<p>Components Repeats.:</p>
<?php
foreach ($no_of_repeats as $page_repeats):
    echo anchor('sample_requests/samples/' . $labref . '/' . $page_repeats . '/' . $r, '<strong>' . $page_repeats . " " . '</strong>');
endforeach;
?>



<p><input type="button" value="Export to Excel" id="Export"/></p>
<?php foreach ($stdweight as $weight)
    
    ?>

<?php
foreach ($worksheetInfo as $Info)
    ;
?>
<?php if ($r > 1) { ?>
    <p><center><h1>Worksheet Sample Information: <?php echo $Info->request_id . ' Repeat ' . $r . ' for some test '; ?> </center></h1></p>
<?php } else { ?>
    <p><center><h1>Worksheet Sample Information: <?php echo $Info->request_id; ?> </center></h1></p>  
<?php } ?>

<fieldset class="overall"> 
    <legend></legend><h3>Worksheet & Assay Information </h3>
    <fieldset class="weight">
        <legend></legend><h3>Worksheet Information</h3> 
        <label for="SampleName"> Sample Name :</label>  <input type="text" name="SampleName" value="<?php echo $Info->product_name; ?>" class="worksheetInfoData"/><p></p>
        <label for="LabRef"> Lab Reference No :</label>  <input type="text" name="LabRef" value="<?php echo $Info->request_id; ?>" class="worksheetInfoData"/><p></p>
        <label for="LabelClaim">Label Claim:</label> <textarea class="worksheetInfoData" name="LabelClaim" ><?php echo $Info->label_claim; ?></textarea><p></p>
        <label for="ActiveInng">Active Ingredient</label> <input type="text" name="ActiveInng" value="<?php echo $Info->active_ing; ?>" class="worksheetInfoData"/><p></p>
        <label for="DateCompleted" >Date Completed :</label>  <input type="text" name="DateCompleted"  id="DateCompleted" class="worksheetInfoData"/><p></p>

    </fieldset>  

    <fieldset class="weight">
        <legend></legend><h3>Standard Assay </h3>
        <label for="potency">POTENCY:</label>:  <input type="text" name="potency" value="<?php echo $stddesired->potency; ?>" class="worksheetInfoData"/>%<p></p>

        <label for="assayDesired">Desired Weight:</label>:  <input type="text" name="assayDesired" value="<?php echo $stddesired->desired_weight; ?>" class="worksheetInfoData"/><p></p>
        <label for="standardA">Standard A: </label><input type="text" name="standardA" value="<?php echo $stdweight['0']->weight; ?>" class="worksheetInfoData"/><p></p>
        <label for="standardB"> Standard B: </label><input type="text" name="standardB" value="<?php echo $stdweight['1']->weight; ?>" class="worksheetInfoData"/>
        <label for="dconcetration"> Desired Concetration: </label><input type="text" name="dconcetration" value="<?php echo $stddesired->concetration; ?>" class="worksheetInfoData"/>

    </fieldset>

    <fieldset id="SampleAssay">
        <legend></legend><h3>Sample Assay </h3>

        <fieldset class="weight">
            <legend><h4>Powder weight</h4></legend>

            <?php foreach ($sample_assay as $assay)
                ; ?>

<?php foreach ($sample_assay_desired as $desired)
    ; ?>

            <p>
                <label for ="sampleDesiredpw">Desired :</label> <input type="text" name="sampleDesiredpw" value="<?php echo $desired->powder_weight; ?>" class="worksheetInfoData"/></p>
            <label for ="sasandarda"> Standard A:</label> <input type="text" name="sastandarda" value="<?php echo $sample_assay [1]->powder_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for ="sasandardb">Standard B:</label> <input type="text" name="sastandardb" value="<?php echo $sample_assay [2]->powder_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for ="sasandardc">Standard C:</label> <input type="text"  name="sastandardc" value="<?php echo $sample_assay [3]->powder_weight; ?>" class="worksheetInfoData"/>
        </fieldset>
        <fieldset class="weight">
            <legend><h4>API Weight</h4></legend>
            <label for="ampleDesiredap" >  Desired Weight :</label> <input type="text" name="sampleDesiredap"value="<?php echo $desired->api_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for ="apstandarda"> Sample A : </label> <input type="text" name="apstandarda" value="<?php echo $sample_assay [1]->api_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for ="apstandardb"> Sample B:</label> <input type="text" name="apstandardb" value="<?php echo $sample_assay [2]->api_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for ="apstandardc">Sample C: </label><input type="text" name="apstandardc" value="<?php echo $sample_assay [3]->api_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for ="sampleconcetration">Sample Concetration: </label><input type="text" name="sampleconcetration" value="<?php echo $sample_assay['0']->concetration; ?>" class="worksheetInfoData"/>
        </fieldset>       

    </fieldset>


    <fieldset class="classB">

        <legend><h3>Uniformity of Weight & Dissolution Data</h3></legend>

        <fieldset class="tabscaps">
            <legend><h4>Uniformity of Weight</h4></legend>

            <label for="tabcapssaverage" >  Tabs/Caps Average Weight :</label> <input type="text" name="tabcapssaverage" value="<?php echo @$tabs->average; ?>" class="worksheetInfoData"/><p></p>




        </fieldset>
        <fieldset class="dissoultion">
            <legend><h4>Dissolution Tab Weights</h4></legend>
            <p></p>
            <label for="tab1">Tab 1:</label> <input type="text" name="tab1" value="<?php echo $dissolutionts['0']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
            <label for="tab2">Tab 2:</label>  <input type="text" name="tab2" value="<?php echo $dissolutionts['1']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
            <label for="tab3">Tab 3:</label> <input type="text" name="tab3" value="<?php echo $dissolutionts['2']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
            <label for="tab4">Tab 4:</label> <input type="text" name="tab4" value="<?php echo $dissolutionts['3']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
            <label for="tab5">Tab 5:</label><input type="text" name="tab5" value="<?php echo $dissolutionts['4']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
            <label for="tab6">Tab 6:</label> <input type="text" name="tab6" value="<?php echo $dissolutionts['5']->tab_caps_weights; ?>" class="worksheetInfoData"/><p></p>
        </fieldset>
        <fieldset class="dissoultion">
            <legend><h4>Dissolution Data</h4></legend>
<?php foreach ($dissolutionData as $data)
    ; ?>

            <label for="desiredweight">Desired Weight: </label><input type="text" name="desiredweight"value="<?php echo $data->desired_weight; ?>" class="worksheetInfoData"/><p></p>
            <label for="disstda">Standard A:</label>  <input type="text" name="disstda" value="<?php echo $data->stda; ?>" class="worksheetInfoData"/><p></p>
            <label for="disstdb">Standard B:</label> <input type="text" name="disstdb" value="<?php echo $data->stdb; ?>" class="worksheetInfoData"/><p></p>
            <label for="concetration"> Concetration:</label> <input type="text" name="concetration" value="<?php echo $data->desired_conc; ?>" class="worksheetInfoData"/><p></p>
            <label for="tabverage">Tablets Average: </label><input type="text" name="tabaverage" value="<?php echo $data->tabs_caps_mean; ?>" class="worksheetInfoData"/><p></p>

        </fieldset>
    </fieldset>


</body>

</html>