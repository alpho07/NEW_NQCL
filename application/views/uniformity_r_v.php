
<script>
 var th = ['','thousand','million', 'billion','trillion'];
// uncomment this line for English Number System
// var th = ['','thousand','million', 'milliard','billion'];

var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine'];var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];function toWords(s){s = s.toString();s = s.replace(/[\, ]/g,'');if (s != parseFloat(s)) return 'not a number';var x = s.indexOf('.');if (x == -1) x = s.length;if (x > 15) return 'too big';var n = s.split('');var str = '';var sk = 0;for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' ';i++;sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' ';if ((x-i)%3==0) str += 'hundred ';sk=1;}if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}}if (x != s.length) {var y = s.length;str += 'point ';for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';}return str.replace(/\s+/g,' ');}
       
            
/*jQuery(function(){
    jQuery("#tcsv1").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv2").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv3").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv4").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv5").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv6").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv7").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });  
    jQuery("#tcsv8").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });  
    jQuery("#tcsv9").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv10").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv11").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv12").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv13").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv14").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv15").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv16").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv17").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv18").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv19").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv20").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
                
                
    jQuery('.AdvancedForm').validated(function(){
        alert("Use this call to tmake AJAX submissions.");
    });
});
/* ]]> */
      
//finding the sum=======================================================================================================
//==================================================================================================================
$(document).ready(function(){
   
    $('.num').live('keyup',function () {
        var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.num[value!=""]').length;
        $('.num').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(4);
            answer=sum1/boxes;
            answer1=answer.toFixed(4);
        });
        
        $('input#totals').val(sum1);
        $('input#av1').val(answer1);
     
    });
});


var tma1;
       
var tma2;
        
var tma3;
       
var tma4;
       
var tma5;
        
var tma6;
       
var tma7;
        
var tma8;
        
var tma9;
        
var tma10;
        
var tma11;
        
var tma12;
       
var tma13;
       
var tma14;
       
var tma15;
      
var tma16;
       
var tma17;
       
var tma18;
        
var tma19;
        
var tma20;
      

$(document).ready(function(){
          
         var a=$('#utcsv1').val();
        var b=$('#utcsv2').val();
        var c=$('#utcsv3').val();
        var d=$('#utcsv4').val();
        var e=$('#utcsv5').val();
        var f=$('#utcsv6').val();
        var g=$('#utcsv7').val();
        var h=$('#utcsv8').val();
        var i=$('#utcsv9').val();
        var j=$('#utcsv10').val();
        var k=$('#utcsv11').val();
        var l=$('#utcsv12').val();
        var m=$('#utcsv13').val();
        var n=$('#utcsv14').val();
        var o=$('#utcsv15').val();
        var p=$('#utcsv16').val();
        var q=$('#utcsv17').val();
        var r=$('#utcsv18').val();
        var s=$('#utcsv19').val();
        var t=$('#utcsv20').val();
        
    
              
  
        var span_text =parseFloat($('#uav3').val());     
      
            
      
        a=parseFloat($('#ucsvc1').val());
        b=parseFloat($('#ucsvc2').val());
        c=parseFloat($('#ucsvc3').val());
        d=parseFloat($('#ucsvc4').val());
        e=parseFloat($('#ucsvc5').val());
        f=parseFloat($('#ucsvc6').val());
        g=parseFloat($('#ucsvc7').val());
        h=parseFloat($('#ucsvc8').val());
        i=parseFloat($('#ucsvc9').val());
        j=parseFloat($('#ucsvc10').val());
        k=parseFloat($('#ucsvc11').val());
        l=parseFloat($('#ucsvc12').val());
        m=parseFloat($('#ucsvc13').val());
        n=parseFloat($('#ucsvc14').val());
        o=parseFloat($('#ucsvc15').val());
        p=parseFloat($('#ucsvc16').val());
        q=parseFloat($('#ucsvc17').val());
        r=parseFloat($('#ucsvc18').val());
        s=parseFloat($('#ucsvc19').val());
        t=parseFloat($('#ucsvc20').val());
         
        ma1 =((a-span_text)/span_text)*100;        
        $('input#udfm1').val( ma1.toFixed(2));
        ma2 =((b-span_text)/span_text)*100;
        $('input#udfm2').val( ma2.toFixed(2));
        ma3 =((c-span_text)/span_text)*100;
        $('input#udfm3').val( ma3.toFixed(2));
        ma4 =((d-span_text)/span_text)*100;
        $('input#udfm4').val( ma4.toFixed(2));
        ma5 =((e-span_text)/span_text)*100;
        $('input#udfm5').val( ma5.toFixed(2));
        ma6 =((f-span_text)/span_text)*100;
        $('input#udfm6').val( ma6.toFixed(2));
        ma7 =((g-span_text)/span_text)*100;
        $('input#udfm7').val( ma7.toFixed(2));
        ma8 =((h-span_text)/span_text)*100;
        $('input#udfm8').val( ma8.toFixed(2));
        ma9 =((i-span_text)/span_text)*100;
        $('input#udfm9').val( ma9.toFixed(2));
        ma10 =((j-span_text)/span_text)*100;
        $('input#udfm10').val( ma10.toFixed(2));
        ma11 =((k-span_text)/span_text)*100;
        $('input#udfm11').val( ma11.toFixed(2));
        ma12 =((l-span_text)/span_text)*100;
        $('input#udfm12').val( ma12.toFixed(2));
        ma13 =((m-span_text)/span_text)*100;
        $('input#udfm13').val( ma13.toFixed(2));
        ma14 =((n-span_text)/span_text)*100;
        $('input#udfm14').val( ma14.toFixed(2));
        ma15 =((o-span_text)/span_text)*100;
        $('input#udfm15').val( ma15.toFixed(2));
        ma16 =((p-span_text)/span_text)*100;
        $('input#udfm16').val( ma16.toFixed(2));
        ma17 =((q-span_text)/span_text)*100;
        $('input#udfm17').val( ma17.toFixed(2));
        ma18 =((r-span_text)/span_text)*100;
        $('input#udfm18').val( ma18.toFixed(2));
        ma19 =((s-span_text)/span_text)*100;
        $('input#udfm19').val( ma19.toFixed(2));
        ma20 =((t-span_text)/span_text)*100;
        $('input#udfm20').val( ma20.toFixed(2));
        var red = 0;
        var green=0;
        var space=", ";
        var holder, holderr,holder1,holderR;
        var oncer, once1;
        var passed="#complies";
        var failed="#dcomply";
        var DNC='Sample Does Not Comply';
        var C='Sample Complies';
        for(var kj = 1;kj<21;kj++){
            var val=window["ma"+kj];
            if(window["ma"+kj]<0){
                val=window['ma'+kj]*-1;
            }else{
                val=window["ma"+kj];
            }
            var div = "#span"+kj+"1"; //red
            var div2 = "#span"+kj+"2"; //blue
            var div3 = "#span"+kj+"3"; //green
           
            if(span_text<300){
                 
                if(val>=10.5 && val<=20.5){
                    $(div3).show();
                       green++;                 
                    holder= window['ma'+kj].toFixed(2)+'%'+space;                        
                    once1+=holder.toString();                         
                    holder1=once1.replace("undefined","");
                    holder1 = holder1.substring(0,holder1.length - 2);
                
                }
                else if(val>=0 &&val<=10.5  ){
                    $(div2).show();                 
                }
                else{
                    $(div).show(); 
                    red++
                    holderr= window['ma'+kj].toFixed(2)+'%'+space;                       
                    oncer+=holderr.toString();                             
                    holderR=oncer.replace("undefined","");
                    holderR = holderR.substring(0,holderR.length - 2);
                }
            }else if(span_text>300){
                   
                if(val>=7.5 && val<=15){
                    $(div3).show();
                     green++;                 
                    holder= window['ma'+kj].toFixed(2)+'%'+space;                        
                    once1+=holder.toString();                         
                    holder1=once1.replace("undefined","");
                    holder1 = holder1.substring(0,holder1.length - 2);
                   
                
                }
                else if(val<=7.5 && val>=0.5){
                    $(div2).show();
                  
                }
                else{
                    $(div).show(); 
                    red++
                    holderr= window['ma'+kj].toFixed(2)+'%'+space;                       
                    oncer+=holderr.toString();                             
                    holderR=oncer.replace("undefined","");
                    holderR = holderR.substring(0,holderR.length - 2);
                }
            
            }   
            //end of main loop
             
        }
              
             if(green!=0 && red!=0){
             $(failed).show(); 
           var n1= parseInt(green)+parseInt(red);
           var total= toWords(n1);
                //var redwords =toWords(red);
                $('#com').val( total+ "deviate ("+holder1+ ", "  +holderR+")"); 
            }
            if(green!=0 && red==0){              
                var  greenwords= toWords(green);                 
                $('#com').val(greenwords+ "deviate ("+holder1+")"); 
                  if(green>1){                     
                      $('#capStatus').val(DNC);
                    $(failed).show(); 
                }else{                   
                      $('#capStatus').val(C);
                    $(passed).show(); 
                }
            }
            if(red!=0 && green==0){
                 var  redwords= toWords(red); 
                 $('#capStatus').val(DNC);
                $(failed).show(); 
                $('#com').val(redwords+ "deviate ("+holderR+")");  
            }
             
            if(green==0 &&red==0){
                $('#capStatus').val(C);
                $(passed).show(); 
                $('#com').val("None Deviates");  
            }
 });
        


       $(document).ready(function() {
                $('.reject').hide();
                
                $("#Inline").fancybox({
           

                });
            });

</script>
<div id="main_wrapper"> 
    <head>
        <style type="text/css">
            table{
                border: #000000 1px solid;
                padding: 0px;
            }
            td{
                border: #000000 1px solid;
            }
            input[type=text]{
                text-align: center;
            }
            span#complies{
              font-family: sans-serif;
              color: white;
              background-color: blue;
              font-weight: bold;
              
            }
            span#dcomply{
              font-family: sans-serif;
              color: white;
              background-color: red;
              font-weight: bold;
            }
            span.span11{
                background-color: #F93;
                color: #F93;                
                width: 10px;
            }
            span.span12{
                background-color: #33ff33;
                color:#33ff33;
                width: 10px;
            }
            span.span13{
                background-color: #E0E2FF;
                color:#E0E2FF;
                width: 10px;
            }

        </style>
<script type="text/javascript">
    $(document).ready(function(){             
        $('#addassay').hide();         
        $('#FormSubmi').click(function(){        
            postData=$('#capsuleUn').serialize();        
            $.ajax({
                type: "POST",    
                url: "<?php echo base_url(); ?>dissolution/save_capsule_weights/",
                data: postData,
                error: function (data) {
                  alert('Sorry there was a problem while tring to save the data, try later')
                },
                success: function (data) {
                    alert('The data has been suceesfully saved')
                        
                    
		}
            })
        });
    });
</script>
   

     

    </head>
    < <<legend><a href="<?php echo site_url() ."supervisors/home/".$labref.'/'; ?>">... BACK</a></legend>
    <body  >
    <h1>Capsule/Sachet/Vials Uniformity of Weight</h1>
    <p>
    <center><legend><h2>Sample: <?php echo $labref;?> </h2></legend></center>
    </p>
    
    <div id="Individual_box">
        
        <?php echo form_open('uniformity/approve/'.$labref.'/'.$r);?>
   <p><input type="submit" value="Approve" style="background-color: #33ff33;color: #ffffff;"/>&nbsp;&nbsp;<a href="#rejectSample" id="Inline" style="background-color: #F00; color: #ffffff;">Reject</a></p>
       
  
        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="dave-table">
            
      
            <tr>
                <td width="45" height="53"><div align="center">No.</div></td>
                <td width="144" align="center" valign="middle"><p align="center">Capsules/Sachets/Vials  (mg)</p></td>
                <td width="155">Empty Capsule/ Sachet/Vial  (mg)</td>
                <td width="147" align="center" valign="middle">Capsule/Sachet/Vial Content (mg)</td>
                <td width="138" valign="middle"><label  class="submit-button"> % deviation</label></td>

            </tr>
            <tr>
                <td><div align="center">1</div></td>
                <td><input type="text" id="utcsv1" name="tcsv1" size="25" class="unum" required value="<?php echo $caps_results[0]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv1" name="ecsv1" size="25" class="unum1" value="<?php echo $caps_results[0]->ecsv;?>" required/></td>
                <td><input type="text" id="ucsvc1" name="csvc1" size="25" class="unum2" value="<?php echo $caps_results[0]->csvc;?>" readonly="readonly" /></td>
                <td><input type="text" id="udfm1"name=" dfm1" size="25" class="unum3" value="<?php echo $caps_results[0]->percent_deviation;?>" readonly="readonly"/></td>
                <td><span id="span11" style="display:none" class="span11">A</span><span id="span12" style="display:none"  class="span12">N</span><span id="span13" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">2</div></td>
                <td><input type="text" id="utcsv2" name="tcsv2" class="unum" size="25" required value="<?php echo $caps_results[1]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv2" name="ecsv2" class="unum1" size="25" required value="<?php echo $caps_results[1]->ecsv;?>"/>
                <td><input type="text" id="ucsvc2" name="csvc2"  class="unum2"size="25"readonly="readonly" value="<?php echo $caps_results[1]->csvc;?>"/></td>
                <td><input type="text" id="udfm2" name=" dfm2" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[1]->percent_deviation;?>"/></td>
                <td><span id="span21" size="25" style="display:none" class="span11">A</span><span id="span22" style="display:none" size="25"  class="span12">N</span><span id="span13" style="display:none"  class="span23">O</span></td>
            </tr>
            <tr>
                <td><div align="center">3</div></td>
                <td><input type="text" id="utcsv3" name="tcsv3"  class="unum" size="25" required value="<?php echo $caps_results[2]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv3" name="ecsv3" class="unum1" size="25" required value="<?php echo $caps_results[2]->ecsv;?>"/></td>
                <td><input type="text"  id="ucsvc3" name="csvc3" class="unum2" size="25" readonly="readonly" value="<?php echo $caps_results[2]->csvc;?>" /></td>
                <td><input type="text" id="udfm3" name=" dfm3" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[2]->percent_deviation;?>"/></td>
                <td><span id="span31" size="25" style="display:none" class="span11">A</span><span id="span32" style="display:none" size="25"  class="span12">N</span><span id="span33" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">4</div></td>
                <td><input type="text" id="utcsv4" name="tcsv4" class="unum" size="25" required value="<?php echo $caps_results[3]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv4" name="ecsv4" class="unum1" size="25" required value="<?php echo $caps_results[3]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc4" name="csvc4" class="unum2" size="25" readonly="readonly"value="<?php echo $caps_results[3]->csvc;?>"  /></td>
                <td><input type="text" id="udfm4" name=" dfm4" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[3]->percent_deviation;?>"/></td>
                <td><span id="span41" size="25" style="display:none" class="span11">A</span><span id="span42" style="display:none" size=" 25" class="span12">N</span><span id="span43" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">5</div></td>
                <td><input type="text" id="utcsv5" name="tcsv5" size="25" class="unum" required value="<?php echo $caps_results[4]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv5" name="ecsv5" size="25"  class="unum1" required value="<?php echo $caps_results[4]->ecsv;?>" /></td>
                <td><input type="text" id="ucsvc5" name="csvc5" class="unum2" size="25" readonly="readonly" value="<?php echo $caps_results[4]->csvc;?>"/></td>
                <td><input type="text" id="udfm5" name=" dfm5" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[4]->percent_deviation;?>"/></td>
                <td><span id="span51" size="" style="display:none" class="span11">A</span><span id="span52" style="display:none" size=""  class="span12">N</span><span id="span53" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">6</div></td>
                <td><input type="text" id="utcsv6" name="tcsv6" size="25" class="unum" required value="<?php echo $caps_results[5]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv6" name="ecsv6" size="25" class="unum1" required value="<?php echo $caps_results[5]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc6" name="csvc6" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[5]->csvc;?>"/></td>
                <td><input type="text" id="udfm6" name=" dfm6" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[5]->percent_deviation;?>"/></td>
                <td><span id="span61" size="" style="display:none" class="span11">A</span><span id="span62" style="display:none" size=""  class="span12">N</span><span id="span63" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">7</div></td>
                <td><input type="text" id="utcsv7" name="tcsv7" size="25" class="unum" required value="<?php echo $caps_results[6]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv7" name="ecsv7" size="25" class="unum1" required value="<?php echo $caps_results[6]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc7" name="csvc7" size="25" class="unum2" readonly="readonly"  value="<?php echo $caps_results[6]->csvc;?>"/></td>
                <td><input type="text" id="udfm7" name=" dfm7" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[6]->percent_deviation;?>"/></td>
                <td><span id="span71" size="" style="display:none" class="span11">A</span><span id="span72" style="display:none" size=""  class="span12">N</span><span id="span73" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">8</div></td>
                <td><input type="text" id="utcsv8" name="tcsv8" size="25" class="unum"  required value="<?php echo $caps_results[7]->tcsv;?>"/></td>
                <td><input type="text"  id="uecsv8" name="ecsv8" size="25" class="unum1" required value="<?php echo $caps_results[7]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc8" name="csvc8" size="25" class="unum2"  readonly="readonly" value="<?php echo $caps_results[7]->csvc;?>"/></td>
                <td><input type="text" id="udfm8" name=" dfm8" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[7]->percent_deviation;?>"/></td>
                <td><span id="span81" size="" style="display:none" class="span11">A</span><span id="span82" style="display:none" size=""  class="span12">N</span><span id="span83" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">9</div></td>
                <td><input type="text" id="utcsv9" name="tcsv9" size="25" class="unum"  required value="<?php echo $caps_results[8]->tcsv;?>"/></td>
                <td><input type="text"  id="uecsv9" name="ecsv9" size="25" class="unum1" required value="<?php echo $caps_results[8]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc9" name="csvc9" size="25" class="unum2"  readonly="readonly" value="<?php echo $caps_results[8]->csvc;?>"/></td>
                <td><input type="text" id="udfm9" name=" dfm9" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[8]->percent_deviation;?>"/></td>
                <td><span id="span91" size="" style="display:none" class="span11">A</span><span id="span92" style="display:none" size=""  class="span12">N</span><span id="span93" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">10</div></td>
                <td><input type="text" id="utcsv10"  name="tcsv10" class="unum" size="25" required value="<?php echo $caps_results[9]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv10" name="ecsv10"  class="unum1" size="25" required value="<?php echo $caps_results[9]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc10"  name="csvc10" class="unum2" size="25" readonly="readonly" value="<?php echo $caps_results[9]->csvc;?>"/></td>
                <td><input type="text" id="udfm10" name=" dfm10" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[9]->percent_deviation;?>"/></td>
                <td><span id="span101" size="" style="display:none" class="span11">A</span><span id="span102" style="display:none" size=""  class="span12">N</span><span id="span103" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">11</div></td>
                <td><input type="text" id="utcsv11" name="tcsv11" class="unum" size="25" required value="<?php echo $caps_results[10]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv11" name="ecsv11"class="unum1"  size="25" required value="<?php echo $caps_results[10]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc11"name="csvc11" class="unum2" size="25" readonly="readonly" value="<?php echo $caps_results[10]->csvc;?>"/></td>
                <td><input type="text" id="udfm11" name=" dfm11" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[10]->percent_deviation;?>"/></td>
                <td><span id="span111" size="" style="display:none" class="span11">A</span><span id="span112" style="display:none" size=""  class="span12">N</span><span id="span113" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">12</div></td>
                <td><input type="text" id="utcsv12" name="tcsv12" class="unum" size="25" required value="<?php echo $caps_results[11]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv12" name="ecsv12" class="unum1" size="25" required value="<?php echo $caps_results[11]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc12" name="csvc12" class="unum2" size="25" readonly="readonly" value="<?php echo $caps_results[11]->csvc;?>"/></td>
                <td><input type="text" id="udfm12" name=" dfm12" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[11]->percent_deviation;?>"/></td>
                <td><span id="span121" size="" style="display:none" class="span11">A</span><span id="span122" style="display:none" size=""  class="span12">N</span><span id="span123" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">13</div></td>
                <td><input type="text" id="utcsv13"  name="tcsv13" size="25" class="unum" required value="<?php echo $caps_results[12]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv13" name="ecsv13" size="25" required class="unum1" value="<?php echo $caps_results[12]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc13" name="csvc13" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[12]->csvc;?>"/></td>
                <td><input type="text" id="udfm13" name=" dfm13" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[12]->percent_deviation;?>"/></td>
                <td><span id="span131" size="" style="display:none" class="span11">A</span><span id="span132" style="display:none" size=""  class="span12">N</span><span id="span133" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">14</div></td>
                <td><input type="text" id="utcsv14" name="tcsv14" size="25" required class="unum" value="<?php echo $caps_results[13]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv14" name="ecsv14" size="25" required class="unum1" value="<?php echo $caps_results[13]->ecsv;?>"td>
                <td><input type="text" id="ucsvc14" name="csvc14" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[13]->csvc;?>"/></td>
                <td><input type="text" id="udfm14" name=" dfm14" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[14]->percent_deviation;?>"/></td>
                <td><span id="span141" size="" style="display:none" class="span11">A</span><span id="span142" style="display:none" size=""  class="span12">N</span><span id="span143" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">15</div></td>
                <td><input type="text" id="utcsv15" name="tcsv15" size="25" required class="unum" value="<?php echo $caps_results[14]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv15" name="ecsv15" size="25" required class="unum1" value="<?php echo $caps_results[14]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc15" name="csvc15" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[14]->csvc;?>"/></td>
                <td><input type="text" id="udfm15" name=" dfm15" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[14]->percent_deviation;?>"/></td>
                <td><span id="span151" size="" style="display:none" class="span11">A</span><span id="span152" style="display:none" size=""  class="span12">N</span><span id="span153" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">16</div></td>
                <td><input type="text" id="utcsv16" name="tcsv16" size="25" required class="unum" value="<?php echo $caps_results[15]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv16" name="ecsv16" size="25" required class="unum1"value="<?php echo $caps_results[15]->ecsv;?>" /></td>
                <td><input type="text"  id="ucsvc16" name="csvc16" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[15]->csvc;?>" /></td>
                <td><input type="text" id="udfm16" name=" dfm16" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[15]->percent_deviation;?>"/></td>
                <td><span id="span161" size="" style="display:none" class="span11">A</span><span id="span162" style="display:none" size=""  class="span12">N</span><span id="span163" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">17</div></td>
                <td><input type="text" id="utcsv17"name="tcsv17" size="25" required class="unum" value="<?php echo $caps_results[16]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv17" name="ecsv17" size="25" required class="unum1" value="<?php echo $caps_results[16]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc17" name="csvc17" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[16]->csvc;?>" /></td>
                <td><input type="text" id="udfm17" name=" dfm17" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[16]->percent_deviation;?>"/></td>
                <td><span id="span171" size="" style="display:none" class="span11">A</span><span id="span172" style="display:none" size=""  class="span12">N</span><span id="span173" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">18</div></td>
                <td><input type="text" id="utcsv18" name="tcsv18" size="25" class="unum" required value="<?php echo $caps_results[17]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv18" name="ecsv18" size="25" class="unum1" required value="<?php echo $caps_results[17]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc18" name="csvc18" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[17]->csvc;?>"/></td>
                <td><input type="text" id="udfm18" name=" dfm18" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[17]->percent_deviation;?>"/></td>
                <td><span id="span181" size="" style="display:none" class="span11">A</span><span id="span182" style="display:none" size=""  class="span12">N</span><span id="span183" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">19</div></td>
                <td><input type="text"id="utcsv19" name="tcsv19" size="25" required class="unum" value="<?php echo $caps_results[18]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv19" name="ecsv19" size="25" required class="unum1" value="<?php echo $caps_results[18]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc19" name="csvc19" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[18]->csvc;?>"/></td>
                <td><input type="text" id="udfm19" name=" dfm19" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[18]->percent_deviation;?>"/></td>
                <td><span id="span191" size="" style="display:none" class="span11">A</span><span id="span192" style="display:none" size=""  class="span12">N</span><span id="span193" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">20</div></td>
                <td><input type="text"id="utcsv20"  name="tcsv20" size="25" required class="unum" value="<?php echo $caps_results[19]->tcsv;?>"/></td>
                <td><input type="text" id="uecsv20" name="ecsv20" size="25" required class="unum1" value="<?php echo $caps_results[19]->ecsv;?>"/></td>
                <td><input type="text" id="ucsvc20" name="csvc20" size="25" class="unum2" readonly="readonly" value="<?php echo $caps_results[19]->csvc;?>"/></td>
                <td><input type="text" id="udfm20" name=" dfm20" size="25" class="unum3" readonly="readonly" value="<?php echo $caps_results[19]->percent_deviation;?>"/></td>
                <td><span id="span201" size="" style="display:none" class="span11">A</span><span id="span202" style="display:none" size="" class="span12">N</span><span id="span203" style="display:none"  class="span13">O</span></td>
            </tr>
            <tr>
                <td><div align="center">Total</div></td>
                <td><input type="text" class="utotal" id="utotals" value="<?php echo $caps_ta[0]->overall_total;?>"/></td>
            <input type="hidden" id="utotalss" name="totalss" />

            <td><span class="utotal1" id="utotals1"></span></td>            
            <input type="hidden" id="utotalss1" name="totalss1" />


            <td><strong><input type="text"class="utotal2" id="utotals2" name="totalss2" value="<?php echo $caps_ta[0]->actual_total;?>"/></strong></td>

            <td><span class="utotal3" id="utotals3"></span></td>
            <input type="hidden" id="utotalss3" name="totalss3"/>
            </tr>
            <tr>
                <td><div align="center">Average</div></td>
                <td><input type="text" class="uav" id="uav1" value="<?php echo $caps_ta[0]->overall_average;?>"/></td>                
                <td><span class="uav1"  id="uav2" </span></td>
                <td><input type="text" class="uav2" id="uav3" name="uav3" value="<?php echo $caps_ta[0]->actual_average;?>"/></td>
                <td></td>
            </tr>
            <input type="hidden" name="capsStatus" id="capStatus"/>
            <td colspan="5"> <strong>Sample:</strong> <span id="complies" style="display:none">Complies</span><span id="dcomply" style="display:none">Does not comply</span></td>
        </table>
        <p>  
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><label for="comment">comments:</label> </strong>                 
        </p><div align="center"><textarea name="comment" cols="90" id="com"><?php echo $caps_ta[0]->cstatus;?></textarea></div>
        
        </form>
    </div>  
   <div class="reject">
        <div id="rejectSample">
        <?php $this->load->view('compose_v_1');?>
        </div>
    </div>
</div>
        </body>
