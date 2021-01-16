---
title: 'Installing Python and R (Windows)'
intro: 'This post describes how to install Python and R on your Windows machine via a special distribution called Anaconda. If you are using a Mac, there''s a separate post that describes installation on OSX.'
template: page
updated_by: 29b0194a-1fd0-4a23-81bd-0da139f7fa37
updated_at: 1609197179
id: 90a7fcd4-8a8f-4cbb-ac17-b5dd5c238352
---
Because both Python and R are open source languages, people are free to update and extend them in any way they like. Our goal today is to

- Install a trusted distribution of Python and R that's tested and supported.

- Create a safe environment that we can use for Python experiments without any danger of breaking anything along the way .

## Installing Anaconda
[Anaconda](https://www.anaconda.com/) is a free and open source distribution of Python and R that makes it easy to install these languages on your computer. Because it's built especially for data science, Anaconda also comes conveniently bundled with many packages and extensions that we'll use for data exploration and visualization.

To install Anaconda on your machine, first go to the [Anaconda download page](https://www.anaconda.com/distribution/) in your browser. Somewhere on the page should be your download options, like this.

You should choose the Python 3.7 64 bit version. It's the default.

![](/img/cookbook/install-r-windows/installer.png)

When the installer has downloaded, double click on it to install Anaconda. You'll see this prompt; click "next" to start the installation:

![](/img/cookbook/install-r-windows/installer2.png)

Next step is installation type. Most users should select the "just me" option and click next:

![](/img/cookbook/install-r-windows/installer3.png)

The installer will ask where to install Anaconda. For most users the default installation location is fine. Just click next.

![](/img/cookbook/install-r-windows/installer4.png)

Advanced options. Unless you know what you are doing, keep the default options. Leave the first box unchecked and the second box checked.

![](/img/cookbook/install-r-windows/installer5.png)

The installer will do its thing, and eventually finish. When it's done, click on the Windows start button to see an Anaconda folder added to your start options.

![](/img/cookbook/install-r-windows/start1.png)

If you click on that folder, you'll see a lot of great new options for you. Let's start by clicking on Anaconda (Anaconda3) prompt:

![](/img/cookbook/install-r-windows/start2.png)

That will open a window with Python installed and ready to go!

![](/img/cookbook/install-r-windows/prompt.png)

You can make sure all is well by typing the following into the terminal. Note the "v" is uppercase!

```bash
$ conda -V
conda 4.7.12
```

Notice that the prompt begins with the word (base). That indicates that you are in the base virtual environment (the default) installed by Anaconda.
What's a virtual environment? Let's get to that next in this post.