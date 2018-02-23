---
title: Reference: Form Options
taxonomy:
    category: docs
---


#### Name

There are no required options for forms.  However as outlined in the [Frontend Forms](../../forms) overview, it is highly recommend to at least have a form name:

```yaml
form:
    name: my-form
```

This **must be unique** for your Grav site. This is because the form's name serves as a unique identifier for this form through the system.  A form can be referenced by this name from any other page.

#### Method

This option allows you to control if the form should be submitted via `POST` or `GET`.  The default is `POST`.  Also note, if you have a `file` field in your form, the method will also get `enctype="multipart/form-data"` appended:

```yaml
form:
    method: GET
```


#### Action

The action by default is going to be the route as the current page.  This makes sense most of the time because the form needs to be processed by the same page that houses the form.  There are times when you want to override the action however to either specify a different file extension (`.json` perhaps) or even target a specific page anchor:

```yaml
form:
    action: /contact-us#contact-form
```

You can even process the form on another page if that page is where you want to handle the results.  This can also be used as a technique to alter the template of the response from the one used in the original form:

```yaml
form:
    action: /contact-us/ajax-process
```

Where you have a page file called `form-messages.html.twig` that returns just the message data.  Alternatively you can use the approach below...

#### Template

Usually the page's Twig template that displays the form is perfectly capable of handling any success/failure messages or in-line validation responses.  However sometimes it's useful to send the form response back using a different Twig template.  A good example of this is when you want to process your form via Ajax.  You probably only want the HTML for the success/failure messages to be returned by the template, so these can be injected back into the page by JavaScript:

```yaml
form:
    template: form-messages
```

#### ID

The ability to set a form-level CSS `id` field. If not provided the form's name is used.

```yaml
form:
    id: my-form-id
```

#### Classes

You can also set explicit classes on the form.  There are no default values here.

```yaml
form:
    classes: 'form-style form-surround'
```

#### Inline Errors

Setting Inline Errors in the form's markdown file or definition enables the display of in-line errors, an important troubleshooting tool.

```yaml
form:
    inline_errors: true
```