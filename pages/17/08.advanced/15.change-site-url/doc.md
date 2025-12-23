---
title: Change the site URL
taxonomy:
    category: docs
---
# Change the site URL

By setting `custom_base_url` in system.yaml (or Custom Base URL in the System Settings, in Admin), we can have Grav in a folder but have it run in the domain root.

## Scenario 1, run in the domain root folder

Grav is installed in `http://localhost:8080/grav-develop` but you want it to respond on `http://localhost:8080`

In system.yaml, set

[codesh=yaml]
custom_base_url: 'http://localhost:8080'
[/codesh]

and set the session path to the new Grav site path,

[codesh=yaml line-numbers="true"]
session:
  path: /
[/codesh]

And in the domain root, set the redirect, e.g. with .htaccess:

[codesh=txt line-numbers="true"]
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/grav-develop/
RewriteRule ^(.*)$ /grav-develop/$1
[/codesh]

where `grav-develop` is the subfolder where Grav is.

## Scenario 2, run in a different subfolder

Grav is installed in `http://localhost:8080/grav-develop` but you want it to respond on `http://localhost:8080/xxxxx`

In system.yaml, set

[codesh=yaml]
custom_base_url: 'http://localhost:8080/xxxxx'
[/codesh]

and set the session path to the new Grav site path,

[codesh=yaml line-numbers="true"]
session:
  path: /xxxxx
[/codesh]

And in the new root folder, /xxxxx, set the redirect, e.g. with .htaccess:

[codesh=txt line-numbers="true"]
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/grav-develop/
RewriteRule ^(.*)$ /grav-develop/$1
[/codesh]

where `grav-develop` is the sister subfolder where Grav is.
