 <!doctype html>
     <html lang="en">
     <head>
     <meta charset="utf-8">
     <title>jQuery UI Dialog - Default functionality</title>
     <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
    >
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                $('#wrapper').dialog({
                    autoOpen: false,
                    title: 'Basic Dialog'
                });
                $('#wrapper2').dialog({
                    autoOpen: false,
                    title: 'Basic Dialog'
                });
                $('#opener').click(function() {
                    $('#wrapper').dialog('open');
//                  return false;
                });
                $('#opener2').click(function() {
                    $('#wrapper2').dialog('open');
//                  return false;
                });
            });
        </script>
    </head>
<body>

<button id="opener">Open the dialog</button>
<div id="wrapper">
    <p>Some txt goes here</p>
</div>


<button id="opener2">Open the dialog</button>
<div id="wrapper2">
    <p>Some other txt goes here</p>
</div>