/*GOOGLE UNIVERSAL ANALYTICS*/
/*
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45415181-1', 'mobide.es');
  ga('send', 'pageview');

	$(document).bind('pageload', function (event, ui) { 			
		 //ga('send', 'pageview');
  });
*/

/* GOOGLE ANALYTICS*/
     var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-45415181-1']);//Mobide Analytics
		//_gaq.push(['_setAccount', 'UA-31558837-1']);//K5 Analytics
	


    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; 
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    
   	$(document).bind('pageshow', function (event, ui) {
      try 
      {		
          hash = location.hash;
					
          if (hash && hash.length > 1) 
          {
              _gaq.push(['_trackPageview', hash.substr(1)]);
          } 
          else 
          {
              _gaq.push(['_trackPageview']);
          }
      }
      catch(err) { }
    });