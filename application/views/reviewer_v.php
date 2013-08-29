<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<body> 
 <legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>reviewer" >Refresh</a> | <?php echo anchor('reviewer/samples_for_review/'.$reviewer_id,'Worksheets Uploaded For Review'); ?> </legend>
 <hr />
<!-- Menu Start --> 

</div> 
<?php $user_id=$this->session->userdata('user_id');?>
<!-- End Menu --> 
<div>
    <table id = "refsubs">
            <thead>
                <tr>
                  
                    <th>File Name</th>
                    <th>Lab Reference No</th>
                    <th>Download </th>                
                    <th>Acceptance Status</th>                    
                     <th>Approve</th>
                     <th>Reject</th>
                     <th>Priority</th>
                  

                </tr>
            </thead>
            <tbody>
<?php foreach ($worksheets as $sheet):?>
              <tr> 
            <td><?php echo $sheet->folder.'.xlsx';?></td>
            <td><strong><em><?php echo $sheet->folder;?></em> </strong></td>
            <td><?php echo anchor('analyst_uploads/'.date('Y').'/'.date('M').'/'.$sheet->folder.'/'.$sheet->folder.'.xlsx', 'Download');?></td>
           
            <?php if($sheet->status=='0'){?>
            <td><span style="background-color: yellow; color: black; font-weight: bold; border-radius: 2px;">Not yet Reviewed</span></td>
            <?php } elseif ($sheet->status=='1') {?>
            <td><span style="background-color: yellowgreen; color: white; font-weight: bold; border-radius: 2px;">Reviewed & Uploaded</span ></td>
            <?php } elseif ($sheet->status=='2') {?>
              <td><span style="background-color: #FF0000; color: white; font-weight: bold; border-radius: 2px;">Rejected</span></td> 
            <?php } ?>
                <td><?php echo anchor('upload/worksheet/'.$sheet->folder, 'Upload');?></td>
                <td style="background: cyan;"><?php echo anchor('reviewer/reject/'.$sheet->folder, 'Reject');?></td>
                
                 <?php if($sheet->priority==='1'){?>
                     <td><span id="high">High</span></td>
                     <?php }else{?>
                      <td><span id="low">Low</span></td>    
                     <?php }?>

            <?php  endforeach;?>
              </tr>
            </tbody>
        </table>

<script type="text/javascript">
     $('#refsubs').dataTable({
            "bJQueryUI": true
        }).rowGrouping({

            iGroupingColumnIndex: 1,
            sGroupingColumnSortDirection: "asc",
            iGroupingOrderByColumnIndex: 1,
            //bExpandableGrouping:true,
            //bExpandSingleGroup: true,
            iExpandGroupOffset: -1

        });
    </script>

  
</div>

 
</body> 
</html> 
