COMMIT_MESSAGE="Automated commit by script"
JENKINS_JOB_NAME="unix"
JENKINS_URL="http://192.168.1.14:8080"
JENKINS_USER="root"
JENKINS_TOKEN="1104b117c9cc42339592cb2a7ce735056f"


git add . || { echo "Failed to add files to Git";  }
git commit -m "$COMMIT_MESSAGE" || { echo "Failed to commit changes"; }
git push || { echo "Failed to push changes"; }


echo "Triggering Jenkins job: $JENKINS_JOB_NAME"
JENKINS_JOB_URL="$JENKINS_URL/job/$JENKINS_JOB_NAME/build?token=$JENKINS_TOKEN"

# Send POST request to trigger the Jenkins job
curl -X POST "$JENKINS_JOB_URL" \
    --user "$JENKINS_USER:$JENKINS_TOKEN" \
    --fail || { echo "Failed to trigger Jenkins job"; }