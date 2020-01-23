# Box Checkout Application

An API providing the backend for an ecommerce system that allows purchasing of boxes of various sizes and strengths.

Prerequisites:
 
    - PHP version 7.0.0+, 
    - MySQL version 5.7 + 
    - Composer

## Install this Application

Clone this repo:
```
git clone git@github.com:charliecog/boxCheckout.git
```

Navigate into the newly created repo:
```
cd boxCheckout
```

One cloned, you must install the slim components by running:
```
composer install
```

To run the application locally:
```
composer start
```

Install the database ```db/box_checkout.sql``` into a db named ```box_checkout```

Ensure your local database host, username and password details are correct in:
```
src/settings.php
```

The application will now be available on:
```
localhost:8080
```

## API ENDPOINTS (ROUTES)

For testing API endpoints [Postman](https://www.getpostman.com/) is recommended. It should bypass any cross origin request issues you may find.

**Get all boxes**
----
  Returns json data of the boxes in the ```box_checkout``` database.

* **URL**

  `/api/boxes`

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
	  None

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Example Content:** 
    ```
    { 
    success: true,
    status: 200,
    message : "Boxes retrieved",
    data: [
		    {
			    "id":"1",
			    "size":"small",
			    "strength":"standard",
			    "price":"2.99" 
		    },
		    {
			    "id":"2",
			    "size":"small",
			    "strength":"strong",
			    "price":"3.29" 
		    }, 
		    ...cont
		  
		  ] 
    }
    ```
 
* **Error Response:**

  * **Code:** 404  <br />
    **Content:** 
    ```
    { 
    success: false,
    status: 404,
    message : "No boxes retrieved",
    data: [] 
    }
    ```

* **Sample Call:**

  ```javascript
    fetch('/api/boxes')
	    .then((data)=> data.json)
	    .then((boxes)=> {
		    console.log(boxes)
	    })
  ```

**Add new Order**
----
  Adds new order to the database and returns json response.

* **URL**

  `/api/order`

* **Method:**

  `POST`
  
*  **URL Params**

   **Required:**
 
	  None

* **Data Params**

    `totalPrice`: The pre-discount total price of all products.
    
    `discount`: The discount percentage to be applied.
    
    `totalPriceCharged`: The total price of all products after discount applied.
    
    `paymentId`: The id assigned by the 3rd party payment gateway.
    
    `products`: an array of json objects that each contain:
     - `pid`: product id.
     - `quantity`: the amount of that product ordered.
     
     `address`: A JSON object that contains:
     - `firstLine`
     - `secondLine`
     - `town`
     - `postcode`
     - `county`
     - `country`
     
     `user`: A JSON object that contains:
     - `title`: One of mr/mrs/miss/master/mx
     - `firstName`
     - `lastName`
     - `email`
     - `phone`
     - `businessName` (optional)
     - `secondaryPhone` (optional)
     

* **Example Content:** 
  ```
  {
    "totalPrice":"560",
    "discount":"15",
    "totalPriceCharged":"504",
    "paymentId":"8368",
    "products":[
      {
        "pid":"2",
        "quantity":"5"
      },
      {
        "pid":"4",
        "quantity":"43"
      },
      {
        "pid":"8",
        "quantity":"14"
      }
    ],
    "address":{
      "firstLine":"50 Windswept Road",
      "secondLine":"Coverdale",
      "town":"FunkyTown",
      "postcode":"TW9 4ED",
      "county":"Surrey",
      "country":"UK"
    },
    "user":{
      "title":"mrs",
      "firstName":"Barbera",
      "lastName":"Liskov",
      "email":"babz@babz.com",
      "phone":"07900387684",
      "businessName":"Babz interfaces",
      "secondaryPhone":"02073392288"
    }
  }
  ```

* **Success Response:**

  * **Code:** 200 <br />
    **Example Content:** 
    ```
    {
        "status": true,
        "message": "Order created",
        "data": {
            "orderId": "9"
        }
    }
    ```
 
* **Error Response:**

  * **Code:** 400  <br />
    **Content:** 
    ```
    { 
    success: false,
    status: 400,
    message : "Please be sure to send the data in the correct format",
    data: [] 
    }
    ```

* **Sample Call:**

  ```javascript
    fetch('/api/order', 
      {
          method: 'POST',
          body: JSON.stringify(data),
          headers: {
            'Content-type': 'application/json'
          }
      })
	    .then((data)=> data.json)
	    .then((boxes)=> {
		    console.log(boxes)
	    })
  ```
