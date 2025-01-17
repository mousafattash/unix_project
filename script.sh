COMMIT_MESSAGE="Automated commit by script"
JENKINS_JOB_NAME="unix"
JENKINS_URL="http://192.168.1.14:8080"
JENKINS_CLI_JAR="/home/vboxuser/jenkins-cli.jar"
JENKINS_USER="root"
JENKINS_TOKEN="1104b117c9cc42339592cb2a7ce735056f"

git add . || { echo "Failed to add files to Git"; exit 1; }


git commit -m "$COMMIT_MESSAGE" || { echo "Failed to commit changes"; exit 1; }

git push  ||  echo "Failed to push changes"

echo "Triggering Jenkins job: $JENKINS_JOB_NAME"
java -jar "$JENKINS_CLI_JAR" -s "$JENKINS_URL" -auth "$JENKINS_USER:$JENKINS_TOKEN" build "$JENKINS_JOB_NAME" || { echo "Failed to trigger Jenkins job";}

echo "Jenkins job triggered successfully."