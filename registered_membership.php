<!DOCTYPE html>
<html lang="en">
 <head>
    <title>FITNESS FREAK::Register Membership</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="./gym.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
    
    <div class="header_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo"><a href="index.html"><img src="./images/logo.jpeg" height="100" width="200"></a></div>
                </div>
                <div class="col-md-9">
                    <div class="menu_text">
                        <ul>
                            <li><a href="index.html">HOME</a></li> 
                            <li><a href="locations.html">LOCATION</a></li>                                                    
                            <li><a href="about.html">ABOUT</a></li>
                            <li><a href="pricing-plans.html">PACKAGE</a></li>
                            <li><a href="Diet-plans.html">DIET PLAN</a></li>
                            <li><a href="contact-us.html">CONTACT US</a></li>
                          </ul>
                    </div>  
                            
                </div>
            </div>
        </div>
    </div>

    <div class="about_section_2 layout_padding" style="margin-bottom:30px;">
		<div class="container-fluid">
			<h1 class="contact_text_2">
            <strong>Register
            <?php echo (isset($_GET['plan']))?"for '".$_GET['plan']."' membership":"";?></h1>
            </strong></h1>
		</div>
	</div>
        <main id="backcol" style="min-height:400px;">
            <p id="error"></p>
            <p id="success" style="font-size: 1.5em;color:green;"></p>
         <form method="POST" onsubmit="return register()" id="newuserform">
			<?php
			if(!isset($_GET['plan'])){
			
			?>
			<label for="pname">Select Plan:</label>
            <select name="myPlan" id="myPlan">
				<option>Black Card</option>
				<option>Standard Card</option>
				<option>4Less Card</option>
			  </select>
			<?php } else{ echo "<input type='hidden' name='myPlan' value='".$_GET['plan']."' >";}?>


            
            <label class="formlabels" for="pname">Name:</label>
            <input class="form-control" type="text" name="myNAME" id="paname" required pattern="[a-z A-Z]{3,}" title="ENter a Valid Name">
            
            <label class="formlabels" for="pmob">Mobile No.:</label>
            <input class="form-control" type="text" name="myMob" id="pmob" required pattern="[0-9]{10}" maxlength=10 title="ENter a Valid Mobile No.">
            
            <label class="formlabels" for="pmail">E-mail:</label>
            <input class="form-control" type="email" name="myEmail" id="pmail" required>

            <label class="formlabels" for="pass">Password:</label>
            <input class="form-control" type="password" for="pass" name="pass" id="pass" pattern=".{6,}" title="ENter minimim 6 characters">
           
            <label class="formlabels" for="cpass">Confirm Password:</label>
            <input class="form-control" type="password" for="cpass" name="cpass" id="cpass">
           
            <input class="form-control" type="submit" value="Register Now" id="mySubmit">
        </form>

        </main>
     <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="footer_section_2">
    	    <div class="container">
    		    <div class="row map_addres">
    		    	<div class="col-sm-12 col-lg-4">
    		    		<div class="map_text">
                  <img src="images/map-icon.png">
                  <span class="map_icon">
                    Open 24/7
                  </span>
                </div>
    		    	</div>
                    <div class="col-sm-12 col-lg-4">
                    	<div class="map_text"><img src="images/phone-icon.png"><span class="map_icon"> +1 555-444-6987 </span></div>
                    </div>
    		    	<div class="col-sm-12 col-lg-4">
    		    		<div class="map_text"><img src="images/email-icon.png"><span class="map_icon">contact@fitnessfreak.com</span></div>
    		    	</div>
    		    </div>
    		    <div class="social_icon">
    		    	<ul>
    		    		<li><a href="#"><img src="images/fb-icon.png"></a></li>
    		    		<li><a href="#"><img src="images/twitter-icon.png"></a></li>
    		    		<li><a href="#"><img src="images/in-icon.png"></a></li>
    		    		<li><a href="#"><img src="images/instagram-icon.png"></a></li>
    		    	</ul>
    		    </div>
    		    <p class="copyright_text">Copyright 2021 All Right Reserved</p>
    	    </div>
        </div>
    </div>
    <!-- footer section end -->


    <script>


    function register()
    {
        var pass = document.getElementById("pass").value;
        var cpass = document.getElementById("cpass").value;

        if(pass==cpass)
        {
               // return true;
			var BASE_URL = "http://localhost/fitness";
			$.ajax({
				type: 'post',
				url: BASE_URL + "/function/requestUpdate.php?requestType=RegisterForm",
				data: $("#newuserform").serialize(),
				beforeSend: function () {
					//$("#mySubmit").prop('disabled', true).html("<span>Please Wait..</span>");
				},
				success: function (result) {
					var result = JSON.parse(result);		
					if(result.status == 2) {
						$("#error").html("User already exists.");
					}					
					else if(result.status == 1) {	
						$("#error").html("");
						$("#success").html("Congratulations!!! Please show the reference code '"+result.code+"' at GYM for payment.");
						$("#newuserform").hide();
						$("#newuserform")[0].reset();
						setTimeout(function() {
							window.location.href=BASE_URL;
						}, 5000);	
					} else {
						$("#mySubmit").prop('disabled', false).html("<span>Register Now</span>");
						new PNotify({
							title: 'Error',
							text: result.error,
							type: 'error',
							hide: true
						});
					}		
				}
			});
			return false;
        }
        else
        {
            document.getElementById("error").innerHTML="Password Not Matched";
            //alert('password not matched');
            return false;
        }

    }


$(document).ready(function(){
        $("#pmob").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
       
    });

});
              
    </script>
    </body>
</html>
