---
title: Twig Primer
taxonomy:
    category: docs
---

Twig is a quick, optimized template engine for PHP. It is designed from the ground up to make creating templates easier on both the developer and the designer.

Its easy-to-follow syntax and straightforward processes make it a natural fit for anyone familiar with Smarty, Django, Jinja, Liquid, or Stencil.

We use it for our Grav templates in part because of its flexibility and inherent security. The fact that it is also one of the fastest template engines for PHP out there made choosing it for use in Grav a no brainer.

Twig compiles templates down to plain PHP. This cuts the amount of PHP overhead down to a minimum, resulting in a faster, more streamlined user experience.

It is also a very flexible engine thanks to its *lexer* and *parser*. This enables the developer to create their own custom tags and filters. It also enables it to create its own [domain-specific language](http://en.wikipedia.org/wiki/Domain-specific_language) (DSL).

When it comes to security, Twig doesn't cut any corners. It gives the developer a sandbox mode that enables them to examine any untrusted code. This gives you the ability to use Twig as a template language for applications while giving users the ability to modify the template design.

Basically, it is a powerful engine that gives you control over the user interface. When combined with YAML for configuration, it makes for a powerful and simple system for any developer or site manager to work with.

## How Does Twig Work?

Twig works by taking all the hocus pocus out of template design. Templates are basically just text files that contain *variables* or *expressions* that are replaced by values as the template is evaluated.

*Tags* are also an important part of a template file, as these control the logic of the template itself.

Twig has two primary language constraints.

* `{{ }}` prints the result of an expression evaluation;
* `{% %}` executes statements.

Here is a basic template created using Twig:

[prism classes="language-html line-numbers"]
<!DOCTYPE html>
<html>
    <head>
        <title>All About Cookies</title>
    </head>
    <body>
        My name is {{ name }} and I love cookies.
        My favorite flavors of cookies are:
        <ul>
        {% for cookie in cookies %}
            <li>{{ cookie.flavor }}</li>
		{% endfor %}
        </ul>
        <h1>Cookies are the best!</h1>
    </body>
</html>
[/prism]

In this example, we set the title of the site up as you would with any standard Web page. The difference is that we were able to use simple Twig syntax to present the author's name and create a dynamic list of types of items.

A template is first loaded, then passed through the **lexer** where its source code is tokenized and broken up into small pieces. At this point, the **parser** takes the tokens and turns them into the abstract syntax tree.

Once this is done, the compiler turns this into PHP code that can then be evaluated and displayed to the user.

Twig can also be extended to add additional tags, filters, tests, operators, global variables, and functions. More information about extending Twig can be found in its [official documentation](http://twig.sensiolabs.org/doc/advanced.html).

## Twig Syntax

A Twig template has several key components that help it to understand what it is you would like to do. These include tags, filters, functions, and variables.

Let's take a closer look at these important tools and how they can help you build an incredible template.

### Tags

Tags tell Twig what it needs to do. It allows you to set which code Twig should handle, and which code it should ignore during evaluation.

There are several different kinds of tags, and each has its own specific syntax that sets them apart.

#### Comment Tags

Comment tags (`{# Insert Comment Here #}`) are used to set comments that exist within the Twig template file, but aren't actually seen by the end user. They are removed during evaluation, and are neither parsed nor output.

A good use of these tags is to explain what a specific line of code or command does so that another developer or designer on your team can quickly read and understand.

Here is an example of a comment tag as you would find it in a Twig template file:

[prism classes="language-twig"]
{# Chocolate Chip Cookies are great! Don't tell anyone! #}
[/prism]

#### Output Tags

Output tags (`{{ Insert Output Here }}`) will be evaluated and added to the generated output. This is where you would put anything you want to appear on the front end, or in some other generated content.

Here is an example of output tags being used in a Twig template:

[prism classes="language-twig"]
My name is {{ name }} and I love cookies.
[/prism]

The variable `name` has been inserted into this line and will appear to the end user as `My name is Jake and I love cookies.` as `Jake` was the value of the name variable.

#### Action Tags

Action tags are the go-getters of the Twig world. These tags actually do something, as opposed to the others which either pass something along or sit idly in the source code waiting for a designer to read it.

Action tags set variables, loop through arrays, and test conditionals. Your `for` and `if` statements are made using these tags.

This is what an action tag might look like in a Twig template:

[prism classes="language-twig line-numbers"]
{% set hour = now | date("G") %}
{% if hour >= 9 and hour < 17 %}
    <p>Time for cookies!</p>
{% else %}
    <p>Time to bake more cookies!</p>
{% endif %}
[/prism]

The initial action tag sets the hour as the current hour in a 24-hour clock. That value is then used to gauge whether it is between 9am and 5pm. If it is, `Time for cookies!` is displayed. If it isn't, `Time to bake more cookies!` is displayed, instead.

It is very important that tags not overlap one another. You can't put an output tag inside of an action tag, or vice versa.

### Filters

Filters are useful, especially when you are using the output tags to display data that might not be formatted the way you want it.

Let's say the value of the `name` variable might include unwanted SGML/XML tags. You can filter them out using the code below:

[prism classes="language-twig"]
{{ name|striptags }}
[/prism]

### Functions

Functions can generate content. They are typically followed by arguments, which appear within parenthesis placed directly after the function call. Even if no argument is present, the function will still have a `()` parenthesis placed directly after it.

[prism classes="language-twig line-numbers"]
{% if date(cookie.created_at) < date('-2days') %}
    {# Eat it! #}
{% endif %}
[/prism]

## Resources

* [Official Twig Documentation](http://twig.sensiolabs.org/documentation)
* [Twig for Template Designers](http://twig.sensiolabs.org/doc/templates.html)
* [Twig for Developers](http://twig.sensiolabs.org/doc/api.html)
* [6 Minute Video Introduction to Twig](http://www.dev-metal.com/6min-video-introduction-twig-php-templating-engine/)
* [Introduction to Twig](http://www.slideshare.net/markstory/introduction-to-twig)
* [Twig: The Basics (free intro to paid course)](https://knpuniversity.com/screencast/twig/basics)
