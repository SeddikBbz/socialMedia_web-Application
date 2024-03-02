# Social Media Web App Using PHP , MySQL
-----------------------------------------------------------------

## 1/ Documentation : 
 **Here I'll describe my project Schema for** *Structred-Data*

 *Schema_SD.json*
 
![photo_2024-03-02_07-22-50](https://github.com/SeddikBbz/socialMedia_web-Application/assets/125443878/4ab5b177-0e83-4d1c-982b-ba706abb44c0)

* Steps to draw a schema in MySQL Workbench together:*

1. Install MySQL Workbench:
   - First, we need to install MySQL Workbench. We can download it from the official MySQL website: [MySQL Workbench Downloads](https://dev.mysql.com/downloads/workbench/).
   - Follow the installation wizard, and choose the appropriate options for our system.

2. Launch MySQL Workbench:
   - After the installation is complete, let's launch MySQL Workbench together.

3. Connect to MySQL Server:
   - Click on the "+" icon in the "MySQL Connections" tab to open the "Setup New Connection" window.
   - Enter the connection details, including connection name, connection method, hostname, port, username, and password.
   - Click "Test Connection" to verify the connection, and if successful, click "OK."

4. Create a New Schema:
   - In MySQL Workbench, in the "Navigator" on the left side, under the "Navigator" tab, we'll see a section called "Schemas."
   - Right-click on "Schemas" and choose "Create Schema."
   - Enter a name for our schema, set any additional options, and click "Apply" and then "Finish."

5. Design Tables:
   - design tables within the schema. Right-click on our newly created schema and choose "Create Table."
   - In the "Columns" tab, we'll define the columns of our table, specifying the name, data type, and any additional properties.
   - Switch to the "Indexes" tab to define primary keys, foreign keys, or indexes.
   - Click "Apply" and then "Finish" to create the table.

6. Define Relationships:
   - If our schema involves multiple tables, we might want to define relationships between them.
   - Right-click on the canvas and choose "Place a Relationship."
   - Click on the primary key column in one table and drag to the corresponding foreign key column in another table.
   - Define the relationship properties and click "Apply."

7. Review and Optimize:
   -  We want to make sure that data types, relationships, and constraints align with our requirements.
   - If needed, we can make further optimizations or adjustments.

8. Generate SQL Script:
   - Once we are satisfied with the schema design, we can generate the SQL script to create the database and tables.
   - Right-click on our schema and choose "Forward Engineer..."
   - Follow the wizard, and MySQL Workbench will generate the SQL script.

9. Execute SQL Script:
   - Open a MySQL connection, select our schema, and paste the generated SQL script into the SQL editor.
   - Execute the script to create the database and tables.

10. Verify the Schema:
    - Finally, verify that the schema and tables have been created successfully by navigating through the "Navigator" in MySQL Workbench.

----------------------------------------------------------------

## 2/ Implementation :

## Overview

This project builds a social media web application using PHP, MySQL, and a frontend framework (Bootstrap CSS) for a user-friendly experience. It offers functionalities for both users and admins, allowing user registration, role selection, profile management, post creation, commenting, liking, and admin-specific user management.

## Features:

* User Registration and Login
* Role Selection (Admin/User)
* User Profile Management
* Post Creation and Viewing
* Commenting on Posts
* Liking Posts
* Admin User Management (Add, Delete, Edit)

## Technologies:

* Backend: PHP (8.1.25) or more.
* Database: MongoDB
* Server: XAMPP (Apache + MySQL + PHP + phpMyAdmin)
* Composer (for dependency management)
* Frontend Framework: (Bootstrap CSS)
* HTML, CSS, JavaScript

## Requirements:

   - Download and install XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/).
   - Ensure PHP *(8.0,..)* is running. Verify the version using `php -v` in your terminal.
   - Install Composer by following the instructions at [https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md](https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md).
  

## Installation Instructions:

1. **Clone the Repository:**

   Open your terminal or command prompt and navigate to your desired project directory. Then, clone this repository using Git:

   ```bash
   git clone https://github.com/SeddikBbz/socialMedia_web-Application 
   
   ```

2. **Run the Application:**

   - Start your XAMPP Apache server.
   - In your web browser, navigate to `http://localhost/projectssd` (replace with your project's directory within XAMPP's `htdocs` folder).

**Remember to :**
* Create on *phpMyAdmin* `projectssd`database .
* Import database `projectssd.sql` 


## Usage:

1. Sign up or log in using the provided user registration and login forms.
2. Select your role (Admin/User) during registration or login.
3. Users can manage their profiles, create posts, comment on posts, and like posts.
4. Admins can view, add, edit, and delete users.

**Additional Notes:**

* Consider using security best practices when storing and handling user data (e.g., password hashing).
* For more complex user management, consider using a dedicated authentication service.


## Getting Started with Development:

1. Fork this repository on GitHub.
2. Clone the forked repository to your local machine.
3. Install dependencies using Composer:

   ```bash
   composer install
   ```

4. Make changes to the PHP code, HTML templates, CSS styles, and JavaScript logic as needed.
5. Test your changes thoroughly.

**Contributing:**

* We welcome contributions to this project! Please create pull requests on GitHub to share your improvements.

## Acknowledgements

Special thanks to [MongoDB](https://www.mongodb.com/), [XAMPP](https://www.apachefriends.org/), [Composer](https://getcomposer.org/), [Bootstrap](https://getbootstrap.com/) for their fantastic tools and frameworks.

----

Feel free to customize this template further to include any additional information or details specific to your project.

---

