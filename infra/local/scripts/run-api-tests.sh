#!/usr/bin/env bash

# Wait for database container online
echo "Waiting Postgres container"
dockerize -wait tcp://postgres:5432 -timeout 60s
sleep 5

# Helper functions
install_deps_and_run_migrations(){
    cd /application \
        && composer install \
        && chmod 777 -R ./vendor \
        && php ./vendor/bin/phinx migrate --configuration phinx.php \
        && php ./vendor/bin/phinx seed:run --configuration phinx.php
}
add_env_to_run_api_tests(){
    cd  /application \
        && touch .env \
        && chmod 777 .env \
        && cp -rf .env .env.wait \
        && cp -rf .env.test.dist .env
}
rollback_env_to_run_api_tests(){
    cd  /application \
        && rm -rf .env \
        && mv .env.wait .env \
        && chmod 777 .env
}
run_api_tests(){
    chmod 777 -R /var/log/
    cd  /application \
        && php ./vendor/bin/codecept run -v

    tests_return=$?

    # Rollback to the initial environment
    rollback_env_to_run_api_tests

    if [[ ${tests_return} -ne 0 ]]; then
        echo -e "\e[41mCodeception API Tests Failed :( \e[0m"
        exit 1
    fi
}

# Execute functions
add_env_to_run_api_tests
install_deps_and_run_migrations
run_api_tests
