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
        <h1>Add Contact</h1>
      </div>
      <div data-role="content">
        <div data-role="collapsible-set" data-inset="false">
          <form method="post" data-ajax="false" action="<?php echo $baseUri; ?>/save">
            <input name="id" type="hidden" value="<?php echo $this->data['contact']['_id']; ?>" />
            <label for="name">Name</label>
            <input name="name" id="name" data-clear-btn="true" type="text" value="<?php echo $this->data['contact']['name']; ?>" />
            <label for="email">Email address</label>
            <input name="email" id="email" data-clear-btn="true" type="text" value="<?php echo $this->data['contact']['email']; ?>" />
            <label for="phone">Phone</label>
            <input name="phone" id="phone" data-clear-btn="true" type="text" value="<?php echo $this->data['contact']['phone']; ?>" />
            <input name="submit" value="Save" type="submit" data-icon="check" data-inline="true" data-mini="true" data-theme="a" />
            <a href="<?php echo $baseUri; ?>/index" data-role="button" data-inline="true" data-icon="back" data-mini="true" data-theme="a">Back</a>
          </form>
      </div>
    </div>
</body>
</html>
