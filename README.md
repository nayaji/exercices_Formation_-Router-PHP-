# PHP-router

# PHP Router exercise

- Repository : `router`
- Type of Challenge : `Learning`
- Duration : `1 day`
- Team challenge : `solo`

## Intro

Whenever you create a PHP application, you don't really want any user to access
all of your files directly from the browser.

Imagine you have a configuration file in your project, containing information regarding
your database connection. It *needs* to be protected from malicious users. Another example would be
your _composer.json_ file, if you have one : If the user knows which package you are using, it
makes it easier for them to find a security breach to attack your application.

A common way to protect your application is to restrict the access to a *public/* directory that will
be separate from the rest of your application. Once your server is correctly set up, *every* request will have to
go through the *public/* directory before being dispatched to the correct file.

The part of the code that dispatches the requests to the correct part of your app is caller a **Router**.

## Learning objectives

- Understand the basics of using a web server such as Nginx or Apache.
- Understand the concept of routing, and implement a router.

## 🌱 The basics

- [ ] Implement a simple router that redirects every request from your _index.php_ file to other files in the _app_ directory 
such as _/app/views/homepage.php_ or _/app/views/contact.php_.
<br/>Note : the url of your requests should _not_ contain a _.php_ extension.
- [ ] For that, you will need to configure your Apache server


- [ ] Make sure your routes redirecting to a web page _only_ accept a GET request.

> Ressource: https://www.freecodecamp.org/news/how-to-build-a-routing-system-in-php/


## 🌼 Nice to have

- [ ] Create a 404 page and redirects to it whenever the request points to a non-existing route. Do not forget to return a 404 status code !


## 🌳 Hard to have: Refactor to OOP

- [ ] Refactor your code to create a _Router_ class that will handle all requests coming into your _/index.php_ file
and dispatch them to the correct file.


- [ ] Create a _Request_ class that can give you information about the current HTTP request. The return values of
  some of its methods should be passed to the Router.

