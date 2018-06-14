pipeline {
  agent {
    docker {
      image 'php:7.2-cli'
    }

  }
  stages {
    stage('teste') {
      steps {
        sh 'php -v'
        sh 'php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"'
        sh 'php composer-setup.php'
        sh 'php -r "unlink('composer-setup.php');"'
        sh 'mv composer.phar /usr/local/bin/composer'
        sh 'php -v'
      }
    }
  }
}