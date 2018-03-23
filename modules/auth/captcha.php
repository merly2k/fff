<html>
  <head>
    <title>reCAPTCHA demo: Explicit render for multiple widgets</title>
    <script type="text/javascript">
      var verifyCallback = function(response) {
        alert(response);
	//var resp=document.getElementById('submit').defineProperties("disabled"="false");
      };
      var widgetId1;
      var widgetId2;
      var onloadCallback = function() {
        widgetId2 = grecaptcha.render(document.getElementById('example2'), {
          'sitekey' : '6Lc9ByAUAAAAAKOlFnpa91fVuvltXVZYkBUVBOVD'
        });
        grecaptcha.render('example3', {
          'sitekey' : '6Lc9ByAUAAAAAKOlFnpa91fVuvltXVZYkBUVBOVD',
          'callback' : verifyCallback,
          'theme' : 'dark'
        });
      };
    </script>
  </head>
  <body>
    <!-- The g-recaptcha-response string displays in an alert message upon submit. -->
    <form action="javascript:alert(grecaptcha.getResponse(widgetId1));">
      <div id="example1"></div>
      <br>
      <input type="submit" value="getResponse">
    </form>
    <br>
    <!-- Resets reCAPTCHA widgetId2 upon submit. -->
    <form action="javascript:grecaptcha.reset(widgetId2);">
      <div id="example2"></div>
      <br>
      <input type="submit" value="reset">
    </form>
    <br>
    <!-- POSTs back to the page's URL upon submit with a g-recaptcha-response POST parameter. -->
    <form action="?" method="POST">
      <div id="example3"></div>
      <br>
      <input type="submit" value="Submit" disabled="disabled">
    </form>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
  </body>
</html>