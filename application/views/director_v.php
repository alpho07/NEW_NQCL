<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<body> 
 <legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>directors" >Refresh</a> | <?php echo anchor('directors/samples/'.$reviewer_id,'Worksheets Uploades to Director'); ?> </legend>
 <hr />


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
                    <th>View</th>
                    <th>Status</th>
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
            <td>Worksheet: <?php echo anchor('director/'.$user_id.'/'.date('Y').'/'.date('M').'/'.$sheet->folder.'/'.$sheet->folder.'.xlsx', 'Download');?> &nbsp; | &nbsp;COA: <?php echo anchor('director/'.$user_id.'/'.date('Y').'/'.date('M').'/'.$sheet->folder.'/'.$sheet->folder.'.pdf', 'Download');?></td>
                                        <td><?php echo anchor('coa/generateCoa/' . $sheet->folder, 'View COA') ?></td>

            <?php if($sheet->approval_status==='0'){?>
            <td><span style="background-color: yellow; color: black; font-weight: bold; border-radius: 2px;">Not yet Checked</span></td>
            <?php } else if ($sheet->approval_status==='1') {?>
            <td><span style="background-color: yellowgreen; color: white; font-weight: bold; border-radius: 2px;">Checked</span ></td>
            <?php } else if ($sheet->approval_status==='2') {?>
              <td><span style="background-color: #FF0000; color: white; font-weight: bold; border-radius: 2px;">Rejected</span></td> 
            <?php } ?>
                <td><?php echo anchor('directors/approve/'.$sheet->folder, 'Mark as Approved');?></td>
                <td style="background: #0FF; font-weight: bolder; "><?php echo anchor('directors/reject/'.$sheet->folder, 'Mark as Rejected');?></td>
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
