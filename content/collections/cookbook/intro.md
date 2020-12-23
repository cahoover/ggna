---
title: 'Maintain multiple sites on a server'
intro: 'If you''re an agency or a consultant, you might want to manage landing pages for multiple clients. Here''s how you set this up on a Linux, Nginx, MySQL, PHP (LEMP) stack using Ubuntu 18.4.'
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1608689362
id: 21997066-fb9c-47f9-a5ba-d694cf8d9da1
---
## A high level view of how this works
(Ignoring DNS for now, and using the friendlier term "folder" in lieu of directory.)

When someone types a URL into browser, the browser makes a connection to the web server that hosts the URL. 

In the server is a folder called /sites-enabled. This folder has a bunch of text files. Each one of those files is a configuration information for a web site, including the folder on the server that contains the site. 

* The server gets an incoming request for a web site
* The server looks at the configuration file to see which folder contains the site
* The server sends back the contents of the folder

It's a tiny bit more complicated than that, but that's the gist.  Here's how to set this up.

## Create the web folder to contain the site

If you remember the sequence of events described a dozen or so words ago, you'll know that this is the folder that will contain our site. It's standard practice to maintain web sites in the /var/www/ folder. So first go there.

>You don't have to put your sites in /var/www, it's just a convention. It's the "usual" place you'd put sites because it's the default and people don't change the default settings very often.

```bash
cd /var/www
```

Now we'll create the folder that will contain the site. It doesn't technically matter what you name it, but to keep track of things it's a good idea to reference the site.  For the sake of example let's say our site will be www.disco-fever.com, so we'll name the folder disco.

```bash
mkdir disco
```
Now let's put some placeholder HTML into the folder so that we can test everything later on. First go into the folder

```bash
cd disco
```
And open the nano text editor

```bash
nano index.html
```

Paste the following little snippet in there: 

```html
<html>
    <head>
        <title>Welcome to Disco-Fever!</title>
    </head>
    <body>
        <h1>Success!  The disco-fever.com server block is working!</h1>
    </body>
</html>
```

and then press ```cntl-x``` to save the file and exit the editor 

>From now on I won't use "disco" in my examples. I'll use the placeholder \[servername\] instead, and you replace that with whatever you like. It turns out people were confused and thought you *had* to use "disco."

## Create a database 

(If necessary. Do this if you are using WordPress). 

First enter into the mysql prompt. You'll need to have the right permissions to do this. Here we assume you mange this server and know the database root password

```bash
mysql -u root -p
```

You'll get a prompt for a password:

```bash
Enter password:
```

Once you're in MySql, we'll create a database. In the command below - replace \[servername\] with the name of the database. Once again, it doesn't technically matter what you call it, but it makes things easier to keep consistent naming.

```bash
CREATE DATABASE [servername] DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
```

Then create the user. Late on we'll configure WordPress to use this username when connecting to the database. Yet again, it doesn't matter what username you pick, but it helps to be consistent. One option is to use the servername and add "\_user" or similar. You'll also want to create a strong password for this user. Note the password, we'll need it later!

Don't forget to add the single quotes around the username, localhost, and the password. 

```bash
GRANT ALL ON [servername].* TO ‘[servername_user]'@'localhost' IDENTIFIED BY ’[password]';
```

Running the "flush privileges" command reloads the permissions table without having to restart the server. You need to use it to activate the new user you just created.

```bash
FLUSH PRIVILEGES;
```
Exit out of MySQL, you're done with the database.

```bash
EXIT;
```

## Update sites-available

Nginx looks in a folder called _/etc/nginx/sites-enabled_ for site configuration files. To provide additional control, we create the configuration file in a folder called _/etc/nginx/sites-available_ and then create a symbolic link in _sites-enabled_ that points to it.

>A symbolic link (or symlink) is a pointer to another file. It's like a mirror. In this way you can prepare many sites in _sites-available_ and create symbolic links to only a few of them in _sites-enabled_.    

Move into the folder

>Some people might point out that you don't have to move into the folder every time. But it's a habit, and it orients me in the OS. Also, it keeps you from having to type the entire path every time, which is a hassle. 

```bash
cd /etc/nginx/sites-available
```

In this folder should be a file called default. You can copy this and use it as a template, but there's lots of comments and it gets a bit cluttered. Instead I suggest you create an empty file, and if you want to use the default for reference you can find it (here)[https://gist.github.com/cahoover/8be8b18faef9cf5436df833684b45a1e]. 

We'll use the 'sudo' command, which lets you act as a superuser. Yet again, I suggest you stay consistent with your naming. Name this file the same as you named the folder in /var/www. 

```bash
sudo nano [servername]
```

Enter the following in the editor. You don't have to keep the comments, but you might want to for later reference. 

```
server {

        ######
        # This line tells nginx the name of the URL that references this site
        # Note I'm entering URL versions both with and without a "www"
        # If you are created a subdomain for a client, just enter it alone
        # For example:
        # server_name info.[client-site].com
                
        server_name disco-fever.com www.disco-fever.com;
        
        # Obviously, swap "disco-fever" with the real name of your site.

	    #####
        # This line tells nginx which folder contains the site (the root folder)
        # For example, if you created a folder called /var/www/disco,
        # this file would say root /var/www/disco;
        
        root /var/www/[servername];
        
        ######
        # This line tells nginx which file to initiate by default. Installing Wordpress will 
        # remove the index and index.html files, leaving only index.php.   
        
        index index.html index.php;
         
        ######
        # This line tells nginx which port to listen for requests for this site.
        # 80 is the default (unsecured) HTTP port, so we'll us it. 
        # Note that this will be changed later when we add security, but 
        # don't sweat it for now.
        
        listen 80 default_server;
        listen [::]:80 default_server;

        ######
        # The location setting lets you configure how NGINX will respond to requests
        # for resources within the server. Just like the server_name directive tells NGINX
        # how to process requests for the domain, location directives cover requests for
        # specific files and folders, such as http://example.com/blog/.

        location / {
                try_files $uri $uri/ /index.php$is_args$args;
        }
        
        ######
        # We'll add some more location files, one for the favicon, one for the robots.txt, 
        # and none for images, js, and css. The log_not_found and access_log directives
        # mean that the logs won't be overwhelmed by 404 errors if the favicon isn't there.
        
        location = /favicon.ico { log_not_found off; access_log off; }
        location = /robots.txt { log_not_found off; access_log off; allow all; }
        location ~* \.(css|gif|ico|jpeg|jpg|js|png)$ {
             expires max;
             log_not_found off;
            }
        
        #####
        # Finally we'll tell nginx where the PHP files are, which is necessary to 
        # Process WordPress (a PHP framework). This file assumes you are using php7.3
        # which might not be the case. By default, php listens on run/php/[version]-fpm.sock
        # by default. For example, php7.4 listens on run/php/php7.4-fpm.sock, and 
        # php 8 listens on run/php/php8.0-fpm.sock
        # 
        # Note: You might see references to /var/run. The directory /run is usually 
        # preferred, with /var/run generally symlinked to /run 
        
        location ~ \.php$ {
        # Choose either a socket or TCP/IP address
        fastcgi_pass unix:/run/php/php7.3-fpm.sock;
        # fastcgi_pass 127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
    }
    ## End - PHP      
}
```

Now we save the file by pressing ```cntl-x``` and selecting "yes". You'll be back at the command prompt.

## Create the symlink

Next, create the symlink between sites-enabled and sites-available. This "enables" the site.

```bash
sudo ln -s /etc/nginx/sites-available/[file-name] /etc/nginx/sites-enabled/
```

## Restart the server

This will load your new configuration into nginx. 

First, test that your configuration files don't have any typos.

```base
sudo nginx -t
```

If you get an error, go back and open your configuration file in nano again and fix the issues. Then try again. You won't have to do the sym-link process again.

Once you get an okay, reload nginx

```bash
sudo systemctl reload nginx
```

## Create a SSL cert

Modern sites are encrypted using a special process that uses a security certificate and an exchange of keys.

>At a very high level, the processes requires a private key (which only you have) and a public key (which anyone can get). Only you can encrypt data using the private key, and your public key is the only key that can un-encrypt it. Using this process assures users that the web site is actually coming from you, and not from someone pretending to be you.

We'll use a free service called certbot to create a security cert. The process will also update the sites-enabled file to reflect the cert. If you don't have certbot installed, that's what needs to happen first.

Add the repository

```bash
sudo add-apt-repository ppa:certbot/certbot
```

Then install Certbot’s Nginx package:

```bash
sudo apt install python-certbot-nginx
```


```
sudo certbot --nginx -d example.com -d www.example.com
```


Get wordpress

```
cd /tmp
curl -O https://wordpress.org/latest.tar.gz
tar xzvf latest.tar.gz
cp /tmp/wordpress/wp-config-sample.php /tmp/wordpress/wp-config.php
mkdir /tmp/wordpress/wp-content/upgrade
```


If you've already done all that, just copy


```
sudo cp -a /tmp/wordpress/. /var/www/[directory]
```


Get salt values for wp


```
curl -s https://api.wordpress.org/secret-key/1.1/salt/
```


Copy the values and open the configuration file

```
nano /var/www/html/wp-config.php
```

Add the database information to the wp-config file

add this line just beneath

```
define('FS_METHOD', 'direct');
```

update permissions in the folder

```
sudo chown -R chris:www-data /var/www/[directory]
```

make sure that additional files will maintain server ownership

```
sudo find /var/www/[directory] -type d -exec chmod g+s {} \;
```
make sure that wp can write to various folders

Chris
```
sudo chmod -R g+w /var/www/[directory]/wp-content
sudo chmod -R g+w /var/www/[directory]/wp-content/themes
sudo chmod -R g+w /var/www/[directory]/wp-content/plugins
```

Now go to the site and finish configuration through the web interface.