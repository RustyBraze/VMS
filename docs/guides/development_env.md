# **VMS Development Environment**

This guide assumes the use of linux as a base for development. However, if using Windows or Mac, there are small variations to consider. (To be updated here)

## **1. Prerequisites**
Before starting, ensure that you have the following installed:

### **1.1 Required Software**
- **PHP** (≥ 8.1)
- **Composer** (Dependency manager for PHP)
- **Symfony CLI** (For running the Symfony project)
- **MySQL or PostgreSQL** (Database)
- **Docker** (Optional for containerized setup)
- **Node.js & npm** (For frontend dependencies, if needed)
- **Git** (For version control)

### **1.2 Installing Dependencies**

#### Install PHP and Required Extensions:

```sh
sudo apt update && sudo apt install php-cli php-mbstring php-xml php-curl php-zip php-intl unzip
```

*For PostgreSQL support, ensure `pdo_pgsql` is enabled in `php.ini`.*

```sh
sudo apt install php-pgsql
```

*For MySQL support, ensure `pdo_mysql` is enabled in `php.ini`.*

```sh
sudo apt install php-mysql
```

#### Install Composer:

```sh
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### Install Symfony CLI:

```sh
curl -sS https://get.symfony.com/cli/installer | bash
mv ~/.symfony/bin/symfony /usr/local/bin/symfony
```

---

## **2. Setting Up the Project**
### **2.1 Clone the Repository**

```sh
git clone git@github.com:RustyBraze/VMS.git
cd vms
```

### **2.2 Install PHP Dependencies**
```sh
composer install
```

### **2.3 Set Up Environment Variables**

Copy the `.env` file:

```sh
cp .env.example .env
```

Edit `.env` to configure the database connection:

```ini
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/vms_db"
# or for PostgreSQL:
DATABASE_URL="pgsql://db_user:db_password@127.0.0.1:5432/vms_db"
```

### **2.4 Start Symfony Server**

```sh
symfony server:start
```

Access the project at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## **3. Database Setup**
### **3.1 Creating the Database**

Run:

```sh
php bin/console doctrine:database:create
```

Then check if the connection works:

```sh
php bin/console doctrine:query:sql "SELECT 1"
```

### **3.2 Running Migrations**

If database migrations exist:

```sh
php bin/console doctrine:migrations:migrate
```

### **3.3 Creating a New Migration**

To generate a new migration when the entity structure changes:

```sh
php bin/console doctrine:migrations:diff
```

Then apply it:

```sh
php bin/console doctrine:migrations:migrate
```

---

## **4. Recreating the Database Without Migrations**
This is useful for **fresh installations** or **resetting a corrupted database**.

### **4.1 Drop and Recreate the Database**

```sh
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
```

### **4.2 Load Initial Schema**

Instead of using migrations, load all schema manually:

```sh
php bin/console doctrine:schema:create
```

### **4.3 Load Fixtures (Sample Data)**

```sh
php bin/console doctrine:fixtures:load
```

(If `doctrine/doctrine-fixtures-bundle` is installed.)

---

## **5. Running in Docker**

If using Docker, ensure you have `docker-compose.yaml` configured. Then, start the services:

```sh
docker-compose up -d
```

To enter the PHP container:

```sh
docker exec -it vms-php bash
```

Then run database setup inside the container.

---

## **6. Common Troubleshooting**

### **Issue: Database Connection Failure**

- Check if MySQL/PostgreSQL is running:

- ```sh
  sudo systemctl status mysql  # For MySQL
  sudo systemctl status postgresql  # For PostgreSQL
  ```
- Ensure `.env` contains the correct **DATABASE_URL**.

### **Issue: Missing PHP Extensions**

Run:

```sh
php -m | grep pdo
```

Ensure **pdo_mysql** or **pdo_pgsql** is enabled in `php.ini`.

### **Issue: Cache Problems**

Clear Symfony cache:

```sh
php bin/console cache:clear
```
