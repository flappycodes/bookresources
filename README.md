# PeopleWave: Book Resource Exam
Central Admin system for Book Resource Exam.

This is based on [Laravel Lumen 5.3 Framework](https://lumen.laravel.com/docs/5.3), its core functionality is managing the following:

* [Books](/api/v1/book)

**Local Site** - localhost:8000/api/v1/

## Setup

Required Minimum PHP Version: 5.6 +

1. Clone from: [https://github.com/flappycodes/bookresources.git](https://github.com/flappycodes/bookresources.git) download GIT from [here](https://git-scm.com/downloads).
2. Run `composer install` - download composer here: https://getcomposer.org/
3. Create database and name it `bookresources`
4. Run `php artisan migrate` - to generate all migrations including the lumen passport.

## API Available

* [Create User](/api/v1/create/user) Type `POST` - Parameters required `name`, `email`, `password`
* [Get All Book](/api/v1/book) Type `GET`
* [Edit Book](/api/v1/book/edit/{id}) Type `GET` - Parameters required `id`
* [Search Book](/api/v1/book/search/{search}) Type `GET` - Parameters required `search`
* [Create Book](/api/v1/book/create) Type `POST` - Parameters required `author_id`, `name`, `quantity`, `genre`, `price`
* [Update Book](/api/v1/book/update/{id}) Type `POST` - Parameters required `id`, `author_id`, `name`, `quantity`, `genre`, `price`
* [Delete Book](/api/v1/book/delete/{id}) Type `POST` - Parameters required `id`
* [Purchase Book](/api/v1/book/delete/{id}) Type `POST` - Parameters required `id`, `buyer_id`, `quantity`