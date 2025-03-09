# Twig Translation Guidelines

## Overview
This document provides **guidelines for working with Twig Translations**. For more information in how to work with `.po` files, [use this guide here](po-files.md).

---

## 1. General Structure
- **Extend a base layout** (`base.html.twig`) for consistent UI.
- **Use `include` for reusable components** (buttons, forms, modals).
- **Organize templates** into structured directories:

```
templates/
│── base.html.twig        # Main layout
│── layouts/              # Shared layout components
│── pages/                # Page-specific templates
│── components/           # Reusable UI components (buttons, forms, tables)
│── emails/               # Email templates

translations/
│── messages.<locale>.po  # Language file
```

---

## 2. Basic Twig Syntax
| Syntax | Description | Example |
|--------|------------|---------|
| `{{ variable }}` | Output a variable | `{{ user.name }}` |
| `{% statement %}` | Execute a control statement | `{% if user.isAdmin %} Admin {% endif %}` |
| `{# comment #}` | Add a comment (not in output) | `{# This is a comment #}` |

**Example Usage:**
```twig
<p>Welcome, {{ user.firstName }}!</p>
```

---

## 3. Translation Standards
- **Always use `|trans`** for text instead of hardcoded strings.
- **Use `.po` translation keys** for consistent multilingual support.
- **Compile translations** after adding new keys.

**Example:**
```twig
<p>{{ 'ui.welcome'|trans }}</p>
<p>{{ 'ui.greeting'|trans({'%name%': user.firstName}) }}</p>
```

### **Compiling Translations**
After modifying `.po` files, run:
```sh
php bin/console translation:update --force --dump-messages en
php bin/console translation:compile
```

---

## 4. Layout and Components
### **Base Layout Usage**
Every page should extend `base.html.twig`:
```twig
{% extends 'base.html.twig' %}

{% block title %}{{ 'ui.dashboard'|trans }}{% endblock %}

{% block content %}
    <h1>{{ 'ui.greeting'|trans({'%name%': user.firstName}) }}</h1>
{% endblock %}
```

### **Including Components**
```twig
{% include 'components/button.html.twig' with { label: 'ui.button.apply', type: 'primary' } %}
```

---

## 5. Forms and Inputs
Use Symfony's **form rendering system** and **translations** for labels.
```twig
{{ form_start(shiftForm) }}
    {{ form_row(shiftForm.name, {'label': 'form.shift.name'|trans }) }}
    {{ form_row(shiftForm.date, {'label': 'form.shift.date'|trans }) }}
    <button type="submit">{{ 'form.submit'|trans }}</button>
{{ form_end(shiftForm) }}
```

---

## 6. Best Practices
✔ **Use `extends` for layouts** to ensure consistency.  
✔ **Use `include` for shared components** (buttons, forms, modals).  
✔ **Always translate text with `|trans`**.  
✔ **Use session caching** to avoid unnecessary DB calls for locale.  
✔ **Compile `.po` files** after adding translations.  
✔ **Follow structured directory organization**.

---

## 7. Debugging
Use `dump()` to inspect variables:
```twig
{{ dump(user) }}
```
Clear cache if changes don’t appear:
```sh
php bin/console cache:clear
```
