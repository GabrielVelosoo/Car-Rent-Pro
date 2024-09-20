<h1 align="center"> 
	   CarRentPro-API
</h1>

---

<!-- ---------------------------------------------------------------------- -->

## About the Project

`CarRentPro-API` is a project created for managing vehicle rentals efficiently.

The challenge for this project was to build a RESTful API to handle the entire vehicle rental process. In this project, we implemented CRUD operations (Create, Read, Update, Delete) for vehicles, brands, and models, ensured secure user authentication using [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum) for [JWT](https://jwt.io/introduction)-based authentication, and established a token-based authentication system with token refresh capabilities. The API also manages the rental process, from booking to returning vehicles.

The API was developed using [Laravel](https://laravel.com/), [Docker](https://www.docker.com/), and [MySQL](https://www.mysql.com/), featuring endpoints to create, retrieve, update, and delete vehicle records, as well as manage rentals. A key feature of the API is the ability to filter responses and select specific attributes of the data returned, giving users flexibility to retrieve only the information they need, such as related car models and brand attributes.

This project demonstrates strong skills in API development, secure data handling, and best programming practices, providing a robust solution for vehicle rental management.

---

<!-- ---------------------------------------------------------------------- -->

## Prerequisites

Before you begin, you will need to have the following tools installed on your machine:<br>
• [Git](https://git-scm.com/downloads)<br>
• [Docker](https://www.docker.com/products/docker-desktop) and [Docker Compose](https://docs.docker.com/compose/install/)<br>

Additionally, it is recommended to have an editor for working with the code, such as [Visual Studio Code](https://code.visualstudio.com/).

Ensure that Docker and Docker Compose are working correctly to set up and run the project environment. There is no need to install PHP or MySQL separately, as they are configured automatically within the Docker containers.

---

<!-- ---------------------------------------------------------------------- -->

## Setting Up the Environment

1. **Download the Project**

   Clone the project repository to your local machine:
   
   ```
   git clone https://github.com/GabrielVelosoo/CarRentPro-API
   ```
   
   Navigate to the project directory:
   
   ```
   cd CarRentPro-API
   ```
   
2. **Configure and Run Docker**

   Ensure that Docker and Docker Compose are installed and working correctly.
   
   • Start the Containers<br><br>

   Run the following command to build the images and start the containers:
   
   ```
   docker-compose up -d
   ```

   • Stop the Containers<br><br>

   When not in use, stop the containers with:

   ```
   docker-compose down
   ```

   • Install PHP Dependencies<br><br>

   Use the command `docker ps` to list the containers, you should see something like this:
   
   ```
   CONTAINER ID     IMAGE                   COMMAND                  CREATED          STATUS          PORTS                   NAMES
   <container-id>   carrentpro-api-app      "docker-php-entrypoi…"   30 minutes ago   Up 30 minutes   0.0.0.0:8000->80/tcp    <container-name>
   <container-id>   mysql:8.0.39            "docker-entrypoint.s…"   30 minutes ago   Up 30 minutes   0.0.0.0:3306->3306/tcp  <container-name>
   ```

   Enter the application container and install the Composer dependencies:
   
   ```
   docker exec -it <container-name-or-id> bash
   ```
   ```
   composer install
   ```

3. **Configure the Application**

   Inside the application container, copy the `.env.example` file to `.env`:
   
   ```
   cp .env.example .env
   ```

   Configure the database variables in the `.env` file:
   
   ```
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=car_rent_pro
   DB_USERNAME=user
   DB_PASSWORD=password
   ```
   
   • Generate the Application Key

   Generate the Laravel application key:
   
   ```
   php artisan key:generate
   ```
   
   • Run Migrations

   Run the migrations to set up the database:

   ```
   php artisan migrate
   ```

   • Run the Seeder

   Run the seeder to create a user in the users table:

   ```
   php artisan db:seed
   ```
   
5. **Access the Project**

   After setup, the API will be available at `http://localhost:8000` (or the port you configured in docker-compose.yml).

   You can use tools like [Postman](https://www.postman.com/downloads/) or [Insomnia](https://insomnia.rest/download) to test the API endpoints.

---

<!-- ---------------------------------------------------------------------- -->

## Authentication

**NOTE**: To avoid issues, include "application/json" in the `Accept` header of your requests:

```
Accept: application/json
```

To access the API endpoints, you will need an authentication token. The API returns a [JWT](https://jwt.io/introduction) token that should be used in subsequent requests. Below are details on how to generate the token. Include the token in the `Authorization` header of your requests:

```
Authorization: Bearer {your-token}
```

#### Authentication Routes

**NOTE**: I recommend using [Postman](https://www.postman.com/downloads/) to test the API.

1. **Generate Access Token**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/login`<br>
   • **Request Body:**<br>
   
     ```
     {
         "email": "test@example.com",
         "password": "12345"
     }
     ```
     
   • **Success Response:**
     **Status: 200**
   
     ```
     {
         "token": "{your-token}"
     }
     ```
     
   • **Invalid Credentials Response:**
     **Status: 403**
   
     ```
     {
        "message": "Credential(s) are incorrect!"
     }
     ```
     
     NOTE: Use the email `test@example.com` and password `12345` created when running the `php artisan db:seed` command. If you prefer, you can change the email and password by editing      `database/seeders/DatabaseSeeder.php` in the project root, updating the data as desired, and running the seeders command again. You can also add more users by updating the data         in `DatabaseSeeder.php` and running `php artisan db:seed` again, or by accessing the MySQL container.<br><br>

     **Accessing MySQL Container**

     Use `docker ps` to list the containers:

     ```
     CONTAINER ID     IMAGE                   COMMAND                  CREATED          STATUS          PORTS                   NAMES
     <container-id>   CarRentPro-API-app      "docker-php-entrypoi…"   30 minutes ago   Up 30 minutes   0.0.0.0:8000->80/tcp    <container-name>
     <container-id>   mysql:8.0.39            "docker-entrypoint.s…"   30 minutes ago   Up 30 minutes   0.0.0.0:3306->3306/tcp  <container-name>
     ```

     Enter the MySQL container:

     ```
     docker exec -it <container-name-or-id> bash
     ```

     After entering the container, use the command:
   
     ```
     mysql -u root -p
     ```

     You will need a password to log in, the root user password is set in the `docker-compose.yml` file, "by default the password is `root`", you will see something like:
   
     ```
     Enter password: "root"
     ```

     Inside MySQL, you can check if the `car_rent_pro` database was created automatically with the command `SHOW DATABASES;`, you should see something like:

     ```
     +--------------------+
     | Database           |
     +--------------------+
     | information_schema |
     | mysql              |
     | performance_schema |
     | sys                |
     | car_rent_pro    |
     +--------------------+
     5 rows in set (0.00 sec)
     ```

     If the `car_rent_pro` database is not created, you can create it using SQL commands within the container:

     ```
     CREATE DATABASE car_rent_pro;
     ```

     **NOTE**: If you create the database with a different name, don't forget to configure the database variables in the .env file!

     After that, you have created the database, now just run the migrations with `php artisan migrate`.<br><br>
 
2. **Retrieve Logged-In User**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/me`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
         "me": {
            "id": 1,
            "name": "Test User",
            "email": "test@example.com",
            "email_verified_at": "0000-00-00T00:00:00.000000Z",
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z"
         }
     }
     ```
     
3. **Logout**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/logout`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "message": "Logout successful!"
     }
     ```

4. **Refresh JWT**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/refresh`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "token": "{your-token}"
     }
     ```
   • **Invalid or Expired token Response:**<br>
     **Status: 401**
   
     ```
     {
        "message": "Invalid or expired token"
     }
     ```

---

<!-- ---------------------------------------------------------------------- -->

## Usage

**NOTE**: Include "application/json" in the `Accept` header of your requests and the token in the `Authorization` header:

```
Accept: application/json
```
```
Authorization: Bearer {your-token} #Include Bearer and then a space and your token
```

The API offers several endpoints for managing vehicle rentals. Below are details on how to interact with each of them.

#### API ENDPOINTS

##### Brands endpoints: 

1. **Create a New Brand**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/brand`<br>
   • **Request Body (form-data):**<br>
   
     ```
     Key      Type       Value
     name     (text)     <brand-name>
     image    (file)     <brand-image(.png)>
     ```
     **NOTE**: The request body must be sent in form-data format. The image field must contain an image file in PNG format (.png).<br>
     
   • **Success Response:**<br>
     **Status: 201**
   
     ```
     {
        "name": "<brand-name>",
        "image": "<brand-image>",
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "id": <brand-id>
     }
     ```
     
2. **Retrieve All Brands**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/brand`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     [
        {
            "id": <brand-id>,
            "name": "<brand-name>",
            "image": "<brand-image>",
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "car_models": [
                 Brand related models
            ]
        }
     ]
     ```
     
3. **Retrieve a Single Brand**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/brand/{id}`<br>
   • **Parameters:** Brand ID<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <brand-id>,
        "name": "<brand-name>",
        "image": "<brand-image>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "car_models": [
             Brand related models
        ]
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
     ```
     {
        "message": "The requested resource does not exist."
     }
     ```
     
4. **Update a Brand**<br>
   • **Method:** `PUT`<br>
   • **URL:** `/api/brand/{id}`<br>
   • **Parameters:** Brand ID<br>
   • **Request Body (form-data):**
   
     ```
     Key      Type       Value
     name     (text)     <update-brand-name>
     image    (file)     <update-brand-image(.png)>
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <brand-id>,
        "name": "<update-brand-name>",
        "image": "<update-brand-image>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```

5. **Partially Update a Brand**<br>
   • **Method:** `PATCH`<br>
   • **URL:** `/api/brand/{id}`<br>
   • **Parameters:** Brand ID<br>
   • **Request Body (form-data):**
   
     ```
     Key      Type       Value
     name     (text)     <update-brand-name>
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <brand-id>,
        "name": "<update-brand-name>",
        "image": "<brand-image>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```
     
6. **Delete a Brand**<br>
   • **Method:** `DELETE`<br>
   • **URL:** `/api/brand/{id}`<br>
   • **Parameters:** Brand ID<br>
   • **Success Response:**<br>
     **Status: 200**
    
     ```
     {
        "message": "Brand deleted."
     }
     ```
     
   • **Response Vacation Plan Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to delete. The requested resource does not exist."
     }
     ```

##### Car Models endpoints: 

1. **Create a New Car Model**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/car-model`<br>
   • **Request Body (form-data):**<br>
   
     ```
     Key               Type          Value
     brand_id          (text)        <brand-id>
     name              (text)        <car-model-name>
     image             (file)        <car-model-image(.png,.jpeg,.jpg)>
     number_ports      (text)        <number-ports(int)>
     places            (text)        <places(int)>
     air_bag           (text)        <air-bag(boolean(0, 1))>
     abs               (text)        <abs(boolean(0, 1))>
     ```
     **NOTE**: The request body must be sent in form-data format. The image field must contain an image file in PNG format (.png, .jpeg, .jpg).<br>
     
   • **Success Response:**<br>
     **Status: 201**
   
     ```
     {
        "brand_id": "<brand-id>",
        "name": "<car-model-name>",
        "image": "<car-model-image>",
        "number_ports": "<number-ports>",
        "places": "<places>",
        "air_bag": "<air-bag>",
        "abs": "<abs>",
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "id": <car-model-id>
     }
     ```
     
2. **Retrieve All Car Models**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/car-model`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     [
        {
            "id": <car-model-id>,
            "brand_id": <brand-id>,
            "name": "car-model-name",
            "image": "<car-model-image>",
            "number_ports": <number-ports>,
            "places": <places>,
            "air_bag": <air-bag>,
            "abs": <abs>,
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "brand": {
                "id": <brand-id>,
                "name": "<brand-name>",
                "image": "<brand-image>",
                "created_at": "0000-00-00T00:00:00.000000Z",
                "updated_at": "0000-00-00T00:00:00.000000Z"
           }
        }
     ]
     ```
     
3. **Retrieve a Single Car Model**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/car-model/{id}`<br>
   • **Parameters:** Car Model ID<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
         "id": <car-model-id>,
         "brand_id": <brand-id>,
         "name": "car-model-name",
         "image": "<car-model-image>",
         "number_ports": <number-ports>,
         "places": <places>,
         "air_bag": <air-bag>,
         "abs": <abs>,
         "created_at": "0000-00-00T00:00:00.000000Z",
         "updated_at": "0000-00-00T00:00:00.000000Z",
         "brand": {
             "id": <brand-id>,
             "name": "<brand-name>",
             "image": "<brand-image>",
             "created_at": "0000-00-00T00:00:00.000000Z",
             "updated_at": "0000-00-00T00:00:00.000000Z"
        }
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
     ```
     {
        "message": "The requested resource does not exist."
     }
     ```
     
4. **Update a Car Model**<br>
   • **Method:** `PUT`<br>
   • **URL:** `/api/car-model/{id}`<br>
   • **Parameters:** Car Model ID<br>
   • **Request Body (form-data):**
   
     ```
     Key               Type          Value
     brand_id          (text)        <update-brand-id>
     name              (text)        <update-car-model-name>
     image             (file)        <update-car-model-image(png,jpeg,jpg)>
     number_ports      (text)        <update-number-ports(int)>
     places            (text)        <update-places(int)>
     air_bag           (text)        <update-air-bag(boolean(0, 1))>
     abs               (text)        <update-abs(boolean(0, 1))>
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <car-model-id>,
        "brand_id": "<update-brand-id>",
        "name": "<update-car-model-name>",
        "image": "<update-car-model-image>",
        "number_ports": "<update-number-ports>",
        "places": "<update-places>",
        "air_bag": "<update-air-bag>",
        "abs": "<update-abs>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```

5. **Partially Update a Car Model**<br>
   • **Method:** `PATCH`<br>
   • **URL:** `/api/car-model/{id}`<br>
   • **Parameters:** Car Model ID<br>
   • **Request Body (form-data):**
   
     ```
     Key      Type       Value
     name     (text)     <update-car-model-name>
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <car-model-id>,
        "brand_id": <brand-id>,
        "name": "<update-car-model-name>",
        "image": "<car-model-image>",
        "number_ports": <number-ports>,
        "places": <places>,
        "air_bag": <air-bag>,
        "abs": <abs>,
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```
     
6. **Delete a Car Model**<br>
   • **Method:** `DELETE`<br>
   • **URL:** `/api/car-model/{id}`<br>
   • **Parameters:** Car Model ID<br>
   • **Success Response:**<br>
     **Status: 200**
    
     ```
     {
        "message": "Car Model deleted."
     }
     ```
     
   • **Response Car Model Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to delete. The requested resource does not exist."
     }
     ```

##### Cars endpoints: 

1. **Create a New Car**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/car`<br>
   • **Request Body:**<br>
   
     ```
     {
         "car_model_id": "<car-model-id>",
         "car_plate": "<car-plate>",
         "available": "<available(boolean(0, 1))>",
         "km": "<km(int)>"
     }
     ```
     
   • **Success Response:**<br>
     **Status: 201**
   
     ```
     {
        "car_model_id": "<car-model-id>",
        "car_plate": "<car-plate>",
        "available": "<available>",
        "km": "<km>",
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "id": <car-id>
     }
     ```
     
2. **Retrieve All Cars**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/car`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     [
        {
            "id": <car-id>,
            "car_model_id": <car-model-id>,
            "car_plate": "<car-plate>",
            "available": <available>,
            "km": <km>,
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "car_model": {
                "id": <car-model-id>,
                "brand_id": <brand-id>,
                "name": "<car-model-name>",
                "image": "<car-model-image>",
                "number_ports": <number-ports>,
                "places": <places>,
                "air_bag": <air-bag>,
                "abs": <abs>,
                "created_at": "0000-00-00T00:00:00.000000Z",
                "updated_at": "0000-00-00T00:00:00.000000Z"
           }
        }
     ]
     ```
     
3. **Retrieve a Single Car**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/car/{id}`<br>
   • **Parameters:** Car ID<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
         "id": <car-id>,
         "car_model_id": <car-model-id>,
         "car_plate": "<car-plate>",
         "available": <available>,
         "km": <km>,
         "created_at": "0000-00-00T00:00:00.000000Z",
         "updated_at": "0000-00-00T00:00:00.000000Z",
         "car_model": {
             "id": <car-model-id>,
             "brand_id": <brand-id>,
             "name": "<car-model-name>",
             "image": "<car-model-image>",
             "number_ports": <number-ports>,
             "places": <places>,
             "air_bag": <air-bag>,
             "abs": <abs>,
             "created_at": "0000-00-00T00:00:00.000000Z",
             "updated_at": "0000-00-00T00:00:00.000000Z"
           }
     }
     ```
     
   • **Response Car Not Found:**<br>
     **Status: 404**
     ```
     {
        "message": "The requested resource does not exist."
     }
     ```
     
4. **Update a Car**<br>
   • **Method:** `PUT`<br>
   • **URL:** `/api/car/{id}`<br>
   • **Parameters:** Car ID<br>
   • **Request Body:**
   
     ```
     {
         "car_model_id": "<update-car-model-id>",
         "car_plate": "<update-car-plate>",
         "available": "<update-available(boolean(0, 1))>",
         "km": "<update-km(int)>"
     }
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <car-id>,
        "car_model_id": "<update-car-model-id>",
        "car_plate": "<update-car-plate>",
        "available": "<update-available>",
        "km": "<update-km>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```

5. **Partially Update a Car**<br>
   • **Method:** `PATCH`<br>
   • **URL:** `/api/car/{id}`<br>
   • **Parameters:** Car ID<br>
   • **Request Body:**
   
     ```
     {
        "car_plate": "<update-car-plate>"
     }
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <car-id>,
        "car_model_id": "<car-model-id>",
        "car_plate": "<update-car-plate>",
        "available": "<available>",
        "km": "<km>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Brand Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```
     
6. **Delete a Car**<br>
   • **Method:** `DELETE`<br>
   • **URL:** `/api/car/{id}`<br>
   • **Parameters:** Car Model ID<br>
   • **Success Response:**<br>
     **Status: 200**
    
     ```
     {
        "message": "Car deleted."
     }
     ```
     
   • **Response Car Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to delete. The requested resource does not exist."
     }
     ```

##### Clients endpoints: 

1. **Create a New Client**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/client`<br>
   • **Request Body:**<br>
   
     ```
     {
         "name": "<client-name>"=
     }
     ```
     
   • **Success Response:**<br>
     **Status: 201**
   
     ```
     {
        "name": "<client-name>",
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "id": <client-id>
     }
     ```
     
2. **Retrieve All Clients**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/client`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     [
        {
            "id": <client-id>,
            "name": "<client-name>",
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z"
        }
     ]
     ```
     
3. **Retrieve a Single Client**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/client/{id}`<br>
   • **Parameters:** Client ID<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
         "id": <client-id>,
         "name": "<client-name>",
         "created_at": "0000-00-00T00:00:00.000000Z",
         "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Client Not Found:**<br>
     **Status: 404**
     ```
     {
        "message": "The requested resource does not exist."
     }
     ```
     
4. **Update a Client**<br>
   • **Method:** `PUT`<br>
   • **URL:** `/api/client/{id}`<br>
   • **Parameters:** Client ID<br>
   • **Request Body:**
   
     ```
     {
         "name": "<update-client-name>"
     }
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <client-id>,
        "name": "<update-client-name>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Cllient Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```

5. **Partially Update a Client**<br>
   • **Method:** `PATCH`<br>
   • **URL:** `/api/client/{id}`<br>
   • **Parameters:** Client ID<br>
   • **Request Body:**
   
     ```
     {
        "name": "<update-client-name>"
     }
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
        "id": <client-id>,
        "name": "<update-client-name>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z"
     }
     ```
     
   • **Response Client Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```
     
6. **Delete a Client**<br>
   • **Method:** `DELETE`<br>
   • **URL:** `/api/client/{id}`<br>
   • **Parameters:** Client ID<br>
   • **Success Response:**<br>
     **Status: 200**
    
     ```
     {
        "message": "Client deleted."
     }
     ```
     
   • **Response Client Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to delete. The requested resource does not exist."
     }
     ```

##### Rentals endpoints: 

1. **Create a New Rental**<br>
   • **Method:** `POST`<br>
   • **URL:** `/api/rental`<br>
   • **Request Body:**<br>
   
     ```
     {
         "client_id": <client-id>,
         "car_id": <car-id>,
         "start_date_period": "<start-date-period(date)>",
         "expected_end_date_period": "<expected-end-date-period(date)>",
         "actual_end_date_period": "<actual-end-date-period(date)>",
         "daily_rate": <daily-rate(numeric)>,
         "initial_km": <initial-km(int)>,
         "final_km": <initial-km(int)>
     }
     ```
     
   • **Success Response:**<br>
     **Status: 201**
   
     ```
     {
        "client_id": <client-id>,
        "car_id": <car-id>,
        "start_date_period": "<start-date-period>",
        "expected_end_date_period": "<expected-end-date-period>",
        "actual_end_date_period": "<actual-end-date-period>",
        "daily_rate": <daily-rate>,
        "initial_km": <initial-km>,
        "final_km": <final-km>,
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "id": <rental-id>
     }
     ```
     
2. **Retrieve All Rentals**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/rental`<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     [
        {
            "id": <rental-id>,
            "client_id": <client-id>,
            "car_id": <car-id>,
            "start_date_period": "<start-date-period>",
            "expected_end_date_period": "<expected-end-date-period>",
            "actual_end_date_period": "<actual-end-date-period>",
            "daily_rate": <daily-rate>,
            "initial_km": <initial-km>,
            "final_km": <final-km>,
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "client": {
                "id": <client-id>,
                "name": "<client-name>",
                "created_at": "0000-00-00T00:00:00.000000Z",
                "updated_at": "0000-00-00T00:00:00.000000Z"
            },
            "car": {
                "id": <car-id>,
                "car_model_id": <car-model-id>,
                "car_plate": "<car-plate>",
                "available": <available>,
                "km": <km>,
                "created_at": "0000-00-00T00:00:00.000000Z",
                "updated_at": "0000-00-00T00:00:00.000000Z"
            }
        }
     ]
     ```
     
3. **Retrieve a Single Rental**<br>
   • **Method:** `GET`<br>
   • **URL:** `/api/rental/{id}`<br>
   • **Parameters:** Rental ID<br>
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
         "id": <rental-id>,
         "client_id": <client-id>,
         "car_id": <car-id>,
         "start_date_period": "<start-date-period>",
         "expected_end_date_period": "<expected-end-date-period>",
         "actual_end_date_period": "<actual-end-date-period>",
         "daily_rate": <daily-rate>,
         "initial_km": <initial-km>,
         "final_km": <final-km>,
         "created_at": "0000-00-00T00:00:00.000000Z",
         "updated_at": "0000-00-00T00:00:00.000000Z",
         "client": {
             "id": <client-id>,
             "name": "<client-name>",
             "created_at": "0000-00-00T00:00:00.000000Z",
             "updated_at": "0000-00-00T00:00:00.000000Z"
         },
         "car": {
             "id": <car-id>,
             "car_model_id": <car-model-id>,
             "car_plate": "<car-plate>",
             "available": <available>,
             "km": <km>,
             "created_at": "0000-00-00T00:00:00.000000Z",
             "updated_at": "0000-00-00T00:00:00.000000Z"
         }
     }
     ```
     
   • **Response Rental Not Found:**<br>
     **Status: 404**
     ```
     {
        "message": "The requested resource does not exist."
     }
     ```
     
4. **Update a Rental**<br>
   • **Method:** `PUT`<br>
   • **URL:** `/api/rental/{id}`<br>
   • **Parameters:** Rental ID<br>
   • **Request Body:**
   
     ```
     {
         "client_id": <update-client-id>,
         "car_id": <update-car-id>,
         "start_date_period": "<update-start-date-period(date)>",
         "expected_end_date_period": "<update-expected-end-date-period(date)>",
         "actual_end_date_period": "<update-actual-end-date-period(date)>",
         "daily_rate": <update-daily-rate(numeric)>,
         "initial_km": <update-initial-km(int)>,
         "final_km": <update-initial-km(int)>
     }
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
         "id": <rental-id>,
         "client_id": <update-client-id>,
         "car_id": <update-car-id>,
         "start_date_period": "<update-start-date-period>",
         "expected_end_date_period": "<update-expected-end-date-period>",
         "actual_end_date_period": "<update-actual-end-date-period>",
         "daily_rate": <update-daily-rate>,
         "initial_km": <update-initial-km>,
         "final_km": <update-final-km>,
         "created_at": "0000-00-00T00:00:00.000000Z",
         "updated_at": "0000-00-00T00:00:00.000000Z",
     }
     ```
     
   • **Response Rental Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```

5. **Partially Update a Rental**<br>
   • **Method:** `PATCH`<br>
   • **URL:** `/api/rental/{id}`<br>
   • **Parameters:** Rental ID<br>
   • **Request Body:**
   
     ```
     {
         "start_date_period": "<update-start-date-period(date)>",
         "expected_end_date_period": "<update-expected-end-date-period(date)>",
         "actual_end_date_period": "<update-actual-end-date-period(date)>"
     }
     ```
     
   • **Success Response:**<br>
     **Status: 200**
   
     ```
     {
         "id": <rental-id>,
         "client_id": <client-id>,
         "car_id": <car-id>,
         "start_date_period": "<update-start-date-period>",
         "expected_end_date_period": "<update-expected-end-date-period>",
         "actual_end_date_period": "<update-actual-end-date-period>",
         "daily_rate": <daily-rate>,
         "initial_km": <initial-km>,
         "final_km": <final-km>,
         "created_at": "0000-00-00T00:00:00.000000Z",
         "updated_at": "0000-00-00T00:00:00.000000Z",
     }
     ```
     
   • **Response Rental Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to update. The requested resource does not exist."
     }
     ```
     
6. **Delete a Rental**<br>
   • **Method:** `DELETE`<br>
   • **URL:** `/api/rental/{id}`<br>
   • **Parameters:** Rental ID<br>
   • **Success Response:**<br>
     **Status: 200**
    
     ```
     {
        "message": "Rental deleted."
     }
     ```
     
   • **Response Rental Not Found:**<br>
     **Status: 404**
   
     ```
     {
        "message": "Unable to delete. The requested resource does not exist."
     }
     ```

---

<!-- ---------------------------------------------------------------------- -->

## Contribution

1. Fork the project.
2. Create a new branch with your changes: `git checkout -b my-feature`.
3. Save your changes and create a commit explaining what was changed: `git commit -m "feature: My new feature"`.
4. Push your changes to the main branch: `git push origin my-feature`.
5. Open a pull request on the original repository and wait for the review.

#### Contributions are always welcome! Feel free to open issues to report bugs, suggest improvements, or discuss new features.

---

<!-- ---------------------------------------------------------------------- -->

## Technologies

The following tools were used in the construction of the project:

#### **Back-End**  ([Laravel](https://laravel.com/))

• **[Laravel Sanctum](https://laravel.com/docs/11.x/sanctum)** - For OAuth token authentication.<br>
• **[Composer](https://getcomposer.org/)** - PHP dependency manager.

#### **Database**

• **[MySQL](https://www.mysql.com/)** - Database management system.

#### **Containerization** ([Docker](https://www.docker.com/))

• **[Docker](https://www.docker.com/)** - For containerizing the development environment.<br>
• **[Docker Compose](https://docs.docker.com/compose/)** - For orchestrating multiple containers.

#### **Dependency Management and Build**

• **[PHP](https://www.php.net/)** - Programming language used in the back-end.<br>

#### **Documentation and Testing**

• **[Postman](https://www.postman.com/)** - For testing API endpoints.

---

<!-- ---------------------------------------------------------------------- -->

## Author

<a href="https://www.linkedin.com/in/gabriel-veloso-2183b82b6/">
Gabriel Veloso Pinheiro</a>
 <br />
 
[![Gmail Badge](https://img.shields.io/badge/-gaabrielvelooso@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:gaabrielvelooso@gmail.com)](mailto:gaabrielvelooso@gmail.com)

---

<!-- ---------------------------------------------------------------------- -->

## License

This project is licensed under the [MIT](./LICENSE) License.

Made by Gabriel Veloso Pinheiro👋🏽 [Get in touch!](https://www.linkedin.com/in/gabriel-veloso-2183b82b6/)

