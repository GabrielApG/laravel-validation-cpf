## README

### Validation CPF for Laravel 5.4

## Composer required

```
composer require "gabrielapg/validador-cpf-laravel @dev"
```

### Register your provider

Insert in file config/app.php

```
ValidationCPF\CpfServiceProvider::class
```

## Publish

```
php artisan vendor:publish
```

## Change message error

In file config/cpf.php your change message error

## Example

```php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ExampleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf' => 'cpf'
        ];
    }
}
```

#### Or if you prefer you can do:

```
$this->validate($request, [
    'cpf' => 'cpf',
]);
```

### References fork
###### This package is an original fork of:
[jailtonsc/validador-cpf-laravel](https://github.com/jailtonsc/validador-cpf-laravel)