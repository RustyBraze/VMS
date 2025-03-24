# DB and Entities

<!-- TOC -->
* [DB and Entities](#db-and-entities)
  * [Templates](#templates)
    * [Contact List](#contact-list)
  * [**Entity:** System Configuration (`SystemConfiguration`)](#entity-system-configuration-systemconfiguration)
  * [**Entity:** Languages (`Languages`)](#entity-languages-languages)
  * [**Entity:** Departments (`Departments`)](#entity-departments-departments)
  * [**Entity:** Requirements (`Requirements`)](#entity-requirements-requirements)
  * [**Location Entity (`Location`)**](#location-entity-location)
    * [**Location Fields**](#location-fields)
  * [**User Entity (`User`)**](#user-entity-user)
    * [**User Fields**](#user-fields)
  * [**4. Shift Type Entity (`ShiftType`)**](#4-shift-type-entity-shifttype)
    * [**Shift Type Fields**](#shift-type-fields)
  * [**5. Shift Entity (`Shift`)**](#5-shift-entity-shift)
    * [**Shift Fields**](#shift-fields)
  * [**6. Shift Application Entity (`ShiftApplication`)**](#6-shift-application-entity-shiftapplication)
    * [**Shift Application Fields**](#shift-application-fields)
  * [**7. Check-In/Check-Out Entity (`CheckInOut`)**](#7-check-incheck-out-entity-checkinout)
    * [**Check-In/Out Fields**](#check-inout-fields)
  * [**8. News & Meetings Entity (`News`)**](#8-news--meetings-entity-news)
    * [**News Fields**](#news-fields)
<!-- TOC -->


**Important:** Every timestamp must be with Time Zone included

## Templates

### Contact List

```json
[
    {
        "userid" : 999999,
        "name" : "Contact name",
        "comment" : "Available between 10:00 and 15:00",
        "telegram" : "@telegramhandleoftheuser",
        "phone" : "+49 000 0000-0000",
        "email" : "contactemail@invalid_email.xxx"
    }
]
```

---

## **Entity:** System Configuration (`SystemConfiguration`)

Stores the application configuration. The configuration is then exported to a file to allow cache and speed.

| Field Name   | Type          | Constraints        | Description              |
|--------------|---------------|--------------------|--------------------------|
| `id`         | `INTEGER`     | `Primary Key`      | Internal Sequencial ID   |
| `key`        | `STRING(255)` | `UNIQUE, NOT NULL` | Unique Configuration ID  |
| `value`      | `TEXT`        | `NOT NULL`         | Value for the key        |
| `updated_at` | `DATETIMETZ`  | `NOT NULL`         | TimeStamp of last update |

Minimum Parameters required for the application:

**TODO: Add here the table with the minimum parameters required**

| Variable                    | Default Value                 | Description                                                                                     |
|-----------------------------|-------------------------------|-------------------------------------------------------------------------------------------------|
| system.hostname             | `localhost`                   | Hostname where the application is hosted - It is used in the URL                                |
| system.base_url             | `/`                           | Base URL - Usually is /                                                                         |
| system.logo.fav             | `fav.png`                     | Favorite Icon                                                                                   |
| system.logo.main            | `vms_logo_main.png`           | Main Logo of the website                                                                        |
| system.logo.header          | `vms_logo_header.png`         | Header Logo                                                                                     |
| system.version              | `1.0`                         |                                                                                                 |
| system.maintenance_mode     | `false`                       | Forces the system to show maintenance mode when opening the page<br/>Does not affect admin area |
| name.project                | `Volunteer Management System` | Application Name                                                                                |
| name.short                  | `VMS`                         | Short Name of the application                                                                   |
| name.volunteer              | `Volunteer`                   | How the Volunteer shall be named                                                                |
| name.volunteer.plural       | `Volunteers`                  | How the Volunteers shall be named (Plural)                                                      |
| name.staff                  | `Staff`                       | How the Staff shall be named                                                                    |
| name.staff.plural           | `Staff`                       | How the Staffs shall be named (Plural)                                                          |
| name.department_head        | `Department Head`             | How the Department Head shall be named                                                          |
| name.department_head.plural | `Department Heads`            | How the Department Heads shall be named (Plural)                                                |
| name.shift_manager          | `Shift Manager`               | How the Shift Manager shall be named                                                            |
| name.shift_manager.plural   | `Shift Manageres`             | How the Shift Manager shall be named                                                            |
| name.goodie                 | `Reward`                      | How Goodie shall be named                                                                       |
| name.goodie.plural          | `Rewards`                     | How Goodies shall be named (Plural)                                                             |
| name.reputation             | `Reputation`                  | How the reputation system shall be called                                                       |
| default.theme               | `1`                           |                                                                                                 |
| default.language            | `en`                          |                                                                                                 |
| system.environment          | `dev`                         | Type of the system deployed - DEV/PROD                                                          |
| email_driver                | ``                            |                                                                                                 |
| email_from_name             | ``                            |                                                                                                 |
| email_from_email            | ``                            |                                                                                                 |
| email.host                  | ``                            |                                                                                                 |
| email.port                  | ``                            |                                                                                                 |
| email.tsl                   | ``                            |                                                                                                 |
| email.username              | ``                            |                                                                                                 |
| email.password              | ``                            |                                                                                                 |
| enable.registration         | ``                            |                                                                                                 |
| enable.password_reset       | ``                            |                                                                                                 |
| enable.login_normal         | ``                            |                                                                                                 |
| password.min                | ``                            | Minimum lenght for the password                                                                 |
| password.req_upper          | ``                            | Requires Upper case                                                                             |
| password.req_upper.min      | ``                            | Minimum count                                                                                   |
| password.req_lower          | ``                            | Requires Lower case                                                                             |
| password.req_lower.min      | ``                            | Minimum count                                                                                   |
| password.req_number         | ``                            | Requires Numbers                                                                                |
| password.req_number.min     | ``                            | Minimum count                                                                                   |
| password.req_special        | ``                            | Requires Special Caracters                                                                      |
| password.req_special.min    | ``                            | Minimum count                                                                                   |
| shift.                      | ``                            |                                                                                                 |
| shift.                      | ``                            |                                                                                                 |
| shift.                      | ``                            |                                                                                                 |
| shift.                      | ``                            |                                                                                                 |
| shift.                      | ``                            |                                                                                                 |
| policy.                     | ``                            |                                                                                                 |
| policy.                     | ``                            |                                                                                                 |
| policy.                     | ``                            |                                                                                                 |
| policy.                     | ``                            |                                                                                                 |
| policy.                     |                               |                                                                                                 |                                                                                                 |                                                                                                 |
| goodies.                    | ``                            |                                                                                                 |
| goodies.                    | ``                            |                                                                                                 |
| goodies.                    | ``                            |                                                                                                 |
| goodies.                    | ``                            |                                                                                                 |
| goodies.                    | ``                            |                                                                                                 |
|                             | ``                            |                                                                                                 |
|                             | ``                            |                                                                                                 |
|                             | ``                            |                                                                                                 |
|                             | ``                            |                                                                                                 |
|                             | ``                            |                                                                                                 |
|                             | ``                            |                                                                                                 |



---

## **Entity:** Languages (`Languages`)

List of supported languages from the System.

| Field Name      | Type          | Constraints        | Description                  |
|-----------------|---------------|--------------------|------------------------------|
| `id`            | `INTEGER`     | `Primary Key`      | Internal ID                  |
| `uuid`          | `GUID`        | `UNIQUE, NOT NULL` | GUID                         |
| `language_code` | `string(5)`   | `UNIQUE, NOT NULL` | Language Code + Country code |
| `name_english`  | `string(100)` | `NOT NULL`         | Language Name - English      |
| `name_local`    | `string(100)` | `NOT NULL`         | Language Name - Local Spoken |
| `flag_enabled`  | `BOOLEAN`     | `NOT NULL`         | True = Available             |

Initial language Support: (The table is wrong and needs to be updated)

| Code | Country                                                  | Language  | Local Language | Language Code |
|:----:|----------------------------------------------------------|:---------:|:--------------:|:-------------:|
|  de  | Germany                                                  |  German   |                |     de-DE     |
|  gb  | The United Kingdom of Great Britain and Northern Ireland |  English  |                |     en-GB     |
|  us  | United States                                            |  English  |                |     en-US     |
|  nl  | Nederlands                                               |   Dutch   |                |     nl-NL     |
|  at  | Austria                                                  |  German   |                |     de-AT     |
|  ch  | Switzerland                                              |  German   |                |     de-CH     |
|  pl  | Poland                                                   |  Polish   |                |     pl-PL     |
|  fr  | France                                                   |  French   |                |     fr-FR     |
|  dk  | Denmark                                                  |  Danish   |                |     da-DK     |
|  fi  | Finland                                                  |  Finnish  |                |     fi-FI     |
|  es  | Spain                                                    |  Spanish  |                |     es-ES     |
|  be  | Belgium                                                  |  Belgien  |                |     de-BE     |
|  it  | Italy                                                    |  Italian  |                |     it-IT     |
|  cz  | Czech Republic                                           |   Czech   |                |     cs-CZ     |
|  se  | Sweden                                                   |  Swedish  |    Sverige     |     sv-SE     |
|  no  | Norway                                                   | Norwegian |     Noreg      |     nn-NO     |

---

## **Entity:** Departments (`Departments`)

Departments organize shifts and staff.

| Field Name        | Type          | Constraints        | Description                |
|-------------------|---------------|--------------------|----------------------------|
| `id`              | `INTEGER`     | `Primary Key`      | Internal ID                |
| `uuid`            | `GUID`        | `UNIQUE, NOT NULL` | GUID                       |
| `name`            | `STRING(100)` | `NOT NULL`         | Department Name            |
| `description`     | `TEXT`        |                    | MARKDOWN Description       |
| `department_head` | `JSON`        |                    | JSON of department heads   |
| `shift_manager`   | `JSON`        |                    | JSON of the shift managers |
| `flag_staff_only` | `BOOLEAN`     | `NOT NULL`         | True = Only for staff      |
| `updated_at`      | `DATETIMETZ`  | `NOT NULL`         | TimeStamp of last update   |

External Connections:

| Field Name  | Type  | Constraints | Description                                  |
|-------------|-------|-------------|----------------------------------------------|
| `LOCATIONS` | `FK`  |             | EXTERNAL - LOCATIONS where the department is |
| `MEMBERS`   | `FK`  |             | EXTERNAL - Users that are members            |

---

## **Entity:** Requirements (`Requirements`)

| Field Name          | Type          | Constraints        | Description                                                                                                                                        |
|---------------------|:--------------|--------------------|----------------------------------------------------------------------------------------------------------------------------------------------------|
| `id`                | `INTEGER`     | `Primary Key`      | Internal ID                                                                                                                                        |
| `uuid`              | `GUID`        | `UNIQUE, NOT NULL` | Internal UUID                                                                                                                                      |
| `type`              | `INTEGER`     | `NOT NULL`         | 0 = Internal / 1 = External / 2 = BOTH (MIX)                                                                                                       |
| `confirmation_type` | `INTEGER`     | `NOT NULL`         | 0 = No Need (Self)<br/>1 = Yes - By Training Responsible<br/>2 = Yes - By Department (ID)<br/>3 = Yes - By Location (ID)<br/>4 = Yes - Custom text |
| `confirmation_text` | `TEXT`        |                    |                                                                                                                                                    |
| `confirmation_ID`   | `INTEGER`     | `NOT NULL`         |                                                                                                                                                    |
| `valid_for`         | `INTEGER`     | `NOT NULL`         | 0 = Event<br/>1 = Year<br/>2 = Life Time                                                                                                           |
| `name`              | `string(255)` | `NOT NULL`         | Requirement Name                                                                                                                                   |
| `description`       | `TEXT`        |                    | Markdown description                                                                                                                               |
| `flag_active`       | `BOOLEAN`     | `NOT NULL`         | False = Requirement is disbled<br/>True = Active/Enabled                                                                                           |
| `flag_staff_only`   | `BOOLEAN`     | `NOT NULL`         | False = Everyone<br/>True = Only Staff                                                                                                             |
| `training_ID`       | `INTEGER`     | FK                 | Connected to a training - consider the option of several trainings                                                                                 |
| `created_at`        | `datetimetz`  | `NOT NULL`         |                                                                                                                                                    |
| `updated_at`        | `datetimetz`  | `NOT NULL`         |                                                                                                                                                    |

---




















---

## **Location Entity (`Location`)**
Tracks event venues and shift locations.

### **Location Fields**
| Field Name       | Type           | Constraints                   | Description                                     |
|------------------|----------------|-------------------------------|-------------------------------------------------|
| `id`             | `INTEGER`      | `Primary Key`                 | Unique location ID.                             |
| `uuid`           | `UUID`         | `NOT NULL, UNIQUE`            | Unique UUID                                     |
| `name`           | `VARCHAR(100)` | `NOT NULL, UNIQUE`            | Location name                                   |
| `description`    | `TEXT`         | `NULLABLE`                    | Location details                                |
| `map_embed_code` | `TEXT`         | `NULLABLE`                    | HTML embed for a map (if available)             |
| `flag_internal`  | `BOOLEAN`      | `DEFAULT FALSE`               | If the location is staff-only                   |
| `contact_list`   | `JSON`         | `NULLABLE`                    | List of contact persons (name, telegram, phone) |
| `updated_at`     | `DATETIMETZ`   | `CURRENT_TIMESTAMP, NOT NULL` | Last update time                                |


---











## **User Entity (`User`)**

The **User** table will store all volunteer and staff information.

### **User Fields**
| Field Name            | Type           | Constraints                                             | Description                                              |
|-----------------------|----------------|---------------------------------------------------------|----------------------------------------------------------|
| `id`                  | `UUID`         | `Primary Key`                                           | Unique identifier for each user.                         |
| `username`            | `VARCHAR(50)`  | `UNIQUE, NOT NULL`                                      | The public nickname used in VMS.                         |
| `first_name`          | `VARCHAR(100)` | `NOT NULL`                                              | User's first name.                                       |
| `last_name`           | `VARCHAR(100)` | `NOT NULL`                                              | User's last name.                                        |
| `email`               | `VARCHAR(255)` | `UNIQUE, NOT NULL`                                      | Used for authentication and communication.               |
| `password_hash`       | `VARCHAR(255)` | `NOT NULL`                                              | Hashed password for local login (if enabled).            |
| `phone`               | `VARCHAR(20)`  | `NULLABLE`                                              | Optional phone number.                                   |
| `telegram_handle`     | `VARCHAR(50)`  | `NULLABLE`                                              | Optional Telegram username for bot notifications.        |
| `roles`               | `JSON`         | `NOT NULL`                                              | Stores user roles (`volunteer`, `staff`, `admin`, etc.). |
| `privacy_permissions` | `JSON`         | `NULLABLE`                                              | Stores privacy settings (GDPR compliance).               |
| `created_at`          | `TIMESTAMP`    | `DEFAULT CURRENT_TIMESTAMP`                             | Timestamp of account creation.                           |
| `updated_at`          | `TIMESTAMP`    | `DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP` | Last update time.                                        |
| `is_active`           | `BOOLEAN`      | `DEFAULT TRUE`                                          | Determines if the account is active.                     |

---

## **4. Shift Type Entity (`ShiftType`)**
Defines types of shifts (e.g., "Logistics Helper", "Stage Support").

### **Shift Type Fields**
| Field Name    | Type           | Constraints        | Description           |
|---------------|----------------|--------------------|-----------------------|
| `id`          | `UUID`         | `Primary Key`      | Unique shift type ID. |
| `name`        | `VARCHAR(100)` | `NOT NULL, UNIQUE` | Name of shift type.   |
| `description` | `TEXT`         | `NULLABLE`         | Description of shift. |
| `department`  | `UUID` (FK)    | `NOT NULL`         | Assigned department.  |

---

## **5. Shift Entity (`Shift`)**
Tracks individual shift instances.

### **Shift Fields**
| Field Name         | Type        | Constraints     | Description                             |
|--------------------|-------------|-----------------|-----------------------------------------|
| `id`               | `UUID`      | `Primary Key`   | Unique shift ID.                        |
| `shift_type`       | `UUID` (FK) | `NOT NULL`      | The type of shift.                      |
| `location`         | `UUID` (FK) | `NULLABLE`      | Location of shift.                      |
| `start_time`       | `DATETIME`  | `NOT NULL`      | When the shift begins.                  |
| `end_time`         | `DATETIME`  | `NOT NULL`      | When the shift ends.                    |
| `max_participants` | `INTEGER`   | `NOT NULL`      | Number of volunteers/staff required.    |
| `is_night_shift`   | `BOOLEAN`   | `DEFAULT FALSE` | Marks shift as overnight (for bonuses). |

---

## **6. Shift Application Entity (`ShiftApplication`)**
Tracks which users applied for shifts.

### **Shift Application Fields**
| Field Name   | Type                                      | Constraints                   | Description               |
|--------------|-------------------------------------------|-------------------------------|---------------------------|
| `id`         | `UUID`                                    | `Primary Key`                 | Unique application ID.    |
| `user`       | `UUID` (FK)                               | `NOT NULL`                    | The applying user.        |
| `shift`      | `UUID` (FK)                               | `NOT NULL`                    | The applied shift.        |
| `status`     | `ENUM('pending', 'approved', 'rejected')` | `NOT NULL, DEFAULT 'pending'` | Application status.       |
| `applied_at` | `TIMESTAMP`                               | `DEFAULT CURRENT_TIMESTAMP`   | Timestamp of application. |

---

## **7. Check-In/Check-Out Entity (`CheckInOut`)**
Tracks user attendance.

### **Check-In/Out Fields**

| Field Name       | Type        | Constraints   | Description               |
|------------------|-------------|---------------|---------------------------|
| `id`             | `UUID`      | `Primary Key` | Unique ID.                |
| `user`           | `UUID` (FK) | `NOT NULL`    | The user checking in/out. |
| `shift`          | `UUID` (FK) | `NOT NULL`    | The associated shift.     |
| `check_in_time`  | `DATETIME`  | `NULLABLE`    | Check-in timestamp.       |
| `check_out_time` | `DATETIME`  | `NULLABLE`    | Check-out timestamp.      |

---

## **8. News & Meetings Entity (`News`)**

Posts announcements for volunteers/staff.

### **News Fields**
| Field Name   | Type                   | Constraints     | Description         |
|--------------|------------------------|-----------------|---------------------|
| `id`         | `UUID`                 | `Primary Key`   | Unique ID.          |
| `title`      | `VARCHAR(200)`         | `NOT NULL`      | News title.         |
| `content`    | `TEXT`                 | `NOT NULL`      | News content.       |
| `is_pinned`  | `BOOLEAN`              | `DEFAULT FALSE` | If pinned to top.   |
| `visible_to` | `ENUM('all', 'staff')` | `DEFAULT 'all'` | Visibility setting. |

---

