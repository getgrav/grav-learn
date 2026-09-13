---
title: 'Example: Config Blueprints'
taxonomy:
    category: docs
---
# Example: Config Blueprints

It's common to add some configuration options to site.yaml, to be shown in the site content.

To make those options configurable via Admin panel, add some fields to `user/blueprints/config/site.yaml`. For example:


[codesh=yaml line-numbers="true"]
extends@:
    '@parent'

form:
    fields:
        content:

            fields:
                myfield:
                    type: text
                    label: My Field
[/codesh]

Will add the 'My Field' input type, appending it to the Content section of the Site configuration.

You can add entire new sections too, for example:

[codesh=yaml line-numbers="true"]
extends@:
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
[/codesh]
