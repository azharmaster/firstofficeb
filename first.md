1. create model and database migrate
php artisan make:model BookingTransaction -m

2. install filament/filament and panel and user

3. filament resource

4. php artisan storage:link 

5.create api resource
php artisan make:resource Api/ViewBookingResource 

6. install api
php artisan install:api

7. create api/controller
php artisan make:controller Api/BookingTransactionController

8. check route
php artisan route:list

9. check api key
php artisan make:middleware CheckApiKey

10. setting middleware app/bootstrap