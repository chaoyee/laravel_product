### Laravel_product

![Laravel_product](https://lh3.googleusercontent.com/R6iFW1zs2Pe9BC1jmHpm82uJaNVLJ4J1NbIzhb45-DDEUuBzfzowe1Tl5EMFRFMgQDFvGa1EqHLrKlyy9HJ9VVIlQyex1Ck9Z1CRUSsaV7N_avmOMQpv7IINJHJcCeTDjMtVqDvhsA=w767-h553-no)

Laravel is an excellent PHP framework for web development.  It creates a RESTful web app with just a few commands. This is a simple Laravel CRUD app.

The blog article about how to create this app is [here](https://charles4code.blogspot.com/2018/12/a-simple-laravel-crud-app_24.html). 

#### Version 1 branch:[01_basic](https://github.com/chaoyee/laravel_product/tree/01_basic): 

Version 1 is just a simple CRUD app with Laravel. It has a product page with pagination. Users can review all the products without user login. In addition, users can create, edit, update and delete any single product.  

#### Version 2 branch:[02_cart_checkout](https://github.com/chaoyee/laravel_product/tree/02_cart_checkout):

It implements many features in version 2 such as:

- Addition of model User, user login and authentication.
- Administrator privilege.
- Shopping cart and cart page. 
- Addition of isAdmin() helper, middleware IsAdmin and customized directive isAdmin.
- Modification of message box.
- Addition of model Address.
- Addition of changing password functionality. 

These features turns a simple product review app into a simple on-line shop. It utilizes the default user authentication features built in Laravel, which makes developers' lives easier.

#### Version 3 branch: [master](https://github.com/chaoyee/laravel_product):

In this version, there are:
- Model Order and OrderDetail are created. 
- All the checkout processes are implemented.

Therefore, it now can perform a real-world on-line shopping transaction.  
