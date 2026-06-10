---
title: Polls
description: Install, Configure, and Use the Polls Plugin
taxonomy:
    category: docs
---

# Polls

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

## Installation

Installing the Polls plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### Dependencies

This plugin requires the following plugins to be installed and enabled:

- **Admin Plugin** >= 1.10.0 - For poll management interface
- **Flex Objects** >= 1.0.0 - For data management
- **Database Plugin** >= 1.0.0 - For vote storage (uses SQLite)
- **Shortcode Core** >= 5.0.0 - For embedding polls in content

> [!TIP]
> Note: The Database plugin uses SQLite to store voting data. Ensure your PHP installation has SQLite support enabled (which is typically included by default in most PHP installations).

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav installation, and enter:

```
bin/gpm install polls
```

This will install the Polls plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/polls`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `polls`. You can find these files on [GitHub](https://github.com/trilbymedia/grav-plugin-polls).

You should now have all the plugin files under

```
/your/site/grav/user/plugins/polls
```

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins` menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/polls/polls.yaml` to `user/config/plugins/polls.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true                    # Enable the plugin
built_in_css: true              # Use built-in CSS styles
theme: default                  # Theme: 'default' or 'modern'
unique_ip_check: true           # One vote per IP address
session_vote_check: true        # One vote per session
readonly: false                 # Display results only (no voting)
callback: /polls                # AJAX endpoint for voting
poll_template: partials/poll.html.twig      # Poll template
results_template: partials/results.html.twig # Results template
colors: |                       # Custom CSS variables
  --poll-primary: #1a73e8;
  --poll-secondary: #f8f9fa;
  --poll-border: #dadce0;
  --poll-text: #202124;
  --poll-hover: #e8f0fe;
```

Note that if you use the Admin Plugin, a file with your configuration named polls.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the Admin.

## Creating Polls

1. Navigate to **Admin > Polls** in your Grav admin panel
2. Click **Add** to create a new poll
3. Fill in the required fields:
   - **Title**: Internal identifier for the poll (used in shortcodes)
   - **Question**: The question displayed to users
   - **Answers**: Add multiple answer options (click "Add item" for each answer)
   - **Published**: Toggle to enable/disable the poll

### Advanced Options

- **Minimum Answers**: Minimum number of selections required (default: 1)
- **Maximum Answers**: Maximum number of selections allowed (default: 1)
- **Show Hints**: Display selection requirements to users

## Usage

> [!WARNING]
> When you embed a **Poll Shortcode** on your page, **you must disable caching on that page**. The plugin uses AJAX to handle voting, which requires dynamic content updates that caching would interfere with. You can do this in admin or by directly in page by setting `cache_enable: false`

### Basic Poll Embedding

Use the `[poll]` shortcode to embed polls in your content:

```markdown
[poll id="my-poll-id" /]
```

### Shortcode Parameters

| Parameter | Type | Description | Default |
|-----------|------|-------------|---------|
| `id` | string | Poll ID (required) | - |
| `theme` | string | Visual theme: 'default' or 'modern' | Config value |
| `callback` | string | Custom AJAX endpoint | `/polls` |
| `unique_ip_check` | boolean | Enforce one vote per IP | Config value |
| `session_vote_check` | boolean | Enforce one vote per session | Config value |
| `poll_template` | string | Custom poll template path | `partials/poll.html.twig` |
| `results_template` | string | Custom results template path | `partials/results.html.twig` |
| `readonly` | boolean | Show results only (disable voting) | `false` |

### Examples

#### Single Choice Poll
```markdown
[poll id="newsletter-signup" theme="modern" /]
```

#### Multiple Choice Poll
Configure the poll to allow multiple selections in the admin panel, then embed:
```markdown
[poll id="favorite-features" /]
```

#### Display Results Only
```markdown
[poll id="survey-2023" readonly="true" /]
```

#### Custom Configuration
```markdown
[poll id="feedback" theme="modern" unique_ip_check="false" session_vote_check="true" /]
```

## Template Customization

### Overriding Templates

To customize poll appearance, copy the template files to your theme:

1. Copy from: `user/plugins/polls/templates/partials/`
2. Paste to: `user/themes/YOUR_THEME/templates/partials/`

Available templates:
- `poll.html.twig` - Main poll display template
- `results.html.twig` - Results display template

### Template Variables

**poll.html.twig**
- `poll` - Poll object (id, question, answers)
- `options` - Configuration options
- `polls` - PollsManager instance
- `uri` - AJAX callback URL with nonce

**results.html.twig**
- `poll` - Poll object
- `results` - Voting results by answer
- `total_votes` - Total number of votes
- `options` - Configuration options

### Example Custom Template

```twig
{# user/themes/YOUR_THEME/templates/partials/poll.html.twig #}
<div class="custom-poll" data-poll-id="{{ poll.id }}">
    <h3>{{ poll.question|markdown(false) }}</h3>
    
    <form class="pollform">
        <input type="hidden" name="id" value="{{ poll.id }}" />
        
        {% for answer in poll.answers %}
            <label>
                <input type="checkbox" value="{{ answer }}" />
                <span>{{ answer|markdown(false) }}</span>
            </label>
        {% endfor %}
        
        <button type="submit">{{ "PLUGIN_POLLS.VOTE"|t }}</button>
    </form>
</div>
```

## CSS Customization

### CSS Variables

Customize the appearance using CSS variables in your theme or in the plugin configuration:

```css
:root {
    --poll-primary: #1a73e8;      /* Primary color */
    --poll-secondary: #f8f9fa;    /* Background color */
    --poll-border: #dadce0;       /* Border color */
    --poll-text: #202124;         /* Text color */
    --poll-hover: #e8f0fe;        /* Hover state color */
    --poll-success: #34a853;      /* Success message color */
    --poll-error: #ea4335;        /* Error message color */
    --poll-radius: 8px;           /* Border radius */
    --poll-transition: 0.3s;      /* Animation duration */
}
```

### Disable Built-in CSS

To use completely custom styling:

```yaml
built_in_css: false
```

## JavaScript Integration

The plugin fires custom events for advanced integration:

```javascript
// Before vote submission
document.addEventListener('polls:beforeVote', function(e) {
    console.log('Voting on poll:', e.detail.pollId);
});

// After successful vote
document.addEventListener('polls:voteSuccess', function(e) {
    console.log('Vote recorded:', e.detail);
});

// On vote error
document.addEventListener('polls:voteError', function(e) {
    console.log('Vote failed:', e.detail.error);
});
```

## API Reference

For advanced usage in PHP:

```php
// Get a specific poll
$poll = $grav['polls']->getPoll('poll-id');

// Get all polls
$polls = $grav['polls']->getPolls();

// Get published polls only
$polls = $grav['polls']->getPolls(['published' => true]);

// Get voting results
$results = $grav['polls']->getResults('poll-id');

// Check if user has voted
$hasVoted = $grav['polls']->hasAlreadyVoted('poll-id');
```

## Troubleshooting

### Poll not found error
- Ensure the poll ID in your shortcode matches the poll's ID exactly
- Check that the poll is published in the admin panel
- Clear Grav cache: `bin/grav clear-cache`

### Voting doesn't work
- Verify all plugin dependencies are installed and enabled
- Check browser console for JavaScript errors
- Ensure the AJAX endpoint (`/polls`) is accessible
- Check file permissions on `user-data://polls/polls.db`

### Results not updating
- Clear Grav cache: `bin/grav clear-cache`
- Check that the Database plugin is properly configured
- Verify SQLite is enabled in your PHP installation
- Check Grav logs for database errors

### Styling issues
- Ensure `built_in_css` is enabled or provide custom CSS
- Check for CSS conflicts with your theme
- Use browser developer tools to inspect CSS variables

### Permission errors
- Ensure the `user/data` directory is writable
- Check that the web server can create/modify the SQLite database
- Verify proper file ownership for the Grav installation

### Debug mode
Enable debug mode for detailed error messages:
```yaml
# user/config/system.yaml
debugger:
  enabled: true
```
