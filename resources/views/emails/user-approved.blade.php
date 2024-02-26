<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="telephone=no" name="format-detection" />
    <title>Your profile has been approved</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;500;700&display=swap" rel="stylesheet">
</head>

<body style="padding: 0; margin: 0; border: none; font-family: 'Lexend', sans-serif; color: #364C66;">
    <table width="100%" cellspacing="0" cellpadding="0" style="border: none;">
        <tbody>
            <tr>
                <td>
                    <table bgcolor="#F8F9FA" width="600px" cellspacing="0" cellpadding="0" align="center"
                        style="border: none; border-left: 1px solid #6E9D72; border-right: 1px solid #6E9D72; border-radius: 10px;">

                        <!-- aqui é a logo -->
                        <tr>
                            <td bgcolor="#6E9D72" style="border-radius: 10px 10px 0 0; padding: 40px 0 50px 0;"
                                align="center">
                                <img style="max-width: 180px;" src="https://i.ibb.co/QPk7nF8/logoemail.png" alt="">
                            </td>
                        </tr>

                        <!-- aqui é o icone -->
                        <tr>
                            <td align="center">
                                <img style="max-width: 300px; padding-top: 40px;"
                                    src="https://i.ibb.co/gPwb6S8/Perfil-Aprovado.png" alt="">
                            </td>
                        </tr>

                        <!-- aqui é o titulo -->
                        <tr>
                            <td align="center">
                                <h1 style="font-size: 30px; font-weight: bold; color: #6E9D72;">
                                    <span>{{ $firstname }}</span>,<br>WELCOME to WOWNESS<br>CLUB Community!
                                </h1>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 20px; font-weight: lighter;" align="center">
                                <h3 style="font-weight: lighter; text-align: left; max-width: 460px; font-size: 22px;">
                                    Hi <span>{{ $firstname }},</span>
                                </h3>
                                <p style="max-width: 460px; text-align: justify;">
                                    Your profile has been approved and you can start creating services and content.<br>

                                    <br>
                                    You will find tutorials inside your admin account. 
                                    <br>
                                    <br>
                                    If you have any questions or need support please reply to this email.
                                    <br>
                                    <br>
                                    Click here to login to your account. 
                                    <br>

                                    
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td align="center" style="padding-top: 50px; padding-bottom: 60px;">
                                @if (Route::has('login'))
                                <!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ route('login') }}" style="height:40px;v-text-anchor:middle;width:150px;" arcsize="10%" strokecolor="#6E9D72" fillcolor="#6E9D72">
                                <w:anchorlock/>
                                <center style="color:#ffffff;font-family:sans-serif;font-size:13px;font-weight:bold;">Login</center>
                                </v:roundrect>
                                <![endif]-->
                                <!--[if !mso]> <!-->
                                <a style="font-weight: normal; text-decoration: none; color: white; background-color: #6E9D72; padding: 16px 50px; border-radius: 2px;" href="{{ route('login') }}">Login</a>
                                <!--<![endif]-->
                                @endif
                            </td>
                        </tr>

                        <!-- aqui é assinatura -->
                        <tr>
                            <td style="font-size: 15px; color: #6E9D72; font-weight: normal;"
                                align="center">
                                <p>Much love,
                                </p>
                                <p>
                                    Wowness Club Support Team</p>
                            </td>
                        </tr>

                        <tr>
                          <td style="padding-bottom: 20px; font-size: 14px; color: #364C66;" align="center">
                              <p>This email was sent to: <span style="color: #6E9D72;">{{ $email }}</span>
                              </p>
                              <p style="font-size: 12px; font-weight: lighter;">Wowness Club - 167-169 Great Portland
                                  street, 5th Floor, London, W1W 5PF<br>Copyright
                                  2023 © Wowness Club. All rights reserved.</p>
                          </td>
                        </tr>

                        <!-- aqui é footer -->
                        <tr>
                            <td bgcolor="#6E9D72" align="center" style="border-radius: 0 0 10px 10px;">
                                <table style="padding: 40px;">
                                    <tr>

                                        <!-- instagran -->
                                        <td>
                                            <a href="https://www.instagram.com/wownessclub/"><img
                                                    style="max-height: 42px; padding: 5px;"
                                                    src="https://mbfbep.stripocdn.email/content/assets/img/social-icons/circle-white/instagram-circle-white.png"
                                                    alt=""></a>
                                        </td>

                                        <!-- youtube -->
                                        <td>
                                            <a href="https://www.youtube.com/@wownessclub"><img
                                                    style="max-height: 42px; padding: 5px;"
                                                    src="https://i.ibb.co/1sPQqQy/iconyoutube-1.png" alt=""></a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
