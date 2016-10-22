<?php
session_start();
include("header.php");
?>

    <center><h1>Register</h1></center>
    <br /><br />

    <i>MULTIPLE NATIONS ARE AGAINST THE RULES. IF YOU HAVE MULTIPLE NATIONS THEY WILL ALL BE DELETED. IF YOU ARE CAUGHT EXPLOITING MULTIPLE NATIONS (SENDING AID BETWEEN THEM, ETC) YOU WILL BE PERMANENTLY BANNED.</i>

    <br /><br />
   
    <?php
if(isset($_POST['register'])){
    $username = mysql_real_escape_string(protect($_POST['username']));
    $password = mysql_real_escape_string(protect($_POST['password']));
    $email = mysql_real_escape_string(protect($_POST['email']));
    $nationname = mysql_real_escape_string($_POST['nationname']);
    $ip=$_SERVER['REMOTE_ADDR'];
    $ip2 = ip2long($ip);
    $region = mysql_real_escape_string($_POST['region']);
    $government = mysql_real_escape_string($_POST['government']);
    $economy = mysql_real_escape_string($_POST['economy']);

    if ($username == "" || $password == "" || $email == "" || $nationname == "" || $region == "" || $government == "" || $economy == ""){
        output("Please supply all fields!");
    }elseif(strlen($username) > 50){
        echo "Username must be less than 50 characters!";
    }elseif(strlen($username) < 4){
        echo "Username must be at least 4 characters!";
    }elseif(strlen($email) > 150){
        echo "E-mail must be less than 150 characters! Don't meme kiddo.";
    }elseif(strlen($nationname) > 15){output("Nation name is too long!");}else{
        $register1 = mysql_query("SELECT `id` FROM `user` WHERE `username` = '$username'") or die(mysql_error());
        $register2 = mysql_query("SELECT `id` FROM `user` WHERE `email` = '$email'") or die(mysql_error());
        $register3 = mysql_query("SELECT `id` FROM `nation` WHERE `nationname` = '$nationname'") or die(mysql_error());
        if(mysql_num_rows($register1) > 0){
            echo output("That username is already in use!");
        }elseif(mysql_num_rows($register2) > 0){
            echo output("That email is already in use!");
        }elseif(mysql_num_rows($register3) > 0){
            output("That nation name is already taken!");
        }else{
            $ins1 = mysql_query("INSERT INTO `user` (`username`,`password`,`email`,`ip`) VALUES ('$username','".md5($password)."','$email','$ip2')") or die(mysql_error());
            $ins2 = mysql_query("INSERT INTO `nation` (`nationname`,`align`,`region`,`government`,`economy`,`approval`,`reputation`,`quality`) VALUES ('$nationname','50','$region','$government','$economy','51','51','51')") or die(mysql_error());
            $ins3 = mysql_query("INSERT INTO `economy` (`gdp`,`growth`,`budget`,`oil`) VALUES ('100','2','300','1')") or die(mysql_error());
            $ins3 = mysql_query("INSERT INTO `government` (`stability`) VALUES ('3')") or die(mysql_error());
            $ins3 = mysql_query("INSERT INTO `military` (`size`,`tech`,`rebels`,`manpower`) VALUES ('10','10','0','100')") or die(mysql_error());
            $ins3 = mysql_query("INSERT INTO `cosmetic` (`flag`,`portrait`,`description`) VALUES ('revolution/flag.png','revolution/portrait.jpg','Welcome to Bloc! Go to settings to change your flag, leader picture, and description (this thing). Also remember to register on the forum and bookmark the game!')") or die(mysql_error());

            output("You have seized power in a glorious revolution! Log in to take over the reins of your nation and lead it to greatness (or destruction).");
        }
    }
}
?>

   <script>
        function refreshName(governmentSelect)
        {
            var value = governmentSelect.options[governmentSelect.selectedIndex].value;
            var newName = "Republic of";
            if (value == 80) { newName="People's Republic of" };
            if (value == 60) { newName="Democratic People's Republic of" };
            if (value == 30) { newName="Revolutionary Democratic People's Republic of" };
            if (value == 1) { newName="Great Revolutionary Democratic People's Republic of" };


            document.getElementById("displayedName").innerHTML=newName;
        }
    </script>


   <table cellpadding="3" cellspacing="5">
        <form action="register.php" method="POST">
            <tr>
                <td>Username/Leader:</td> <td><input type="text" name="username"/></td>
            </tr><tr>
                <td>Password:</td> <td><input type="password" name="password"/></td>
            </tr><tr>
                <td>E-mail:</td> <td><input type="text" name="email"/></td>
            </tr></table><br /><center>
    <h1>Create your country!</h1></center>
    <table cellpadding="3" cellspacing="5"><tr>
            <td>Nation Name:</td> <td><p id="displayedName">Republic of</p><input type="text" name="nationname"/></td>
        </tr><tr>
            <td>Region:</td><td>  <select name="region">
                    <option value="">Select...</option>
                    <option value="Latin America">Latin America</option>
                    <option value="Africa">Africa</option>
                    <option value="Middle East">Middle East</option>
                    <option value="Asia">Asia</option>
                </select></td></tr><tr>
            <td>Government:</td><td>  <select onchange="refreshName(this)" name="government">
                    <option value="">Select...</option>
                    <option value="1">Dictatorship</option>
                    <option value="30">Military Junta</option>
                    <option value="60">One Party Rule</option>
                    <option value="80">Authoritarian Democracy</option>
                    <option value="100">Multi-party Democracy</option>
                </select></td></tr><tr>
            <td>Economy:</td><td>  <select name="economy">
                    <option value="">Select...</option>
                    <option value="10">Central Planning</option>
                    <option value="50">Mixed Economy</option>
                    <option value="90">Free Market</option>
                </select></td><tr><td></td>
            <td><input type="submit" name="register" value="Register"/></td></tr>
        </form></table>
<?php
include("footer.php");
?>
