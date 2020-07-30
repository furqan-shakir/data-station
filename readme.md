# MediumClone

Example for unpack binary data after checing the validity of CRC-16 

## Where to see the code

1. All the important code can be found at the SensorsController, CRC & IntHelper traits. 

## How to test the application 
* Just link the application to a local db and migrate the database. 
* run the command `php artisan serve`
* call the api http://127.0.0.1:8000/api/store using postman or any similar application
* upload the examples.txt file and send a request.
* the result of unpacking the data can be found in the databast at the sensors table.

