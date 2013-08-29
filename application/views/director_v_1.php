<?php
if ($is_director[0]->user_type != 8) {
    $error = 'Unauthorized User: ACCESS DENIED!';
    echo '<div style="color:red; text-align:center;">' . $error . '</div>';
} else {
    ?>
    <!--
    To change this template, choose Tools | Templates
    and open the template in the editor.
    -->

    <body> 
    <legend><a href="<?php echo base_url(); ?>" >Home</a> | <a href="<?php echo base_url(); ?>directors" >Refresh</a> | <?php echo anchor('directors/samplesD/', 'Worksheets and COAs Submitted for Approval'); ?> </legend>
    <hr />


    </div> 

    <!-- End Menu --> 
    <div>
        <table id = "refsubs">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Lab Reference No</th>
                    <th>Status</th>
                    <th>Approve</th>
                    <th>Reject</th>
                    <th>Priority</th>


                </tr>
            </thead>
            <tbody>

    <?php foreach ($worksheets as $sheet): ?>
                    <tr>
                      
                        <td><?php echo $sheet->folder . '.xlsx'; ?></td>
                        <td><strong><em><?php echo $sheet->folder; ?></em> </strong></td>   
                        <?php if($sheet->approval_status==='0'){?>
                        <td><span style="background-color: yellow; color: black; font-weight: bold; border-radius: 2px;">Not yet Checked</span></td>
                        <?php } else if ($sheet->approval_status==='1') {?>
                        <td><span style="background-color: yellowgreen; color: white; font-weight: bold; border-radius: 2px;">Checked</span ></td>
                        <?php } else if ($sheet->approval_status==='2') {?>
                          <td><span style="background-color: #FF0000; color: white; font-weight: bold; border-radius: 2px;">Rejected</span></td> 
                        <?php } ?>
                        <td><?php echo anchor('directors/approve_d/' . $sheet->folder, 'Approve'); ?></td>
                        <td><?php echo anchor('directors/reject_d/' . $sheet->folder, 'Reject'); ?></td>
                        <?php if ($sheet->priority === '1') { ?>
                            <td><span id="high">High</span></td>
                        <?php } else { ?>
                            <td><span id="low">Low</span></td>    
                        <?php } ?>
    <?php endforeach; ?>
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
<?php } ?>
