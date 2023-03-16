# Task 5

The ToucanTech database stores information about its members. Each member can be
associated with 1 or more schools.
### Part 1
You should build a working demo that allows someone to add a new member with the fields
“Name”, “Email Address” and "School" (selected from a list).
The demo should display all members for a selected school.
### Part 2
Extend the demo with one or more of these features
- A. Add a link that downloads a CSV report listing each member, their email address, and school
- B. Show a table or bar chart that displays each school and the number of members in that school
- C. Extend the demo to include a country field for each school and add searching or displaying data by country

## Prerequisites

You will need :

- **Docker Desktop / Docker Compose**
- **PHP 8**

## Framework/Libraries
- Laravel
- Jquery
- Bootstrap

# Quick start

### 1 : Install dependencies

```shell
composer install
```

### 2 : Run the server

```shell
make run-server
```
### 2: Run the migration

```shell
make migrate
```

### Cleanup (Shutdown all the containers)
```shell
make clean
```

> Listed below are the possible improvements that could be implemented in this project.

- Generate an API documentation using swagger Swagger
- Using Test pyramid to improve the code quality
- Using External libraries to improve the coding standards like (PHP_CodeSniffer, PHPStan ...)
