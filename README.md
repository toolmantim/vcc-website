# Victorian Climbing Club Website

New website for the Victorian Climbing Club :muscle:, by [Tim Lucas](https://github.com/toolmantim) & [Josh Bassett](https://github.com/nullobject)

## Getting Started (OSX)

Get started:

* `docker-compose build && docker-compose up`
* `docker exec -it $(docker-compose ps -q wordpress) script/bootstrap`
* `open "http://$(boot2docker ip):8080"`
* `open "http://$(boot2docker ip):8080"/wp-admin`

Start a bash prompt in the container:

* `docker exec -it $(docker-compose ps -q wordpress) bash`

To start a MySQL prompt:

* `docker exec -it $(docker-compose ps -q db) bash -c 'env TERM=dumb mysql -uroot -pexample'`

## Exporting Content

* `docker exec -it $(docker-compose ps -q wordpress) wp export --dir=/var/www/html/exports`

## Style Development

Set watch files for change, recompile, and livereload in the browser simply run:

```bash
# `npm install` first if you need, then:
./node_modules/.bin/gulp
```

## Custom Theme

### Events

Events are configured as a [custom post
type](https://codex.wordpress.org/Post_Types#Custom_Post_Types).

* `theme/event-summary.php` - The template used to render event summaries on the home or archive pages.
* `theme/event-single.php` - The template used to render a single event.

### Articles

News articles are also configured as a custom post type.

* `theme/article-summary.php` - The template used to render article summaries on the home or archive pages.
* `theme/article-single.php` - The template used to render a single article.
