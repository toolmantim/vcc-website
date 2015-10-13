# Victorian Climbing Club Website

New website for the Victorian Climbing Club :muscle:, by [Tim Lucas](https://github.com/toolmantim) & [Josh Bassett](https://github.com/nullobject)

[![Arapiles by Glenn Tempest](http://i.imgur.com/jynMzO8.jpg)](http://osp.com.au/?p=294) <br> *[Arapiles by Glenn Tempest](http://osp.com.au/?p=294) [(by-nc-nd)](http://creativecommons.org/licenses/by-nc-nd/3.0/)*

## Getting Started (OSX)

Get started:

* `docker-compose build && docker-compose up`
* `open "http://$(boot2docker ip):8080"`
* `open "http://$(boot2docker ip):8080"/wp-admin`

Start a bash prompt in the container:

* `docker exec -it $(docker-compose ps -q wordpress) bash`

To start a MySQL prompt:

* `docker exec -it $(docker-compose ps -q db) bash -c 'env TERM=dumb mysql -uroot -pexample'`

## Required plugins

```bash
for plugin in advanced-custom-fields; do
  docker exec -it $(docker-compose ps -q wordpress) wp plugin install "$plugin"
  docker exec -it $(docker-compose ps -q wordpress) wp plugin activate "$plugin"
done
```

## Importing Content

* `docker exec -it $(docker-compose ps -q wordpress) wp theme activate vcc`
* `docker exec -it $(docker-compose ps -q wordpress) wp plugin install wordpress-importer`
* `docker exec -it $(docker-compose ps -q wordpress) wp plugin activate wordpress-importer`
* `docker exec -it $(docker-compose ps -q wordpress) wp import --authors=create exports/file.xml` (add `--skip=nav_menu_item` if re-importing otherwise you'll get dupe items in the main menu)

## Importing Custom Fields

* `docker exec -it $(docker-compose ps -q wordpress) wp import --authors=create exports/advanced-custom-field-export.xml`

## Exporting Content

* `docker exec -it $(docker-compose ps -q wordpress) wp export --dir=/var/www/html/exports`

## Style Development

Set watch files for change, recompile, and livereload in the browser simply run:

```bash
# `npm install` first if you need, then:
./node_modules/.bin/gulp
```
