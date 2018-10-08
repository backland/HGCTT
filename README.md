# HGCTT
Heidelberg Golf Club Table Tappers

Web site for the Heidelberg Golf Club Table Tappers social group of players.  
The initial goal of the site is to randomly create the playing groups for each week ensuring that the booking duties are equally distributed to members. The site will also generate a email to each member in the group with the groups for the following week.

The site consists of the following components
 - ViewBookings.php : The default home page to allow members to check the groups for a specific date
 - PlayerDates.php : Allow players to indicate if they are not playing on specific dates.
 - Players.php : View List the list of group members with links to Playing Dates or Player Edit facilities.
 - EditPlayer.php : Edit group member details.
 - Booking.php : Generate Playing Groups and Emails
 - Database.php : Common Include to connect to MySQL database
 - Header.php : Common Include for HTML Page Heading
 - Navigation.php : Common Include for Menu Components
 - Footer.php : Common Include for HTML Page Footer
 - MemberLookup.php : AJAX Call from PlayerDates.php to Lookup player by Membership Number 
 - Unavailable.php : Toggle playing date on/off.  AJAX Call from PlayerDates.php
 - DeleteLock.php : Hidden Page to allow deleting of booking lock for re-generation of groups
 - GolfBooking.sql : Backup of Database Tables

Image Files are as Follows
 - android-touch-icon.png
 - apple-touch-icon-1.png
 - apple-touch-icon-2.png
 - calendar.png          ( For Email )
 - window-icon.png
 

Notes to self Linux commands for GitHub
 - To get code from GitHub
  	- git clone https://github.com/backland/HGCTT.git
  	- git checkout

 - To commit changes and push into GitHub
	- git commit -a 
        - git push https://github.com/backland/HGCTT.git master

