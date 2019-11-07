---
title: 'Migrating from Drupal 7 to Grav'
taxonomy:
    category:
        - docs
page-toc:
    active: true
---

## Requirements

* PHP v7.1 or above for the composer dependencies.
* Drush
* Working Drupal 7 site from which content will be exported.
* R/W access to `public://` as well as the user modules folder on the Drupal site (typically `sites/all/modules/contrib`).

## Installation

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/I6UVFUqZMOU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

1. Download and move the [grav_export](https://www.drupal.org/project/grav_export/) plugin to your Drupal's `sites/all/modules/contrib` folder.
2. Run `composer install` within the `grav_export` folder to install dependencies.
3. Enable the grav_export module either via `drush en grav_export -y` or the administration GUI.
4. Run `drush grav_export_all`, or its alias `drush gravea`, to export all items.  See other options below.
5. Exported files are located at `[DRUPAL_ROOT]/sites/default/files/grav_export/EXPORT`
6. The Grav plugin [https://github.com/david-szabo97/grav-plugin-admin-addon-user-manager](admin-addon-user-manager) is recommended to view and manage users.
7. Follow the steps below for importing the data into Grav.

===

## Exporting Users from Drupal

### Command

`drush grav_export_users` or `drush graveu` will generate Grav user account files.

### Results

* User accounts in the export folder under `EXPORT/accounts/`.  
  * Usernames will be padded to a minimum of 3 characters, maximum of 16.  
  * If a username is truncated or padded, the username will also have the Drupal uid to avoid collisions.
  * Passwords in each account are randomly generated, and have no connection with the respective Drupal account.  The password automatically switches to a hashed_password once the account authenticates for the first time.

### Importing Users to Grav

Copy the `EXPORT/accounts` folder to your `user` directory (e.g. username.yaml files should be placed at `user/accounts`).

## Exporting User Roles from Drupal

### Command

`drush grav_export_roles` or `drush graver` will generate a Grav groups.yaml file.

### Results

Drupal user roles export as Grav groups in a `groups.yaml` file at `config/groups.yaml`. Some notes about the role exporting:

* Each Drupal role is converted to the Grav group `drupal_<ROLE_WITH_UNDERSCORES>` (e.g. `authenticated user` becomes `drupal_authenticated_user`).
* The `drupal_administrator` group receives `admin.super` access along with `admin.login` access.
* The `drupal_authenticated_user` group receives `admin.login` access.
* All accounts receive the "drupal_authenticated_user" group.
* Drupal users with administrator roles receive the `drupal_administrator` group.

### Importing User Roles

Copy the `EXPORT/config` folder to `users/config`.

## Exporting Content Types from Drupal

### Command

`drush grav_export_content_types` or `drush gravect` will generate Grav blueprints and html.twig files.

### Results

For every defined field type, `drush gravect` will attempt to create compatible blueprint and matching html.twig file for each Drupal content type.  The files will be exported to `EXPORT/themes/drupal_export/blueprints` and `EXPORT/themes/drupal_export/templates` respectively.

### Known Limitations

1. Field "number_integer"

Cardinality in many Grav fields only support one value.  Only the first Drupal entry is exported.

2. Field "addressfield"

Grav has no concept of an address field.  Drupal field data is exported as an `array` form type.

### Importing Content Types to Grav

Copy the `EXPORT/themes/drupal_export/blueprints` and `EXPORT/themes/drupal_export/templates` folder to the active theme in Grav.  The admin plugin should now provide extra options for each content type and related fields.

Note: While field content is added to Grav page headers, display of those fields is **not** exported from Drupal.  The html.twig file will need to be modified in order to display any additional fields (besides main body content).

### Exporting Nodes from Drupal

### Command

`drush grav_export_nodes` or `drush graven` will generate Grav users and groups.

### Results

* Each node is exported to its own folder structure under `EXPORT/pages`, based on Drupal's url alias and content type (i.e. `pages/content/my_first_page/page.yaml` or `pages/content/cool_article/article.yaml`).
* Drupal field data is stored in the header of the page.
* Files are stored in `EXPORT/data/files/`, following a Drupal-like storage model.
* In the drush output, extra taxonomy terms may be outputted.  Copy these to Grav's `user/config/site.yaml` file under the taxonomy key.

### Importing Nodes to Grav Pages

Copy the `EXPORT/data` and `EXPORT/pages` folders to the `user directory in Grav. 
