Adding Stardate, Local Date and Time to your Nova Theme
=======================================================
Developer: Dustin Lennon<br />
Email: <demonicpagan@gmail.com>

This application is developed under the licenses of Nova and CodeIgniter.

Install Instructions
--------------------
The following MOD will alter your Nova installation to place stardate, local time, and local date to your theme.
To install this application you need to perform the following steps.

1. Upload application/config/hooks.php to your application/config folder of your Nova install replacing 
the existing one if you haven't already modified this file. If you already have changes in this file, it's best 
that you just take the contents of this file and add it into your existing hooks.php file.

2. Open and edit application/config/stardate.php to chose the proper Stardate Era.

3. Upload application/config/stardate.php to your application/config folder of your Nova install.

4. Upload application/hooks/UCIP-Stardate-Hook.php to your application/hooks folder of your Nova install.

5. In any theme you want to add this MOD to add `<?php echo $stardate;?>` to where ever you want this to be displayed.
Display alterations will need to be made in the file you uploaded in step 2.

**NOTE: FOR THOSE USING THIS MOD AND ARE NOT A PART OF THE UCIP SIMMING ORGANIZATION, YOU WILL NEED TO MODIFY UCIP-Stardate-Hook.php
SO THAT THE STARDATE SHOWS THE WAY YOUR ORGANZIATION OR SIM DEALS WITH STARDATES.**

**NOTE: IF YOU ARE WANTING TO MATCH YOUR UNMODIFIED SMS STARDATE SETTINGS SET IN YOUR NOVA SITE OPTIONS THE CORRESPONDING YEAR THAT YOU
SET FOR THE ERA IN STEP #2.

EXAMPLE: IF YOU SET ENTERPRISE AS YOUR ERA, SET YOUR YEAR TO 2265 OR EARLIER.**



At a later date and time, I MAY make this an option in the site settings to turn on/off.

Changelog - Dates are in Epoch time
-----------------------------------
1305215087:

*	Changed the UCIP choice to Other to be more universal.

1305018789:

*	Updated the MOD to use stardates that were present in SMS2. Read above on how to configure.

1304919901:

*	Updated the hooks.php file to include recent hooks added by Anodyne-Productions that I missed.

1290255553:

*	Reworked server timezone issue again. This time using PHP 5.2+ DateTime class. By doing this, you now have to be running version 5.2 or greater of PHP. If you aren't, you will be unable to use this MOD.

1290030403:

*	Reworked server timezone issue. Added a switch statement to set the PHP value to whatever timezone was set in Nova.

1289356151:

*	Updated hook to use the Nova system site stored settings to retrieve the proper timezone and DST setting and display it.
Bug found by CajunSamurai of the Anodyne Productions forums.


1272515242:

*	Created a more readable README for GitHub.

1271958859:

*	As per a suggestion by Anodyne Productions on GitHub, I have made the theme alteration a hook using
CodeIgniter's hook system.

1271798383:

*	Wrote this README to tell you how to put a stardate, local server time and date in your theme.