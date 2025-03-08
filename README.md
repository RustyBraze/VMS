# Volunteer Management System (VMS)

![VMS Logo](docs/assets/vms_logo_small_500.png)

## 🚀 About the Project

The **Volunteer Management System (VMS)** is an open-source, web-based application designed to **streamline shift coordination for event volunteers and staff**. Built with **PHP (Symfony), Bootstrap, and Docker**, VMS provides a **scalable** and **customizable** solution for managing volunteer participation, shift scheduling, and event operations.

### ⚠️ Development Status: **Work in Progress**
> - **This project is in active development and not yet ready for production use.**  
> - Features, APIs, and functionalities are subject to change as we refine the system.
> - There is no database migration, every deploy is a clean start.

---

## 🎯 Key Features
- **Shift & Volunteer Management** 🏆
  - Volunteers can apply for **open shifts**, while staff can **self-assign** or be assigned.
  - Reputation system to track participation and recognize contributions.
  - **Check-in/Check-out** tracking for attendance verification.

- **Multi-Phase Event Handling** 🎭
  - Supports **Pre-Event, Build-Up, Event Start, Event End, and Tear-Down** stages.
  - Allows **different roles and permissions** throughout event phases.

- **Role-Based Access Control (RBAC)** 🔒
  - Volunteers, Staff, Shift Managers, Service Desk, Admins, and more.
  - Granular permissions for managing shifts, departments, and locations.

- **Customization & Multi-Tenant Support** 🎨
  - Custom **branding (logo, themes, CSS)** for different events.
  - Supports multiple **regional settings (date/time formats, translations)**.

- **API for Telegram Bot & External Services** 🤖
  - Integrates with a Telegram bot for **shift notifications and reminders**.
  - Webhooks support **real-time updates** for external integrations.

- **Scalability & Performance** 🚀
  - Designed for events with **up to 10,000 attendees** (hopefully).
  - Supports **Docker-based deployments**, database replication, and **Prometheus monitoring**.

---

## 🏗️ Technology Stack
- **Backend:** PHP (Symfony)
- **Frontend:** Bootstrap (HTML5)
- **Database:** MySQL/PostgreSQL
- **Authentication:** Keycloak OAuth2
- **Monitoring:** Prometheus
- **Deployment:** Docker (optional)

---

## ⚙️ Installation (Development)
```bash
# Clone the repository
git clone https://github.com/RustyBraze/VMS.git
cd VMS

# Set up the environment variables
cp .env.example .env

# Install dependencies
composer install
npm install

# Start the development server
symfony server:start
```

For full deployment instructions, see the [Installation Guide](docs/INSTALLATION.md).

---

## 🔄 Contribution & Development
This project is **open-source** and welcomes contributions! If you’d like to help, check out the [CONTRIBUTING.md](docs/CONTRIBUTING.md) guide for information on how to get started.

**Roadmap Highlights:**
- Implementing **Telegram Bot API** for real-time notifications.
- Enhancing **admin panel** for shift and user management.
- Expanding **multi-event support** for different organizations.

---

## 📜 Responsible Use
The **VMS brand, name, and logo** are part of an open-source initiative dedicated to helping event organizers and volunteers. To **protect the reputation** of the project, we kindly ask that:
- **You do not impersonate, misrepresent, or act on behalf of VMS** without official permission.
- **You do not use the logo, name, or branding for misleading, harmful, or illegal purposes.**
- **If you modify the software, clearly state that your version is an independent project** and not an official release of VMS.

We appreciate your support in maintaining the integrity of the VMS project. If you find any misuse of the VMS name or branding, please report it via the official channels.

---

## 📬 Contact & Support
For questions, suggestions, or bug reports, feel free to open an issue or reach out via:

📧 Email: TBD
💬 Community Chat: TDB

---

## 📜 License
The **Volunteer Management System (VMS)** is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for more details.

