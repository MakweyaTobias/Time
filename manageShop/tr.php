<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <title>Document</title>
    <script>
 $(document).ready(function() {
  $('#nav a').click(function(e) {
   e.preventDefault();
   $('#content').load($(this).attr('href'));
  });
 });
</script>
</head>
<body>
    <<div id="nav">
   <a href="somepage.html">Some page</a>
   <a href="someotherpage.html">Some other page</a>
   <a href="smypage.html">My page</a>
</div>
<div id="content">
 show the stuff
</div>
</body>
</html>