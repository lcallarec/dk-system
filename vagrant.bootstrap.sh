#!/usr/bin/env bash
#LANGS
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8
export LC_ALL=en_US.UTF-8
sudo localedef -i en_US -f UTF-8 en_US
sudo echo 'LANG="en_US.UTF-8"' > /etc/sysconfig/i18n

#Base packages for compiling
sudo yum -y groupinstall "Development Tools"
sudo yum -y install wget 
sudo yum -y install libxml2-devel httpd-devel libXpm-devel gmp-devel libicu-devel t1lib-devel aspell-devel openssl-devel bzip2-devel libcurl-devel libjpeg-devel libvpx-devel libpng-devel freetype-devel readline-devel libtidy-devel libxslt-devel libmcrypt-devel

mkdir /tmp/php-5.5.11.sources
mkdir /tmp/libmcrypt

cd /tmp/libmcrypt
wget http://pkgs.repoforge.org/libmcrypt/libmcrypt-devel-2.5.7-1.2.el6.rf.x86_64.rpm
wget http://pkgs.repoforge.org/libmcrypt/libmcrypt-2.5.7-1.2.el6.rf.x86_64.rpm
sudo rpm -ivh libmcrypt-2.5.7-1.2.el6.rf.x86_64.rpm
sudo rpm -ivh libmcrypt-devel-2.5.7-1.2.el6.rf.x86_64.rpm

cd /tmp/php-5.5.11.sources
wget -O php-5.5.11.tar.bz2 http://fr2.php.net/get/php-5.5.11.tar.bz2/from/this/mirror
tar jxf php-5.5.11.tar.bz2

sudo chown -R vagrant:vagrant /tmp/php-5.5.11.sources

cd php-5.5.11

sudo cp php.ini-development /etc/php.ini

sudo sed -i -e 's#;date.timezone =#date.timezone=Europe/Paris#' /etc/php.ini

./configure \
--with-libdir=lib64 \
--prefix=/usr/local \
--with-layout=PHP \
--with-pear \
--with-apxs2 \
--enable-bcmath \
--enable-exif \
--with-mcrypt \
--with-mhash \
--enable-mbstring \
--with-iconv \
--enable-intl \
--with-icu-dir=/usr \
--with-gd \
--enable-gd-native-ttf \
--with-jpeg-dir=/usr \
--with-png-dir=/usr \
--with-freetype-dir=/usr \
--with-libxml-dir=/usr \
--with-pdo-mysql=mysqlnd \
--with-xsl \
--with-readline \
--enable-pcntl \
--enable-sysvshm \
--enable-sysvmsg \
--enable-fpm \
--with-fpm-user=nginx \
--with-fpm-group=www-data \
--with-config-file-path=/etc/php.ini

#not enable:
#--enable-calendar \
#--enable-soap \
#--with-xmlrpc \
#--enable-shmop \
#--with-zlib \
#--with-bz2 \
#--enable-zip \
#--enable-ftp \
#--with-gettext \
#--with-pspell \
#--enable-sockets \
#--with-openssl \
#--with-curl \
#--with-zlib-dir=/usr \
#--with-xpm-dir=/usr \
#--with-vpx-dir=/usr \
#--with-tidy=/usr \
#--with-mysql=mysqlnd \
#--with-mysqli=mysqlnd \
#--with-t1lib=/usr \
#--with-gmp \

make
sudo make install

#Message from make install:
#/usr/lib64/httpd/build/instdso.sh SH_LIBTOOL='/usr/lib64/apr-1/build/libtool' libphp5.la /usr/lib64/httpd/modules
#/usr/lib64/apr-1/build/libtool --mode=install cp libphp5.la /usr/lib64/httpd/modules/
#libtool: install: cp .libs/libphp5.so /usr/lib64/httpd/modules/libphp5.so
#libtool: install: cp .libs/libphp5.lai /usr/lib64/httpd/modules/libphp5.la
#libtool: install: warning: remember to run `libtool --finish /tmp/php-5.5.11.sources/php-5.5.11/libs'
#chmod 755 /usr/lib64/httpd/modules/libphp5.so
#[activating module `php5' in /etc/httpd/conf/httpd.conf]

sudo libtool --finish /tmp/php-5.5.11.sources/php-5.5.11/libs

#MYSQL
#SERVER
mkdir -p /tmp/mysql/mysql-server && cd /tmp/mysql/mysql-server
wget http://dev.mysql.com/get/Downloads/MySQL-5.6/MySQL-5.6.17-1.el6.x86_64.rpm-bundle.tar
tar xf MySQL-5.6.17-1.el6.x86_64.rpm-bundle.tar

sudo yum -y install libaio libc libcrypt libdl libgcc libm libpthread librt libstdc++

sudo yum -y remove mysql-libs-5.1.73-3.el6_5.x86_64
sudo rpm -ivh MySQL-shared-compat-5.6.17-1.el6.x86_64.rpm
sudo rpm -ivh MySQL-shared-5.6.17-1.el6.x86_64.rpm
sudo rpm -ivh MySQL-client-5.6.17-1.el6.x86_64.rpm
sudo rpm -ivh MySQL-server-5.6.17-1.el6.x86_64.rpm

read MYSQL_ROOT_PASS <<< $(sudo cat /root/.mysql_secret | awk -F " " '{print $NF}')
sudo service mysql start
sudo mysqladmin -u root -p$MYSQL_ROOT_PASS password 'root'

#####APACHE
cat <<EOT > /etc/httpd/conf.d/php5-handler.conf
AddHandler application/x-httpd-php .php .phtml
Action application/x-httpd-php modules/libphp5.so
EOT

sudo sed -i -e 's#DocumentRoot "/var/www/html"#DocumentRoot "/var/www"#' /etc/httpd/conf/httpd.conf

sudo service httpd restart

sudo rm -rf /var/www
sudo ln -fs /vagrant /var/www






