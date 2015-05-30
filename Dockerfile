FROM wordpress

# Install less (for wp-cli)
RUN apt-get update && \
    apt-get install less

# Add wp-cli wrapper
ADD script/wp /usr/local/bin/

# Install wp-cli
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/ && \
    chmod +x /usr/local/bin/wp-cli.phar && \
    wp --info
