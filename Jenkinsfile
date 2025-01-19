pipeline {
    agent any
    stages {
        stage('Pull Code') {
            steps {
                sh '''
                if [ -d "unix_project" ]; then
                    echo "Directory exists. Pulling latest changes..."
                    cd unix_project
                    git reset --hard
                    git pull origin main
                else
                    echo "Directory does not exist. Cloning repository..."
                    git clone https://github.com/mousafattash/unix_project.git
                fi
                '''
            }
        }
        
        stage('Deploy') {
            steps {
                sh '''
                   cd unix_project
                   docker ps -a
                   pwd
                   docker compose down -v
                   docker compose up -d
                '''
            }
        }
        
            }
        }