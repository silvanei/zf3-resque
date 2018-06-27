pipeline {
  agent any
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
        build job: "Deployment/${serviceName}/${env.BRANCH_NAME}",
        propagate: true,
        wait: true,
        parameters: [
          [$class: 'StringParameterValue', name: 'imageName', value: imageName],
          [$class: 'StringParameterValue', name: 'serviceName', value: serviceName],
          [$class: 'StringParameterValue', name: 'tag', value: "${env.BUILD_NUMBER}"]
        ]
      }
    }
  }
}
