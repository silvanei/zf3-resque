pipeline {
  agent {
    docker {
      image 'teste:dev'
    }

  }
  stages {
    stage('composer install') {
      steps {
        sh 'composer install'
      }
    }

    stage('PHPUnit') {
      steps {
        sh 'vendor/bin/phpunit'
      }
    }
  }
}