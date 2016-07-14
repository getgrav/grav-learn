---
title: Cloudways - Managed Cloud Hosting
menu: Cloudways
visible: true
twig_first: true
process:
    twig: true
taxonomy:
    category: docs
---

[Cloudways](http://www.cloudways.com) is a managed cloud host provider for PHP based sites. On Cloudways, you can choose your server from four cloud providers; Digital Ocean, Vultr, GCE and AWS to run your PHP work on it. Cloudways employs thunder stack which you won’t find anywhere else. Recently, Cloudways interviewed one of the [lead developer of Grav CMS Andy Miller](https://www.cloudways.com/blog/interview-andy-miller/).

![Cloudways](cw-logo.png)
## Signing Up On Cloudways
First [Sign Up for an account](https://platform.cloudways.com/signup) on Cloudways, which will only require your email and password. After Signing Up on Cloudways and launching a PHP Stack application follow these steps to install and running Grav CMS on your server: 

## Installing And Running Grav On Cloudways
Login in SSH Terminal and move to your application public_html folder.

```bash
cd applications/<foldername>/public_html/
```

Now go [Grav CMS download](https://getgrav.org/downloads) page and copy the download link. Now go to the terminal and download it there by the following command

```bash
wget https://github.com/getgrav/grav/releases/download/1.0.10/grav-admin-v1.0.10.zip
```

After downloading it, unzip the file.

```bash
unzip grav-admin-v1.0.10.zip
```

That’s it! Grav is installed and is ready to use. Head to your application staging url and add /grav-admin at the end of the URL.