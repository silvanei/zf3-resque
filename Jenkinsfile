pipeline {
  agent {
    docker {
      image 'directcall/php7.2:dev'
    }

  }
  stages {
    stage('Composer install') {
      steps {
        sh 'composer install'
      }
    }
  }
}