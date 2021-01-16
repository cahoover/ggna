---
title: 'Helpful Commands for Anaconda VMs'
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1608837329
id: f87b8726-0fd6-476a-b5d9-053551510330
---
## Create an environment using a specific version of Python
You can create a virtual environment with a specific version of python this way:

```bash
conda create -n myenv python=3.6
```     
## Clone environment
You can clone an environment

```bash
conda create --name myclone --clone myenv
```

## List environments
What environments have you created? Find out with this:

```bash
conda env list
```

## List packages in an environment
To list the packages when you are inside an active environment, type this (within the environment).

```bash
conda list
```

## List the packages in an inactive environment
Maybe you want to see the packages in an environment you aren't currently using. Just type this (substituting the name of the environment for myenv).

```bash
conda list -n myenv
```

## Listing specifications of an environment
This command can be helpful to see the details about what's installed within an environment

```bash
conda list --explicit
```