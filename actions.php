<?php
session_start();
include("header.php");


if (!isset($_SESSION['uidtrw'])){
    echo "You must be logged in to view this page";
}else{
    if (isset($_POST['greatleap'])){
        $greatleap_cost=100;
        
        if($economy['budget'] < $greatleap_cost){
            output("You do not have enough money!");
        }elseif($nation['economy'] > 66 ){
            output("Free markets states cannot engage in heinous socialism!");}else{$successchancegl=rand(1, 10);
            if ($successchancegl>5){
                $economy['growth'] = $economy['growth'] + 1;
                $update_growth = mysql_query("UPDATE `economy` SET `growth`='".$economy['growth']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $economy['budget'] = $economy['budget'] - $greatleap_cost;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $nation['economy'] = $nation['economy'] - 6;
                $update_economy = mysql_query("UPDATE `nation` SET `economy`='".$nation['economy']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
            
                output("You have improved your economic growth! Let a thousand pig irons bloom!");}elseif($successchancegl<2){
                    $economy['growth'] = $economy['growth'] - 1;
                $update_growth = mysql_query("UPDATE `economy` SET `growth`='".$economy['growth']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $economy['budget'] = $economy['budget'] - $greatleap_cost;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                output("Poor pig iron! Economic growth decreases!");
            }else{
                
                $economy['budget'] = $economy['budget'] - $greatleap_cost;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
            
                output("Mediocre pig iron! You have failed to improve economic growth!");}
        }
        
    } 
    
    if (isset($_POST['foreigninvestment'])){
        $fi_cost=75;
        
        if($economy['budget'] < $fi_cost){
            output("You do not have enough money!");
        }elseif($nation['economy'] < 33){
            output("Foreign capitalists will not invest in a nation ruled by money-hating Bolsheviks!");}else{$successchance=rand(1, 10);
            if ($successchance>9){
                $economy['growth'] = $economy['growth'] + 1;
                $update_growth = mysql_query("UPDATE `economy` SET `growth`='".$economy['growth']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $economy['budget'] = $economy['budget'] - $fi_cost;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $economy['FI'] = $economy['FI'] + 150;
                $update_fi = mysql_query("UPDATE `economy` SET `FI`='".$economy['FI']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $nation ['economy'] = $nation ['economy'] + 3;
                $update_economy = mysql_query("UPDATE `nation` SET `economy`='".$nation['economy']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("Foreign investment pours in which trickles down all over your economy, generating growth!");}elseif($successchance<3){

                $economy['budget'] = $economy['budget'] - $fi_cost;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $economy['FI'] = $economy['FI'] + 150;
                $update_fi = mysql_query("UPDATE `economy` SET `FI`='".$economy['FI']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $nation ['economy'] = $nation ['economy'] + 3;
                $update_economy = mysql_query("UPDATE `nation` SET `economy`='".$nation['economy']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("Foreign investment pours in but unfortunately there is no trickling down on the domestic economy!");
            }else{
                
                $economy['budget'] = $economy['budget'] - $fi_cost;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                output("No one takes up your offer to invest!");}
        }
        
    }
    
     if (isset($_POST['nationalize'])){if($economy['FI'] < 150){output("You cannot nationalize nothing!");
     }else{
                
                $economy['budget'] = $economy['budget'] + $economy['FI'];
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $economy['FI'] = 0;
                $update_fi = mysql_query("UPDATE `economy` SET `FI`='".$economy['FI']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $nation ['align'] = $nation ['align'] - 20;
                $update_align = mysql_query("UPDATE `nation` SET `align`='".$nation['align']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
            
                $nation ['economy'] = $nation ['economy'] - 20;
                $update_economy = mysql_query("UPDATE `nation` SET `economy`='".$nation['economy']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("You seize what is yours! Foreign investment added to the budget. Spend it before the next turn or you'll lose it all!");}}
        
      if (isset($_POST['imf'])){if($economy['growth'] <= 0){
            output("You cannot borrow if your economy is not growing!");
        }elseif($nation['align'] < 25){
            output("Eastern Bloc nations are not members of the IMF!");}else{
                
                $economy['budget'] = $economy['budget'] + 100;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $economy['growth'] = $economy['growth'] - 1;
                $update_growth = mysql_query("UPDATE `economy` SET `growth`='".$economy['growth']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
            
                $nation ['economy'] = $nation ['economy'] + 6;
                $update_economy = mysql_query("UPDATE `nation` SET `economy`='".$nation['economy']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("You take out an IMF loan. Growth decreases as you must now pay off your debt. Spend the loan before the next turn or you'll lose it all!!");} }
    //foregin policy            
      if (isset($_POST['praise_ussr'])){$praise_cost = 50;
        if($economy['budget'] < $praise_cost){
            output("You do not have enough money!");
        }else{
                
                $economy['budget'] = $economy['budget'] - 50;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                $nation ['align'] = $nation ['align'] - 6;
                $update_align = mysql_query("UPDATE `nation` SET `align`='".$nation['align']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
            
                output("You praise the glorious advances of the Soviet Union. They like that.");}}
                
      if (isset($_POST['praise_us'])){$praise_cost = 50;
        if($economy['budget'] < $praise_cost){
            output("You do not have enough money!");
        }else{
                
                $economy['budget'] = $economy['budget'] - 50;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                $nation ['align'] = $nation ['align'] + 6;
                $update_align = mysql_query("UPDATE `nation` SET `align`='".$nation['align']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
            
                output("You praise the glorious success of American freedom. They like that.");}}          
    //military
   if (isset($_POST['conscript'])){if($economy['growth'] <= -2){
            output("Your economy cannot support further conscription!");
        }else{
                
                $economy['growth'] = $economy['growth'] - 1;
                $update_growth = mysql_query("UPDATE `economy` SET `growth`='".$economy['growth']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
            
                $military ['size'] = $military ['size'] + 2;
                $update_military = mysql_query("UPDATE `military` SET `size`='".$military ['size']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("You conscript thousands of young men into your army.");}}
    
    
    
    if (isset($_POST['aks'])){
        $ak_cost=50;
        
        if($economy['budget'] < $ak_cost){
            output("You do not have enough money!");
        }elseif($nation['align'] > 25){
            output("The Soviet Union will not provide weapons to capitalist scum like you!");}else{
                
                $economy['budget'] = $economy['budget'] - 50;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                $military ['tech'] = $military ['tech'] + 1;
                $update_military = mysql_query("UPDATE `military` SET `tech`='".$military ['tech']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("Thousands of AK-47s are airlifted straight to you from Moscow.");
            }}
    
   if (isset($_POST['aksblack'])){
        $aksblack_cost=100;
        
        if($economy['budget'] < $aksblack_cost){
            output("You do not have enough money!");
        }else{
            
                $economy['budget'] = $economy['budget'] - 100;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                $military ['tech'] = $military ['tech'] + 1;
                $update_military = mysql_query("UPDATE `military` SET `tech`='".$military ['tech']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("The deal is done. The Gold AK is on the house.");
            }}    
   if (isset($_POST['ustanks'])){
        $ustanks_cost=300;
        
        if($economy['budget'] < $ustanks_cost){
            output("You do not have enough money!");
        }elseif($nation['align'] < 75){output("The United States will not provide weapons to communist scum like you!");}else{  $economy['budget'] = $economy['budget'] - 300;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                $military ['tech'] = $military ['tech'] + 6;
                $update_military = mysql_query("UPDATE `military` SET `tech`='".$military ['tech']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("The deal is done. The Gold AK is on the house.");
            }}
      if (isset($_POST['attackrebels'])){
        $attackrebels_cost=75;
        
        if($economy['budget'] < $attackrebels_cost){
            output("You do not have enough money!");
        }elseif($military ['rebels'] <= 0){output("There are no rebels to attack!");
        }else{$successchancereb=rand(1, 10);  
            
           if($successchancereb>5) {$economy['budget'] = $economy['budget'] - 75;
                $update_budget = mysql_query("UPDATE `economy` SET `budget`='".$economy['budget']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                
                $military ['size'] = $military ['size'] - 1;
                $update_military = mysql_query("UPDATE `military` SET `size`='".$military ['size']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                $military ['rebels'] = $military ['rebels'] - 1;
                $update_military = mysql_query("UPDATE `military` SET `rebels`='".$military ['rebels']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("Your forces suffer casualties but they manage to weaken the rebels.");}else{
                
                $military ['rebels'] = $military ['rebels'] - 1;
                $update_military = mysql_query("UPDATE `military` SET `rebels`='".$military ['rebels']."' WHERE `id`='".$_SESSION['uidtrw']."'") or die(mysql_error());
                output("Your forces are victorious against the rebels.");
                    
                }
            }}    
        
    
    
    
    
    
    
    ?>
    
    <center><h2>Actions</h2></center>
    <br />
    Available budget: $<?php echo $economy['budget']; ?>k
    <br /> <i>Budget does not accumulate between turns!</i>
    <br /><br />
    <form action="actions.php" method="post">
    <table cellpadding ="5" cellspacing ="5">
    
    <center><h4>Economic Development</h4>
     </center>
    
        <tr>
            <td><b>Action</b></td>
            <td><b>Description</b></td>
            <td><b>Cost</b></td>
            <td><b></b></td>
        </tr>
        <tr>
            <td><b>Great Leap Forward</b></td>
            <td>The workers must produce more pig iron! Possibly increase economic growth.</td>
            <td>$100k</td>
            <td><input type="submit" name="greatleap" /></td>
        </tr>
        <tr>
            <td><b>Encourage Foreign Investment</b></td>
            <td>Invite rich yankees to exploit your cheap labor and resources. Slight chance of increasing economic growth... but the rest could always be nationalized later.</td>
            <td>$75k</td>
            <td><input type="submit" name="foreigninvestment" /></td>
        </tr>
        <tr>
            <td><b>Nationalize Foreign Investment</b></td>
            <td>Take from the rich yankees what is rightfully yours. Seizure of all foreign investment is added directly to your budget, but alienates the US and moves your nation closer towards the left.</td>
            <td>Nothing!</td>
            <td><input type="submit" name="nationalize" /></td>
        </tr>
        <tr>
            <td><b>IMF Loan</b></td>
            <td>A Faustian Bargain. 100k in cold hard cash for a decrease in growth.</td>
            <td>Decrease in growth.</td>
            <td><input type="submit" name="imf" /></td>
        </tr>
        
        
        </table><br /><br /><hr />
        <table cellpadding ="5" cellspacing ="5">
    <center><h4>Foreign Policy</h4></center>
         <tr>
            <td><b>Action</b></td>
            <td><b>Description</b></td>
            <td><b>Cost</b></td>
            <td><b></b></td>
        </tr>
        <tr>
            <td><b>Praise the Soviet Union</b></td>
            <td>Give the General Secretary a bear hug in front of the cameras. Increases your relations with the godless communists, hurts them with the freedom-loving Americans.</td>
            <td>$50k</td>
            <td><input type="submit" name="praise_ussr" /></td>
        </tr>
        <tr>
            <td><b>Praise the United States</b></td>
            <td>Shake the Prez' hand on the tarmac. Increases your relations with the bloodthirsty capitalists, hurts them with the equality-loving Soviets.</td>
            <td>$50k</td>
            <td><input type="submit" name="praise_us" /></td>
        </tr>
    
    </table><hr />
    <table cellpadding ="5" cellspacing ="5">
    <center><h4>Military</h4></center>
         <tr>
            <td><b>Action</b></td>
            <td><b>Description</b></td>
            <td><b>Cost</b></td>
            <td><b></b></td>
        </tr>
        <tr>
            <td><b>Conscription</b></td>
            <td>Time to serve! Increase size of military at the cost of economic growth.</td>
            <td>Decrease in growth.</td>
            <td><input type="submit" name="conscript" /></td>
        </tr>
        <tr>
            <td><b>Buy AK-47s from the Soviets</b></td>
            <td>Buy a lot of the finest mass-produced guns ever wielded by everyone ever. Must have good relations with the Soviets. Slight increase in technology.</td>
            <td>$50k</td>
            <td><input type="submit" name="aks" /></td>
        </tr>
        <tr>
            <td><b>Buy AK-47s from the black market</b></td>
            <td>Evading international law comes at a premium. Slight increase in technology.</td>
            <td>$100k</td>
            <td><input type="submit" name="aksblack" /></td>
        </tr>
        <tr>
            <td><b>Buy Surplus Pershing tanks from the US</b></td>
            <td>Uncle Sam will sell you some of their old tanks... If they like you. Increase in technology.</td>
            <td>$300k</td>
            <td><input type="submit" name="ustanks" /></td>
        </tr>
        <tr>
            <td><b>Attack the rebel scum!</b></td>
            <td>Launch an offensive against the rebels. Might suffer casualties.</td>
            <td>$75k</td>
            <td><input type="submit" name="attackrebels" /></td>
        </tr>
    </form>
   </table>
   
       </table><hr />
    <table cellpadding ="5" cellspacing ="5">
    <center><h4>Domestic Politics</h4></center>
         <tr>
            <td><b>Action</b></td>
            <td><b>Description</b></td>
            <td><b>Cost</b></td>
            <td><b></b></td>
        </tr>
        <tr>
            <td><b>Arrest opposition figures and would-be revolutionaries</b></td>
            <td>These imputent fools do nothing but criticize. Shut them up. Your government will become more authoritarian. Chance of decreasing rebels.</td>
            <td>$25k</td>
            <td><input type="submit" name="arrest" /></td>
        </tr>
        <tr>
            <td><b>Release political prisoners</b></td>
            <td>Free the poor souls. Your government becomes more democratic. Small chance of the ungrateful fucks joining up with rebels.</td>
            <td>$50k</td>
            <td><input type="submit" name="release" /></td>
        </tr>
        <tr>
            <td><b>Declare martial law</b></td>
            <td>Dissent cannot be tolerated in wartime! Move decisively authoritarian, increase military size.</td>
            <td>$100k</td>
            <td><input type="submit" name="martial" /></td>
        </tr>

    </form>
   </table>
   
    <?php
}

include("footer.php");

?>