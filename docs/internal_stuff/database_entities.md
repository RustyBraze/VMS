# DB Entities

## **1. User Entity (`User`)**

The **User** table will store all volunteer and staff information.

### **User Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique identifier for each user. |
| `username` | `VARCHAR(50)` | `UNIQUE, NOT NULL` | The public nickname used in VMS. |
| `first_name` | `VARCHAR(100)` | `NOT NULL` | User's first name. |
| `last_name` | `VARCHAR(100)` | `NOT NULL` | User's last name. |
| `email` | `VARCHAR(255)` | `UNIQUE, NOT NULL` | Used for authentication and communication. |
| `password_hash` | `VARCHAR(255)` | `NOT NULL` | Hashed password for local login (if enabled). |
| `phone` | `VARCHAR(20)` | `NULLABLE` | Optional phone number. |
| `telegram_handle` | `VARCHAR(50)` | `NULLABLE` | Optional Telegram username for bot notifications. |
| `roles` | `JSON` | `NOT NULL` | Stores user roles (`volunteer`, `staff`, `admin`, etc.). |
| `privacy_permissions` | `JSON` | `NULLABLE` | Stores privacy settings (GDPR compliance). |
| `created_at` | `TIMESTAMP` | `DEFAULT CURRENT_TIMESTAMP` | Timestamp of account creation. |
| `updated_at` | `TIMESTAMP` | `DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP` | Last update time. |
| `is_active` | `BOOLEAN` | `DEFAULT TRUE` | Determines if the account is active. |

---

## **2. Department Entity (`Department`)**
Departments organize shifts and staff.

### **Department Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique department ID. |
| `name` | `VARCHAR(100)` | `NOT NULL, UNIQUE` | Name of the department. |
| `description` | `TEXT` | `NULLABLE` | Description of department. |
| `is_internal` | `BOOLEAN` | `DEFAULT FALSE` | Whether the department is staff-only. |
| `contact_people` | `JSON` | `NULLABLE` | List of contact persons (name, telegram, phone). |

---

## **3. Location Entity (`Location`)**
Tracks event venues and shift locations.

### **Location Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique location ID. |
| `name` | `VARCHAR(100)` | `NOT NULL, UNIQUE` | Location name. |
| `description` | `TEXT` | `NULLABLE` | Location details. |
| `is_internal` | `BOOLEAN` | `DEFAULT FALSE` | If the location is staff-only. |
| `map_embed_code` | `TEXT` | `NULLABLE` | HTML embed for a map (if available). |

---

## **4. Shift Type Entity (`ShiftType`)**
Defines types of shifts (e.g., "Logistics Helper", "Stage Support").

### **Shift Type Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique shift type ID. |
| `name` | `VARCHAR(100)` | `NOT NULL, UNIQUE` | Name of shift type. |
| `description` | `TEXT` | `NULLABLE` | Description of shift. |
| `department` | `UUID` (FK) | `NOT NULL` | Assigned department. |

---

## **5. Shift Entity (`Shift`)**
Tracks individual shift instances.

### **Shift Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique shift ID. |
| `shift_type` | `UUID` (FK) | `NOT NULL` | The type of shift. |
| `location` | `UUID` (FK) | `NULLABLE` | Location of shift. |
| `start_time` | `DATETIME` | `NOT NULL` | When the shift begins. |
| `end_time` | `DATETIME` | `NOT NULL` | When the shift ends. |
| `max_participants` | `INTEGER` | `NOT NULL` | Number of volunteers/staff required. |
| `is_night_shift` | `BOOLEAN` | `DEFAULT FALSE` | Marks shift as overnight (for bonuses). |

---

## **6. Shift Application Entity (`ShiftApplication`)**
Tracks which users applied for shifts.

### **Shift Application Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique application ID. |
| `user` | `UUID` (FK) | `NOT NULL` | The applying user. |
| `shift` | `UUID` (FK) | `NOT NULL` | The applied shift. |
| `status` | `ENUM('pending', 'approved', 'rejected')` | `NOT NULL, DEFAULT 'pending'` | Application status. |
| `applied_at` | `TIMESTAMP` | `DEFAULT CURRENT_TIMESTAMP` | Timestamp of application. |

---

## **7. Check-In/Check-Out Entity (`CheckInOut`)**
Tracks user attendance.

### **Check-In/Out Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique ID. |
| `user` | `UUID` (FK) | `NOT NULL` | The user checking in/out. |
| `shift` | `UUID` (FK) | `NOT NULL` | The associated shift. |
| `check_in_time` | `DATETIME` | `NULLABLE` | Check-in timestamp. |
| `check_out_time` | `DATETIME` | `NULLABLE` | Check-out timestamp. |

---

## **8. News & Meetings Entity (`News`)**
Posts announcements for volunteers/staff.

### **News Fields**
| Field Name | Type | Constraints | Description |
|------------|------|-------------|-------------|
| `id` | `UUID` | `Primary Key` | Unique ID. |
| `title` | `VARCHAR(200)` | `NOT NULL` | News title. |
| `content` | `TEXT` | `NOT NULL` | News content. |
| `is_pinned` | `BOOLEAN` | `DEFAULT FALSE` | If pinned to top. |
| `visible_to` | `ENUM('all', 'staff')` | `DEFAULT 'all'` | Visibility setting. |

---

