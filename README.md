# Web Progamming Group 14 Final Project
## Project Summary
Our groups plans to develop a sneaker retailer called Sneaks. Our website will allow users to register for an account, shop for sneakers by allowing the user to add and remove products from their cart, order items placed in the user’s cart, and view previous order history. We will be implementing input validation and other security features to prevent against common website and database security vulnerabilities.
## How to setup
- Clone this repo into your htdocs folder
- Copy [.env.example](./.env.example) to .env and change the database username and password to your own
- Import data from [mysql_data/Store.sql](./.mysql_data/Store.sql) to phpMyAdmin
- Start xampp
- Go to http://localhost/htdocs/csci4300-final to view our site
## How to use
- You can browse our products on the homepage
- If you would like to place an order, click on the login in button, and then navigate to the create account page.
- To place an order, click on a product, select your size, and add it to your cart.
- Once you are ready to checkout, click on your cart, and then click on checkout
- Your order history can be viewed in the orders page
## External Libraries
We use [F.R Michel's .env library](https://dev.to/fadymr/php-create-your-own-php-dotenv-3k2i) to use a .env file to help secure our database.
## Folder structure
- [./index.php](./index.php)   - Home/Product page
- [pages/](./pages/)           - Linked pages
- [resources/](./resources/)   - Images and favicon
- [mysql_data/](./mysql_data/) - Sql tables and rows to import our site
- [styles/](./styles/)         - Css for each page
## Responsibilities
### John
- [x] Orders page
### Hunter
- [x] Register/Login page and Home/Product page
### Nikul
- [x] Cart page
### Kai
- [ ] Update user information
