sudo pecl install pcntl
sudo pecl install swoole

# echo "extension=swoole.so" >> `php --ini | grep 'Loaded Configuration' | sed -e "s|.*:\s*||"`
