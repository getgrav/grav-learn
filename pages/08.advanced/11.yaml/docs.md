---
title: YAML Syntax
page-toc:
  active: true
taxonomy:
    category: docs
---

Introduction
-----

YAML stands for _"YAML Ain't Markup Language"_ and it is used extensively in Grav for its configuration files, blueprints, and also in page settings. 

YAML is to configuration what markdown is to markup. It’s basically a human-readable structured data format. It is less complex and ungainly than XML or JSON, but provides similar capabilities. It essentially allows you to provide powerful configuration settings, without having to learn a more complex code type like CSS, JavaScript, and PHP.

YAML is built from the ground up to be simple to use. At its core, a YAML file is used to describe data. One of the benefits of using YAML is that the information in a single YAML file can be easily translated to multiple language types.

Basically, the data you enter in a YAML file is used in conjunction with a library to create the pages you see within Grav.

YAML Basic Rules
-----

There are some rules that YAML has in place to avoid issues related to ambiguity in relation to various languages and editing programs. These rules make it possible for a single YAML file to be interpreted consistently, regardless of which application and/or library is being used to interpret it.

* YAML files should end in `.yaml` whenever possible in Grav.
* YAML is case sensitive.
* YAML does not allow the use of tabs. Spaces are used instead as tabs are not universally supported.

Basic Data Types
-----

YAML excels at working with **mappings** (hashes / dictionaries), **sequences** (arrays / lists), and **scalars** (strings / numbers). While it can be used with most programming languages, it works best with languages that are built around these data structure types. This includes: PHP, Python, Perl, JavaScript, and Ruby.

## Scalars

Scalars are a pretty basic concept. They are the strings and numbers that make up the data on the page. A scalar could be a boolean property, like `Yes`, integer (number) such as `5`, or a string of text, like a sentence or the title of your website.

Scalars are often called variables in programming. If you were making a list of types of animals, they would be the names given to those animals.

Most scalars are unquoted, but if you are typing a string that uses punctuation and other elements that can be confused with YAML syntax (dashes, colons, etc.) you may want to quote this data using single `'` or double `"` quotation marks. Double quotation marks allow you to use escapings to represent ASCII and Unicode characters.

[prism classes="language-yaml line-numbers"]
integer: 25
string: "25"
float: 25.0
boolean: Yes
[/prism]

## Sequences

Here is a simple sequence you might find in Grav. It is a basic list with each item in the list placed in its own line with an opening dash.

[prism classes="language-yaml line-numbers"]
- Cat
- Dog
- Goldfish
[/prism]

This sequence places each item in the list at the same level. If you want to create a nested sequence with items and sub-items, you can do so by placing a single space before each dash in the sub-items. YAML uses spaces, **NOT** tabs, for indentation. You can see an example of this below.

[prism classes="language-yaml line-numbers"]
-
 - Cat
 - Dog
 - Goldfish
-
 - Python
 - Lion
 - Tiger
[/prism]

If you wish to nest your sequences even deeper, you just need to add more levels.

[prism classes="language-yaml line-numbers"]
-
 -
  - Cat
  - Dog
  - Goldfish
[/prism]

Sequences can be added to other data structure types, such as mappings or scalars.

## Mappings

Mapping gives you the ability to list keys with values. This is useful in cases where you are assigning a name or a property to a specific element.

[prism classes="language-yaml line-numbers"]
animal: pets
[/prism]

This example maps the value of `pets` to the `animal` key. When used in conjunction with a sequence, you can see that you are starting to build a list of `pets`. In the following example, the dash used to label each item counts as indentation, making the line items the child and the mapping line `pets` the parent.

[prism classes="language-yaml line-numbers"]
pets:
 - Cat
 - Dog
 - Goldfish
[/prism]

Resources and Further Documentation
-----

For more information about YAML, including detailed documentation about how it works, check out the resources linked below.

* [Dave's YAML Primer](https://github.com/darvid/trine/wiki/YAML-Primer)
* [Official YAML 1.2 Documentation](https://yaml.org/spec/1.2/spec.html)
* [YAML Reference Card](https://yaml.org/refcard.html)
* [Xavier Shay's YAML Tutorial](http://rhnh.net/2011/01/31/yaml-tutorial)
* [YAMLLint](http://www.yamllint.com/)
