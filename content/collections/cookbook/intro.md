---
title: 'Create a new subdomain'
intro: 'Test introduction'
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1608432821
id: 21997066-fb9c-47f9-a5ba-d694cf8d9da1
---
Create the web folder to contain the content and wp

create a folder in var/www

```{bash}
mkdir [directory]
```

Create a database

First enter into the mysql prompt

```
mysql -u root -p
password {see 1Password}

```

Then create a database - replace [servername] with the name of the server instance. For example, name it “scylla” or “fauna.” The username should be the same as the server name. In the example below we use Timeout1 as a password.

```
CREATE DATABASE [servername] DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
```

Then create the user

```
GRANT ALL ON [servername].* TO ‘[servername]'@'localhost' IDENTIFIED BY ’Timeout1';
```

```
FLUSH PRIVILEGES;
```

```
EXIT;
```

Update sites available

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