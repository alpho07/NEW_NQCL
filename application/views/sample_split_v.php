<html lang ="en">

    <legend><a href="<?php echo site_url() . "sample_issue/listing"; ?>" >Samples Listing</a>
        &nbsp;&rarr;&nbsp;Sample Split & / Issue&nbsp;&rarr;&nbsp;<?php $reqid = $this->uri->segment(3);
echo $reqid; ?></legend>

    <hr />

    <?php
    $units = Request_details::getTestSplit($reqid);
//var_dump($sample_listing[0]['version_id']);

    if (count($units) > 1) {

        $splitstatus = 1;
    } else {

        $splitstatus = 0;
    }
    $split_pending = Sample_issuance::getSplits($reqid);
    ?>

    <?php
    for ($i = 0; $i < count($units); $i++) {

        $user_type = 1;
        $unit_id = $units[$i]['Department'];
        $analysts = User::getAnalysts2($reqid, $user_type);

        $unit1 = $this->uri->segment(4);
        $unit2 = $this->uri->segment(5);
        $unit3 = $this->uri->segment(6);

        $unitsarray = array($unit1, $unit2, $unit3);

        if (!in_array($unit_id, $unitsarray)) {
            ?>

            <legend id="unit"><?php
        switch ($unit_id) {
            case 1:

                echo "Wet Chemistry Unit";

                break;

            case 2:

                echo "Biological Analysis Unit";

                break;

            case 3:

                echo "Medical Devices Unit";

                break;

            default:

                echo "";
        }
            ?></legend>

            <table id="tests" >

                <tr><td colspan="4" ><hr></td></tr>	

                <tr>
                    <th>Samples Available</th>
                    <th>Samples to Issue</th>
                    <th>Analyst</th>
                    <th>Assign</th>
                </tr>

        <?php
        $attributes = array('id' => 'entry_form');
        echo form_open('sample_issue/save/' . $reqid, $attributes);
        echo validation_errors('<p class="error">', '</p>');
        ?>

                <tr class="unitrows">
                    <td class="samples_available"><span><?php echo $sample_listing[0]['sample_qty']; ?></span></td>
                    <td class ="samples2issue"><input type="text" id="samples2issue" name="samples_no" required /></td>
                    <td>
                        <span>
                            <select name="analyst_id" id="analyst">
                                <!--option value="" >Select Analyst</option-->
        <?php foreach ($analysts as $analyst) { ?>
                                    <option value="<?php echo $analyst['id']; ?>"><?php echo $analyst['fname'] . " " . $analyst['lname']; ?></option>
        <?php } ?>	
                            </select>
                        </span>
                    </td>

                <input type="hidden" name="dept_id" value="<?php echo $unit_id ?>"/>
                <input type="hidden" name="lab_ref_no" value="<?php echo $reqid ?>"/>
                <input type="hidden" name="upd_samples_qty" value="<?php echo $sample_listing[0]['sample_qty'] ?>"/>
                <input type="hidden" name="status_id" value= "2"/>
                <input type="hidden" name="splitstatus" value="<?php echo $splitstatus; ?>"/>
                <!--input type="hidden" name="tests_version_id" value="<?php //echo $tests[0]['version_id'];  ?>" /-->
                <!--input type="hidden" name="req_version_id" value="<?php //echo $sample_listing[0]['version_id']  ?>" /-->
                <td><span><input type ="submit" name="sample_assign" id="assign_button" class="submit-button" value="Assign"/> </span></td>
        <?php echo form_close(); ?>

            </tr>

        </table>

                    <?php } ?>
<?php } ?>


<script>
    $(function(){
        $('.unitrows').each(function(i){
  	
            $('.samples2issue input').eq(i).keyup(function(){
  	
                var s_avail = $('.samples_available span').eq(i).text();
  	
                var samples_a = parseInt(s_avail);
  	
                if($(this).val() > samples_a ) {
  	
                    alert("Samples to Issue must be less than Samples Available.");
  	
                    $(this).val("");
  	
                }
  	
                else if ($(this).val() <= 0) {
  		
                    alert("Samples to Issue must be greater than zero.");
  		
                    $(this).val("");
  	
                }	
  	
                else
                {
                    var diff = $('.samples_available span').eq(i).text() - $(this).val();
                    if($('.unitrows').length == 2){
     
                        $('.samples_available span').eq(i+1).text(diff);
                        $('.samples_available span').eq(i-1).text(diff); 	
                    }
  	
  	
                    else if ($('.unitrows').length == 3) {
  	
                        $('.samples_available span').eq(i+1).text(diff);
                        $('.samples_available span').eq(i+2).text(diff);
                        $('.samples_available span').eq(i-1).text(diff); 	
                        $('.samples_available span').eq(i-2).text(diff);
                    }	
  		
                }
  	
            });
        });
    })	
</script>


</html>
