<legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>analyst_labreference" >Sample Worksheet Upload</a> | <a href="<?php echo base_url(); ?>sample_requests" >Done Tests </a> | <a href="<?php echo base_url(); ?>repeat_test" >Repeated Test Upload </a> </legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }




</style>

<table id = "analystable">

    <thead><tr><th>Lab Reference Number</th><th>Lab Reference Number</th><th>Download Worksheet</th><th>Priority</th></tr></thead>

    <tbody>
        <?php foreach ($done_tests as $test) { ?>
            <tr class="sample_issue">
                  
                <td class="common_data" ><span class="green_bold" id="labref" ><?php echo anchor('supervisors/home/'.$test->labref,$test->labref) ?></span></td>
                <td></td>
                <td><?php echo anchor('analyst_uploads/'.date('Y').'/'.date('M').'/'.$test->labref.'/'.$test->labref.".xlsx",$test->labref.".xlsx") ?></td>
                <?php if($test->priority==='1'){?>
                     <td><span id="high">High</span></td>
                     <?php }else{?>
                      <td><span id="low">Low</span></td>    
                     <?php }?>
            </tr>
         <?php } ?>
 </tbody>

</table>

<script type="text/javascript">
    $(function() {

        $('#analystable').dataTable({
            "bJQueryUI": true
        }).rowGrouping({
            //iGroupingColumnIndex: 0,
            //sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 0
            //bExpandableGrouping:true,
          //  bExpandSingleGroup: false,
          //  iExpandGroupOffset: -1

        });
    });

</script>

