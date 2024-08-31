<!-- Some Hints : For sending HTML Emails, Please use the Free Thunderbird Software, in which, while composing a New Message, use the Insert Menu's HTML... Option, in the Message Body and then test sending a sample message, to your other email accounts, first, before circulating it largely to others. -->

<!DOCTYPE html>
<html>
<head>
<title>[CodePen Spark] Tab Details, Cool :has() Tricks, and a Skating Bunny</title>
<link rel="important stylesheet" href="chrome://messagebody/skin/messageBody.css">
</head>
<body>
<br>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <title>
    The CodePen Spark
  </title>
  <!--[if !mso]><!-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; ">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    #outlook a {
      padding: 0;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      border-collapse: collapse;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
    }

  </style>
  <!--[if mso]>
    <noscript>
    <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    </noscript>
    <![endif]-->
  <!--[if lte mso 11]>
    <style type="text/css">
      .mj-outlook-group-fix { width:100% !important; }
    </style>
    <![endif]-->
  <!--[if !mso]><!-->
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Lato:300,400,500,700);

  </style>
  <!--<![endif]-->
  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-100 {
        width: 100% !important;
        max-width: 100%;
      }

      .mj-column-per-50 {
        width: 50% !important;
        max-width: 50%;
      }
    }

  </style>
  <style media="screen and (min-width:480px)">
    .moz-text-html .mj-column-per-100 {
      width: 100% !important;
      max-width: 100%;
    }

    .moz-text-html .mj-column-per-50 {
      width: 50% !important;
      max-width: 50%;
    }

  </style>
  <style type="text/css">
    @media only screen and (max-width:480px) {
      table.mj-full-width-mobile {
        width: 100% !important;
      }

      td.mj-full-width-mobile {
        width: auto !important;
      }
    }

  </style>
  <style type="text/css">
    @media screen {
      @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        src: local('Lato Regular'), local('Lato-Regular'),
          url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
      }

      @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 700;
        src: local('Lato Bold'), local('Lato-Bold'),
          url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
      }

      @font-face {
        font-family: 'Lato';
        font-style: italic;
        font-weight: 400;
        src: local('Lato Italic'), local('Lato-Italic'),
          url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
      }

      @font-face {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 900;
        src: local('Lato Black'), local('Lato-Black'),
          url(https://fonts.gstatic.com/s/lato/v14/S6u9w4BMUTPHh50XSwiPGQ3q5d0.woff2) format('woff2');
      }
    }

    body {
      font-family: Lato, 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, sans-serif;
      font-size: 18px;
      line-height: 1.5;
      color: #3d4852;
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      max-width: 100%;
    }

    p,
    li {
      color: #3d4852;
      line-height: 1.5;
      font-size: 18px;
      margin: 0 0 15px 0;
    }

    li {
      margin-bottom: 10px;
    }

    blockquote {
      background: none;
      border-left: 1px solid gray;
      padding-left: 10px;
      margin: 0 0 15px 10px;
    }

    h1,
    h2,
    h3 {
      color: white;
    }

    h1 {
      font-size: 28px;
      margin: 0 0 15px 0;
      line-height: 1.2;
    }

    h2 {
      font-size: 26px;
      margin: 0;
      line-height: 1.2;
    }

    h3 {
      font-size: 24px;
      margin: 20px 0 10px 0;
      line-height: 1.2;
    }

    .news-content a,
    .spark-item a,
    .subscription-details a,
    .pro-content a {
      text-decoration: none;
      color: #76adff;
    }

    pre {
      white-space: pre-wrap;
      line-height: 1.8;
      font-family: SFMono-Regular, Consolas, 'Liberation Mono', Menlo, monospace;
    }

    .view-on-web-link {
      color: #74c5ff;
      text-transform: uppercase;
      display: block;
      padding: 5px 10px;
      background: #383b43;
      width: 66%;
      margin: 0 auto;
      clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
      text-decoration: none;
    }

    .dedicated-hero-area-copy {
      padding: 20px;
    }

    .dedicated-hero-area-copy h2 {
      font-family: 'Lato', system-ui, Lato, sans-serif;
      text-align: center;
      margin: 0 0 20px 0;
      font-size: 32px;
      line-height: 1.2;
    }
    .dedicated-hero-area-copy h3 {
      font-family: 'Lato', system-ui, Lato, sans-serif;
      text-align: center;
      margin: 0 0 20px 0;
      font-size: 26px;
      line-height: 1.2;
    }

    .spark-item {
      margin-bottom: 50px;
    }

    .spark-item[data-type='sponsor'] .spark-item-type {
      color: #fedd41;
    }

    .spark-item-type {
      color: #99a3bc;
      padding-bottom: 3px;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-size: 10px;
    }

    .spark-title {
      font-weight: bold;
      color: #505050;
      padding: 5px 0 5px 0;
      font-size: 20px;
      line-height: 1.2;
    }

    .spark-desc {
      padding-top: 4px;
      color: #cccfdc;
      font-size: 15px;
      line-height: 1.4;
    }

    .spark-thumb {
      border: 0;
      display: block;
      height: auto;
      max-width: 100%;
      outline: none;
      text-decoration: none;
      margin: 0 0 10px 0;
    }
    
    .fem-callout {
      background: #dd7932;
      color: white;
      padding: 1rem;
      border-radius: 4px;
      margin-bottom: 60px;
      line-height: 1.4;
    }
    .fem-callout p {
      font-size: 14px;
    }
    .fem-callout a {
      color: #fffd00;
    }
    .fem-callout h3 {
      margin: 0 0 8px 0;
      font-size: 18px;
    }

    .news-header {
      font-family: 'Lato', system-ui, Lato, sans-serif;
      margin: 0 0 5px 0;
      font-size: 36px;
      text-align: left;
      color: white;
    }

    .news-bar {
      height: 5px;
      border-radius: 100px;
      background: white;
      background: linear-gradient(92.63deg,
          #769aff 8.23%,
          #ffdd40 25.83%,
          #f19994 51.91%,
          #47cf73 68.56%);
      width: 70%;
      margin: 0 0 10px 0;
    }

    .pro-bar {
      height: 5px;
      border-radius: 100px;
      background: #ffdb00;
      width: 70%;
      margin: 0 0 10px 0;
    }

    .pro-header {
      text-align: left;
    }

    .pro-header a {
      color: #ffdb00;
      text-decoration: none;
    }

    .footer-bar {
      height: 10px;
      background: linear-gradient(92.63deg,
          #769aff 8.23%,
          #ffdd40 25.83%,
          #f19994 51.91%,
          #47cf73 68.56%);
    }

    @media only screen and (max-width: 400px) {
      h1 {
        font-size: 22px;
      }

      p {
        font-size: 14px;
      }

      .spark-thumb {
        display: block;
        max-width: 100% !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
    }

  </style>
</head>

<body style="word-spacing:normal;">
<div style="color:transparent;visibility:hidden;opacity:0;font-size:0px;border:0;max-height:1px;width:1px;margin:0px;padding:0px;border-width:0px!important;display:none!important;line-height:0px!important;"><img border="0" width="1" height="1" src="http://post.spmailtechnolo.com/q/1wkKaoq4OrYOqBNTWRWTYA~~/AABEfgA~/RgRn0daSPVcDc3BjQgpl75RR72VErWOqUhZhdG96d2VicGFnZXNAZ21haWwuY29tWAQAAAAA" alt=""/></div>

  @php
    $color = '#284bb4';
    $db_color = \DB::table('settings')->first();
    if($db_color){
      $color = $db_color->background_color; 
    }
  @endphp

  <div>
    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" role="presentation" style="width:600px;" width="600" bgcolor="#434857" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
    <div style="background:#434857;background-color:#434857;margin:0px auto;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#434857;background-color:{{$color}};width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:0;text-align:center;">
              <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tbody>
                    <tr>
                      <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                          <tbody>
                            <tr>
                              <td>
                                <img height="auto" src="{{ asset('asset/frontend/test/images/trackrak-logo.png') }}" style="margin: auto;width: 35% !important;border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;padding-top: 30px;margin-bottom: -60px;"/>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    
                    <tr>
                      <td align="left" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-right:35px;padding-bottom:0;padding-left:35px;word-break:break-word;">
                        <div style="font-family:'Lato', system-ui, sans-serif;font-size:13px;line-height:125%;text-align:left;color:#e7f0ff;">
                          <h1></h1>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td align="left" style="padding:10px 25px;padding-top:0;padding-right:35px;padding-left:35px;word-break:break-word;">
                        <div style="font-family:Lato, system-ui, sans-serif;font-size:13px;text-align:left;color:white;" class="news-content">
                          {!! $email_content !!}
                        </div>
                      </td>
                    </tr>

                    <tr>
                              <td align="left" vertical-align="middle" style="padding: 35px;font-size:0px;padding:31px;word-break:break-word;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                  <tbody>
                                    <tr>
                                      <td align="left" role="presentation" valign="middle">
                                       
                                      <a href="{{ url('/') }}" style="background-color: #95bb3c; padding: 10px 30px; border-radius: 50px; font-size: 25px; font-weight: bolder; color: #000000 !important; text-decoration: none; display: inline-block;line-height: normal;border: solid black;">Take Me to TrackRak</a>

                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                  </tbody>
                </table>
              </div>
              <!--[if mso | IE]></td></tr></table><![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
<img border="0" width="1" height="1" alt="" src="http://post.spmailtechnolo.com/q/WxvUTSl1dIih_Pm7pUD-VA~~/AABEfgA~/RgRn0daSPlcDc3BjQgpl75RR72VErWOqUhZhdG96d2VicGFnZXNAZ21haWwuY29tWAQAAAAA">
</body>

</html>

</body>
</html>
</table></div>