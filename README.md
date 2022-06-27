![](https://banners.beyondco.de/Laravel%20Pagination%20Merge.png?theme=light&packageManager=composer+require&packageName=aneeskhan47%2Flaravel-pagination-merge&pattern=architect&style=style_1&description=Merge+multiple+laravel+paginate+instances&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)
# Pagination Merge for Laravel 5/6/7/8/9

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aneeskhan47/laravel-pagination-merge.svg?style=flat-square)](https://packagist.org/packages/aneeskhan47/laravel-pagination-merge)
[![Total Downloads](https://img.shields.io/packagist/dt/aneeskhan47/laravel-pagination-merge.svg?style=flat-square)](https://packagist.org/packages/aneeskhan47/laravel-pagination-merge)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/aneeskhan47/laravel-pagination-merge/run-tests?label=tests)](https://github.com/aneeskhan47/laravel-pagination-merge/actions?query=workflow%3Arun-tests+branch%3Amain)

A simple laravel pagination merge package that allows you to merge multiple `->paginate()` instances.

### Some Background

I had to deal with something like that in a project i was working on, where in one of the pages i had to display two type of publication paginated and sorted by the created_at field. In my case it was a **Post** model and an **Event** Model (hereinafter referred to as publications).

The only difference is i didn't want to get all the publications from database then merge and sort the results, as you can imagine it would rise a performance issue if we have hundreds of publications.

So i figure out that it would be more convenient to paginate each model and only then, merge and sort them. that's why i built this package.

This package is heavily inspired by this stackoverflow [answer](https://stackoverflow.com/a/58252907)

## Installation

### For Laravel 5.5+

Require this package with composer:

```
composer require aneeskhan47/laravel-pagination-merge
```

The service provider will be auto-discovered. You do not need to add the provider anywhere.

### For Laravel 5.0 to 5.4

Require this package with composer:

```
composer require aneeskhan47/laravel-pagination-merge
```

Find the `providers` key in `config/app.php` and register the PaginationMerge Service Provider.

```php
'providers' => [
    // ...
    Aneeskhan47\PaginationMerge\PaginationMergeServiceProvider::class,
]
```

Find the `aliases` key in `config/app.php` and register the PaginationMerge alias.

```php
'aliases' => [
    // ...
    'PaginationMerge' => Aneeskhan47\PaginationMerge\Facades\PaginationMerge::class,
]
```

## Usage

```php
use App\Models\Post;
use App\Models\Event;
use Aneeskhan47\PaginationMerge\Facades\PaginationMerge;


class PublicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = Event::latest()->paginate(5);
        $posts = Post::latest()->paginate(5);

        $publications = PaginationMerge::merge($events, $posts)
                                       ->sortByDesc('created_at')
                                       ->get();

        // since get() will return \Illuminate\Pagination\LengthAwarePaginator
        // you can continue using paginator methods like these etc:

        $publications->withPath('/admin/users')
                     ->appends(['sort' => 'votes'])
                     ->withQueryString()
                     ->fragment('users');

        return view('publications.index', compact('publications'));
    }
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email kingkhan2388@gmail.com instead of using the issue tracker.

## Credits

- [Anees Khan](https://github.com/aneeskhan47)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

