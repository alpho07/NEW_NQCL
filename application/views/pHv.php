<p><h1><center>pH MEASUREMENTS</center></h1></p>
<legend><a href="<?php echo base_url() ?>analyst_controller" >Analyst Home&nbsp;&rarr;&nbsp;</a>pH Measurements</legend>
<hr />
<?php echo form_open('pH/save_first/' .$labref."/".$test_id)?>
  <p><strong>Outline the Sample Preparation Procedure:</strong><p>
  <p>
    <textarea name="spp" id="spp" cols="100" rows="5" required></textarea>
  </p>  

  <p><input type="submit" value="Save Sample Prep" class="submit-button" id="FormSubmit"></input></p>
</form>
</body>
</html>

