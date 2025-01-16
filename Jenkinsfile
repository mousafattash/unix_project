pipeline {
    agent any
    stages {
        stage('Pull Code') {
            steps {
                sh'''
                ls -l
                rm -rf unix_project || true
                git clone https://github.com/mousafattash/unix_project.git
                '''
            }
        }
        
        stage('Deploy part 1') {
            steps {
                sh '''
                   cd unix_project
                   docker ps -a
                   pwd
                   docker compose down -v
                   docker system prune -a
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