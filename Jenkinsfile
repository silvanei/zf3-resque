pipeline {
  agent any
  stages {
    stage('Build') {
      steps {
        sh 'echo Build'
      }
    }
    stage('Unit Test') {
      steps {
        sh 'echo Test'
      }
    }
    stage('Deploy') {
      steps {
        input message: 'Deploy to production?',
                   ok: 'Fire away'
        
        sh 'echo deploy production'
      }
    }
  }
}
