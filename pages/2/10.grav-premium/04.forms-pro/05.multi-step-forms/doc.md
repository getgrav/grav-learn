---
title: Multi-Step Forms
taxonomy:
    category: docs
description: Split a long form into steps with a progress bar, numbered circles or tabs, and see how each step is checked before the visitor moves on.
---

# Multi-Step Forms

A multi-step form shows one page of fields at a time, with Previous and Next buttons and a progress indicator. It is still one form: the answers from every step are sent together when the visitor submits on the last step, and the server checks everything once more.

## Turn a form into steps

On the **Build** tab, click **Convert to multi-step** under the form. Every field you already have moves into **Step 1**, and a step bar appears at the top of the canvas.

- Click **Add step** for another step, and click a step's tab to work on it. New fields you add by clicking go into the step you are viewing, and you can drag fields from one step to another. Hover over another step's tab while dragging for half a second and it opens, so you can drop the field inside it.
- Click a step's tab to select it. The property panel then shows its **Step Title**, **Step Description** (shown under the title) and **CSS Classes**. You can also click the title on the tab to edit it in place.
- The arrows on a tab move the step left or right, and the remove button deletes it. Removing a step moves its fields into the previous step. A form always keeps at least one step.
- The gear in the step bar selects the steps as a whole, with the settings below.
- **Remove steps** converts the form back to one page. All the fields are kept, in order.

Converting moves every field into **Step 1**, the Honeypot included, and it stays invisible there. A challenge you add later from [Settings](../settings-tab) goes in the last step, where the visitor meets it before **Submit**.

### Step settings

| Key | Label | Default |
|---|---|---|
| `progress` | **Progress Indicator** | `bar` (**Progress Bar**). Also `steps` (**Step Circles**) and `tabs` (**Tabs**). |
| `show_step_numbers` | **Show Step Numbers** | on. Numbers the circles or tabs. |
| `classes` | **CSS Classes** | none. Added to the element around the steps. |

The progress bar fills as the visitor advances and says which step they are on. The circles and tabs mark each step as completed, current or upcoming, and the visitor can click one to jump to it.

## How it works for visitors

- Only the first step shows. **Previous** and **Next** buttons move between steps, and the form's **Submit** button shows on the last step only.
- Clicking **Next** checks the fields of the current step in the browser. If one is invalid (a required field left empty, an email that is not an email), the visitor stays on the step and the browser points at the field. Jumping ahead with the circles or tabs checks every step passed over. Moving back is never blocked.
- Pressing `Enter` in a text field moves to the next step instead of sending the form.
- A field hidden by [conditional logic](../conditional-logic) is skipped by the check.
- The check uses the browser's own validation attributes, which the form only writes while **Check Fields in the Browser** is on. With it off, **Next** moves on without checking. The server still validates everything when the form is sent.
- Without JavaScript, every step shows at once and the plain form still submits.

A required field on step 1 therefore cannot be skipped by clicking ahead, and a visitor who tampers with the page still meets the server's checks on every field.

## The YAML

A multi-step form is a `pro-steps` field holding `pro-step` fields. This is a three-step form that was tested as written:

```yaml
title: Event Registration
type: forms-pro
fields:
  steps:
    type: pro-steps
    progress: steps
    show_step_numbers: true
    fields:
      step_1:
        type: pro-step
        title: About you
        description: We use this to send your ticket.
        fields:
          name:
            type: text
            label: Name
            validate:
              required: true
          email:
            type: email
            label: Email
            validate:
              required: true
      step_2:
        type: pro-step
        title: Your ticket
        fields:
          ticket:
            type: select
            label: Ticket
            options:
              standard: Standard
              vip: VIP
          guests:
            type: number
            label: Guests
            validate:
              min: 0
              max: 4
      step_3:
        type: pro-step
        title: Anything else?
        fields:
          notes:
            type: textarea
            label: Notes
buttons:
  - type: submit
    value: Register
process:
  - submission: true
  - message: You are registered.
```

Field names must still be unique across the whole form, not only within a step. Answers are stored flat, as `name`, `email`, `ticket`, `guests` and `notes`. The step a field sits in does not appear in the entry.

Steps cannot be nested, and the builder keeps the `pro-steps` field at the top level of the form. Conditional logic applies to fields, not to whole steps.

> [!NOTE]
> A required File Upload field holds **Next** until a file has finished uploading, and shows a message under the field until then (see [File Upload](../field-reference#uploads)).

## Related

- [Conditional logic](../conditional-logic)
- [Settings tab](../settings-tab)
- [The builder](../the-builder)
