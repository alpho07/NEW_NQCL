
<legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>analyst_labreference" >Sample Worksheet Upload</a> | <a href="<?php echo base_url(); ?>sample_requests" >Done Tests </a> </legend>

<hr />
<style type="text/css">
    #analystable tr:hover {
        background-color: #ECFFB3;
    }





</style>

<table id = "analystable">

    <thead><tr><!--th>No.</th-->
            <th>Lab Reference Number</th>
            <th>Test Name</th>
            <th>Product Name</th>
            <th>Samples Issued</th>
            <th>Time Issued</th>
            <th>View Worksheet</th>
            <th>Status</th>
            <th>is OOS?</th>
            <th>priority</th>
            <th>Review Status</th>
        </tr>
    </thead>

    <tbody>
       <?php $session=$this->session->userdata('data');

       ?>

        
        <?php foreach ($tests_assigned as $test) { ?>


            <?php
            $test_id = $test->Test_id;
            $lab_ref_no = $test->Lab_ref_no;
            $done_status=$test->done_status;
            $priority=$test->priority;
            $oos=$test->do_count;
            $review_status=$test->review_status;
            $worksheet = Tests::getWorksheet($test_id);

            $worksheet_name = $worksheet[0]['Alias'];
          

            $products = Request::getProducts($lab_ref_no);

            $product_name = $products[0]['product_name'];

            $status_check = Sample_issuance::getStatus($lab_ref_no, $test_id);

            $status = $status_check[0]['Status_id'];
            
            if ($status != 3) {
                
                ?>
        
                <tr class="sample_issue">
                        <!--td class="numbering" ><span class="bold number" id="number" ></span></td-->
                    <td class="common_data" ><span class="green_bold" id="labref" ><?php echo $test->Lab_ref_no ?></span></td>
                    <td><span><?php echo $worksheet_name ?></span></td>
                    <td class="prod_data" ><span class=""><?php echo $product_name ?></span></td>
                    <td class="sample_data"><span class=""><?php echo $test->Samples_no ?></span></td>
                    <td><span><?php echo $test->created_at ?></span></td>
                    <td><a href='<?php echo site_url() . $worksheet_name . "/worksheet/" . $lab_ref_no . "/" . $test_id ?>'>View Worksheet</a></td>
                    <?php if($done_status=='1'){?>
                    <td style="background: greenyellow; font-weight: bold;  "><?php echo $worksheet_name;?> <strong>(Done)</strong></td>
                    <?php } else {?>
                     <td style="background: yellow; font-weight: bold; "><?php echo $worksheet_name;?> <strong>(Not Done Yet)</strong></td>
                    <?php }?>
                     <?php if($oos >=2){?>
                     <td style="text-align: center; font-weight: bolder; color: white; text-decoration: blink; background-color: #f43;">Yes</td>
                     <?php } else{?>
                     <td style="text-align: center; font-weight: bolder; color: black;">No</td>
                     <?php }?>
                     <?php if($priority==='1'){?>
                     <td><span id="high">High</span></td>
                     <?php }else{?>
                      <td><span id="low">Low</span></td>    
                     <?php }?>
                      <?php if($review_status==0){?>
                     <td style="text-align: center; font-weight: bolder; color: black; ">Not yet reviewed</td>
                     <?php } else if($review_status==1){?>
                     <td style="text-align: center; font-weight: bolder; color: black;">Accepted</td>
                     <?php }else if($review_status==2){?>
                      <td style="text-align: center; font-weight: bolder; color: white; text-decoration: blink; background-color: #f43">Rejected - Redo test</td>
                     <?php } ?>
                   
                      
                </tr>


            <?php } ?>

        <?php } ?>

    </tbody>

</table>

<script type="text/javascript">
    $(function(){

        $('#analystable').dataTable({

            "bJQueryUI":true

        }).rowGrouping({

            iGroupingColumnIndex: 0,
            sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 0,
            //bExpandableGrouping:true,
            bExpandSingleGroup: true,
            iExpandGroupOffset: -1

        })
    })

</script>

