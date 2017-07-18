<!DOCTYPE html>
ciao
<html>
    <head>
        <link rel="stylesheet" href="CSS/reg_style.css?<?= rand() ?>" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    </head> 

<!--    <script>
        function enter_group(group) {
            alert(group);
            window.location.href = "http://ipsoccer.altervista.org/rielvideos.php";
        }
    </script>-->
    <!--<body style=" ">-->


    <script>
        username = prompt("Please enter your name:", "");
        document.cookie="";
//        alert(document.cookie);
        
        function saveFile(url) {
            // Get file name from url.
            var filename = url.substring(url.lastIndexOf("/") + 1).split("?")[0];
            var xhr = new XMLHttpRequest();
            xhr.responseType = 'blob';
            xhr.onload = function () {
                var a = document.createElement('a');
                a.href = window.URL.createObjectURL(xhr.response); // xhr.response is a blob
                a.download = filename; // Set the file name.
                a.style.display = 'none';
                document.body.appendChild(a);
                a.click();
                delete a;
            };
            xhr.open('GET', url);
            xhr.send();
        }

//        if (document.cookie.valueOf().indexOf('fbsr_216805568409503') > -1)
//        {
//            window.location.href = "http://ipsoccer.altervista.org/gio.php";
//        }
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                testAPI();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into this app.';
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                document.getElementById('status').innerHTML = 'Please log ' +
                        'into Facebook.';
            }
        }

        function checkLoginState() {
            FB.logout(statusChangeCallback);
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '216805568409503',
                cookie: true, // enable cookies to allow the server to access 
                // the session
                xfbml: true, // parse social plugins on this page
                version: 'v2.2' // use version 2.2
            });

        };

        // Load the SDK asynchronously
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            email = "";
//            FB.logout(function(response) {
//                // user is now logged out
//              });
            FB.api('/me?fields=id,name,email,picture ', function (response) {
                console.log('Successful login for: ' + JSON.stringify(response));
                document.getElementById('status').innerHTML =
                        'Thanks for logging in, ' + response.length + '! ' + JSON.stringify(response);
                email = response.email;
                nome = response.name;
                //saveFile(response.picture.data.url);
                //console.log(JSON.stringify(response.picture.data.url));
//                console.log(response.picture);
                
                cosa = "loginfb"
                picture=response.picture.data.url;
                $.post('PHP/crea_login.php', {cosa: cosa, email: email, nome: nome, picture:picture }, loginfb);
                function loginfb(data)
                {
                   
                    var dati = JSON.parse(data);
//                alert();
                    if (dati[0]['cosa'] === "registrazione")
                    {
                       
//                         alert(dati[0]['picture']);
                        $.ajax({
                            //imposto il tipo di invio dati (GET O POST)
                            type: "POST",
                            //Dove devo inviare i dati recuperati dal form?
                            url: "PHP/register2.php",
                            //Quali dati devo inviare?
                            data: "username=" + dati[0]['nome'] + "&email=" +dati[0]['email']  + "&account=org&picture="+escape(dati[0]['picture']) ,
                            //Inizio visualizzazione errori
                            success: function (msg)
                            {
                                alert("ok "); // messaggio di avvenuta aggiunta valori al db (preso dal file risultato_aggiunta.php) potete impostare anche un alert("Aggiunto, grazie!");
                                window.location.href = "http://ipsoccer.altervista.org/org.php";
                            },
                            error: function ()
                            {
                                alert("Chiamata fallita, si prega di riprovare..."); //sempre meglio impostare una callback in caso di fallimento
                            }
                        });
                        //seleziona il tipo di account 
                        //var data_ora=document.getElementById("datepicker").value;
                        // $("#regfb_dialog").dialog("open");
//                        $("#account_fb").click(function () {
//                            var acc_fb = document.getElementById("account_sel").value;
//                            if (acc_fb == "seleziona il tipo di account") {
//                                alert("Inserisci il tipo di account che vuoi registrare!")
//                            } else {
//
//                                alert(document.getElementById("email").value);
//                                
//                            }
//                        });
                    } 
                    else {

                       var account= dati[0]['acc'];
                    
                        if (account === "gio") {
                            //$.post('crea_login.php', {cosa: cosa, id: id});
                            window.location.href = "http://ipsoccer.altervista.org/gio.php";
                        } else if (account == "org") {
                            window.location.href = "http://ipsoccer.altervista.org/org.php";
                        } else {
                            alert("errore inconsueto");
                        }
                    }
                }
            });
        }
        //reg fb
        $(function () {
            $("#regfb_dialog").dialog({
                autoOpen: false,
                show: {
                    effect: "blind",
                    duration: 1000
                },
                hide: {
                    effect: "explode",
                    duration: 1000
                }
            });
        });

    </script>


    <!--<div ></div>-->
    <div id="status" style="display: none">
    </div>

    <div id="regfb_dialog">
        <input id="user" type="hidden" >
        <input id="email" type="hidden" >
        <table>
            <tr>
                <td colspan="1">
                    <select id="account_sel">
                        <option value="seleziona il tipo di account">Seleziona il tuo account</option>
                        <option value="gio">Giocatore</option>
                        <option value="org">Organizzatore</option>

                    </select>
                </td>

            </tr>

        </table>


        <button  id="account_fb" type="submit" >Registrati!</button>
    </div>

    <div id="content2">

        <div id="intestazione">
            <!--                <div id="logo_content">-->
            <img id="logo" src="IMG\ip_logo.png" >   
            <!--                </div>-->
        </div>

        <!--Centrale-->
        <div id="centrale">
           
            <div id="c_down">
                <div id="c_d_0" >
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/HyuAO67qt4k" frameborder="0" allowfullscreen></iframe>
                </div>
                <div id="c_d_1">

                </div>
                <div id="c_d_2">

                </div>
                <div id="c_d_3">

                </div>


            </div>
             <div id="c_top">
                <div id="c_top_1">
                    <div id="c_t_1" class="c_top">
<!--                        <img id="gio_c" src="img\gio_c.png">-->
                      <div class="c_top_text">  GIOCA <br> TUTTE LE AMICHEVOLI</div>
                    </div>
                    <div id="c_t_2" class="c_top">
<!--                        <img id="org_c" src="img\org_c.png?1">-->
                        <div class="c_top_text">ORGANIZZA <br>  UN CAMPIONATO</div>
                    </div>
                    <div id="c_t_3" class="c_top">
<!--                        <img id="org_c" src="img\ges_c.png?1">-->
                        <div class="c_top_text">GESTISCI <br> UN CAMPETTO</div>
                    </div>
                </div>
            </div>
        </div>    

        <!--Account-->
        <div id="account">
            <div id="registrazione" class="reg_content" >
                <div id="fb_reg">
                    <div id="reg_ip_text" class="reg_text">
                        ACCEDI O REGISTRATI TRAMITE FACEBOOK
                    </div>
                    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"  data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="true">
                    </fb:login-button>
                </div>
            </div>
            <div id="registrazione2" class="reg_content"  >
                <div id="login">
                    <div id="reg_ip_text" class="reg_text">
                        ENTRA IN IPSOCCER
                    </div>
                    <form id="login" action="verifica.php" method="post">
                        <fieldset id="inputs">
                            <div class="reg_field"> 
                                <label class="reg_label"  for="username">Username</label>
                                <input id="username" name="username" type="text" placeholder="Username" autofocus required>
                            </div>
                            <div class="reg_field"> 
                                <label class="reg_label" for="password">Password</label>
                                <input id="password" name="password" type="password" placeholder="Password" required>
                            </div>
                        </fieldset>
                        <fieldset id="actions">                            
                            <input type="submit" id="submit" value="Collegati">
                            <!-- <a href="registrati.php" id="back">Registrati</a>-->
                        </fieldset>
                    </form>
                </div>
            </div>
            <div id="registrazione3" class="reg_content"  >               
                <div id="ip_reg">
                    <div id="reg_ip_text" class="reg_text">
                        REGISTRATI A IPSOCCER
                    </div>
                    <form  id="login" action="register.php" method="post">
                        <fieldset id="inputs">
                             <div class="reg_field"> 
                                <label class="reg_label"  for="username">Username</label>
                                <input id="username" name="username" type="text" placeholder="Username" autofocus required>
                             </div>
                             <div class="reg_field"> 
                                <label class="reg_label" for="password">Password</label>
                                <input id="password" name="password" type="password" placeholder="Password" required>
                            </div>
                            <div class="reg_field"> 
                                <label style="width: 70%;" class="reg_label" for="password2">Ripeti Password</label>
                                <input id="password" name="password2" type="password" placeholder="Ripeti Password" required>
                            </div>
                            <div class="reg_field"> 
                                <label class="reg_label" for="password">Password</label>
                                <input id="email" name="email" type="email" placeholder="E-mail" required>
                            </div>
                            <div class="reg_field" > 
                                <label style="width: 100%;" class="reg_label" for="account">Seleziona il tuo Account</label>
                                <select  id="tipo" name="account"  placeholder="Account" required>
                                    <option value="gio"> Giocatore </option>  
                                    <option value="org"> Organizzatore </option>  
                                    <option value="gest"> Gestore </option>  
                                </select>
                            </div>
                        </fieldset>

                        <fieldset id="actions">
                            <input type="submit" id="submit" value="Registrati">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        <div id="footer">
             <div id="footer_content">
                IpSoccr 2016
            </div>
        </div>



    </div>
</body>
</html>

