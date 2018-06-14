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
      }
    }
  }
}