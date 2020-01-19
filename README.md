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

