---
title: Comments Pro
description: Learn how to implement and manage Comments Pro
taxonomy:
    category: docs
---

# Comments Pro

> [!IMPORTANT]
> Premium products require the free [License Manager](../license-manager) plugin. Install it and add your product license before installing this product.

# Installation

First ensure you are running the latest version of **Grav 1.7** (`-f` forces a refresh of the GPM index).

```
$ bin/gpm selfupgrade -f
```

The Comments Pro plugin does not have any dependencies, so installation is a simple process of running the command:

```
$ bin/gpm install comments-pro
```

You can also install the plugin via the **Plugins** section in the admin plugin.

---

# Basic Integration

### In Your Theme Templates

To add comments to any page, include the comments section in your template:

```twig
{# Method 1: Use the helper function #}
{{ comments_section() }}

{# Method 2: Include the template directly #}
{% include 'partials/comments-section.html.twig' %}
```

### Enable Comments on Specific Pages

Add this to your page frontmatter:

```yaml
---
title: My Blog Post
comments: true
---
```

## Advanced Usage

### Custom Comment Form

You can customize the comment form by overriding the template:

```twig
{# In your theme: templates/partials/comment-form-custom.html.twig #}
{% include 'partials/_comment-form.html.twig' with {
    parent_id: null,
    show_email: true,
    placeholder_text: "Share your thoughts..."
} %}
```

### Get Comment Count

Display comment count anywhere:

```twig
This post has {{ comment_count() }} comments.
```

### Admin Functions

#### Moderate Comments

- Visit `/admin` and navigate to Comments Pro
- Approve, reject, or mark comments as spam
- Bulk actions available

#### API Endpoints

The plugin provides REST API endpoints:

- `POST /_comments/` - Add new comment
- `GET /_comments/` - Get all comments
- `PATCH /_comments/{id}/status` - Update comment status
- `DELETE /_comments/{id}` - Delete comment
- `GET /_comments/{id}/replies` - Get replies to a comment

## Configuration Options

### Basic Settings

```yaml
enabled: true
built_in_css: true
built_in_js: true
api_route: '/_comments'
```

### Moderation

```yaml
moderation:
  enabled: true
  default_status: 'pending'  # or 'published'
  auto_approve_registered: false
  auto_approve_previous: false
```

### Spam Protection

```yaml
spam:
  enabled: true
  honeypot_field: 'website_url'
  min_time_seconds: 3
  link_limit: 2
  spam_threshold: 50
  scores:
    honeypot_filled: 100
    time_too_fast: 20
    per_extra_link: 10
    keyword_match: 15
    suspicious_patterns: 10
    email_in_text: 20
  blacklist:
    - 'spam keyword'
    - 'another bad word'
```


### Custom Styling

Disable built-in CSS and add your own:

```yaml
built_in_css: false
```

Then add your styles to your theme's CSS. Consult the [Theming Guide](#table-of-contents-1) for more details.

## Data Storage

Comments are stored as YAML files in each page's directory:
```
/user/pages/01.blog/my-post/comments.yaml
```

## Security Features

- Honeypot spam protection
- Rate limiting
- Content filtering
- XSS protection
- Admin authentication required for moderation

## Troubleshooting

### Comments Not Appearing

1. Check that the plugin is enabled
2. Verify HTMX is loading
3. Check browser console for JavaScript errors
4. Ensure proper permissions on page directories

### API Errors

1. Check server error logs
2. Verify Bramus Router is installed
3. Ensure proper .htaccess configuration

### Spam Issues

1. Adjust spam threshold
2. Add more blacklisted keywords
3. Enable stricter moderation
4. Check honeypot implementation

## Performance

The plugin is optimized for performance:

- Atomic file writes
- Minimal database queries
- Efficient comment threading
- Optional caching support

For high-traffic sites, consider:
- Enabling page caching
- Using external comment storage
- Implementing rate limiting

---

# Configuration Guide

This guide provides detailed information about all configuration options available in the Comments Pro plugin.

## Table of Contents

1. [Configuration File Location](#configuration-file-location)
2. [General Settings](#general-settings)
3. [Moderation Settings](#moderation-settings)
4. [Spam Filter Settings](#spam-filter-settings)
5. [Authentication Settings](#authentication-settings)
6. [Security Settings](#security-settings)
7. [Display Settings](#display-settings)
8. [Markdown Editor Settings](#markdown-editor-settings)
9. [Real-time Updates Settings](#real-time-updates-settings)
10. [Common Configuration Scenarios](#common-configuration-scenarios)
11. [Performance Tuning](#performance-tuning)

## Configuration File Location

The plugin configuration should be stored in:

```
user/config/plugins/comments-pro.yaml
```

Never edit the default configuration file at:
```
user/plugins/comments-pro/comments-pro.yaml
```

## General Settings

### Basic Plugin Settings

```yaml
# Enable/disable the entire plugin
enabled: true

# Include built-in CSS styles
built_in_css: true

# Include built-in JavaScript (HTMX and plugin scripts)
built_in_js: true

# API endpoint route prefix
api_route: '/_comments'
```

**Options explained:**

- `enabled`: Master switch for the plugin
- `built_in_css`: Set to `false` if you want to provide your own styles
- `built_in_js`: Set to `false` if you're already loading HTMX elsewhere
- `api_route`: The URL prefix for API endpoints (change if conflicts exist)

## Moderation Settings

### Comment Moderation Configuration

```yaml
moderation:
  # Enable comment moderation
  enabled: true
  
  # Default status for new comments
  # Options: 'published', 'pending', 'spam'
  default_status: pending
  
  # Auto-approve comments from registered users
  auto_approve_registered: false
  
  # Auto-approve if user had a previous comment approved
  auto_approve_previous: false
```

**Moderation Strategies:**

1. **Open Comments** (no moderation):
   ```yaml
   moderation:
     enabled: false
   ```

2. **Full Moderation** (all comments reviewed):
   ```yaml
   moderation:
     enabled: true
     default_status: pending
   ```

3. **Trust Registered Users**:
   ```yaml
   moderation:
     enabled: true
     default_status: pending
     auto_approve_registered: true
   ```

## Spam Filter Settings

### Spam Detection Configuration

```yaml
spam:
  # Enable spam filtering
  enabled: true
  
  # Honeypot field name (should be hidden via CSS)
  honeypot_field: 'website_url'
  
  # Minimum seconds before form can be submitted
  min_time_seconds: 3
  
  # Score threshold for marking as spam
  spam_threshold: 50
  
  # Score threshold for immediate deletion
  delete_threshold: 75
  
  # Maximum links allowed before spam points
  link_limit: 2
  
  # Scoring weights for different spam indicators
  scores:
    honeypot_filled: 100      # Instant spam if honeypot filled
    time_too_fast: 20         # Submitted too quickly
    per_extra_link: 10        # Each link over limit
    keyword_match: 15         # Each blacklisted keyword
    suspicious_patterns: 10   # Suspicious text patterns
    email_in_text: 20        # Email addresses in comment text
  
  # Blacklisted keywords (case-insensitive)
  blacklist:
    - 'viagra'
    - 'casino'
    - 'cheap meds'
    - 'click here'
    - 'limited offer'
```

**Spam Scoring Examples:**

- Honeypot filled: 100 points (instant spam)
- Form submitted in 2 seconds + 3 extra links: 20 + 30 = 50 points (marked as spam)
- Normal comment with 1 link: 0 points (clean)

## Authentication Settings

### User Authentication Configuration

```yaml
authentication:
  # Allow non-logged-in users to comment
  allow_guests: true
  
  # Require login to comment
  require_login: false
  
  # Show inline login form
  grav_login_integration: false
```

**Authentication Modes:**

1. **Open Commenting** (default):
   ```yaml
   authentication:
     allow_guests: true
     require_login: false
   ```

2. **Members Only**:
   ```yaml
   authentication:
     allow_guests: false
     require_login: true
     grav_login_integration: true
   ```

3. **Optional Login**:
   ```yaml
   authentication:
     allow_guests: true
     require_login: false
     grav_login_integration: true
   ```

## Security Settings

### Security Configuration

```yaml
security:
  # Enable CSRF protection
  csrf_protection: true
  
  # Track IP addresses (disable for GDPR)
  track_ip_addresses: true
  
  # Rate limiting configuration
  rate_limit:
    enabled: true
    max_requests: 10          # Max comments per IP
    time_window: 300          # Within 5 minutes
    timeout_duration: 600     # 10 minute penalty
  
  # Form timing validation
  form_timing:
    enabled: true
    min_time: 3              # Minimum seconds
    max_time: 3600           # Maximum seconds (1 hour)
  
  # IP blocklist (supports wildcards and CIDR)
  ip_blocklist:
    - '192.168.1.100'        # Specific IP
    - '10.0.0.*'             # Wildcard range
    - '172.16.0.0/12'        # CIDR notation
```

**Security Profiles:**

1. **Maximum Security**:
   ```yaml
   security:
     csrf_protection: true
     track_ip_addresses: true
     rate_limit:
       enabled: true
       max_requests: 5
       time_window: 300
       timeout_duration: 1800
   ```

2. **GDPR Compliant**:
   ```yaml
   security:
     csrf_protection: true
     track_ip_addresses: false  # No IP storage
     rate_limit:
       enabled: true  # Still works with IP hashing
   ```

## Display Settings

### Comment Display Configuration

```yaml
display:
  # View mode: 'nested', 'tree', or 'flat'
  view_mode: nested
  
  # Maximum visual nesting depth
  nested_max_depth: 5
  
  # Form position: 'top' or 'bottom'
  comment_form_position: bottom
  
  # Allow markdown links in comments
  allow_links: true
  
  # Pagination: 'none', 'manual', or 'infinite'
  pagination_type: manual
  
  # Comments per page
  pagination_items: 10
  
  # Maximum comment length
  max_characters: 5000
  
  # Show user avatars
  show_avatars: true
  
  # Avatar size in pixels
  avatar_size: 40
```

**Display Modes Explained:**

1. **Nested Mode**: Simple indented replies
   - Best for: Simple discussions
   - Performance: Good

2. **Tree Mode**: Collapsible nested structure
   - Best for: Deep discussions
   - Performance: Moderate

3. **Flat Mode**: Chronological with reply indicators
   - Best for: High-volume comments
   - Performance: Best

## Markdown Editor Settings

### Editor Configuration

```yaml
markdown_editor:
  # Enable markdown editor with toolbar
  enabled: true
  
  # Auto-resize textarea as user types
  auto_resize: true
  
  # Textarea dimensions
  min_height: 100
  max_height: 400
```

**Editor Customization:**

For custom toolbar buttons, modify the template:
```twig
data-markdown-toolbar="bold,italic,link,heading,quote,code,unordered_list,ordered_list"
```

## Real-time Updates Settings

### Real-time Features Configuration

```yaml
realtime:
  # Enable automatic polling for updates
  enabled: true
  
  # Base check interval (seconds)
  # Adaptive: halves on high activity, doubles on low
  check_interval: 10
  
  # Show notifications for new comments
  notifications: true
  
  # Notification position
  notification_position: top-right
  
  # Auto-update comment list
  auto_update: true
  
  # Show manual update button
  show_update_button: true
```

**Real-time Modes:**

1. **Full Real-time**:
   ```yaml
   realtime:
     enabled: true
     check_interval: 5
     auto_update: true
   ```

2. **Notification Only**:
   ```yaml
   realtime:
     enabled: true
     notifications: true
     auto_update: false
     show_update_button: true
   ```

## Common Configuration Scenarios

### Blog Comments

```yaml
# Ideal for blog posts with moderate traffic
enabled: true
moderation:
  enabled: true
  default_status: pending
  auto_approve_previous: true
spam:
  enabled: true
  spam_threshold: 40
display:
  view_mode: nested
  pagination_type: manual
  pagination_items: 20
realtime:
  enabled: false  # Not needed for blogs
```

### Community Forum

```yaml
# High-engagement community discussions
enabled: true
moderation:
  enabled: true
  auto_approve_registered: true
authentication:
  require_login: true
display:
  view_mode: tree
  nested_max_depth: 10
  pagination_type: infinite
realtime:
  enabled: true
  check_interval: 5
```

### Corporate Website

```yaml
# Strict moderation, no spam
enabled: true
moderation:
  enabled: true
  default_status: pending
spam:
  enabled: true
  spam_threshold: 30
  delete_threshold: 50
security:
  rate_limit:
    max_requests: 3
    time_window: 600
authentication:
  allow_guests: false
  require_login: true
```

### News Website

```yaml
# High volume, real-time discussions
enabled: true
moderation:
  enabled: true
  auto_approve_registered: true
display:
  view_mode: flat
  pagination_type: infinite
  pagination_items: 50
realtime:
  enabled: true
  check_interval: 10
  auto_update: true
```

## Performance Tuning

### High-Traffic Optimization

```yaml
# Optimize for performance
display:
  view_mode: flat           # Fastest rendering
  pagination_type: manual   # Load on demand
  pagination_items: 25      # Balance load
  show_avatars: false       # Reduce requests

realtime:
  enabled: false            # Reduce server load
  # Or use longer intervals
  check_interval: 30

# Aggressive caching (if using Grav cache)
cache_lifetime: 3600        # 1 hour
```

### Low-Traffic Optimization

```yaml
# Rich features for engaged users
display:
  view_mode: tree
  pagination_type: none     # Show all
  show_avatars: true

markdown_editor:
  enabled: true
  auto_resize: true

realtime:
  enabled: true
  check_interval: 5         # Quick updates
```

## Configuration Best Practices

1. **Start Conservative**: Begin with moderation enabled and adjust based on spam levels
2. **Monitor Spam Scores**: Check admin panel to fine-tune spam thresholds
3. **Test Rate Limits**: Ensure legitimate users aren't blocked
4. **Cache Considerations**: Clear cache after configuration changes
5. **Backup Configuration**: Keep versioned copies of your config

## Troubleshooting Configuration

### Comments Not Saving

Check:
- File permissions on `user/data/`
- `csrf_protection` conflicts
- Rate limiting too strict

### Spam Getting Through

Adjust:
- Lower `spam_threshold`
- Add keywords to `blacklist`
- Enable `form_timing`

### Performance Issues

Try:
- Switch to `flat` view mode
- Enable pagination
- Disable real-time updates
- Reduce avatar size or disable

### Authentication Problems

Verify:
- Grav Login plugin installed
- `require_login` matches your needs
- Session configuration correct

---

# Theming & Customization Guide

This guide covers how to customize the appearance and behavior of the Comments Pro plugin to match your theme and requirements.

## Table of Contents

1. [Template Override System](#template-override-system)
2. [CSS Customization](#css-customization)
3. [JavaScript Hooks](#javascript-hooks)
4. [Template Variables](#template-variables)
5. [Custom View Modes](#custom-view-modes)
6. [Theme Integration Examples](#theme-integration-examples)
7. [Advanced Customization](#advanced-customization)

## Template Override System

### Override Hierarchy

The plugin looks for template overrides in this order:

1. `user/themes/your-theme/templates/plugins/comments-pro/`
2. `user/plugins/comments-pro/templates/`

### Available Templates

```text
templates/
├── partials/
│   ├── comments-section.html.twig          # Main wrapper
│   ├── _comments-base.html.twig             # Base template with variables
│   ├── _comments-header.html.twig           # Comment count and sort controls
│   ├── _comment-form.html.twig              # Comment submission form
│   ├── _comment.html.twig                   # Individual comment display
│   ├── _comments-list.html.twig             # Nested view
│   ├── _comments-tree.html.twig             # Tree view (collapsible)
│   ├── _comments-flat.html.twig             # Flat/chronological view
│   ├── _login-form.html.twig                # Inline login form
│   └── _vote-count.html.twig                # Vote buttons and count
└── admin/
    └── templates/                           # Admin interface templates
```

### Basic Template Override

Create a directory in your theme:

```bash
mkdir -p user/themes/your-theme/templates/plugins/comments-pro/partials/
```

Copy and modify any template:

```bash
cp user/plugins/comments-pro/templates/partials/_comment.html.twig \
   user/themes/your-theme/templates/plugins/comments-pro/partials/
```

### Example: Custom Comment Template

```twig
{# user/themes/your-theme/templates/plugins/comments-pro/partials/_comment.html.twig #}
<article class="comment {{ comment.status }}" id="comment-{{ comment.id }}">
    <div class="comment-avatar">
        {% if config.plugins['comments-pro'].display.show_avatars %}
            <img src="{{ comment.email|avatar_url }}" 
                 alt="{{ comment.author }}" 
                 class="avatar">
        {% endif %}
    </div>
    
    <div class="comment-content">
        <header class="comment-meta">
            <h4 class="comment-author">{{ comment.author }}</h4>
            <time class="comment-date" 
                  datetime="{{ comment.date|date('c') }}">
                {{ comment.date|date('M j, Y \\a\\t g:i A') }}
            </time>
            
            {# Custom: Add user badge for registered users #}
            {% if comment.logged_in %}
                <span class="user-badge">Verified Member</span>
            {% endif %}
        </header>
        
        <div class="comment-text">
            {{ comment.text|comment_text_render }}
        </div>
        
        {# Custom: Social sharing #}
        <div class="comment-actions">
            {% include 'partials/_vote-count.html.twig' %}
            
            <button class="reply-button" 
                    onclick="toggleReplyForm('{{ comment.id }}')">
                Reply
            </button>
            
            <button class="share-comment" 
                    data-comment-id="{{ comment.id }}">
                Share
            </button>
        </div>
    </div>
    
    {# Nested replies #}
    {% if comment.replies is not empty %}
        <div class="comment-replies">
            {% for reply in comment.replies %}
                {% include 'partials/_comment.html.twig' with {'comment': reply} %}
            {% endfor %}
        </div>
    {% endif %}
</article>
```

## CSS Customization

### CSS Custom Properties

The plugin uses CSS custom properties for easy theming:

```css
/* Override in your theme's CSS */
:root {
    /* Primary colors */
    --comments-color-primary: #007bff;
    --comments-color-primary-hover: #0056b3;
    
    /* Text colors */
    --comments-color-text: #333;
    --comments-color-text-light: #666;
    --comments-color-text-muted: #999;
    
    /* Background colors */
    --comments-color-bg: #ffffff;
    --comments-color-bg-light: #f8f9fa;
    --comments-color-bg-alt: #e9ecef;
    
    /* Border colors */
    --comments-color-border: #dee2e6;
    --comments-color-border-light: #e9ecef;
    
    /* Status colors */
    --comments-color-success: #28a745;
    --comments-color-warning: #ffc107;
    --comments-color-error: #dc3545;
    --comments-color-info: #17a2b8;
    
    /* Spacing */
    --comments-spacing-xs: 0.25rem;
    --comments-spacing-sm: 0.5rem;
    --comments-spacing-md: 1rem;
    --comments-spacing-lg: 1.5rem;
    --comments-spacing-xl: 3rem;
    
    /* Typography */
    --comments-font-family: inherit;
    --comments-font-size: 1rem;
    --comments-font-size-sm: 0.875rem;
    --comments-line-height: 1.5;
    
    /* Borders */
    --comments-border-radius: 0.375rem;
    --comments-border-width: 1px;
    
    /* Shadows */
    --comments-shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --comments-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    --comments-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}
```

### Disable Built-in CSS

To use completely custom styles:

```yaml
# In comments-pro.yaml
built_in_css: false
```

Then create your own CSS:

```css
/* Your theme's CSS file */
.comments-section {
    /* Your custom styles */
}

.comment-form {
    /* Form styling */
}

.comment {
    /* Individual comment styling */
}
```

### Dark Mode Support

```css
/* Automatic dark mode */
@media (prefers-color-scheme: dark) {
    :root {
        --comments-color-text: #e9ecef;
        --comments-color-text-light: #adb5bd;
        --comments-color-bg: #212529;
        --comments-color-bg-light: #343a40;
        --comments-color-border: #495057;
    }
}

/* Manual dark mode toggle */
[data-theme="dark"] {
    --comments-color-text: #e9ecef;
    --comments-color-text-light: #adb5bd;
    --comments-color-bg: #212529;
    --comments-color-bg-light: #343a40;
    --comments-color-border: #495057;
}
```

### Responsive Design

```css
/* Mobile-first responsive design */
.comments-section {
    padding: var(--comments-spacing-md);
}

.comment {
    margin-bottom: var(--comments-spacing-lg);
}

.comment-form {
    display: grid;
    gap: var(--comments-spacing-md);
}

@media (min-width: 768px) {
    .comment-form {
        grid-template-columns: 1fr 1fr;
    }
    
    .comment-form .form-field-text {
        grid-column: 1 / -1;
    }
}

/* Nested comment indentation */
.comment-replies {
    margin-left: var(--comments-spacing-lg);
    border-left: 2px solid var(--comments-color-border-light);
    padding-left: var(--comments-spacing-md);
}

@media (max-width: 767px) {
    .comment-replies {
        margin-left: var(--comments-spacing-md);
    }
}
```

## JavaScript Hooks

### Available Events

The plugin dispatches custom events you can listen to:

```javascript
// Comment events
document.addEventListener('comments:loaded', function(event) {
    console.log('Comments loaded:', event.detail);
});

document.addEventListener('comments:added', function(event) {
    console.log('New comment added:', event.detail);
});

document.addEventListener('comments:updated', function(event) {
    console.log('Comments updated:', event.detail);
});

document.addEventListener('comments:error', function(event) {
    console.log('Comment error:', event.detail);
});

// Form events
document.addEventListener('commentForm:submit', function(event) {
    console.log('Form submitted:', event.detail);
});

document.addEventListener('commentForm:reset', function(event) {
    console.log('Form reset:', event.detail);
});

// Real-time events
document.addEventListener('comments:realtime:update', function(event) {
    console.log('Real-time update:', event.detail);
});
```

### Custom JavaScript Integration

```javascript
// Initialize custom comment features
document.addEventListener('DOMContentLoaded', function() {
    initCommentFeatures();
});

function initCommentFeatures() {
    // Add reading time to comments
    addReadingTime();
    
    // Setup comment highlighting
    setupCommentHighlighting();
    
    // Initialize social sharing
    initSocialSharing();
}

function addReadingTime() {
    document.querySelectorAll('.comment-text').forEach(function(element) {
        const text = element.textContent;
        const words = text.split(/\s+/).length;
        const readingTime = Math.ceil(words / 200); // 200 WPM
        
        if (readingTime > 1) {
            const badge = document.createElement('span');
            badge.className = 'reading-time';
            badge.textContent = `${readingTime} min read`;
            
            const meta = element.parentNode.querySelector('.comment-meta');
            meta.appendChild(badge);
        }
    });
}

function setupCommentHighlighting() {
    // Highlight linked comments
    const hash = window.location.hash;
    if (hash.startsWith('#comment-')) {
        const commentElement = document.querySelector(hash);
        if (commentElement) {
            commentElement.classList.add('highlighted');
            commentElement.scrollIntoView({ behavior: 'smooth' });
        }
    }
}

function initSocialSharing() {
    document.querySelectorAll('.share-comment').forEach(function(button) {
        button.addEventListener('click', function() {
            const commentId = this.dataset.commentId;
            const url = `${window.location.origin}${window.location.pathname}#comment-${commentId}`;
            
            if (navigator.share) {
                navigator.share({
                    title: 'Check out this comment',
                    url: url
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url);
                showToast('Link copied to clipboard!');
            }
        });
    });
}
```

### Extending Plugin Functionality

```javascript
// Extend the Comments core
if (window.CommentsCore) {
    // Add custom validation
    CommentsCore.addValidator('profanity', function(text) {
        const profanityWords = ['badword1', 'badword2'];
        const hasProfanity = profanityWords.some(word => 
            text.toLowerCase().includes(word)
        );
        
        if (hasProfanity) {
            return 'Please keep comments family-friendly';
        }
        return null; // Valid
    });
    
    // Add custom formatter
    CommentsCore.addFormatter('mentions', function(text) {
        return text.replace(/@(\w+)/g, '<span class="mention">@$1</span>');
    });
}
```

## Template Variables

### Available Variables in Templates

```twig
{# Global plugin configuration #}
{{ config.plugins['comments-pro'] }}

{# Current page object #}
{{ page }}

{# Comment data #}
{{ comment.id }}
{{ comment.author }}
{{ comment.email }}
{{ comment.text }}
{{ comment.html }}           {# Rendered HTML #}
{{ comment.date }}
{{ comment.status }}
{{ comment.parent_id }}
{{ comment.score }}
{{ comment.votes.up }}
{{ comment.votes.down }}
{{ comment.replies }}        {# Array of reply comments #}
{{ comment.ip_address }}     {# If tracking enabled #}
{{ comment.logged_in }}      {# Boolean #}

{# View configuration #}
{{ view_mode }}              {# 'nested', 'tree', 'flat' #}
{{ form_position }}          {# 'top', 'bottom' #}
{{ api_base }}               {# API endpoint URL #}
{{ pagination_type }}        {# 'none', 'manual', 'infinite' #}
{{ pagination_items }}       {# Number per page #}
{{ realtime_enabled }}       {# Boolean #}

{# User information #}
{{ grav.user }}              {# Current user object #}
{{ is_logged_in }}           {# Boolean #}
```

### Custom Template Variables

Add custom variables in your template override:

```twig
{# _comments-base.html.twig #}
{% set custom_config = {
    'show_user_badges': true,
    'enable_threading': comment_depth < 3,
    'social_sharing': true
} %}

{# Pass to child templates #}
{% block content %}
    {# Template content with custom_config available #}
{% endblock %}
```

## Custom View Modes

### Creating a Custom View Mode

1. **Create the template:**

```twig
{# user/themes/your-theme/templates/plugins/comments-pro/partials/_comments-cards.html.twig #}
<div class="comments-cards-view">
    {% for comment in comments %}
        <div class="comment-card">
            <div class="card-header">
                <img src="{{ comment.email|avatar_url }}" alt="{{ comment.author }}">
                <div class="author-info">
                    <h4>{{ comment.author }}</h4>
                    <time>{{ comment.date|date('M j') }}</time>
                </div>
            </div>
            <div class="card-body">
                {{ comment.text|comment_text_render }}
            </div>
            {% if comment.replies %}
                <div class="card-replies">
                    {{ comment.replies|length }} replies
                    <button onclick="toggleReplies('{{ comment.id }}')">
                        Show/Hide
                    </button>
                </div>
            {% endif %}
        </div>
    {% endfor %}
</div>
```

2. **Modify the controller to use your template:**

```php
// In a custom plugin or theme function
public function selectCommentsTemplate($viewMode) {
    switch ($viewMode) {
        case 'cards':
            return 'partials/_comments-cards.html.twig';
        case 'timeline':
            return 'partials/_comments-timeline.html.twig';
        default:
            return 'partials/_comments-list.html.twig';
    }
}
```

3. **Add CSS for the new view:**

```css
.comments-cards-view {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--comments-spacing-lg);
}

.comment-card {
    background: var(--comments-color-bg);
    border: var(--comments-border-width) solid var(--comments-color-border);
    border-radius: var(--comments-border-radius);
    padding: var(--comments-spacing-md);
    box-shadow: var(--comments-shadow);
}

.card-header {
    display: flex;
    align-items: center;
    gap: var(--comments-spacing-sm);
    margin-bottom: var(--comments-spacing-md);
}
```

## Theme Integration Examples

### Bootstrap Integration

```twig
{# Bootstrap-styled comment form #}
<form class="comment-form" 
      hx-post="{{ api_base }}" 
      hx-target="#comments-list">
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="author" class="form-label">Name *</label>
                <input type="text" 
                       class="form-control" 
                       name="author" 
                       id="author" 
                       required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       class="form-control" 
                       name="email" 
                       id="email">
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="text" class="form-label">Comment *</label>
        <textarea class="form-control" 
                  name="text" 
                  id="text" 
                  rows="4" 
                  required></textarea>
    </div>
    
    {{ nonce_field('comments-pro')|raw }}
    
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-comment"></i> Post Comment
    </button>
</form>
```

### Tailwind CSS Integration

```twig
{# Tailwind-styled comment #}
<article class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="flex items-start space-x-4">
        <img class="w-10 h-10 rounded-full" 
             src="{{ comment.email|avatar_url }}" 
             alt="{{ comment.author }}">
        
        <div class="flex-1 min-w-0">
            <div class="flex items-center space-x-2">
                <h3 class="text-sm font-semibold text-gray-900">
                    {{ comment.author }}
                </h3>
                <time class="text-sm text-gray-500">
                    {{ comment.date|date('M j, Y') }}
                </time>
            </div>
            
            <div class="mt-2 text-sm text-gray-700">
                {{ comment.text|comment_text_render }}
            </div>
            
            <div class="mt-4 flex items-center space-x-4">
                <button class="text-sm text-blue-600 hover:text-blue-800">
                    Reply
                </button>
                <div class="flex items-center space-x-1">
                    <button class="text-gray-400 hover:text-blue-600">
                        👍 {{ comment.votes.up }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</article>
```

### Foundation Integration

```css
/* Foundation-specific styles */
.comments-section {
    @include xy-grid-container;
}

.comment-form {
    @include xy-grid;
    
    .form-field-author,
    .form-field-email {
        @include xy-cell(6);
        
        @include breakpoint(small only) {
            @include xy-cell(12);
        }
    }
    
    .form-field-text {
        @include xy-cell(12);
    }
}

.comment {
    @include callout;
    margin-bottom: 1rem;
    
    &.highlighted {
        @include callout($background: $warning-color);
    }
}
```

## Advanced Customization

### Custom Comment Filtering

```javascript
// Add client-side comment filtering
class CommentFilter {
    constructor() {
        this.filters = new Set();
        this.initializeControls();
    }
    
    initializeControls() {
        const filterContainer = document.createElement('div');
        filterContainer.className = 'comment-filters';
        filterContainer.innerHTML = `
            <label>
                <input type="checkbox" value="show-votes"> 
                Show highly voted only
            </label>
            <label>
                <input type="checkbox" value="recent"> 
                Recent comments only
            </label>
        `;
        
        filterContainer.addEventListener('change', (e) => {
            if (e.target.checked) {
                this.filters.add(e.target.value);
            } else {
                this.filters.delete(e.target.value);
            }
            this.applyFilters();
        });
        
        document.querySelector('.comments-header').appendChild(filterContainer);
    }
    
    applyFilters() {
        const comments = document.querySelectorAll('.comment');
        
        comments.forEach(comment => {
            let show = true;
            
            if (this.filters.has('show-votes')) {
                const votes = parseInt(comment.querySelector('.vote-count')?.textContent || '0');
                show = show && votes >= 5;
            }
            
            if (this.filters.has('recent')) {
                const date = new Date(comment.querySelector('time').dateTime);
                const dayAgo = new Date(Date.now() - 24 * 60 * 60 * 1000);
                show = show && date > dayAgo;
            }
            
            comment.style.display = show ? 'block' : 'none';
        });
    }
}

// Initialize filtering
new CommentFilter();
```

### Comment Reactions

```twig
{# Add reaction buttons to comment template #}
<div class="comment-reactions">
    {% set reactions = ['👍', '❤️', '😂', '😮', '😢', '😠'] %}
    {% for reaction in reactions %}
        <button class="reaction-button" 
                data-reaction="{{ reaction }}"
                data-comment-id="{{ comment.id }}">
            {{ reaction }} 
            <span class="reaction-count">{{ comment.reactions[reaction]|default(0) }}</span>
        </button>
    {% endfor %}
</div>

<script>
document.addEventListener('click', function(e) {
    if (e.target.matches('.reaction-button')) {
        const reaction = e.target.dataset.reaction;
        const commentId = e.target.dataset.commentId;
        
        fetch(`/_comments${window.location.pathname}?action=react`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                comment_id: commentId,
                reaction: reaction,
                nonce: document.querySelector('[name="nonce"]').value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                e.target.querySelector('.reaction-count').textContent = data.count;
            }
        });
    }
});
</script>
```

### Integration with Page Builder

```twig
{# For page builders like Gantry #}
{% if config.plugins['comments-pro'].enabled and page.header.comments %}
    <div class="g-content">
        <div class="g-container">
            {{ comments_section() }}
        </div>
    </div>
{% endif %}
```

This theming guide provides comprehensive coverage of customization options available in the Comments Pro plugin, from simple CSS tweaks to advanced JavaScript integration and custom view modes.
