
# Italian VAT

Small POC project as a test for QBind, to assess programming capabilities. The software is based on a Laravel 12 scaffolding structure.

## Objective

The idea of the project is to create a simple application that can validate VAT numbers in Italian format. 
The application should be able to handle those numbers, check if they are valid or not and fixe them when possible.

The VAT number types valid to be processed are:
1. A number consisting of the tuple "IT" + 11 digits (VALID)
2. A number consisting of 11 digits (INVALID BUT ABLE TO BE FIXED BY PREFIXING "IT")
3. A set of characters different from 11 digits or a string of non digits (INVALID AND NOT ABLE TO BE FIXED) 

Example from the test documentation:

- IT12345678901 => valid
- 98765432158 => corrected in IT98765432158
- IT12345 => not valid, as we can't guess the missing digits
- 123-hello => not valid as it contains non-digit characters

## Installation

Clone or download the repository and run the following commands, after the code has been cloned:

```bash
  composer install
  cp .env.example .env
  php artisan key:generate
  php artisan migrate
  php artisan db:seed
```
These commands wil set up the Laravel environment, generate an application key, run migrations, and seed the database with initial data.
In order to use the application, you will need to set up a database connection in the `.env` file, in my case I used MySQL
with:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vat
DB_USERNAME=root
DB_PASSWORD=root
```

Of course feel free to change it to your own database configuration.

# Routes

The application has two main routes defined in the `routes/web.php` file:

- `<base-url>/` Redirects to `<base-url>/vat-processing` which is the index page, with all the VAT numbers listed & paginated
- `<base-url>/vat-processing/create` Upload file page to upload a CSV file with VAT numbers to be processed
- `<base-url>/vat-processing/validate` Validates a single VAT number, which can be entered in a form on the page


## Architecture & Structure

The project is structured in a standard Laravel way, with the following main standard directories, as a reminder:

- `app/`: Contains the application logic, including models, controllers, and services.
- `database/`: Contains the database migrations and seeders.
- `resources/`: Contains the views and assets.
- `routes/`: Contains the route definitions for the application.
- `tests/`: Contains the tests for the application.
- `config/`: Contains the configuration files for the application.
- `public/`: Contains the public assets, such as CSS, JavaScript, and images.
- `storage/`: Contains the storage files, such as logs and cached data.
- `vendor/`: Contains the third-party packages installed via Composer.
- `composer.json`: The Composer configuration file, which defines the dependencies of the project.

The custom app itself is located in the `app/` directory, with the following main components:

- `app/Http/Controllers/VatProcessingController`
- `app/Http/Controllers/SingleVatProcessingController`

### VatProcessingController

This controller handles the main VAT processing logic, including displaying the list of VAT numbers, validating them, and uploading CSV files.
The `index` method retrieves and displays the list of VAT numbers, paginated for better user experience, 
the `create` method displays the form for uploading a CSV file, and the `store` method processes the uploaded file, 
validates the VAT numbers, and saves them to the database.

### SingleVatProcessingController

This controller handles the validation of a single VAT number. It provides a method to validate a single VAT number via 
a form submission. The `validate` method checks the VAT number format, determines if it is valid or can be fixed, 
and returns the result to the user.

### VatProcessingLogic, VatStrategyFactory & VatProcessingStrategyInterface

This class encapsulates the logic needed to process VAT numbers. It uses a factory to get a specific strategy in order to 
process specific VAT numbers (In this case, only Italian VAT) but essentially **it can be extended to support other VAT formats as well**.

The way to extend the functionality is to create a new class that implements the `VatProcessingStrategyInterface`, 
implement in the new strategy whatever logic/algorithm needed for the new VAT number/country, and finally update the
factory to return the new class when needed. 

### Observations for the architecture

Although the project meant to be s simple VAT processing system, it has several interesting points to note:

- **Use of Design Patterns**: The application uses the Factory design pattern to create instances of VAT processing strategies. 
  This allows for easy extension and modification of the VAT processing logic without changing the existing code.

- **Validation Logic**: The validation logic is encapsulated in a separate class (`VatProcessingLogic`), which makes it reusable and testable.
- 
- **Separation of Concerns**: The application is structured in a way that separates the concerns of different components, 
  such as controllers, services, and models. This makes the code easier to maintain and extend.

- **Extensibility**: The use of a strategy pattern allows for easy extension of the VAT processing logic.

- **Testing**: The application includes tests for the VAT processing logic, ensuring that the functionality works as expected.

## Testing

The application includes tests for the VAT processing logic, which can be found in the `tests/Unit` directory. For time constraints,
I skipped Feature tests for both controllers, but they can be easily added in the future.
To run the tests, you can use the following command:

```bash
  php artisan test
```
Or execute them individually or via PHPUnit directly (Included with Laravel by default)

## Deployment

I used a local server provided by Laravel, which is started with the command:

```bash
  php artisan serve
```

That will serve the application on `http://localhost:8000` by default, but you can change the port if needed with the `--port` option
like so:

```bash
  php artisan serve --port=8080
```
