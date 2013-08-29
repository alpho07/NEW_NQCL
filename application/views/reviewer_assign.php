
<?php echo form_open('assign/sendSamplesFolder/'.$labref);?>
<table>
    <tr>
        <th>Reviewer </th>  <th>Assign</th>
    </tr>
    <tr><td>
            <select name="reviewer" required>
                <option value="">Select Reviewer</option>
                <?php            
              
                foreach ($reviewers as $reviewer):
                    echo "<option value='$reviewer->id'>$reviewer->alias</option>";
                endforeach;
                ?>
                
            </select></td>
        <td>
            
            <input type="submit" value="Assign" class="submit-button"/> 
        </td>
    </tr>
</form>

</table>