# My Personal Blog Web App 

This web app is for posting personal posts and you can also show personal portfolio.


## Login and Register

 - Account with role (admin) can go to admin dashobard.
 - Account with default (user) can go to home page.


## Admin

- can manage CRUD posts.
- can see like, dislike and commments.
- can manage show or not to show some comment.
- can manage profile and password.
- can manage portfolio details.



## Users

- can see posts.
- can search filter by categories or name.
- can manage own profile and password.
- can like, dislike and comment posts.
- I write like-dislike system with jquery-ajax except comment system (someday, I will write with jquery-ajax or API)

## Technologies Used 

- Laravel (9)
- jQuery 
- Ajax
- HTML/CSS
- Javascript
- Bootstrap 5
- Fontawesome

## Installation

- If cloning my project is complete or download is complete, open terminal in project directory.
- Install composer dependicies
  - **composer install** (command)
- Install npm dependicies
  - **npm install**
- Create a copy of .env file
  - **cp .env.example .env**
- Generate an app encryption key
  - **php artisan key:generate**
- Create an empty database for my web project
  - created database name must match from .env file
- Start npm 
  - **npm run build**
- Seed Database
  - **php artisan db:seed**
- Delete storage folder from public/ and link storage
  - **php artisan storage:link**
- Migrate
  - **php artisan migrate**
- Start 
  - **php artisan serve**
- type in url with port 
  - localhost:8000

## Usage

- Need Internet!
- In DatabaseSeeder.php, I created admin account.
- Login as admin,
  - Email - admin@gmail.com
  - Password - password

