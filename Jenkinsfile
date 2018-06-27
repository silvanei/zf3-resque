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
