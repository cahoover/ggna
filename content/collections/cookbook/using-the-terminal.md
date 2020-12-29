---
title: 'Using the terminal'
intro: 'To explore data science in any real depth, you''ll need to become proficient at using the command line interface, (called the Terminal on a Mac).'
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1609202155
id: 12da92c6-8eed-42b6-a2ba-26de3f31187a
---
## Change directory

Imagine you have a directory called "disco-fever" in /var/www. To move into it, use cd

```bash
cd /var/www/disco-fever
```

## List contents 

To list the contents of "disco-fever" use ls

```bash
ls /var/www/disco-fever
```

It's subjective, but I like to move into a directory before listing the contents. It helps me orient myself. So I would first move into the folder using 

```bash
cd /var/www/disco-fever
```
and then get the listing by typing only ls

```bash
ls
```

## Find where you are
Sometimes it's helpful to ask the path of the current working directory you're in. Pwd will tell you

```bash
pwd
```

## Open files

You can open files using the cleverly named "open" command

```bash
open how-to-disco.pdf
```

## Find a file
You can find all instances of a file using locate

```bash
locate README.txt
```
You can also use locate with wildcards

```bash
locate disco*fever
```

will find all files systemwide that contain disco and fever.

To search a particular folder, use the find command

```bash
find /var/www/ -n disco-fever
```

Will find all files named disco-fever in /var/www/

## Search within files
Grep lets you search within a file. For example

```bash
grep disco-ball disco-fever.txt
```

Will find all instances of disco-ball in the file disco-fever.txt

## View contents of a file
To look inside a file, use the cat command

```bash
cat how-to-disco.pdf
```

You can use this command to combine files, too
```bash
cat file1.txt file2.txt > file3.txt
```
Will command file 1 and file 2 into a third file 3.



## View the first fiew lines of a file

Sometimes you don't want to see the entire file. The head command will display the first ten lines of a file.

```bash
head disco-fever.txt
```

You can go backwards and veiw the last few line of a file with tail

```bash
tail disco-fever.txt
```

## Rename a file or folder

```bash
mv (option) oldname.txt newname.text
```

The same pattern works for renaming folders

```bash
mv /home/user/temp /home/user/directory
```

## Move a file

```bash
mv /home/user/filename.txt /var/www/filename.txt
```

The same command works across multiple files using the wildcard *

```bash
mv /home/user/* /var/www/*
```

Or choose a subset of multiple files, say those with a .txt extension

```bash
mv /home/user/*.txt /var/www/*.txt
```

## Copy a file

Similar to move, except you don't remove the original file(s)

```bash
cp /home/user/filename.txt /var/www/filename.txt
```

The same command works across multiple files using the wildcard *

```bash
cp /home/user/* /var/www/*
```

Or choose a subset of multiple files, say those with a .txt extension

```bash
cp /home/user/*.txt /var/www/*.txt
```

## Create a directory

The following will create a directory called "disco-fever" in /var/www

```bash
mkdir /var/www/disco-fever
```

## Remove a directory

The following will remove "disco-fever" in /var/www (assuming it's empty)

```bash
rmdir /var/www/disco-fever
```

If the directory isn't empty, add the -r  option (r stands for recursive). This will remove disco-fever and all files and folders within it:

```bash
rmdir -r /var/www/disco-fever
```

## Execute commands as a superuser 

Sometimes a command is restricted to the system superuser (the "root" user). One option is to log into the system as root, but that opens the door for trouble. Much safer to run commands as superuser one at a time using the sudo command.

For example, if you didn't have permissions to remove disco-fever, you could do it as a superuser

```bash
sudo rmdir -r /var/www/disco-fever
```

The system will ask for your password before executing the command. Sudo does copious logging of each command, providing a clear audit trail of who did what. 

Not just anyone can use the sudo command. To use it, you must be added to the sudoers file. The file is located at /etc/sudoers and requires root permissions. To make yourself a superuser, enter the following (as root or another superuser):

```bash
usermod -aG sudo username
```

Replace username with the actual username, of course.

## List actively running computer processes
Sometimes it's nice to see what is running on your system at any given time. Top will tell you:

```bash
top
```

## Quit and return to prompt
Some commands, such as "top" to view active processes, take over the Terminal. Press "q" to exit.

```bash
Command: q
```

## Clear previous commands

```bash
clear
```

## Get help

You can get the help file for any command by using the man (manual) command. For example, get help for grep:

```bash
man grep
```

You can also get a one line description of a command 

```bash
whatis grep
```