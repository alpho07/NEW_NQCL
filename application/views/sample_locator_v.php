<style>
    #gps_information{
        display: none;
        width: 290px;
        height: 220px;

    }
    label{
        font-weight: bold;
        display: block;
    }
</style>
<legend><a href="<?php echo base_url(); ?>" >Home</a><div class="coding"> Key: 
        <span id="documentation" style="width: 4px;height: 4px;background-color: #FF3399">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Sample Recieving&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="analyst" style="width: 4px;height: 4px;background-color: orange">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Analyst&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="supervisor" style="width: 4px;height: 4px;background-color: yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Supervisor&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="documentation" style="width: 4px;height: 4px;background-color: blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Documentation - 2&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="reviewer" style="width: 4px;height: 4px;background: indigo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Reviewer&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="documentation" style="width: 4px;height: 4px;background: violet">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Documentation - 3&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="director" style="width: 4px;height: 4px;background: turquoise">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Deputy Director&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="sdirector" style="width: 4px;height: 4px;background: skyblue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Director&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="documentation" style="width: 4px;height: 4px;background: greenyellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Documentation - 4&nbsp;&nbsp;&nbsp;&nbsp;

    </div></legend>
<hr />
<div>
    <table id="tests2" class="sample_listing">
        <thead>                
            <tr id="samples_l_th">
                <th>No.</th><th>Sample</th><th>Location</th><th>Code</th><th>More</th><th>Priority</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($location as $gps): ?>
                <tr>

                    <td><?php echo $gps->id; ?></td>
                    <td><?php echo $gps->labref ?></td>
                    <td><?php echo $gps->current_location ?></td>

                    <?php if ($gps->stage === '1') { ?>
                        <td style="background: #FF3399; text-align: center; color: white; font-weight: bolder;">0% Completed</td>
                    <?php } else if ($gps->stage === '2') { ?>
                        <td style="background: orange; text-align: center; color: black; font-weight: bolder;">9.09% Complete</td>
                    <?php } else if ($gps->stage === '3') { ?>
                        <td><span style="background: orange; text-align: center; color: black; font-weight: bolder;">18.18% Complete</span> || <span style="background: yellow; text-align: center; color: black; font-weight: bolder; width: auto">18.18% Complete</span></td>
                    <?php } else if ($gps->stage === '4') { ?>
                        <td style="background: yellow; text-align: center; color: black; font-weight: bolder;">27.27% Complete</td>
                    <?php } else if ($gps->stage === '5') { ?>
                        <td><span style="background: yellow; text-align: center; color: black; font-weight: bolder; width: auto" >36.36% Complete</span> || <span style="background: blue; text-align: center; color: white; font-weight: bolder;">36.36% Complete</span></td>
                    <?php } else if ($gps->stage === '6') { ?>
                        <td style="background: blue; text-align: center; color: white; font-weight: bolder;" >45.45% Complete</td>                        
                    <?php } else if ($gps->stage === '7') { ?>
                        <td style= "background: indigo; text-align: center; color: white;  font-weight: bolder;">54.54% Complete</td>
                    <?php } else if ($gps->stage === '8') { ?>
                        <td style="background: violet; text-align: center; color: black; font-weight: bolder;">63.63% Complete</td>
                    <?php } else if ($gps->stage === '9') { ?>
                        <td style=" background: turquoise; text-align: center; color: black; font-weight: bolder;">72.72% Complete</div> </td>
                    <?php } else if ($gps->stage === '10') { ?>
                        <td style=" background: skyblue; text-align: center; color: black; font-weight: bolder;">81.81% Complete</div> </td>
                    <?php } else if ($gps->stage === '11') { ?>
                        <td style=" background: greenyellow; text-align: center; color: black; font-weight: bolder;">99.99% Complete</div> </td>
                    <?php }
                    ?>
                        

                    <td><a class="pop" href="#gps_information" id="<?php echo $gps->labref ?>">More</a><input type="hidden" id="labref" value=""/></td>
                    <?php if ($gps->priority === '1') { ?>
                        <td><span id="high">High</span></td>
                    <?php } else { ?>
                        <td><span id="low">Low</span></td>    
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>	
</div>
<div id="gps_information">



</div>
<script>
    $(document).ready(function() {
        $('#tests2').dataTable({
            "bJQueryUI": true,
            "asStripClasses": null,
            "iDisplayLength": 50
        
        });       
                  
    });
   
    
    $(document).ready(function(){
        $('.pop').click(function() {
            labref = $(this).attr('id');                   
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>sample_location/gps/"+labref,
                dataType:"json",
                success: function(data)
                {
                               
                    $.each(data, function(id, info)
                    {
                           
                        $('#gps_information').html("<label>CURRENT LOCATION</label>"+info.current_location+"<br><br><label> SAMPLE:</label> "+info.labref+"<br><br><label> ACTIVITY:</label> "+info.activity+"<br><br><label> FROM:</label>  "+info.from+"<br><br> <label>TO:</label>  "+info.to+"<br><br> <label>DATE:</label> "+info.date);
                            
                       
                        $.fancybox({
                            href:'#gps_information'
                               
                        });
                            
                           
                    });
                               
                            
                    return true;
                },
                error: function(data) {
                                


                    return false;
                }
            });
            return false;
        });
                
    });
</script>
