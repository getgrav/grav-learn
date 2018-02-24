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

#### Client-side Validation

Turning client-side validation off will enable you to see in-line errors and detailed server-side validation that go beyond the HTML5 client-side validation. You can disable client-side validation through form.yaml or in the form definition.

```yaml
form:
    client_side_validation: false
```

#### Fieldsets

You can set up `<fieldset></fieldset>` tags for the fields in your form using the `fieldset:` designation in the form.

```yaml
form:
    name: Example Form
    fields:
        example:
            type: fieldset
            id: my-fieldset
            legend: 'Test Fieldset'
            fields:
                first_field: { type: text, label: 'First Field' }
                second_field: { type: text, label: 'Second Field' }
```

The above form outputs as follows:

```html
<form action="/grav/example/forms" class="" id="my-example-form" method="post" name="Example Form">
  <fieldset id="my-fieldset">
    <legend>Test Fieldset</legend>
    <div class="form-group">
      <div class="form-label-wrapper">
        <label class="form-label">First Field</label>
      </div>
      <div class="form-data" data-grav-default="null" data-grav-disabled="true" data-grav-field="text">
        <div class="form-input-wrapper">
          <input class="form-input" name="data[first_field]" type="text" value="">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-label-wrapper">
        <label class="form-label">Second Field</label>
      </div>
      <div class="form-data" data-grav-default="null" data-grav-disabled="true" data-grav-field="text">
        <div class="form-input-wrapper">
          <input class="form-input" name="data[second_field]" type="text" value="">
        </div>
      </div>
    </div>
  </fieldset>
</form>
```

In the above example, the fields appear within the `my-fieldset` fieldset. You'll also notice that the `<legend></legend>` tags are supporting through the `legend:` option.