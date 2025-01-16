pipeline {
    agent any
    stages {
        stage('Pull Code') {
            steps {
                sh 'rm -rf unix_project || true'
                sh 'git clone https://github.com/mousafattash/unix_project.git'
                sh 'cd unix_project && git pull origin main'
            }
        }
        
        stage('Deploy part 1') {
            steps {
                sh '''
                   cd unix_project
                   docker compose down || true
                '''
            }
        }
        
        stage('Deploy part 2') {
            steps {
                sh '''
                   cd unix_project
                   docker compose up -d
                '''
            }
        }
    }
}