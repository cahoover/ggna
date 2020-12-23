---
title: 'Maintain multiple sites on a server'
intro: 'If you''re an agency or a consultant, you might want to manage landing pages for multiple clients. Here''s how you set this up on a Linux, Nginx, MySQL, PHP (LEMP) stack using Ubuntu 18.4.'
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1608682776
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
```
CREATE DATABASE [servername] DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
```

Then create the user. Late on we'll configure WordPress to use this username when connecting to the database. Yet again, it doesn't matter what username you pick, but it helps to be consistent. One option is to use the servername and add "\_user" or similar. You'll also want to create a strong password for this user. Note the password, we'll need it later!

Don't forget to add the single quotes around the username, localhost, and the password. 

```
GRANT ALL ON [servername].* TO ‘[servername_user]'@'localhost' IDENTIFIED BY ’[password]';
```

Running the "flush privileges" command reloads the permissions table without having to restart the server. You need to use it to activate the new user you just created.

```
FLUSH PRIVILEGES;
```
Exit out of MySQL, you're done with the database.

```
EXIT;
```

## Update sites available

Nginx looks in a folder called _sites-enabled_ for site configuration files. To provide additional control, we create the configuration file in a folder called _sites-available_ and then create a symbolic link in _sites-enabled_ that points to it.

>A symbolic link (or symlink) is a pointer to another file. It's like a mirror. In this way you can prepare many sites in _sites-available_ and create symbolic links to only a few of them in _sites-enabled_.    

Change into the folder

```
cd /etc/nginx/sites-available
```

clone one of the sb ones - replace [servername] with the server’s name

```
sudo cp sb1 [servername]
```

Then enter the file you just created

```
sudo nano [servername]
```

Remove all the cert stuff with ‘ctrl-k’ and update to this:

```
server {
    . . .
    location / {
#try_files $uri $uri/ =404;
try_files $uri $uri/ /index.php$is_args$args;
}

    location = /favicon.ico { log_not_found off; access_log off; }
    location = /robots.txt { log_not_found off; access_log off; allow all; }
    location ~* \.(css|gif|ico|jpeg|jpg|js|png)$ {
        expires max;
        log_not_found off;
    }
    . . .
}
```

Create the symlink

```
sudo ln -s /etc/nginx/sites-available/[directory] /etc/nginx/sites-enabled/
```

Restart the server

```
sudo nginx -t
sudo systemctl reload nginx
```

Update the cert


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