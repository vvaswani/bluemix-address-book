<!DOCTYPE html> 
<html> 
<head> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
 
</head> 
<body> 

  <div data-role="page">

    <div data-role="header">
      <h1>Contacts</h1>
    </div>
    

    <div data-role="content">
      You are now signed out of the application. However, since you originally signed in using your Google Account, you must also sign out of your Google Account to completely expire your session and access tokens.
      <br/>
      <a href="<?php echo $baseUri; ?>/index" data-ajax="false" data-inline="true" data-role="button" data-icon="back" data-mini="true" data-theme="a">Back</a>
      <a href="https://accounts.google.com/Logout" data-ajax="false" data-inline="true" data-role="button" data-icon="action" data-mini="true" data-theme="a">Sign out of Google</a>
    </div>
    
  </div>

</body>
</html>