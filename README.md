# Laravel Domain Driven Design Demo

A demo application with a DDD membership domain.

## Installation

Simply clone the repository:

`git clone git@github.com:keithmifsud/laravel-ddd-demo.git`

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

... in process



## Support

If you need any help or have any comments, please submit an issue on GitHub.

## Contribution

Simply fork this repository and submit a PR with your changes.

## Copyright

As per the Creative Commons community, copyright is reserved to the author:

Keith Mifsud <https://keith-mifsud.me>

## License

The Laravel framework and this demo are open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

