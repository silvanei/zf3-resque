pipeline {
  agent {
    docker {
      image 'php:7.2-cli'
    }

  }
  stages {
    stage('prepare') {
      steps {
        sh 'set -e && apt-get update && apt-get install -my  git'
        sh 'php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"'
        sh 'php composer-setup.php'
        sh 'php -r "unlink(\'composer-setup.php\');"'
        sh 'mv composer.phar /usr/local/bin/composer'
        sh 'pecl install xdebug-2.6.0 && docker-php-ext-enable xdebug '
        sh 'docker-php-ext-install -j$(nproc) pcntl'
      }
    }

    stage('composer install') {
      steps {
        sh 'composer install'
      }
    }
  }
}