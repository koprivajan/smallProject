SMALL REGISTRATION SYSTEM VUEJS + SYMFONY 4 + REST API

# Quick start

If you want to try out the project just follow those steps:

```bash
$ docker-compose up -d
$ docker-compose exec app bash # executing bash inside app service
$ composer install
$ yarn install
$ yarn dev
$ php bin/console doctrine:migration:migrate
$ php bin/console doctrine:fixtures:load
```

On MacOS, Linux also update your `/etc/hosts` file with:

```
127.0.0.1   app.localhost
127.0.0.1   phpmyadmin.app.localhost
```

You may now go to [http://app.localhost/](http://app.localhost/) and
login using the following credentials:

Login: `foo2`
Password: `bar`
# smallProject
