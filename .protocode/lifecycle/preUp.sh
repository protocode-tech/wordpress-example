# Made with Protocode
# Generated on 2025-03-07 at 09:15:22

#!/bin/bash
set -eux

# Load vars from deckor env file is present
if [ -f .protocode/.env ]; then
    export $(grep -v '^#' .protocode/.env | xargs)
fi

# WordPress specific
# Generate config file with values for database
cp wp-config-sample.php wp-config.php

# Replace sample values
sed -i "s/'DB_HOST', '.*/'DB_HOST', 'database');/" wp-config.php
sed -i "s/'DB_NAME', '.*/'DB_NAME', '${MYSQL_DATABASE:-database}');/" wp-config.php
sed -i "s/'DB_USER', '.*/'DB_USER', '${MYSQL_USER:-user}');/" wp-config.php
sed -i "s/'DB_PASSWORD', '.*/'DB_PASSWORD', '${MYSQL_PASSWORD:-password}');/" wp-config.php
