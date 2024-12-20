# WalletPlus Budget Planner
<div align="center"> <a href="https://beta.walletplus.in"> <img src="https://walletplus.in/wp-content/uploads/2024/10/walletplus-logo.png" alt="WalletPlus" > </a>  <p align="center"> Free Financial Planner App - Budget Planning, Expense Tracking, and More! <br /> <a href="https://secure.walletplus.in">View Demo</a> | <a href="https://github.com/wallet-plus/WalletPlus_v2/issues">Report Bug</a> | <a href="https://github.com/wallet-plus/WalletPlus_v2/issues">Request Feature</a> </p> </div>
About The Project
WalletPlus is a free personal finance management app that assists users with budgeting, tracking expenses, and achieving financial discipline. Here’s what makes WalletPlus unique:

#### Budget Tracking and Expense Management: Easily monitor transactions and control your spending.
#### Enhanced Security: WalletPlus employs encryption to protect your payment information.
#### Convenience: Store all payment details securely for quick access.

# Built With
#### Backend: PHP, Yii2, MySQL
#### Frontend: Angular, HTML, CSS, Bootstrap, JavaScript, JQuery, AJAX

# Getting Started
##### Prerequisites
##### Backend: XAMPP, WAMP, or LAMP for PHP and MySQL server.
##### Frontend: Node.js, Angular CLI
##### Backend Setup Instructions

### Step 1: Install XAMPP / WAMP / LAMP Server
#### Download and install your preferred server: XAMPP / WAMP / LAMP

### Step 2: Clone the Repository
Open your terminal or command prompt.
Navigate to your server’s root directory:
For XAMPP: cd xampp/htdocs
For WAMP: cd wamp/www
Clone the repository:
git clone https://github.com/Wallet-Plus/Budget-Tracker-App.git
cd Budget-Tracker-App

### Step 3: Install Dependencies
Download and install Composer.
In the project directory, run:
`composer install`

### Step 4: Database Setup
Open PHPMyAdmin (usually at http://localhost/phpmyadmin).
Create a new database named walletplus. run:
`php yii migrate`


### Step 5: Configuration
Configure the database settings in config/db.php as needed for your environment.

### Step 6: Start Backend Server
Start your XAMPP/WAMP/LAMP server.
Access the backend by navigating to http://localhost/your-repo-directory.

### Step 7: Admin Login
Username: 1234567890
Password: admin

# Frontend Setup Instructions
### Step 1: Install Node.js and Angular CLI
Download and install Node.js.
Install Angular CLI:
`npm install -g @angular/cli`

### Step 2: Clone the Frontend Repository
Clone the frontend repository if separate:
`git clone https://github.com/Wallet-Plus/WalletPlus-Frontend.git
cd WalletPlus-Frontend`


### Step 3: Install Dependencies
In the project directory, run:
`npm install`

### Step 4: Start the Development Server
Run the following command to start the Angular application:
`ng serve`
Open your browser and navigate to http://localhost:4200/ to view the app.
Additional Angular Commands
Generate Components: `ng generate component component-name`
Build Project: `ng build`
Running Tests:
Unit Tests: `ng test`
End-to-End Tests: `ng e2e`

# Contributing
We welcome contributions! To contribute:

#### Fork the project.
##### Create a feature branch (git checkout -b feature/AmazingFeature).
##### Commit your changes (git commit -m 'Add AmazingFeature').
##### Push to the branch (git push origin feature/AmazingFeature).
##### Open a Pull Request.

# License
Distributed under the MIT License. See LICENSE for more information.

# Contact
For questions or support, open an issue in the GitHub Repository.
