<?php 
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/classes/defineThis.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.class.php';
$CloseWindow = 0;
if ($_POST['accept'] == 1) {
	$DB = new DB();
	$Today = date('Y-m-d h:i:s');
	$query = "INSERT into rumble_entries (project_id, user_id, signup_date,".$_POST['r'].",active) values ('".$_POST['p']."','".$_SESSION['userid']."','$Today',1,1)";
	$DB->execute($query);
	$DB->close();
	$CloseWindow = 1;
}


?>
<style type="text/css">
body,html {
	margin:0px;
	padding:0px;
}
</style>
  <script>
function closeWindow() 
{
	var href = parent.window.location.href;
	href = href.split('#');
	href = href[0];
	parent.window.location = href;
}
<? if ($CloseWindow == 1) {?>
closeWindow() ;
<? }?>
</script>

<script type="text/javascript" src="http://www.wevolt.com/scripts/global_functions.js"></script>
 <LINK href="http://www.wevolt.com/css/pf_css_new.css" rel="stylesheet" type="text/css">
<div align="center" style="height:518px; width:414px; background-image:url(http://www.wevolt.com/images/accept_bg.jpg); background-repeat:no-repeat;">
<div class="spacer"></div>
<img src="http://www.wevolt.com/images/weekly_rules.png" />
<div class="spacer"></div>
<div style="color:#FFF; height:380px; width:350px;overflow:auto;" align="left">
As of October 14, 2010<br />
<br />

  <p>  BY ENTERING THE CONTEST YOU ("Competitor") AGREE TO BE BOUND BY THE RULES AND REGULATIONS CONTAINTED IN THIS AGREEMENT.<br />

    
    1. SPONSOR: WOWIO Inc., a Texas Corporation, with offices at 3545 Motor Ave. Los Angeles, CA 90034 ("WOWIO"), is solely responsible for all aspects of this contest ("Contest").<br />
<br />

    
    2. CONTEST SUMMARY:  The WEvolt Weekly Rumble Series is a multi-layered Contest in which web-comic creators compete to obtain the most Facebook and WEvolt Likes (herein referred to as "Votes") for their respective comics pages ("Pages") posted on WEvolt.com during the contest periods ("Contest Periods"). <br />
<br />
 
    
    3. CONTEST PERIODS: Each of the Contest Periods listed below begin at 12:01 a.m. PST each respective Monday, and end at 6 p.m. PST each respective Friday. <br />
   
    <ul>Round 1: 
    <li>Weekly Rumble 1: October 25 through October 29
    <li>Weekly Rumble 2: November 1 through November 5
    <li>Weekly Rumble 3: November 8 through November 12
    <li>Weekly Rumble 4: November 15 through November 19 
    </ul>
    
    <ul>Round 2:
    <li>Weekly Rumble 1: November 29 through December 3
   <li> Weekly Rumble 2: December 6 through December 10
    <li>Weekly Rumble 3: December 13 through December 17
   <li> Weekly Rumble 4: December 20 through December 24
    </ul>
    <ul>Round 3:
   <li> Weekly Rumble 1: January 3 through January 7
    <li>Weekly Rumble 2: January 10 through January 14
    <li>Weekly Rumble 3: January 17 through January 21
    <li>Weekly Rumble 4: January 24 through January 28
    </ul>
   <ul>Lord of the Rumble ("Final Round"):
    <li>Weekly Rumble 1: February 7 through February 11
    <li>Weekly Rumble 2: February 14 through February 18
    </ul><br />

    4. WEEKLY RUMBLES:  The Contest is divided into weekly competitions (each a "Weekly Rumble").  For each Weekly Rumble, the competitor with the highest number of Votes received during the Contest Period for that Weekly Rumble shall be chosen as that week's winner ("Rumble Winner").
    <br /><br />


    (A) 	Timeliness of Posting Pages.  In order for a Page to count for a particular Weekly Rumble, it must be posted during the Contest Period for that particular Weekly Rumble. (See Section 3, Contest Periods).
    <br /><br />


    (B)	Timeliness of Receiving Votes.  In order for Votes to be counted for a particular Weekly Rumble, such Votes must have been posted during the Contest Period for that particular Weekly Rumble. (See Section 3, Contest Periods).
    <br /><br />


    (C) 	Number of Pages Submitted; Number of Pages Counted. Competitors are allowed to post an unlimited number of Pages during each Weekly Rumble. Of the Pages posted by a competitor during a particular Weekly Rumble, only the Votes received for that competitor's Top Five Pages will be counted for that particular Weekly Rumble. ("Top Five Pages" shall refer to those five Pages posted by a particular competitor during a particular Weekly Rumble, which receive more Votes than any other Pages posted by that Competitor during that particular Weekly Rumble). 
    <br /><br />


    (D)	Rumble Winners not precluded from Winning Subsequent Weekly Rumbles. A Rumble Winner is not precluded from winning subsequent Weekly Rumbles, subject to the limitations set forth in Section 5(C). 	
    <br />
<br />

    5. ROUNDS:  Four consecutive Weekly Rumbles constitute a round ("Round"). There will be three separate Rounds, held at dates and times set forth in Section 3, Contest Periods. 
    <br /><br />


    (A) 	Round Winners. Of the Rumble Winners for a particular Round, the Rumble Winner with the most overall Votes received for that Round shall be chosen as the Round Winner ("Round Winner") for that particular Round. 
    <br /><br />


    (B)	All Votes on All Pages Posted During Contest Periods of a Particular Round Counted for Round Winner Determination. In determining which Rumble Winner will be named the Round Winner of a particular Round, all Votes received for all Pages posted by a Rumble Winner during the Contest Periods of that particular Round will be counted. Votes counted for the determination of Round Winners are not limited to the Votes received on the competitor's Top Five Pages, as is the limitation in each Weekly Rumble. 
    <br /><br />


    (C) 	Round Winners Precluded from Winning Subsequent Weekly Rumbles and Subsequent Rounds. A Round Winner may not win any subsequent Weekly Rumbles or any subsequent Rounds. 
    <br /><br />


    (D)	Round Winners Earn Place in Lord of the Rumble. Each of the three Round Winners shall receive a place in the final round, entitled "Lord of the Rumble" ("Final Round").
    
    <br />
<br />

    6. LORD OF THE RUMBLE; FINAL ROUND. The three Round Winners will compete in a fourth and final "Lord of the Rumble" ("Final Round"), to determine the winner of the Grand Prize ("Grand Prize Winner").  
    <br /><br />


    (A) 	All Votes on All Pages Posted During Contest Periods of Final Round Counted for Determination of Grand Prize Winner. The grand prize ("Grand Prize") will be given to the Round Winner with the most Votes received for all Pages posted by it during the Contest Periods of the Final Round. 
    <br />
<br />

    7. DETERMINATION OF WINNERS IN THE EVENT OF A TIE: In the event that two or more competitors receive the same amount of Votes for a particular Contest Period, the criteria for a tie-breaker shall be such that the competitor with the most "unique page views" over all of its pages posted during the applicable Contest Period shall be deemed the Winner for that particular Weekly Rumble, Round, or Final Round. In the unlikely event that there are the same number of Page views between two or more competitors, the competitor with the most WEvolt fans shall be named the Winner. 
    <br />
<br />

    8. PRIZES. Sponsor shall notify each of the winners described below via email, or through a message on the WEvolt website ("Notification"). Prizes will be distributed through Paypal. The Winner of any Prize shall respond to WEvolt Notification with Winner's specific Paypal information within 48 hours of Notification, and WEvolt shall issue the payments within 24 hours thereafter via Paypal. 
    <br /><br />


    (A) 	Weekly Winners. For each Weekly Rumble, a prize of one hundred dollars ($100.00) is given to the Weekly Winner.  In addition, each Weekly Winner shall have the opportunity to become the Round Winner of the Round in which they won their Weekly Rumble(s). 
    <br /><br />


    (B) 	Round Winners. For each Round, a prize of one hundred dollars ($100.00) is given to the Round Winner. Each Round Winner shall have the opportunity to win the Final Round. 
    <br /><br />


    (C)  	Grand Prize Winner; Runners-up. The Grand Prize Winner shall receive a prize of five hundred dollars ($500). Second Place shall receive a prize of two hundred dollars ($200.00). Third Place shall receive a prize of one hundred dollars ($100.00). 
    <br />
<br />

    9. CONTEST ENTRY; NO PURCHASE NECESSARY:  No purchase is necessary. Void where prohibited. All Federal, State and local laws, rules and regulations apply. In order for a competitor to participate in a particular Weekly Rumble, it must, prior to the initiation of the Contest Period for that particular Weekly Rumble, have entered the Contest as a registered member ("Member") of WEvolt.com (the "Website"), by visiting the Website and logging in by providing its Member Name and Password, and by clicking to acknowledge acceptance of this Agreement at www.wevolt.com/rumble.php.  Once a competitor has submitted its acceptance of the terms and conditions of this Agreement it will be allowed to participate in all subsequent Weekly Rumbles, subject to the terms, conditions and limitations contained herein. For purposes of these Official Rules ("Rules"), all times and days are Pacific Time. If you are not a Member, you may easily register for free to become a Member through the link on the site: www.wevolt.com, by filling out the simple Registration Form. Upon registration, or if you are already a Member, you may enter this Contest by creating a comic strip Pages. Normal Internet access and usage charges imposed by your online service will apply.
    <br /><br />


    10. SUBMISSION PROCEDURES: Members shall submit their comic strip entries through the instructions and links available at www.wevolt.com/rumble.php.  
    <br />
<br />

    11. DISQUALIFICATION: Disqualification and the selection of alternate winners may result from any of the following: 
    <br /><br />


    (A) in the event Sponsor identifies a Winner who has been banned the Web Site;
    <br /><br />


    (B) the return of any notice as undeliverable; 
    <br /><br />


    (C) potential winner's failure to respond to Sponsor's notification within 48 hours of receipt; or 
    <br /><br />


    (D) any other non-compliance with the Rules. 
    <br />
<br />

    12. LIMITATIONS. 
    <br /><br />


    (A)	NO PURCHASE NECESSARY. Competitor must have signed up for a WEvolt account and must have agreed to the terms and conditions upon creation of their account. Competitor need not be a WEvolt Pro account holder to win. Holding a WEvolt Pro account does not increase chances of winning. 
    <br /><br />


    (B)	One Comic Title per entrant. 
    <br /><br />


    (C)	A Weekly Winner may win subsequent Weekly Contests. 
    <br /><br />


    (D) 	A Round Winner may not win subsequent Weekly Rumbles, nor may a Round Winner win subsequent Rounds, except that each Round Winner competes to win the Final Round. 
    <br /><br />


    (E) 	In event of a dispute regarding the identity of the person entered into the Contest, the Entry will be deemed to be the person whose name the membership is registered. 
    <br /><br />


    (F) 	Any use of automated or programmed methods of effecting Entry is prohibited.
    <br /><br />


    (G)	Any use of automated or programmed methods of effecting Votes is prohibited. 
    <br /><br />


    (H) 	Contest open to the general public, so long as the following criteria are met: Contest is only open to persons 18 or older upon entering who are legal residents of, and physically located within, the 50 states, Washington D.C. or Canada (excluding Quebec) ("Territory") and not employees of Sponsor, its parent, subsidiary or affiliated companies; the advertising, promotional or fulfillment agencies of any of them (individually and collectively, "Entities"); nor members of their households or immediate families. 
    <br /><br />


    (I)	Neither the Entities, nor any of their officers, directors, shareholders, employees, agents or representatives (individually and collectively, "Releasees") are responsible for Entries from persons residing, or physically located, outside the Territory, or Entries that are altered, delayed, deleted, destroyed, failed, fraudulent, improperly accessed, inaccurate, incomplete, interrupted, late, lost, misrouted, multiple, non-delivered, stolen, tampered with, unauthorized or unintelligible; or any printing, production, technical, electronic or other errors; or for lost, interrupted or unavailable network, server or other connections; miscommunications; failed phone, computer hardware or software or telephone transmissions; technical failures; unauthorized human intervention; traffic congestion; garbled or jumbled transmissions; undeliverable e-mails resulting from any form of active or passive e-mail filtering; insufficient space in entrant's e-mail account to receive e-mail; or other errors of any kind, whether due to electronic, mechanical or human error or other causes; even if caused by the negligence of any of the Releasees. Each of such potential Entries will be disqualified. Void where prohibited or restricted by law and subject to all applicable federal, state, provincial, local and municipal laws and regulations.
    <br /><br />


    (J)	Persons entering the Contest must be in good standing with the Website and have not been banned from WEvolt.com.
    <br /><br />


    (K) 	Uploaded Pages must remain on WEvolt for at least six months from the date of upload.
    <br /><br />


    (L) 	Odds of winning depend on the total number of eligible Entries received.
    <br /><br />


    (M) 	All winners shall be chosen at Sponsor's sole discretion. 
    <br /><br />


    (N)	All Pages posted for consideration in the Contest must be new to WEvolt. Content that has been posted to WEvolt prior to the beginning of the will not be considered with respect to the Contest. 
    <br />
<br />

    
    13. CONDITIONS:  Each entrant by entering the Contest agrees that: 
    <br /><br />


    (1) he/she will abide by and be bound by the Rules and the Sponsor's decisions; 
    <br /><br />


    (2) the Releasees are not responsible for claims, injuries, losses or damages of any kind resulting, in whole or in part, directly or indirectly, from the awarding, delivery, acceptance, use, misuse, possession, loss or misdirection of the prize; participation in the Contest or in any activity or travel related thereto or from any interaction with, or downloading of, computer Contest information; 
    <br /><br />


    (3) winner's acceptance of the prize(s) constitutes the grant to Sponsor and assigns of an unconditional right to use winner's name and prize information and/or statements about the promotion for any publicity, advertising and promotional purposes without additional compensation, except where prohibited by law; 
    <br /><br />


    (4) in the event of viruses, bugs, unauthorized human intervention, Acts of God, acts or regulations of any governmental or supra-national authority, war, national emergency, accident, fire, riot, strikes, lock-outs, industrial disputes, acts of terrorism or other matters beyond the Sponsor's reasonable control, corrupt, prevent or impair the administration, security, fairness or proper play of the Contest, so that it cannot be conducted as originally planned, the Sponsor has the right to cancel, modify, terminate or suspend the Contest; 
    <br /><br />


    (5) the Releasees are not responsible for typographical or other errors in the offer or administration of this Contest, including but not limited to: errors in the advertising, Rules and selection and announcement of the winner; 
    <br /><br />


    (6) any portion of the Prize not accepted or used by the winner will be forfeited and 
    <br /><br />


    (7) the Releasees are not responsible for any inability of the winner to accept or use the Prize (or any portion thereof) for any reason; 
    <br /><br />


    (8) Competitor shall only enter Pages that it owns the copyright, title and license to, and the comic strip entered into the contest shall include only materials that the Member alone creates for the Contest and not include services, contributions, graphics, video, music, photos, text, copyrighted materials or trademarks belonging to any third parties or incorporating the names, likenesses, voice or personas of any real person or entity other than the Member; 
    <br /><br />


    (9) the Comic Strip submitted must not include any matter or material that (a) is sexually explicit, unnecessarily violent or derogatory of any ethnic, racial, gender, religious, professional or age group; (b) is obscene or offensive, or may create public disrepute, contempt, scandal or ridicule; (c) defames or invades publicity rights or privacy of any person, living or deceased, or otherwise infringe upon any third party's or Sponsor's personal or intellectual property rights or contain disparaging remarks about other people or companies; (d) are inconsistent with the positive images and/or goodwill to which the Sponsor wishes to associate (which may be determined by the Sponsor, at its sole and absolute discretion); and/or (e) otherwise violates these Official Rules; 
    <br /><br />


    (10) the Comic Strip submitted shall not make or imply any claim regarding Sponsor's products or services; and 
    <br /><br />


    (11) any depiction of Sponsor's product or service shall not suggest an inappropriate, unlawful or dangerous use of the product or service; 
    <br /><br />


    (12) all right, title and interest in and to the intellectual property contained in the Pages submitted by a competitor remains the property of that competitor; 
    <br /><br />


    (13) All State, Local, Federal and/or other taxes, duties, tariffs, title fees, licensing fees, or other fees for prizes awarded become the sole responsibility of the winner(s). 
    <br /><br />


    (14) All entrants and winners agree that the WOWIO, Inc., their affiliates, members, directors, officers, employees, agents and representatives shall have no liability for any injury, misfortune, or damage to either persons or property incurred by entering, participating in, winning, or losing any contest and/or by the use or non-use of any prize received in connection with this contest. 
    <br /><br />


    (15) Proper identification must be presented by any winner to claim prize.  As a condition to receiving the prize, any potential winner must complete and sign a Winner's Affidavit and Release, releasing the Sponsor, their affiliates, members, directors, officers, and employees from all liability in connection with winner's participation in the contest, acceptance, and use or non-use of the prize. 
    <br />

    (16) Sponsor is not responsible for any incorrect or inaccurate information submitted by contest participants or entered by websites users, and assumes no responsibility for any error, omission, interruption, deletion, defect, delay in operation or transmission, communications line failure, theft or destruction or unauthorized access to the Website(s). 
    <br />

    (17) By participating in the Contest, participants agree to be bound by the decisions of Sponsor personnel. Persons who violate any rule, gain unfair advantage in participating in the Contest, or obtain winner status using fraudulent means will be disqualified. Unsportsmanlike, disruptive, annoying, harassing or threatening behavior is prohibited. The Sponsor will interpret these rules and resolve any disputes, conflicting claims or ambiguities concerning the rules or the contest and the Sponsor's decisions concerning such disputes shall be final. If the conduct or outcome of a contest is affected by human error, any mechanical malfunctions or failures of any kind, intentional interference or any event beyond the control of the Station, the Station reserves the right to terminate the contest, or make such other decisions regarding the administration or outcome as the Station deems appropriate. All decisions will be made by the Station are final. The Station may waive any of these rules in its sole discretion. <br />
<br />
ANY ATTEMPT BY A CONTESTANT OR ANY OTHER INDIVIDUAL TO DELIBERATELY CIRCUMVENT, DISRUPT OR DAMAGE ORDINARY AND NORMAL OPERATION OF A STATION CONTEST, TELEPHONE SYSTEMS OR WEBSITES, OR UNDERMINE THE LEGITIMATE OPERATION OF A STATION CONTEST IS A VIOLATION OF CRIMINAL AND CIVIL LAWS AND SHOULD SUCH AN ATTEMPT BE MADE, SPONSOR RESERVES THE RIGHT TO SEEK DAMAGES FROM ANY SUCH PARTICIPANT TO THE FULLEST EXTENT PERMITTED BY LAW.
    
  
  </p>
</div>
<div class="spacer"></div>
 <img src="http://www.wevolt.com/images/clicking_info.png" />
<form method="post" action="#">
<input type="hidden" name="accept" value="1" />
<input type="hidden" name="p" value="<? echo $_GET['p'];?>" />
<input type="hidden" name="r" value="<? echo $_GET['r'];?>" />
<input type="image" src="http://www.wevolt.com/images/accept_button.jpg" />
</form>
</div>
</div>
