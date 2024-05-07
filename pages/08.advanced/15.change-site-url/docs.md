---
title: Change the site URL
taxonomy:
    category: docs
---

By setting `custom_base_url` in system.yaml (or Custom Base URL in the System Settings, in Admin), we can have Grav in a folder but have it run in the domain root.

## Scenario 1, run in the domain root folder

Grav is installed in `http://localhost:8080/grav-develop` but you want it to respond on `http://localhost:8080`

In system.yaml, set

[prism classes="language-yaml"]
custom_base_url: 'http://localhost:8080'
[/prism]

and set the session path to the new Grav site path,

[prism classes="language-yaml line-numbers"]
session:
  path: /
[/prism]

And in the domain root, set the redirect, e.g. with .htaccess:

[prism classes="language-text line-numbers"]
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/grav-develop/
RewriteRule ^(.*)$ /grav-develop/$1
[/prism]

where `grav-develop` is the subfolder where Grav is.

## Scenario 2, run in a different subfolder

Grav is installed in `http://localhost:8080/grav-develop` but you want it to respond on `http://localhost:8080/xxxxx`

In system.yaml, set

[prism classes="language-yaml"]
custom_base_url: 'http://localhost:8080/xxxxx'
[/prism]

and set the session path to the new Grav site path,

[prism classes="language-yaml line-numbers"]
session:
  path: /xxxxx
[/prism]

And in the new root folder, /xxxxx, set the redirect, e.g. with .htaccess:

[prism classes="language-text line-numbers"]
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/grav-develop/
RewriteRule ^(.*)$ /grav-develop/$1
[/prism]

where `grav-develop` is the sister subfolder where Grav is.
