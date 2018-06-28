pipeline {
  agent any
  options {
    disableConcurrentBuilds()
  }
  parameters {
      string(name: 'Greeting', defaultValue: 'Hello', description: 'How should I greet the world?')
  }
  stages {
      stage('Example') {
          steps {
              echo "${params.Greeting} World!"
          }
      }
  }
  stages {
    stage('Build') {
      steps {
        sh 'echo Build'
      }
    }
    stage('Unit Test') {
      agent {
        docker {
          image 'php:7.2-cli'
        }
      }
      steps {
        sh 'php -v'
        sh 'echo Unit Test'
      }      
    }
    stage('Deploy') {
      when {
        branch 'master'
      }
      steps {
        input message: 'Deploy to production?',
                   ok: 'Fire away'
        
        sh 'echo deploy production'
        sh 'echo Notifying the Team!'
      }
    }
  }
}
