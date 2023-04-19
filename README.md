Steps to install project

1) Download php(8.1),mysql,composer if not installed

2) clone repository or download zip of project

3) go to project's root directory and run below command
=> composer install

4) copy .env.example and rename new file to .env

5) change credentials of database and email

6) run below command to migrate database
php artisan migrate

7) run below command to start project
=> php artisan serve

9) Also run below command to start scheduler
=> php artisan schedule:work

8) Go to below url to register user
http://127.0.0.1:8000/register

9) Do login with same credentials and test functionalities