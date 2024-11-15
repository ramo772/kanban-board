# Kanban Board

# Getting started

## Installation

Clone the repository

    git clone https://github.com/ramo772/kanban-board.git

Switch to the backend folder

    cd kanban-board/backend
    
Install all the dependencies 

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate
    
Run the database seeder 

    php artisan db:seed MemberCardSeeder

Start the local development server

    php artisan serve

You can now access the server at http://127.0.0.1:8000


Switch to the frontend folder

    cd apex-task

Install all the dependencies 

    npm install

You can now access the server at http://localhost:5173/

