Calender app for Coding Academy, 
Includes Docker


** information on how to run it **
  #run in console#
-sh start
-composer install
-cp.env.example .env
-php artisan key:generate
-php artisan migrate
-php artisan app:get-data-into-database
