<h1 align="center"> Laravel Quick Role </h1>

<p align="center"> A package to quickly build a simple roles manager system. </p>

## Installing

```shell
$ composer require sunxyw/laravel-quick-role
```

## Usage

First, add the `Sunxyw\LaravelQuickRole\HasRole` trait to your `User` model:

```php
use Sunxyw\LaravelQuickRole\HasRole;

class User extends Authenticatable
{
    use HasRole;
}
```

Then, create a new role for testing:

```php
use Sunxyw\LaravelQuickRole\Models\Role;

Role::create([
    'name' => 'admin',
    'title' => 'Administrator',
    'color' => 'FF5555',
]);
```

Now, you can assign a role to a user by:

```php
$user = User::find(1);
$user->assignRole('admin'); // By name
$user->assignRole(Role::find(1)); // By instance
$user->assignRole(1); // By ID
```

You can check user's role by:

```php
$user->hasRole('admin'); // Accept name, ID and instance
// or
$user->hasAnyRole(['admin', 'leader']);
```

## License

MIT
