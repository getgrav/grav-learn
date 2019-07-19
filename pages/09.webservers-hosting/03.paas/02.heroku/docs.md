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

Download the [Heroku CLI](https://devcenter.heroku.com/articles/heroku-cli), which is a command-line utility needed to deploy create and deploy your site.

Once installed, type


[prism classes="language-bash command-line"]
heroku login
[/prism]


Enter your credentials.

Now checkout the PHP "Getting Started" example they provide in your local web root, so you can test locally the site prior to deploying it.

[prism classes="language-bash command-line"]
git clone https://github.com/heroku/php-getting-started.git your-folder
[/prism]

[prism classes="language-bash command-line"]
cd your-folder
[/prism]

Now deploy your app with

[prism classes="language-bash command-line"]
heroku create
[/prism]

and

[prism classes="language-bash command-line"]
git push heroku master
[/prism]

Ensure that at least one instance of the app is running:

[prism classes="language-bash command-line"]
heroku ps:scale web=1
[/prism]

and open the site in the browser:


[prism classes="language-bash command-line"]
heroku open
[/prism]



You should now see the sample PHP project. Now that all is set, you're ready to go on and run Grav instead of the sample site.

First, delete the web/ folder in your current site folder.

Copy your Grav site files there, making sure you're also copying the `.htaccess` hidden file. Overwrite all the files that were existing.

Now open the `Procfile` file. This is a Heroku-specific file. Change the line to

[prism classes="language-text"]
web: vendor/bin/heroku-php-apache2 ./
[/prism]

You should make sure the site works locally, prior to uploading it to Heroku, just to ensure the are no errors.

Now commit to the repository with

`git add . ; git commit -am 'Added Grav'`

Then edit `composer.json` and add post deploy command to the `scripts` section as in

[prism classes="language-json line-numbers"]
"scripts": {
  "compile": [
    "bin/grav install",
    "bin/gpm install quark -y"
  ]
}
[/prism]

and commit that to the repository with 

[prism classes="language-bash command-line"]
git add . ; git commit -am 'Add post deploy bin/grav install'
[/prism]

Then run

[prism classes="language-bash command-line"]
git push heroku master
[/prism]

and the site should be good to go!

Due to the ephemeral nature of Heroku's filesystem, all needed plugins or themes must be added to `composer.json` just like above and kept there so they are installed every time the site is pushed to Heroku. For example, if you need the `admin` plugin and a theme, add them in composer like in

[prism classes="language-json line-numbers"]
"scripts": {
  "compile": [
    "bin/grav install",
    "bin/gpm install admin -y",
    "bin/gpm install awesome-theme-name-here -y"
  ]
}
[/prism]
