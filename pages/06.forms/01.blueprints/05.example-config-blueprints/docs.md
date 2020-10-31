---
title: 'Example: Config Blueprints'
taxonomy:
    category: docs
---

It's common to add some configuration options to site.yaml, to be shown in the site content.

To make those options configurable via Admin panel, add some fields to `user/blueprints/config/site.yaml`. For example:


[prism classes="language-yaml line-numbers"]
@extends:
    '@parent'

form:
    fields:
        content:

            fields:
                myfield:
                    type: text
                    label: My Field
[/prism]

Will add the 'My Field' input type, appending it to the Content section of the Site configuration.

You can add entire new sections too, for example:

[prism classes="language-yaml line-numbers"]
@extends:
    '@parent'

form:
    fields:
        anothersection:
            type: section
            title: Another Section
            underline: true

            fields:
                myfield:
                    type: text
                    label: A label
                    size: large
[/prism]