# FIREBASE CLOUD MESSAGING FCM NOTIFICATIONS

The Firebase Cloud messaging Android app demonstrates registering an android app for notification on firebase.MyFirebaseMessagingService and MyFirebaseInstanceID enable us to token refresh and message handling on the client.

# Intro
* (Read more about Firebase Cloud Messaging)
# Getting Started
* Create an Android studio project
As we do always create a new android studio project. Once the project is loaded copy the package name you can get it from the AndroidManifest.xml file.
# Getting a Configuration File
* Go to (firebase console) and create a new project.
* Now put your app name and select your country.
* Now click on Add Firebase to Your Android App.
* Now you have to enter your projects package name and click on ADD APP.
* After clicking add app you will get google-services.json file
# Adding Firebase Messaging to Your Project
* Now come back to your android project. Go to app folder and paste google-services.json file.
# Implementing Firebase Cloud Messaging

* Create a class named  MyFirebaseInstanceIDService.java 
# Sending Notifications
* Use Firebase console to send FCM messages to device or emulator.
# Send to a single device
* From Firebase console Notification section, click New Message.
* Enter the text of your message in the Message Text field.
* Set the target to Single Device.
* Check the logs for the InstanceID token, copy and paste it into the Firebase console Token field.
..* If you cannot find the token in your logs, click on the LOG TOKEN button in the application and the token will be logged in logcat.
* Click on the Send Message button.
* If your application is in the foreground you should see the incoming message printed in the logs. If it is in the background, a system notification should be displayed.
# Send to a topic (global)
* From Firebase console Notification section, click New Message.
* Enter the text of your message in the Message Text field.
* Click on the SUBSCRIBE TO NEWS button to subscribe to the news topic.
* Set the target to Topic.



