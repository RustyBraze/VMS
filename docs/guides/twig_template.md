# **Guide to Working with Twig Templates (With Translations)**

## **Introduction**
Twig is the templating engine used in Symfony for rendering HTML views in the **Volunteer Management System (VMS)**. To ensure **multilingual support**, all static text must be translated using `.po` files, following the established **translation key structure**.

This guide explains how to:
- Use **Twig syntax** for templates.
- Implement **translations** using `.po` files.
- Work with **layouts and reusable components**.
- Follow **best practices** for consistency.

---

## **1. Twig Basics**
Twig is a **secure, fast, and flexible** template engine that separates logic from presentation.

### **1.1. Twig Syntax Overview**
| Syntax | Description | Example |
|--------|------------|---------|
| `{{ variable }}` | Outputs a variable | `{{ user.name }}` |
| `{% statement %}` | Executes a control statement | `{% if user.is_admin %} Admin {% endif %}` |
| `{# comment #}` | Adds a comment (not visible in output) | `{# This is a comment #}` |

### **1.2. Displaying Variables**
```twig
<p>Welcome, {{ user.firstName }}!</p>
```

### **1.3. Control Structures**
#### **Conditional Statements**
```twig
{% if user.isAdmin %}
    <p>{{ 'ui.admin.welcome'|trans }}</p>
{% else %}
    <p>{{ 'ui.user.welcome'|trans({'%name%': user.firstName}) }}</p>
{% endif %}
```

#### **Loops (Iteration)**
```twig
<ul>
    {% for shift in shifts %}
        <li>{{ 'schedule.shift.available'|trans({'%title%': shift.title}) }} - {{ shift.startTime|date('H:i') }}</li>
    {% else %}
        <li>{{ 'schedule.no_shifts'|trans }}</li>
    {% endfor %}
</ul>
```

---

## **2. Template Structure & Best Practices**
### **2.1. Directory Structure**
All Twig templates follow a structured approach:

```
templates/
│── base.html.twig  # Main layout (includes navbar, footer)
│── layouts/        # Shared layout components
│── pages/          # Page-specific templates
│── components/     # Reusable UI components (buttons, forms, tables)
│── emails/         # Email templates
```

### **2.2. Base Template (Extending Layouts)**
A common **base layout** ensures a **consistent UI**.

#### **Example: `base.html.twig`**
```twig
<!DOCTYPE html>
<html lang="{{ app.request.locale }}">
<head>
    <meta charset="UTF-8">
    <title>{% block title %}{{ 'ui.app_name'|trans }}{% endblock %}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav>{% include 'layouts/navbar.html.twig' %}</nav>

    <main>
        {% block content %}{% endblock %}
    </main>

    <footer>{% include 'layouts/footer.html.twig' %}</footer>
</body>
</html>
```

### **2.3. Extending the Base Template**
Each page should **extend** `base.html.twig` to inherit the global layout.

#### **Example: `pages/dashboard.html.twig`**
```twig
{% extends 'base.html.twig' %}

{% block title %}{{ 'ui.dashboard'|trans }}{% endblock %}

{% block content %}
    <h1>{{ 'ui.greeting'|trans({'%name%': user.firstName}) }}</h1>
    <p>{{ 'schedule.upcoming_shifts'|trans({'%count%': shifts|length}) }}</p>
{% endblock %}
```

---

## **3. Reusable Components (With Translations)**
Twig allows using **reusable components** to maintain **consistency**.

### **3.1. Using `include` for Components**
#### **Example: `components/button.html.twig`**
```twig
<button class="btn btn-{{ type|default('primary') }}">
    {{ label|trans }}
</button>
```

#### **Usage in a Page**
```twig
{% include 'components/button.html.twig' with { label: 'ui.button.apply', type: 'success' } %}
```

---

## **4. Forms in Twig (With Translations)**
Symfony provides the **Form Component**, which can be integrated with Twig.

### **4.1. Rendering Forms**
#### **Example: `forms/shift_application.html.twig`**
```twig
{{ form_start(shiftForm) }}
    {{ form_row(shiftForm.name, {'label': 'form.shift.name'|trans }) }}
    {{ form_row(shiftForm.date, {'label': 'form.shift.date'|trans }) }}
    <button type="submit">{{ 'form.submit'|trans }}</button>
{{ form_end(shiftForm) }}
```

---

## **5. Using Translations in Twig**
### **5.1. Basic Translations**
Use `|trans` to **translate strings** from `.po` files.
```twig
<p>{{ 'ui.welcome'|trans }}</p>
```

### **5.2. Translations with Parameters**
Use placeholders for **dynamic content**.
```twig
<p>{{ 'ui.greeting'|trans({'%name%': user.firstName}) }}</p>
```
If `ui.greeting` is defined in the `.po` file as:
```po
msgid "ui.greeting"
msgstr "Hello, %name%!"
```
Then the output will be:
```html
Hello, John!
```

---

## **6. Compiling Translations**
After updating `.po` files, **compile them** to generate `.mo` files:
```sh
php bin/console translation:update --force --dump-messages en
php bin/console translation:compile
```
This ensures that the latest translations are available in Twig.

---

## **7. Best Practices**
✔ **Use `extends` for layout inheritance**  
✔ **Use `include` for reusable components**  
✔ **Use `|trans` for all static text**  
✔ **Follow `.po` key structure** for clarity  
✔ **Compile `.po` files after updates**

---

## **8. Example Full Page**
### **`pages/shifts.html.twig`**
```twig
{% extends 'base.html.twig' %}

{% block title %}{{ 'schedule.available_shifts'|trans }}{% endblock %}

{% block content %}
    <h1>{{ 'schedule.open_shifts'|trans }}</h1>
    <ul>
        {% for shift in shifts %}
            <li>
                <strong>{{ 'schedule.shift.title'|trans({'%title%': shift.title}) }}</strong>
                - {{ shift.startTime|date('H:i') }}
                {% include 'components/button.html.twig' with { label: 'ui.button.apply', type: 'primary' } %}
            </li>
        {% else %}
            <li>{{ 'schedule.no_shifts'|trans }}</li>
        {% endfor %}
    </ul>
{% endblock %}
```