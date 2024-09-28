<section class="mb-8 text-center">
    <p class="text-base sm:text-lg text-gray-700">
        Welcome to the Car Rent Pro API documentation. This free high-performance web service allows you to efficiently manage vehicle rentals. You can query and manage information on vehicles, customers, and reservations. Ideal for rental companies looking for a scalable solution to integrate into their systems.
    </p>
</section>

<section class="mb-8">
    <h2 class="text-xl sm:text-2xl text-gray-800 font-bold mb-4">Accessing the webservice</h2>
            
    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Operations Overview</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">The API supports the following CRUD operations:</p>
        <ul class="list-disc pl-6">
            <li><strong>Brands:</strong> Create, Read, Update, Delete</li>
            <li><strong>Car Models:</strong> Create, Read, Update, Delete</li>
            <li><strong>Cars:</strong> Create, Read, Update, Delete</li>
            <li><strong>Clients:</strong> Create, Read, Update, Delete</li>
            <li><strong>Rentals:</strong> Create, Read, Update, Delete</li>
        </ul>
        <p class="text-sm sm:text-base mb-2 text-gray-700">Note: Publicly, the API allows access only to the lists of brands, car models, and cars.</p>
    </div>

    <!-- /brands -->
    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Car Brands</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">Use this URL to get car brands from the system.</p>
        <a href="{{ route('brands') }}" 
            class="text-blue-700 hover:underline break-all"
        >
            carrentpro-api.onrender.com/api/brands
        </a>
    </div>
            
    <!-- /car-models -->
    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Car Models</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">Use this URL to get car models from the system.</p>
        <a href="{{ route('car-models') }}" 
            class="text-blue-700 hover:underline break-all"
        >
            carrentpro-api.onrender.com/api/car-models
        </a>
    </div>

    <!-- /cars -->
    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Cars</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">Use this URL to get cars from the system.</p>
        <a href="{{ route('cars') }}" 
            class="text-blue-700 hover:underline break-all"
        >
            carrentpro-api.onrender.com/api/cars
        </a>
    </div>

    <!-- format response -->
    <h2 class="text-xl sm:text-2xl text-gray-800 font-bold mb-4">Return Format</h2>
    <div class="mb-6">
        <p class="text-sm sm:text-base mb-2 text-gray-700">See examples of accessing the webservice and the <strong>json</strong> response:</p>
                
        <!-- car brands response -->
        <div class="mb-6">
            <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Response Example - Car Brands</h3>
            <p class="text-sm sm:text-base mb-2 text-gray-700">This example shows the response when requesting the list of available car brands:</p>
            <pre class="text-xs sm:text-sm text-gray-700 p-4 overflow-x-auto max-w-full bg-gray-200 rounded">
    [
        {
            "id": brand-id,
            "name": "brand-name",
            "image": "brand-logo.png",
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "car_models": [
                {
                    Car model(s) related to brand
                }
            ]
        }
    ]
            </pre>
        </div>

        <!-- car models response -->
        <div class="mb-6">
            <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Response Example - Car Models</h3>
            <p class="text-sm sm:text-base mb-2 text-gray-700">This example shows the response when requesting the list of available car models:</p>
            <pre class="text-xs sm:text-sm text-gray-700 p-4 overflow-x-auto max-w-full bg-gray-200 rounded">
    [
        {
            "id": car-model-id,
            "brand_id": brand-id,
            "name": "car-model-name",
            "image": "car-model-image.png",
            "number_ports": number-ports,
            "places": places,
            "air_bag": air-bag,
            "abs": abs,
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "brand": {
                Brand related to the model
            }
        }
    ]
            </pre>
        </div>

        <!-- cars response -->
        <div class="mb-6">
            <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Response Example - Cars</h3>
            <p class="text-sm sm:text-base mb-2 text-gray-700">This example shows the response when requesting the list of available cars:</p>
            <pre class="text-xs sm:text-sm text-gray-700 p-4 overflow-x-auto max-w-full bg-gray-200 rounded">
    [
        {
            "id": car-id,
            "car_model_id": car-model-id,
            "car_plate": "car-plate",
            "available": available,
            "km": km,
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "rental_id": rental-id,
            "car_model": {
                Car model(s) related to car
            },
            "rental": {
                Rental(s) related to car
            }
        }
    ]
            </pre>
        </div>
    </div>

    <h2 class="text-xl sm:text-2xl text-gray-800 font-bold mb-4">Customizing the Response</h2>
    <div class="mb-6">
        <p class="text-sm sm:text-base mb-2 text-gray-700">The webservice allows dynamic customization of the response, providing the option to select specific attributes and filter the results.</p>
    </div>

    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Selecting Attributes</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">To choose which attributes are returned in the response, you can pass the attributes parameter in the query string. This parameter should contain a comma-separated list of the desired attributes. For example:</p>
        <p class="text-sm sm:text-base mb-2 text-gray-700">URL: 
            <a href="{{ route('brands', ['attributes' => 'id,name']) }}" 
                class="text-blue-700 hover:underline break-all"
            >
                carrentpro-api.onrender.com/api/brands?attributes=id,name
            </a>
        </p>
        <pre class="text-xs sm:text-sm text-gray-700 p-4 overflow-x-auto max-w-full bg-gray-200 rounded">
    [
        {
            "id": brand-id,
            "name": "brand-name",
            "car_models": [
                {
                    Car model(s) related to brand
                }
            ]
        }
    ]
        </pre>
    </div>

    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Filtering Results</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">To filter the results based on certain criteria, you can use the filter parameter in the query string. The filter should be formatted as filter=<strong>column:comparator:value</strong>. For example:</p>
        <p class="text-sm sm:text-base mb-2 text-gray-700">URL: 
            <a href="{{ route('brands', ['filter' => 'id:=:3']) }}" 
                class="text-blue-700 hover:underline break-all"
            >
                carrentpro-api.onrender.com/api/brands?filter=id:=:3
            </a>
        </p>
        <pre class="text-xs sm:text-sm text-gray-700 p-4 overflow-x-auto max-w-full bg-gray-200 rounded">
    [
        {
            "id": 3,
            "name": "brand-name",
            "image": "brand-image.png",
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "car_models": [
                {
                    Car models related to brand
                }
            ]
        }
    ]
        </pre>
    </div>

    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Including Related Records</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">You can also include related records, such as car models, in the response by using the <strong>attributes_car_models</strong> parameter. For example:</p>
        <p class="text-sm sm:text-base mb-2 text-gray-700">URL: 
            <a href="{{ route('brands', ['attributes_car_models' => 'name,image,places']) }}" 
                class="text-blue-700 hover:underline break-all"
            >
                carrentpro-api.onrender.com/api/brands?attributes_car_models=name,image,places
            </a>
        </p>
        <pre class="text-xs sm:text-sm text-gray-700 p-4 overflow-x-auto max-w-full bg-gray-200 rounded">
    [
        {
            "id": brand-id,
            "name": "brand-name",
            "image": "brand-image.png",
            "created_at": "0000-00-00T00:00:00.000000Z",
            "updated_at": "0000-00-00T00:00:00.000000Z",
            "car_models": [
                {
                    "id": car-model-id,
                    "brand_id": brand-id,
                    "name": "car-model-name",
                    "image": "car-model-image.png",
                    "places": places
                }
            ]
        }
    ]
        </pre>
    </div>

    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Using Parameters Together</h3>
        <p class="text-sm sm:text-base mb-2 text-gray-700">You can combine these parameters in a single request for more specific results. Parameters should be separated by an ampersand <strong>&</strong> as <strong>par1&par2&par3</strong>. For example:</p>
        <p class="text-sm sm:text-base mb-2 text-gray-700">URL: 
            <a href="{{ route('brands', ['attributes' => 'id,name', 'attributes_car_models' => 'name,places', 'filter' => 'id:=:2']) }}" 
                class="text-blue-700 hover:underline break-all"
            >
                carrentpro-api.onrender.com/api/brands?attributes=id,name&attributes_car_models=name,places&filter=id:=:2
            </a>
        </p>
        <pre class="text-xs sm:text-sm text-gray-700 p-4 overflow-x-auto max-w-full bg-gray-200 rounded">
    [
        {
            "id": 2,
            "name": "brand-name",
            "car_models": [
                {
                    "id": car-model-id,
                    "brand_id": brand-id,
                    "name": "car-model-name",
                    "places": places
                }
            ]
        }
    ]
        </pre>
    </div>

    <h2 class="text-xl sm:text-2xl text-gray-800 font-bold mb-4">Custom Response Examples</h2>
    <div class="mb-6">
        <p class="text-sm sm:text-base mb-2 text-gray-700">You can customize the response for different endpoints using the following parameters:</p>
    </div>

    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Custom Response for Brands</h3>

        <div class="overflow-x-auto">      
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-800 text-white text-left text-sm uppercase font-semibold">Parameters</th>
                        <th class="py-3 px-4 bg-gray-800 text-white text-left text-sm uppercase font-semibold">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-3 px-4 text-gray-700 text-sm">attributes</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Specifies the attributes you want to return.</td>
                    </tr>
                    <tr class="border-b bg-gray-100">
                        <td class="py-3 px-4 text-gray-700 text-sm">attributes_car_models</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Includes attributes of related car models.</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 text-gray-700 text-sm">filter</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Applies filters to the results.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Custom Response for Car Models</h3>

        <div class="overflow-x-auto"> 
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-800 text-white text-left text-sm uppercase font-semibold">Parameters</th>
                        <th class="py-3 px-4 bg-gray-800 text-white text-left text-sm uppercase font-semibold">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-3 px-4 text-gray-700 text-sm">attributes</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Specifies the attributes you want to return.</td>
                    </tr>
                    <tr class="border-b bg-gray-100">
                        <td class="py-3 px-4 text-gray-700 text-sm">attributes_brand</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Includes attributes of the related brand.</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 text-gray-700 text-sm">filter</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Applies filters to the results.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-6">
        <h3 class="text-lg sm:text-xl text-gray-700 font-bold mb-4">Custom Response for Cars</h3>
                
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-3 px-4 bg-gray-800 text-white text-left text-sm uppercase font-semibold">Parameters</th>
                        <th class="py-3 px-4 bg-gray-800 text-white text-left text-sm uppercase font-semibold">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-3 px-4 text-gray-700 text-sm">attributes</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Specifies the attributes you want to return.</td>
                    </tr>
                    <tr class="border-b bg-gray-100">
                        <td class="py-3 px-4 text-gray-700 text-sm">attributes_car_model</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Includes attributes of the related car model.</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-3 px-4 text-gray-700 text-sm">filter</td>
                        <td class="py-3 px-4 text-gray-700 text-sm">Applies filters to the results.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h2 class="text-xl sm:text-2xl text-gray-800 font-bold mb-4">Installation</h2>
    <div class="mb-6">
        <p class="text-sm sm:text-base mb-2 text-gray-700">For those who want to install the project locally, you can access the repository on GitHub:</p>
        <a href="https://github.com/GabrielVelosoo/CarRentPro-API" class="text-blue-700 hover:underline break-all">
            GitHub Repository
        </a>
    </div>
</section>