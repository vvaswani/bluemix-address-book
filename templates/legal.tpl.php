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
      <h1>Legal Notices</h1>
    </div>
    

    <div data-role="content">
    <ul>
      <li>This application is intended for demonstration purposes only and is provided without any warranties or safeguards. Users are hereby warned that they should not store any sensitive or confidential information within it. The application author takes no responsibility or liability for any data loss arising from usage of this application.</li>
      <li>By using this application, you agree to be bound by Google's Terms of Service, available at <a href="https://www.google.com/intl/en/policies/terms">https://www.google.com/intl/en/policies/terms</a> and to comply with (and not knowingly violate) applicable law, regulation, and the above Terms of Service.</li>
      <li>This application incorporates by reference the Google Privacy Policy, available at <a href="https://www.google.com/policies/privacy">https://www.google.com/policies/privacy</a>.</li>
      <li>By using this application, you agree to defend, indemnify and hold harmless the application author, from and against all costs, charges and expenses (including attorneys' fees) arising from any third party claim, action, suit, or proceeding against any action by a third party against the application author.</li>
    </ul>
    You can delete all the data associated with your Google Account email address from this application using the link below.
    <br/>
    <a href="<?php echo $baseUri; ?>/delete-my-data" data-ajax="false" data-inline="true" data-role="button" data-icon="action" data-mini="true" data-theme="a">Delete My Data!</a>      
    </div>
    
  </div>

</body>
</html>