# Laravel API Response Helpers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/your-vendor/laravel-api-helpers.svg?style=flat-square)](https://packagist.org/packages/your-vendor/laravel-api-helpers)
[![Total Downloads](https://img.shields.io/packagist/dt/your-vendor/laravel-api-helpers.svg?style=flat-square)](https://packagist.org/packages/your-vendor/laravel-api-helpers)
[![Tests](https://github.com/your-vendor/laravel-api-helpers/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/your-vendor/laravel-api-helpers/actions/workflows/run-tests.yml)
[![License](https://img.shields.io/packagist/l/your-vendor/laravel-api-helpers.svg?style=flat-square)](https://packagist.org/packages/your-vendor/laravel-api-helpers)

A elegant and consistent API response helper package for Laravel applications. Simplify your API responses with standardized JSON formats and proper HTTP status codes.

## Requirements

- PHP 8.3 or higher
- Laravel 11.0 or higher

## Installation

You can install the package via composer:

```bash
composer require your-vendor/laravel-api-helpers
```

## Usage

Add the `ApiResponseHelpers` trait to your controller:

```php
use YourVendor\ApiHelpers\Traits\ApiResponseHelpers;

class ApiController extends Controller
{
    use ApiResponseHelpers;
    
    public function index()
    {
        return $this->respondWithSuccess(['data' => $users]);
    }
}
```

### Available Methods

#### Success Responses

```php
// Return 200 with default success response
return $this->respondWithSuccess();

// Return 200 with custom data
return $this->respondWithSuccess(['data' => $users]);

// Return 200 with simple message
return $this->respondOk('Operation completed successfully');

// Return 201 for resource creation
return $this->respondCreated(['id' => $user->id]);

// Return 204 for no content
return $this->respondNoContent();
```

#### Error Responses

```php
// Return 404 Not Found
return $this->respondNotFound('User not found');

// Return 401 Unauthorized
return $this->respondUnAuthenticated('Please login');

// Return 403 Forbidden
return $this->respondForbidden('Not allowed');

// Return 400 Bad Request
return $this->respondError('Invalid parameters');

// Return 422 Validation Error
return $this->respondFailedValidation('Validation failed');
```

#### Custom Success Response

You can customize the default success response:

```php
// In your constructor or middleware
$this->setDefaultSuccessResponse(['status' => 'ok']);

// Now respondWithSuccess() will use this format
return $this->respondWithSuccess(); // Returns: {"status": "ok"}
```

### Supported Data Types

The package supports various data types for responses:

- Arrays
- Laravel Collections
- Objects implementing Arrayable
- Objects implementing JsonSerializable

```php
// Using with Laravel Collection
$users = User::all();
return $this->respondWithSuccess($users);

// Using with API Resource
$resource = UserResource::make($user);
return $this->respondWithSuccess($resource);
```

## Response Format Examples

### Success Response
```json
{
    "success": true
}
```

### Success Response with Data
```json
{
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

### Error Response
```json
{
    "error": "Resource not found"
}
```

### Validation Error Response
```json
{
    "message": "The given data was invalid"
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Your Name](https://github.com/yourusername)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
```

### Additional Files

You might also want to create these supporting files:

1. `CHANGELOG.md`:
```markdown
# Changelog

All notable changes to `laravel-api-helpers` will be documented in this file

## 1.0.0 - 202X-XX-XX

- initial release
```

2. `CONTRIBUTING.md`:
```markdown
# Contributing

Contributions are welcome and will be fully credited.

Please read and understand the contribution guide before creating an issue or pull request.

## Etiquette

This project is open source, and as such, the maintainers give their free time to build and maintain the source code held within. They make the code freely available in the hope that it will be of use to other developers. It would be extremely unfair for them to suffer abuse or anger for their hard work.

Please be considerate towards maintainers when raising issues or presenting pull requests.

## Requirements

If the project maintainer has any additional requirements, you will find them listed here.

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to install [PHP Code Sniffer](https://pear.php.net/package/PHP_CodeSniffer).

- **Add tests!** - Your patch won't be accepted if it doesn't have tests.

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](https://semver.org/). Randomly breaking public APIs is not an option.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

## Happy coding!
