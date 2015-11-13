<meta charset="utf-8">
<meta lang="en">
<title>MaskCamp</title>
<link rel="shortcut icon" href="{{URL::to('img/logo.png')}}" type="image/png"/><!--Title Image-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:title" content="MaskCamp"/>
<meta property="og:image" content="{{asset('img/logo_2.png')}}" />
@if(isset($data['single']))
<meta property="og:url" content="{{URL::to('singlepost/'.$data['post']['id'])}}"/>

<meta property="og:type" content="article"/>
<meta property="og:description" content="{{$data['post']['post']}}" />
<meta property="og:image:width" content="250" />
<meta property="og:image:height" content="250" />
@endif
<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,600italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<link href="{{asset('css/styling.css')}}" rel="stylesheet">
<link href="{{asset('css/others.css')}}" rel="stylesheet">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63537586-1', 'auto');
  ga('send', 'pageview');

</script>