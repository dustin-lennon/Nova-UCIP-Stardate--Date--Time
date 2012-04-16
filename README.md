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

4. Upload application/hooks/Stardate.php to your application/hooks folder of your Nova install.

5. In any theme you want to add this MOD to add `<?php echo $stardate;?>` to where ever you want this to be displayed.
Display alterations will need to be made in the file you uploaded in step 2.

**NOTE: FOR THOSE USING THIS MOD AND ARE USING A STARDATE NOT COVERED, YOU WILL NEED TO MODIFY application/hooks/Stardate.php
SO THAT THE STARDATE SHOWS THE WAY YOUR ORGANZIATION OR SIM DEALS WITH STARDATES.**

**NOTE: IF YOU ARE WANTING TO MATCH YOUR UNMODIFIED SMS STARDATE SETTINGS SET IN YOUR NOVA SITE OPTIONS THE CORRESPONDING YEAR THAT YOU
SET FOR THE ERA IN STEP #2.

EXAMPLE: IF YOU SET ENTERPRISE AS YOUR ERA, SET YOUR YEAR TO 2265 OR EARLIER.**