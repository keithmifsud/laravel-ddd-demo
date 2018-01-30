# Laravel Domain Driven Design Demo

A demo application with a DDD membership domain.

A working version of this demo is available on: http://laravel-ddd-demo.keith-mifsud.me/

## Installation

Simply clone the repository:

`git clone git@github.com:keithmifsud/laravel-ddd-demo.git`

and install composer's dependencies:

`composer install`

Create a database and update a copy of the `.env.example` file:

```bash
mysql -u yourusername -p

## enter your password
create database databasename;
exit

## copy the example file
cp .env.example .env

## Fill in the details in .env

## Then migrate the database tables
php artisan migrate
```


## Documentation

The purpose of this demo is the code base itself. However, you can still register, login and update your profile. This process is intuitive once the application is running.

In this demo, you can study the separation of layers as follows:

__[Domain Layer](https://github.com/keithmifsud/laravel-ddd-demo/tree/master/src/Domain)__

The Domain Layer holds the "Business Logic". In this example, we have two contexts. One is a "Common" domain which is simply a helper domain with extensible objects. Other Bounded Contexts can have the Common domain as a dependency.

The main context for this demo, is the Member domain which is also tested here [Unit Tests](https://github.com/keithmifsud/laravel-ddd-demo/tree/master/tests/Unit/Domain/Member).

You may also notice the application of the Repository Pattern. The Domain depends on repository interfaces and not concrete implementations.

__[Infrastructure Layer](https://github.com/keithmifsud/laravel-ddd-demo/tree/master/src/Infrastructure)__

This layer handles concrete implementations related to infrastructure requirements. For the purpose of this demo, we only have Database requirements, however, in general applications you'll have other requirements such as Mailing services and external APIs.


__[Application Layer](https://github.com/keithmifsud/laravel-ddd-demo/tree/master/app)__

The Application Layer is provided by the Laravel Framework. However, the Repository Pattern is also applied here. This Layer is the glue in between the Domain and the Infrastructure layers.

Please also note that the HTTP Controllers do not handle any logic which is not related to the request or response. In this Demo, I've used Application Services to handle all internal processes with the Domain and the Infrastructure.

## Support

If you need any help or have any comments, please submit an issue on GitHub.

## Contribution

Simply fork this repository and submit a PR with your changes.

## Copyright

As per the Creative Commons community, copyright is reserved to the author:

Keith Mifsud <https://keith-mifsud.me>

## License

The Laravel framework and this demo are open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

