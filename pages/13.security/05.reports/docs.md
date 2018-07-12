---
title: Reports
published: true
taxonomy:
    category: docs
content:
    items: '@self.children'
    order:
        by: date
        dir: desc
    limit: 10
    pagination: true
process:
    markdown: true
    twig: true
twig_first: true
---

This is the public repository for security reports for Grav. Below are the most recent reports that have been submitted and processed.

{% for p in page.collection %}
  <a href="{{ p.url }}">
    <h4>{{ p.title }}</h4>
  </a>
{% endfor %}
