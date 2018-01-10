# ids

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Scrutinizer Code Quality][ico-code-quality]][link-scrutinizer]
[![Code Coverage][ico-scrutinizer]][link-scrutinizer]

A simple PHP IDS based on Expose / PHPIDS rules.

## Install

Via Composer

``` bash
$ composer require vakata/ids
```

## Usage

``` php
$ids = new \vakata\ids\IDS();
$impact = $ids->analyzeData(['get' => $_GET, 'post' => $_POST ]);
```

Read more in the [API docs](docs/README.md)

## Testing

``` bash
$ composer test
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email github@vakata.com instead of using the issue tracker.

## Credits

- [vakata][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information. 

[ico-version]: https://img.shields.io/packagist/v/vakata/ids.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/vakata/ids/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/vakata/ids.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/vakata/ids.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/vakata/ids.svg?style=flat-square
[ico-cc]: https://img.shields.io/codeclimate/github/vakata/ids.svg?style=flat-square
[ico-cc-coverage]: https://img.shields.io/codeclimate/coverage/github/vakata/ids.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/vakata/ids
[link-travis]: https://travis-ci.org/vakata/ids
[link-scrutinizer]: https://scrutinizer-ci.com/g/vakata/ids/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/vakata/ids
[link-downloads]: https://packagist.org/packages/vakata/ids
[link-author]: https://github.com/vakata
[link-contributors]: ../../contributors
[link-cc]: https://codeclimate.com/github/vakata/ids

