ID := $(shell docker-compose ps -q wordpress)

setup:
	# Configure the site.
	docker exec -it $(ID) wp core install --admin_user=admin --admin_password=password --admin_email="admin@example.com" --title=VCC --url="http://192.168.99.100:8080"

  # Activate the VCC theme.
	docker exec -it $(ID) wp theme activate vcc

	# Nuke the sample posts.
	docker exec -it $(ID) wp post delete 1 2; true

	# Nuke the menu.
	docker exec -it $(ID) wp menu delete home-menu; true

	docker exec -it $(ID) wp plugin install custom-post-type-permalinks --activate

	# Import the data.
	docker exec -it $(ID) wp plugin install wordpress-importer --activate
	docker exec -it $(ID) wp import --authors=create exports/vcc.wordpress.2015-08-02.000.xml

PHONY: setup
