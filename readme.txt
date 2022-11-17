Installation Instructions
================================================================================
This installation instructions assume that you are running either fresh or customized installation of OpenCart. 

1. Using the Extension Installer
---------------------------------------------------
 1) Login to your OpenCart admin panel. Once you do that, go to Extensions -> Extension Installer.
 2) Click on the Upload button.
 3) Find Reward-Shipping-oc-your-version.ocmod.zip on your computer and load it.
 4) OpenCart will begin the installation of the module along with the OCMod and when the operation is done you will receive the following message - Success: You have installed your extension!
 5) Go to Extensions > Modifications and click the refresh button to rebuild your modification cache.
 6) Go to Extensions > Shipping and find Reward Points Shipping and click the [Install] button.
 7) Go to Extensions > Shipping and find Reward Points Shipping and click the [Edit] button.
 8) The Reward Shipping control panel is displayed. Now, this is the place where you edit/customize your Reward Shipping extension.
 9) Set settings and click the [Save] button.
10) Now Reward Shipping is installed. Congratulations!
--------------------------------------------------------------------------------


--------------------------------------------------------------------------------
If during the install you get an error saying "Could not connect as ......" 
while uploading this zipped extension via the Extension Installer, 
you probably have the FTP support disabled from your hosting. 
In that case you may try the following OpenCart Extension Installer fix first:
<http://www.opencart.com/index.php?route=extension/extension/info&extension_id=18892>
--------------------------------------------------------------------------------


--------------------------------------------------------------------------------
If for some reason the Extension installer does not
 work for you, you can try the old fashioned way.
                    Read below:
--------------------------------------------------------------------------------
 1) Unzip the downloaded ZIP file into a new folder
 BEFORE YOU COPY THE FILES: 
 --->>> If your OpenCart is not a fresh installation, files backup is highly recommended. 
 2) Copy all files from /upload folder over your current OpenCart installation preserving the directory structure.
 3) Rename the file install.xml in the downloaded ZIP file to install.ocmod.xml.
 4) Login to your OpenCart admin panel. Once you do that, go to Extensions -> Extension Installer.
 5) Upload the file install.ocmod.xml and wait for the success message. 
 6) Go to Extensions > Modifications and click the refresh button to rebuild your modification cache.
 7) Go to Extensions > Shipping and find Reward Points Shipping and click the [Install] button.
 8) Go to Extensions > Shipping and find Reward Points Shipping and click the [Edit] button.
 9) The Reward Shipping control panel is displayed. Now, this is the place where you edit/customize your Reward Shipping extension.
10) Set settings and click the [Save] button.
11) Login to your database system and run the folowing script
    ALTER TABLE `your_prefix_customer_reward` ADD COLUMN `note` VARCHAR(20) NOT NULL DEFAULT '' AFTER `date_added`;
12) Now Reward Shipping is installed and ready to use. Congratulations!
--------------------------------------------------------------------------------


Support & Feature Requests
======================================================
This tool has been successfully tested for a standard OpenCart 2.3.0.2 versions.
Don't use other Opencart versions with this module.
