Replacing the Drupal "sites" folder for the Y Service Club website

# ASSEMBLY INSTRUCTIONS

*Setting up a local copy of the yservice.ca website*

> 1.	[Overview](#1-overview)
> 2.	[Drupal installation](#2-drupal-installation)
> 3.	[Clone from github](#3-clone-the-repository)
> 4.	[Restore database](#4-restore-the-database)
> 5.	[Troubleshooting](#5-if-you-get-errors)


***
###### 1. OVERVIEW
---
+ Install Drupal first. 
+ Replace the sites folder with this repository ...  
+ but keep your settings.php file !  
+ Import database from *sites/default/private* using the *Backup_and_Migrate* module.  



#### Localhost installation

Visit drupal.org for suggestions on [Installing Drupal on Windows PCs](https://www.drupal.org/documentation/install/windows) or for [Installing with Microsoft Web Platform Installer](https://www.drupal.org/node/1130898)  

Or try one of these solutions:   
Linux, Windows or Mac: [XAMPP](https://www.apachefriends.org/index.html "multiplatform"), 
Windows: [WAMP](http://www.wampserver.com/en/ "Windows"), 
Mac: [MAMP](http://www.mamp.info/en/ "Macintosh")  

#### Git installation

[git](http://git-scm.com/) has many resources. [This tutorial](https://www.atlassian.com/git/) compares **git** to **subversion**.  
And you can also use a [GUI](http://git-scm.com/downloads/guis).

#### Drush installation

I like [drush](https://github.com/drush-ops/drush) but you don't have to use drush.  
[Windows Install guide](https://www.drupal.org/node/594744), and [configuration guide](https://www.drupal.org/node/1843176)  

---
###### 2. DRUPAL INSTALLATION
---
2.1 Make a database  
2.2 Table prefix = 'drup_'  
2.3 Get the Drupal core  
2.4 Install Drupal  

#### 2.1 Make a database

You will need the database **name**, **username** and **password** for the Drupal installation process.  

>2.2 Note that Godaddy uses *drup_* as a prefix for tables in databases used for Drupal.  
>Since we're going to a Godaddy server, let’s use the same Table prefix for our installations to make it that much easier. 

#### 2.3 Get the Drupal core
```
git clone --branch 7.x http://git.drupal.org/project/drupal.git
git checkout 7.35
```
You don't have to clone, you can also [download](https://www.drupal.org/project/drupal) the zip file for example.  
And you don't have to use command line, there are [GUIs](http://git-scm.com/downloads/guis) that you can use.

#### 2.4 Install Drupal 
Navigate in your browser to the Drupal folder you downloaded and follow instructions.  
Or use any other method to get Drupal up and running in your browser

>Note that you can use any name and password you like for the Drupal user.  

The database information will be written to the **settings.php** file and must correspond with the database being used for this installation.   

>The table prefix can make things more complicated so I recommend using 'drup_' same as Godaddy’s database. 

---
###### 3. CLONE THE REPOSITORY
---
3.1 rename sites folder  
3.2 clone sites repository  
3.3 copy settings.php  

#### 3.1 Rename the **sites** folder
A git clone won’t replace an existing directory and you need to keep a copy of the **settings.php**  

Rename the **sites** folder ex: **sites-backup**  

Here's how using command line:  
```
mv sites sites-backup
```
#### 3.2 Clone the sites repository 
taking care to be in the directory where the sites folder should be.
```
git clone https://github.com/yserviceclub/sites.git
```
#### 3.3 Copy the **settings.php** file. 
You only need to do this once for the initial setup.  
The git repository will ignore the settings.php file as configured in the .gitignore file.
You can use a command line to copy the file
```
cp ~/sites-backup/setting.php ~/sites/setting.php
```
You should have something that looks like this
```
Localhost/
└────── Drupal/
		├─── sites-backup
		│   	└── default/
		│   			└── settings.php  --->  copy
		└─── sites/							    file 
				└── default/				     to
						└── settings.php  <---  here

```

The **sites-backup** folder won't have any effect on the repository or anything at all. You can delete it if you want.


---
###### 4. RESTORE THE DATABASE
---
4.1 configure file system  
4.2 enable Backup module  
4.3 restore database  

#### 4.1 Configure the file system
You need to set the private files path for the Backup and Migrate module to work.
Login to Drupal and find:
```
administration » configuration » media » file system
```
Set the private file system path to:
```
sites/default/private
```

#### 4.2 enable the Backup and Migrate module
You can find it near the bottom of the list. Don't forget to save.
```
administration » modules 
```
Or you can use Drush
```
drush en -y backup_migrate
```

#### 4.3 restore database
You can now restore the latest saved backup files
```
administration » configuration » system » backup and migrate
```


---
###### 5. IF YOU GET ERRORS
---
#### Most problems will likely be due to the settings.php not corresponding to the database.  
>For example, you can't install Drupal without a database nor settings.php file.  

If the settings.php file is good then look at the tables in phpMyAdmin to see if the table prefixes are correct.  

If everything seems right but not the latest version then try to update the git repository to the correct branch.  

see if git is working
```
git status
```
list available branches 
```
git branch -a
```
list available tags (revisions)
```
git tag
```
choose a branch
```
git checkout <branch_name>
```
choose a version
```
git checkout <tag_name>
```
