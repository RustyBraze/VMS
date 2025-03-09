# Symfony and Composer sheet cheats

### **Symfony Commands**

#### **Basic Project Management**
- `symfony new my_project --version=7.2`  
  Create a new Symfony project (specific version, if needed).

- `php bin/console`  
  Lists all available Symfony commands.

- `php bin/console about`  
  Displays details about the Symfony application.

#### **Development Server**
- `symfony serve`  
  Start the local Symfony server.

- `symfony server:stop`  
  Stop the Symfony server.

#### **Routing**
- `php bin/console debug:router`  
  Displays a list of all routes in the application.

- `php bin/console router:match /path`  
  Match a route to its controller for a specific path.

#### **Cache**
- `php bin/console cache:clear`  
  Clear the Symfony cache.

- `php bin/console cache:warmup`  
  Warm up the Symfony cache.

#### **Database**
- `php bin/console doctrine:database:create`  
  Create the database.

- `php bin/console doctrine:database:drop --force`  
  Drop the database (with `--force` to confirm).

- `php bin/console doctrine:schema:create`  
  Create the database schema.

- `php bin/console doctrine:schema:update --force`  
  Update the database schema to match the entity definitions.

- `php bin/console doctrine:migrations:status`  
  Display the status of database migrations.

- `php bin/console doctrine:migrations:migrate`  
  Execute database migrations.

#### **Generating Code**
- `php bin/console make:controller NameController`  
  Create a new controller.

- `php bin/console make:entity`  
  Create a new entity.

- `php bin/console make:form`  
  Create a new form class.

- `php bin/console make:migration`  
  Generate a migration file for schema changes.

- `php bin/console make:crud`  
  Generate CRUD for an entity.

#### **Debugging Tools**
- `php bin/console debug:autowiring`  
  Shows all services available for autowiring.

- `php bin/console debug:event-dispatcher`  
  Debug event listeners and subscribers.

- `php bin/console debug:config`  
  View the current configuration for a specific bundle.

---

### **Composer Commands**

#### **Common Usage**
- `composer install`  
  Install dependencies listed in `composer.json`.

- `composer update`  
  Update all dependencies to the latest versions.

- `composer require package/name`  
  Add a new dependency (e.g., `composer require symfony/twig-bundle`).

- `composer remove package/name`  
  Remove a dependency.

- `composer dump-autoload`  
  Rebuild the autoload files.

- `composer outdated`  
  Show outdated dependencies.

- `composer show`  
  List all installed packages along with their versions.

#### **Project Initialization**
- `composer init`  
  Create a new `composer.json` file by interacting with prompts.

- `composer create-project symfony/skeleton my_project`  
  Create a minimal Symfony project.

#### **Scripts and Tools**
- `composer run-script script-name`  
  Run a script defined in `composer.json`.

- `composer diagnose`  
  Check for potential issues in the Composer setup.

- `composer clear-cache`  
  Clears the Composer cache.

---

### **Tips**
- Always prepend `php` to Symfony commands if you don’t have the Symfony binary installed (e.g., `php bin/console` instead of `symfony`).
- Use `--help` with any command to explore options (e.g., `php bin/console make:entity --help`).
