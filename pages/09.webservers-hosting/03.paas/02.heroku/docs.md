---
title: Heroku
menu: Heroku
visible: true
taxonomy:
    category: docs
---

Heroku is a very well known hosting for web applications.
It has a free plan useful for testing purposes, and paid options to deploy the website.

It offers a wide variety of addons and it's one of the most flexible PAAS around.

They are PHP friendly, and they have a great "Getting Started with PHP on Heroku" guide at [https://devcenter.heroku.com/articles/getting-started-with-php#introduction](https://devcenter.heroku.com/articles/getting-started-with-php#introduction), and it will be the base of the instruction set.

Let's see how to install Grav on Heroku.

First, sign up for Heroku.

Download the Heroku Toolbelt, which is a command-line utility needed to deploy create and deploy your site.

Once installed, type

`heroku login`

Enter your credentials.

Now checkout the PHP "Getting Started" example they provide in your local web root, so you can test locally the site prior to deploying it.

`git clone https://github.com/heroku/php-getting-started.git your-folder`

`cd your-folder`


Now deploy your app with

`heroku create`

and

`git push heroku master`


Ensure that at least one instance of the app is running:


`heroku ps:scale web=1`


and open the site in the browser:

`heroku open`


You should now see the sample PHP project. Now that all is set, you're ready to go on and run Grav instead of the sample site.

First, delete the web/ folder in your current site folder.

Copy your Grav site files there, making sure you're also copying the `.htaccess` hidden file. Overwrite all the files that were existing.

Now open the `Procfile` file. This is a Heroku-specific file. Change the line to

```
web: vendor/bin/heroku-php-apache2 ./
```

You should make sure the site works locally, prior to uploading it to Heroku, just to ensure the are no errors.

Now commit to the repository with

`git add . ; git commit -am 'Added Grav'`

Then run

`git push heroku master`

and the site should be good to go!