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
      <a data-inline="true" data-ajax="false" data-role="button" data-icon="action" data-theme="a" href="<?php echo $baseUri; ?>/logout" class="ui-btn-right"><?php echo $_SESSION['uid']; ?></a>
    </div>
    

    <div data-role="content">
      <ul data-role="listview" data-inset="true" data-filter="true" data-filter-placeholder="Search contacts...">
        <?php foreach ($this->data['contacts'] as $c): ?>
        <li>
            <h3><?php echo $c['name']; ?></h3> 
            <div data-type="horizontal">
              <a data-inline="true" data-ajax="false" data-role="button" data-icon="mail" data-theme="b" data-mini="true" href="mailto:<?php echo $c['email']; ?>"><?php echo $c['email']; ?></a>
              <a data-inline="true" data-ajax="false" data-role="button" data-icon="phone" data-theme="b" data-mini="true" href="tel:<?php echo $c['phone']; ?>"><?php echo $c['phone']; ?></a>
            </div>
            <div data-type="horizontal">
              <a href="<?php echo $baseUri; ?>/save/<?php echo $c['_id']; ?>" data-ajax="false" data-inline="true" data-role="button" data-icon="edit" data-mini="true" data-theme="a">Update</a>
              <a href="<?php echo $baseUri; ?>/delete/<?php echo $c['_id']; ?>" data-ajax="false" data-inline="true" data-role="button" data-icon="delete" data-mini="true" data-theme="a">Remove</a>
            </div>
        </li>
        <?php endforeach; ?>
      </ul> 
      <a href="save" data-ajax="false" data-inline="true" data-role="button" data-icon="plus" data-mini="true"data-theme="a">Add</a>
    </div>

    <div data-role="footer">
      <a href="/legal" data-ajax="false">Legal</a>
    </div>
    
  </div>

</body>
</html>
