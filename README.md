<h1 align="center"> 
	   Car Rent Pro
</h1>

---

<!-- ---------------------------------------------------------------------- -->

# About the Project

`Car Rent Pro` is a project created for managing vehicle rentals efficiently.

The challenge for this project was to build a RESTful API to handle the entire vehicle rental process. In this project, we implemented CRUD operations (Create, Read, Update, Delete) for brands, car models, cars, clients and rentals, ensured secure user authentication using [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum) for [JWT](https://jwt.io/introduction)-based authentication, and established a token-based authentication system with token refresh capabilities. The API also manages the rental process, from booking to returning vehicles.

The API was developed using [Laravel](https://laravel.com/), [Docker](https://www.docker.com/), and [MySQL](https://www.mysql.com/), featuring endpoints to create, retrieve, update, and delete vehicle records, as well as manage rentals. A key feature of the API is the ability to filter responses and select specific attributes of the data returned, giving users flexibility to retrieve only the information they need, such as related car models and brand attributes.

This project demonstrates strong skills in API development, secure data handling, and best programming practices, providing a robust solution for vehicle rental management.

---

<!-- ---------------------------------------------------------------------- -->

# Webservice Link

The `Car Rent Pro` is available for public access, publicly the API allows access only to the lists of brands, car models, and cars. You can use the following link to interact with the API:

#### Car Rent Pro: [https://carrentpro-api.onrender.com](https://carrentpro-api.onrender.com)

**NOTE**: If you want to download the project locally, skip to the [Local Project Download](#local-project-download) section.

<!-- ---------------------------------------------------------------------- -->

# Local Project Download

## Prerequisites

Before you begin, you will need to have the following tools installed on your machine:<br>
• [Git](https://git-scm.com/downloads)<br>
• [Docker](https://www.docker.com/products/docker-desktop) and [Docker Compose](https://docs.docker.com/compose/install/)<br>

Additionally, it is recommended to have an editor for working with the code, such as [Visual Studio Code](https://code.visualstudio.com/).

Ensure that Docker and Docker Compose are working correctly to set up and run the project environment. There is no need to install PHP or MySQL separately, as they are configured automatically within the Docker containers.

---

<!-- ---------------------------------------------------------------------- -->

## Setting Up the Environment

### 1. Download the Project

   Clone the project repository to your local machine:
   
   ```
   git clone https://github.com/GabrielVelosoo/Car-Rent-Pro
   ```
   
   Navigate to the project directory:
   
   ```
   cd Car-Rent-Pro
   ```

### 2. Configure the Application

   Copy the `.env.example` file to `.env`:
   
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
   
### 3. Configure and Run Docker

   **NOTE**: Ensure that Docker and Docker Compose are installed and working correctly.
   
   • **Start the Containers**

   Run the following command to build the images and start the containers:
   
   ```
   docker-compose up -d
   ```

   • **Stop the Containers**

   When not in use, stop the containers with:

   ```
   docker-compose down
   ```
   
### 4. Access the Project

   After setup, the API will be available at `http://localhost` (or the port you configured in docker-compose.yml).

   You can use tools like [Postman](https://www.postman.com/downloads/) or [Insomnia](https://insomnia.rest/download) to test the API endpoints.

---

<!-- ---------------------------------------------------------------------- -->

# Authentication

**NOTE**: To avoid issues, include "application/json" in the `Accept` header of your requests:

```
Accept: application/json
```

To access the API endpoints, you will need an authentication token. The API returns a [JWT](https://jwt.io/introduction) token that should be used in subsequent requests. Below are details on how to generate the token.

## Authentication Routes

**NOTE**: I recommend using [Postman](https://www.postman.com/downloads/) to test the API.

### 1. Generate Access Token
#### • Method: `POST`
#### • URL: `/api/login`
#### • Request Body:
 
```json
{
    "email": "test@example.com",
    "password": "12345"
}
```
     
#### • Success Response(200):
   
```
{
    "token": "{your-token}"
}
```
     
#### • Invalid Credentials Response(403):
   
```
{
    "message": "Credential(s) are incorrect!"
}
```
     
**NOTE**: Use the email `test@example.com` and password `12345` created when running the `php artisan db:seed` command. If you prefer, you can change the email and password by editing  `database/seeders/DatabaseSeeder.php` in the project root, updating the data as desired, and running the seeders command again. You can also add more users by updating the data in `DatabaseSeeder.php` and running `php artisan db:seed` again. 
 
### 2. Retrieve Logged-In User
#### • Method: `GET`
#### • URL: `/api/me`
#### • Headers:

```
Authorization: Bearer {your-token}
```

#### • Success Response(200):
   
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
     
### 3. Logout
#### • Method: `POST`
#### • URL: `/api/logout`
#### • Headers:

```
Authorization: Bearer {your-token}
```

#### • Success Response(200):
  
```
{
    "message": "Logout successful!"
}
```

### 4. Refresh JWT
#### • Method: `POST`
#### • URL: `/api/refresh`
#### • Headers:

```
Authorization: Bearer {your-token}
```

#### • Success Response(200):
   
```
{
    "token": "{your-token}"
}
```

#### • Invalid or Expired token Response(401):
   
```
{
    "message": "Invalid or expired token"
}
```

---

<!-- ---------------------------------------------------------------------- -->

# Usage

**NOTE**: Include "application/json" in the `Accept` header of your requests and the token in the `Authorization` header:

```
Accept: application/json
```
```
Authorization: Bearer {your-token}
```

The API offers several endpoints for managing vehicle rentals. Below are details on how to interact with each of them.

## API ENDPOINTS

### Brands endpoints: 

### 1. Create a New Brand
#### • Method: `POST`
#### • URL: `/api/brand`
#### • Request Body (form-data):
   
```
Key      Type       Value
name     (text)     <brand-name>
image    (file)     <brand-image(.png)>
```

**NOTE**: The request body must be sent in form-data format. The image field must contain an image file in PNG format (.png).
     
#### • Success Response(201):
   
```
{
    "name": "<brand-name>",
    "image": "<brand-image>",
    "updated_at": "0000-00-00T00:00:00.000000Z",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "id": <brand-id>
}
```
     
### 2. Retrieve All Brands
#### • Method: `GET`
#### • URL: `/api/brand`
#### • Success Response(200):
   
```
[
    {
        "id": <brand-id>,
        "name": "<brand-name>",
        "image": "<brand-image>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "car_models": [
            {
                Car model(s) related brand
            }
        ]
    }
}
```
     
### 3. Retrieve a Single Brand
#### • Method: `GET`
#### • URL: `/api/brand/{id}`
#### • Parameters: Brand ID
#### • Success Response(200):
   
```
{
    "id": <brand-id>,
    "name": "<brand-name>",
    "image": "<brand-image>",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "updated_at": "0000-00-00T00:00:00.000000Z",
    "car_models": [
        {
            Car model(s) related brand
        }
    ]
}
```
     
### 4. Update a Brand

**Notice: Updating Records with Files**<br>

To perform updates on records that require a file and are of type form-data, the update must be made using the `POST` method. It is necessary to pass the parameter `_method` in the request body with the value `PUT` or `PATCH`.

#### • Method: `POST`
#### • URL: `/api/brand/{id}`
#### • Parameters: Brand ID
#### • Request Body (form-data):
   
```
Key        Type       Value
name       (text)     <update-brand-name>
image      (file)     <update-brand-image(.png)>
_method    (text)     <PUT>
```
     
#### • Success Response(200):
   
```
{
    "id": <brand-id>,
    "name": "<update-brand-name>",
    "image": "<update-brand-image>",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "updated_at": "0000-00-00T00:00:00.000000Z"
}
```

### 5. Partially Update a Brand

**Notice: Updating Records with Files**<br>

To perform updates on records that require a file and are of type form-data, the update must be made using the `POST` method. It is necessary to pass the parameter `_method` in the request body with the value `PUT` or `PATCH`.

#### • Method: `POST`
#### • URL: `/api/brand/{id}`
#### • Parameters: Brand ID
####• Request Body (form-data):
   
```
Key        Type       Value
name       (text)     <update-brand-name>
_method    (text)     <PATCH>
```
     
#### • Success Response(200):
   
```
{
    "id": <brand-id>,
    "name": "<update-brand-name>",
    "image": "<brand-image>",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "updated_at": "0000-00-00T00:00:00.000000Z"
}
```
     
### 6. Delete a Brand
#### • Method: `DELETE`
#### • URL: `/api/brand/{id}`
#### • Parameters: Brand ID
#### • Success Response(200):
    
```
{
    "message": "Brand deleted."
}
```

### Car Models endpoints: 

### 1. Create a New Car Model
#### • Method: `POST`
#### • URL: `/api/car-model`
#### • Request Body (form-data):
   
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

**NOTE**: The request body must be sent in form-data format. The image field must contain an image file in PNG format (.png, .jpeg, .jpg).
     
#### • Success Response(201):
   
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
     
### 2. Retrieve All Car Models
#### • Method: `GET`
#### • URL: `/api/car-model`
#### • Success Response(200):
   
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
            Brand related to car model
        }
    }
]
```
     
### 3. Retrieve a Single Car Model
#### • Method: `GET`
#### • URL: `/api/car-model/{id}`
#### • Parameters: Car Model ID
#### • Success Response(200):
   
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
        Brand related to car model
    }
}
```
     
### 4. Update a Car Model

**Notice: Updating Records with Files**<br>

To perform updates on records that require a file and are of type form-data, the update must be made using the `POST` method. It is necessary to pass the parameter `_method` in the request body with the value `PUT` or `PATCH`.

#### • Method: `POST`
#### • URL: `/api/car-model/{id}`
#### • Parameters: Car Model ID
#### • Request Body (form-data):
   
```
Key               Type          Value
brand_id          (text)        <update-brand-id>
name              (text)        <update-car-model-name>
image             (file)        <update-car-model-image(png,jpeg,jpg)>
number_ports      (text)        <update-number-ports(int)>
places            (text)        <update-places(int)>
air_bag           (text)        <update-air-bag(boolean(0, 1))>
abs               (text)        <update-abs(boolean(0, 1))>
_method           (text)        <PUT>
```
     
#### • Success Response(200):
   
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

### 5. Partially Update a Car Model

**Notice: Updating Records with Files**<br>

To perform updates on records that require a file and are of type form-data, the update must be made using the `POST` method. It is necessary to pass the parameter `_method` in the request body with the value `PUT` or `PATCH`.

#### • Method: `POST`
#### • URL: `/api/car-model/{id}`
#### • Parameters: Car Model ID
#### • Request Body (form-data):
   
```
Key      Type       Value
name     (text)     <update-car-model-name>
_method  (text)     <PATCH>
```
     
#### • Success Response(200):
   
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
     
### 6. Delete a Car Model
#### • Method: `DELETE`
#### • URL: `/api/car-model/{id}`
#### • Parameters: Car Model ID
#### • Success Response(200):
 
```
{
    "message": "Car Model deleted."
}
```

### Cars endpoints: 

### 1. Create a New Car
#### • Method: `POST`
#### • URL: `/api/car`
#### • Request Body:
   
```
{
    "car_model_id": "<car-model-id>",
    "car_plate": "<car-plate(8-digits)>",
    "available": "<available(boolean(0, 1))>",
    "km": "<km(int)>"
}
```
     
#### • Success Response(201):
   
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
     
### 2. Retrieve All Cars
#### • Method: `GET`
#### • URL: `/api/car`
#### • Success Response(200):
   
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
            Car model related to car
        }
    }
]
```
     
### 3. Retrieve a Single Car
#### • Method: `GET`
#### • URL: `/api/car/{id}`
#### • Parameters: Car ID
#### • Success Response(200):
   
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
        Car model related to car
    }
}
```
     
### 4. Update a Car
#### • Method: `PUT`
#### • URL: `/api/car/{id}`
#### • Parameters: Car ID
#### • Request Body:
   
```
{
    "car_model_id": "<update-car-model-id>",
    "car_plate": "<update-car-plate(8-digits)>",
    "available": "<update-available(boolean(0, 1))>",
    "km": "<update-km(int)>"
}
```
     
#### • Success Response(200):
   
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

### 5. Partially Update a Car
#### • Method: `PATCH`
#### • URL: `/api/car/{id}`
#### • Parameters: Car ID
#### • Request Body:
   
```
{
    "car_plate": "<update-car-plate(8-digits)>"
}
```
     
#### • Success Response(200):
   
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
     
### 6. Delete a Car
#### • Method: `DELETE`
#### • URL: `/api/car/{id}`
#### • Parameters: Car Model ID
#### • Success Response(200):
    
```
{
    "message": "Car deleted."
}
```

### Clients endpoints: 

### 1. Create a New Client
#### • Method: `POST`
#### • URL: `/api/client`
#### • Request Body:
   
```
{
    "name": "<client-name>"
}
```
     
#### • Success Response(201):
   
```
{
    "name": "<client-name>",
    "updated_at": "0000-00-00T00:00:00.000000Z",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "id": <client-id>
}
```
     
### 2. Retrieve All Clients
#### • Method: `GET`
#### • URL: `/api/client`
#### • Success Response(200):
   
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
     
### 3. Retrieve a Single Client
#### • Method: `GET`
#### • URL: `/api/client/{id}`
#### • Parameters: Client ID
#### • Success Response(200):
   
```
{
    "id": <client-id>,
    "name": "<client-name>",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "updated_at": "0000-00-00T00:00:00.000000Z"
}
```
     
### 4. Update a Client
#### • Method: `PUT`
#### • URL: `/api/client/{id}`
#### • Parameters: Client ID
#### • Request Body:
   
```
{
    "name": "<update-client-name>"
}
```
     
#### • Success Response(200):
   
```
{
    "id": <client-id>,
    "name": "<update-client-name>",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "updated_at": "0000-00-00T00:00:00.000000Z"
}
```

### 5. Partially Update a Client
#### • Method: `PATCH`
#### • URL: `/api/client/{id}`
#### • Parameters: Client ID
#### • Request Body:
   
```
{
    "name": "<update-client-name>"
}
```
     
#### • Success Response(200):
   
```
{
    "id": <client-id>,
    "name": "<update-client-name>",
    "created_at": "0000-00-00T00:00:00.000000Z",
    "updated_at": "0000-00-00T00:00:00.000000Z"
}
```
     
### 6. Delete a Client
#### • Method: `DELETE`
#### • URL: `/api/client/{id}`
#### • Parameters: Client ID
#### • Success Response(200):
    
```
{
    "message": "Client deleted."
}
```

### Rentals endpoints: 

### 1. Create a New Rental
#### • Method: `POST`
#### • URL: `/api/rental`
#### • Request Body:
   
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
     
#### • Success Response(201):
   
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
     
### 2. Retrieve All Rentals
#### • Method: `GET`
#### • URL: `/api/rental`
#### • Success Response(200):
   
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
            Client related to the rental
        },
        "car": {
            Car related to the rental
        }
    }
]
```
     
### 3. Retrieve a Single Rental
#### • Method: `GET`
#### • URL: `/api/rental/{id}`
#### • Parameters: Rental ID
#### • Success Response(200):
   
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
        Client related to the rental
    },
    "car": {
        Car related to the rental
    }
}
```
     
### 4. Update a Rental
#### • Method: `PUT`
#### • URL: `/api/rental/{id}`
#### • Parameters: Rental ID
#### • Request Body:
   
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
     
#### • Success Response(200):
   
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

### 5. Partially Update a Rental
#### • Method: `PATCH`
#### • URL: `/api/rental/{id}`
#### • Parameters: Rental ID
#### • Request Body:
   
```
{
    "start_date_period": "<update-start-date-period(date)>",
    "expected_end_date_period": "<update-expected-end-date-period(date)>",
    "actual_end_date_period": "<update-actual-end-date-period(date)>"
}
```
     
#### • Success Response(200):
   
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

### 6. Delete a Rental
#### • Method: `DELETE`
#### • URL: `/api/rental/{id}`
#### • Parameters: Rental ID
#### • Success Response(200):
    
```
{
    "message": "Rental deleted."
}
```

## Response Request Not Found (Status: 404)

### Response request not found (GET)

```
{
    "message": "The requested resource does not exist."
}
```

### Response request not found (PUT/PATCH)

```
{
    "message": "Unable to update. The requested resource does not exist."
}
```

### Response request not found (DELETE)

```
{
    "message": "Unable to delete. The requested resource does not exist."
}
```

## Customizing the Response

API endpoints allow dynamic customization of the response by providing the option to select specific attributes and filter the results.

### Selecting Attributes

To choose which attributes are returned in the response, you can pass the `attributes` parameter in the query string. This parameter should contain a comma-separated list of the desired attributes. For example:

#### • Method: `GET`
#### • URL: `/api/brand?attributes=id,name`
#### • Success Response(200):

```
[
    {
        "id": <brand-id>,
        "name": "<brand-name>",
        "car_models": [
            Brand related models
        ]
    }
]
 ```

This will return only the id and name attributes of each brand.

### Filtering Results

To filter the results based on certain criteria, you can use the `filter` parameter in the query string. The filter should be formatted as filter=`column:comparator:value`. For example:

#### • Method: `GET`
#### • URL: `/api/brand?filter=id:=:6`
#### • Success Response(200):

```
[
    {
        "id": 6,
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

This will return only brands that match the filter criteria (e.g. brand with id "6").
  
#### You can also combine multiple filter conditions using a semicolon `;`. For example:

#### • Method: `GET`
#### • URL: `/api/brand?filter=name:like:%o%;id:=:1`

### Including Related Records

You can also include related records, such as car models, in the response by using the `attributes_car_models` parameter. For example:

#### • Method: `GET`
#### • URL: `/api/brand?attributes_car_models=name,image,places`
#### • Success Response(200):

```
[
    {
        "id": <brand-id>,
        "name": "<brand-name>",
        "image": "<brand-image>",
        "created_at": "0000-00-00T00:00:00.000000Z",
        "updated_at": "0000-00-00T00:00:00.000000Z",
        "car_models": [
            {
                "id": <car-model-id>,
                "brand_id": <brand-id>,
                "name": "<car-model-name>",
                "image": "<car-model-image>",
                "places": <places>
            }
        ]
    }
]
```

This will include related car models with only the name, image and places attributes. If no specific attributes are provided, all related car models will be returned.

### Using Parameters Together

You can combine these parameters in a single request for more specific results. Parameters should be separated by an ampersand `&` as `par1&par2&par3`. For example:

#### • Method: `GET`
#### • URL: `/api/brand?attributes=id,name&attributes_car_models=name,places&filter=name:like:bm%`
#### • Success Response(200):

```
[
    {
        "id": <brand-id>,
        "name": "BMW",
        "car_models": [
            {
                "id": <car-model-id>,
                "brand_id": <brand-id>,
                "name": "<car-model-name>",
                "places": <places>
            }
        ]
    }
]
```

This request will return only the id and name attributes of brands that match the filter criteria (e.g., brands with the name like "bm%"), and it will also include related car models 
with only the name and places attributes.

## Custom Response Examples

You can customize the response for different endpoints using the following parameters:

### Custom Response for Brands

**Parameters**:<br>
    • **attributes**: Specifies the attributes you want to return.<br>
    • **attributes_car_models**: Includes attributes of related car models.<br>
    • **filter**: Applies filters to the results.
    
### Custom Response for Car Models
    
**Parameters**:<br>
    • **attributes**: Specifies the attributes you want to return.<br>
    • **attributes_brand**: Includes attributes of the related brand.<br>
    • **filter**: Applies filters to the results.
    
### Custom Response for Cars
    
**Parameters**:<br>
    • **attributes**: Specifies the attributes you want to return.<br>
    • **attributes_car_model**: Includes attributes of the related car model.<br>
    • **filter**: Applies filters to the results.
    
### Custom Response for Clients
    
**Parameters**:<br>
    • **attributes**: Specifies the attributes you want to return.<br>
    • **filter**: Applies filters to the results.
    
### Custom Response for Rentals
    
**Parameters**:<br>
    • **attributes**: Specifies the attributes you want to return.<br>
    • **attributes_client**: Includes attributes of the related client.<br>
    • **attributes_car**: Includes attributes of the related car.<br>
    • **filter**: Applies filters to the results.

---

<!-- ---------------------------------------------------------------------- -->

# Contribution

#### 1. Fork the project.
#### 2. Create a new branch with your changes: `git checkout -b my-feature`.
#### 3. Save your changes and create a commit explaining what was changed: `git commit -m "feature: My new feature"`.
#### 4. Push your changes to the main branch: `git push origin my-feature`.
#### 5. Open a pull request on the original repository and wait for the review.

### Contributions are always welcome! Feel free to open issues to report bugs, suggest improvements, or discuss new features.

---

<!-- ---------------------------------------------------------------------- -->

# Technologies

The following tools were used in the construction of the project:

#### **Back-End**  ([Laravel](https://laravel.com/))

• **[Laravel Sanctum](https://laravel.com/docs/11.x/sanctum)** - For OAuth token authentication.<br>
• **[Composer](https://getcomposer.org/)** - PHP dependency manager.

#### **Database**

• **[PostgreSQL](https://www.postgresql.org/)** - Database management system.<br>
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

# Author

<a href="https://www.linkedin.com/in/gabriel-veloso-2183b82b6/">
Gabriel Veloso Pinheiro</a>
<br /><br />
 
[![Gmail Badge](https://img.shields.io/badge/-gaabrielvelooso@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:gaabrielvelooso@gmail.com)](mailto:gaabrielvelooso@gmail.com)

---

<!-- ---------------------------------------------------------------------- -->

# License

#### This project is licensed under the [MIT](./LICENSE) License.

#### Made by Gabriel Veloso Pinheiro👋🏽 [Get in touch!](https://www.linkedin.com/in/gabriel-veloso-2183b82b6/)

