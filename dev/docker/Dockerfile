FROM centos:7

ENV LANG=C.UTF-8

ARG APP_USER=cw
ARG APP_DIR=/var/www
# ARG REPO_DIR=/var/git

#&& echo -e "[epel]\nname=Extra Packages for Enterprise Linux 7 - \$basearch\n#baseurl=http://download.fedoraproject.org/pub/epel/7/\$basearch\nmirrorlist=https://mirrors.fedoraproject.org/metalink?repo=epel-7&arch=\$basearch\nfailovermethod=priority\nenabled=0\ngpgcheck=1\ngpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7" > etc/yum.repos.d/epel.repo \

RUN yum -y install epel-release wget vim\
    && rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm \
    #&& yum install -y --enablerepo=remi,remi-php72,epel php php-devel php-mbstring php-pdo php-gd php-xml php-mcrypt php-pecl-zip php-mysqlnd sudo nginx git fcgi-devel automake autoconf spawn-fcgi\
    && yum install -y --enablerepo=remi,remi-php72,epel php php-devel php-mbstring php-pdo php-gd php-xml php-mcrypt php-pecl-zip php-mysqlnd sudo\
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && useradd ${APP_USER} \
    # && mkdir ${REPO_DIR} \
    # && chown ${APP_USER}:nginx ${REPO_DIR} \
    # && chmod 2775 ${REPO_DIR} \
    # && mkdir /var/lib/git \
    # && chown ${APP_USER}:${APP_USER} /var/lib/git \
    && echo "${APP_USER} ALL=NOPASSWD: ALL" > /etc/sudoers.d/appuser

# COPY nginx/nginx.conf /etc/nginx/nginx.conf
# COPY nginx/git.conf /etc/nginx/default.d/
# COPY init.sh /

# WORKDIR /usr/local/src

# RUN git clone https://github.com/gnosek/fcgiwrap

# WORKDIR /usr/local/src/fcgiwrap

# RUN autoreconf -i \
#     && ./configure \
#     && make \
#     && make install

WORKDIR ${APP_DIR}

USER ${APP_USER}