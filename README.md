# CMSWithImageHandling
A PHP based Content Management System with Image Handling
Thanks to Rico Chan's Basic Idea

### Prerequisites
```
Codeigniter2 & PHP & MySQL & XAMPP  
```
CodeIgniter will be updated to 3.0 later

XAMPP is the php server and MySql
XAMPP: https://www.apachefriends.org/zh_cn/index.html
CodeIgniter: https://codeigniter.com/

### 1.	Database Preparation
Tables, please ensure the following table existing and the content is correct
*a)	sys_uid_gen (contains the table’s name and its largest “id number” )
*b)	sys_param (defines the upload image folder)
*c)	sys_image (contains all the information of the uploaded image, please modify it)
*d)	sys_image_type
*e)	usr_user (modify the column if needed)
*f)	usr_userrole
*g)	usr_role


### 2.	Configuration

*a)	Configure the XAMPP and Windows Hosts accordingly.
*b)	Configure CMS
```
*i.	.\application\config 
Please configure the base_url accordingly
*ii.	.\application\database
Please change the database name accordingly
```

### 3.	MVC (the Codeigniter structure)
*a)	Administrator Account:
This account was in the UserModule.php
*b)	Controller
```
*i.	option.php
This is the example controller for an option, we could modify the model to add new options
*ii.	user.php
This is the controller to display the users’ information. 
*iii.	system.php
This is the controller for the view->account.php, we need to modify this page if we want to add some function to the normal user page, such as upload some pictures, change some content.
```
*c)	Model
```
*i.	user_model.php
Contains the data and operation of the user. Please modify accordingly.
*ii.	option_model.php
This is the example model for an option, we could modify the model to add new options
The new model function need to be the same with the example in order to use the library
```
*d)	View
```
Only a few view need change
*i.	admin_header.php
Edit this page to increase the options on the top of the CMS website，remember to modify the active model of each option.
*ii.	register.php
Edit this page to modify the input if needed. Used an api, which could let the website generate the password for the user and email it to the user.  
*iii.	account.php
Please change this account page in order to change the detail information that the normal user could update. 
The corresponding Controller (system.php) and model (the model could be added if we needed) should be correct.
*iv.	login.php
Modify the page to display the instruction of the login display.
*v.	Other page added manually.
Please ensure the corresponding Controller, Model and Session are used correctly.
```

### Acknowledgments

* Rico Chan
