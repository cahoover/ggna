---
title: 'Virtual Environments in Anaconda'
intro: |
  You can think of a virtual environment as a container for a Python project.  You can make as many virtual environments as you like (usually one per project), and assign each one a unique name.
  
  What you'll have is a working copy of Python that's isolated from other Python environments. Each environment has separate files, directories, and paths; nothing you do in one environment will impact projects in other environments.
  
  Why does this matter? Well, if  Project Blue expects to find a certain version of a file in a certain place, and Project Red replaces that file with a different version, Project Blue might stop working. Virtual environments make sure that doesn't happen.
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1609196435
id: 4994035e-8a07-4819-be3f-e0cea5a1b750
---
## Create an environment  
The easiest way to create a virtual environment is using the conda create command:

```
conda create --name myname
```

You'd replace "myname" with the name of your virtual environment.

## Activate an environment

To enter in your virtual environment and start using it, type
```
conda activate myname
```

Of course, you will enter the actual name of your environment instead of "myname." You'll now see that (base) has been replaced with the name of your environment to indicate that it is now active.

## Deactivate your environment
You can deactivate your environment and return to base with:
```
conda deactivate
```

## Other commands
We've compiled a list of helpful commands in this post.