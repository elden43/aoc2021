init: directories composer

directories:
	mkdir -p src/temp

composer:
	cd src && composer install

#just useful
bash:
	 docker exec -it aoc2021 /bin/bash
