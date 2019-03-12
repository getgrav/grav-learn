---
title: Twig Tags
process:
    twig: false
taxonomy:
    category: docs
---

#### Markdown

```
{% markdown %}
This is **bold** and this _underlined_

1. This is a bullet list
2. This is another item in that same list
{% endmarkdown %}
```

#### Scripts

##### File

```
{% script 'theme://js/something.js' in 'bottom' priority: 20 with { defer: true, async: true } %}
```

##### Inline

```
{% script in 'bottom' priority: 20 %}
    alert('Warning!');
{% endscript %}
```

#### CSS Styles

##### File

```
{% style 'theme://css/foo.css' priority: 20 %}
```

##### Inline

```
{% style priority: 20 with { media: 'screen' } %}
    a { color: red; }
{% endstyle %}
```

#### Switch

```
{% switch type %}
  {% case 'foo' %}
     {{ my_data.foo }}
  {% case 'bar' %}
     {{ my_data.bar }}
  {% default %}
     {{ my_data.default }}
{% endswitch %}
```

#### Deferred Blocks

```
{% block myblock deferred %}
    This will be rendered after everything else. 
{% endblock %}
```

See documentation for [Deferred Extension](https://github.com/rybakit/twig-deferred-extension).

#### Throw an Exception

```
{% throw 404 'Not Found' %}
```

#### Try / Catch Exceptions

```
{% try %}
   <li>{{ user.get('name') }}</li>
{% catch %}
   User Error: {{ e.message }}
{% endcatch %}
```
 
#### Render Object (Flex only)
 
```
{% render object layout: 'default' with { variable: 'value' } %}
```
