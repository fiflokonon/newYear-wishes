<!DOCTYPE html>
<html lang="fr">
<?php
$currentProtocol = request()->secure() ? 'https://' : 'http://';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lien du message</title>
    <style>
        body {
            font-family: Grand Hotel, 'serif';
            margin: 0;
            padding: 0;
            color: whitesmoke;
            /*background-image: url("/assets/images/background.jpeg");*/
            background-size: cover;
            background: linear-gradient(50deg, #202738, #795353, #9b2424) no-repeat center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: transparent;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .link-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            overflow-x: auto; /* Activer le défilement horizontal si nécessaire */
        }

        .link-box {
            flex: 1;
            padding: 5px;
            color: white;
            border: 1px solid #ced4da;
            border-radius: 4px;
            max-width: 300px; /* Ajoutez une largeur maximale selon vos besoins */
            overflow: hidden;
            text-overflow: ellipsis; /* Afficher des points de suspension pour les textes dépassant la largeur */
            white-space: nowrap; /* Empêcher le retour à la ligne du texte */
        }

        #copyLinkButton {
            background-color: #28a745;
            color: #fff;
            padding: 10px 12px;
            border: none;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
            font-family: Grand Hotel, 'serif';
        }

        #copyLinkButton:hover {
            background-color: #218838;
        }

        form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }

        * {
            margin: 0;
            padding: 0;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        .pg-footer {
            font-family: 'Roboto', sans-serif;
        }


        .footer {
            background-color: #004658;
            color: #fff;
        }
        .footer-wave-svg {
            background-color: transparent;
            display: block;
            height: 30px;
            position: relative;
            top: -1px;
            width: 100%;
        }
        .footer-wave-path {
            fill: #fffff2;
        }

        .footer-content {
            margin-left: auto;
            margin-right: auto;
            max-width: 1230px;
            padding: 40px 15px 450px;
            position: relative;
        }

        .footer-content-column {
            box-sizing: border-box;
            float: left;
            padding-left: 15px;
            padding-right: 15px;
            width: 100%;
            color: #fff;
        }

        .footer-content-column ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer-logo-link {
            display: inline-block;
        }
        .footer-menu {
            margin-top: 30px;
        }

        .footer-menu-name {
            color: #fffff2;
            font-size: 15px;
            font-weight: 900;
            letter-spacing: .1em;
            line-height: 18px;
            margin-bottom: 0;
            margin-top: 0;
            text-transform: uppercase;
        }
        .footer-menu-list {
            list-style: none;
            margin-bottom: 0;
            margin-top: 10px;
            padding-left: 0;
        }
        .footer-menu-list li {
            margin-top: 5px;
        }

        .footer-call-to-action-description {
            color: #fffff2;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .footer-call-to-action-button:hover {
            background-color: #fffff2;
            color: #00bef0;
        }
        .button:last-of-type {
            margin-right: 0;
        }
        .footer-call-to-action-button {
            background-color: #027b9a;
            border-radius: 21px;
            color: #fffff2;
            display: inline-block;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .1em;
            line-height: 18px;
            padding: 12px 30px;
            margin: 0 10px 10px 0;
            text-decoration: none;
            text-transform: uppercase;
            transition: background-color .2s;
            cursor: pointer;
            position: relative;
        }
        .footer-call-to-action {
            margin-top: 30px;
        }
        .footer-call-to-action-title {
            color: #fffff2;
            font-size: 14px;
            font-weight: 900;
            letter-spacing: .1em;
            line-height: 18px;
            margin-bottom: 0;
            margin-top: 0;
            text-transform: uppercase;
        }
        .footer-call-to-action-link-wrapper {
            margin-bottom: 0;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
        }
        .footer-call-to-action-link-wrapper a {
            color: #fff;
            text-decoration: none;
        }





        .footer-social-links {
            bottom: 0;
            height: 54px;
            position: absolute;
            right: 0;
            width: 236px;
        }

        .footer-social-amoeba-svg {
            height: 54px;
            left: 0;
            display: block;
            position: absolute;
            top: 0;
            width: 236px;
        }

        .footer-social-amoeba-path {
            fill: #027b9a;
        }

        .footer-social-link.linkedin {
            height: 26px;
            left: 3px;
            top: 11px;
            width: 26px;
        }

        .footer-social-link {
            display: block;
            padding: 10px;
            position: absolute;
        }

        .hidden-link-text {
            position: absolute;
            clip: rect(1px 1px 1px 1px);
            clip: rect(1px,1px,1px,1px);
            -webkit-clip-path: inset(0px 0px 99.9% 99.9%);
            clip-path: inset(0px 0px 99.9% 99.9%);
            overflow: hidden;
            height: 1px;
            width: 1px;
            padding: 0;
            border: 0;
            top: 50%;
        }

        .footer-social-icon-svg {
            display: block;
        }

        .footer-social-icon-path {
            fill: #fffff2;
            transition: fill .2s;
        }

        .footer-social-link.twitter {
            height: 28px;
            left: 62px;
            top: 3px;
            width: 28px;
        }

        .footer-social-link.youtube {
            height: 24px;
            left: 123px;
            top: 12px;
            width: 24px;
        }

        .footer-social-link.github {
            height: 34px;
            left: 172px;
            top: 7px;
            width: 34px;
        }

        .footer-copyright {
            background-color: #027b9a;
            color: #fff;
            padding: 15px 30px;
            text-align: center;
        }

        .footer-copyright-wrapper {
            margin-left: auto;
            margin-right: auto;
            max-width: 1200px;
        }

        .footer-copyright-text {
            color: #fff;
            font-size: 13px;
            font-weight: 400;
            line-height: 18px;
            margin-bottom: 0;
            margin-top: 0;
        }

        .footer-copyright-link {
            color: #fff;
            text-decoration: none;
        }







        /* Media Query For different screens */
        @media (min-width:320px) and (max-width:479px)  { /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */
            .footer-content {
                margin-left: auto;
                margin-right: auto;
                max-width: 1230px;
                padding: 40px 15px 1050px;
                position: relative;
            }
        }
        @media (min-width:480px) and (max-width:599px)  { /* smartphones, Android phones, landscape iPhone */
            .footer-content {
                margin-left: auto;
                margin-right: auto;
                max-width: 1230px;
                padding: 40px 15px 1050px;
                position: relative;
            }
        }
        @media (min-width:600px) and (max-width: 800px)  { /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */
            .footer-content {
                margin-left: auto;
                margin-right: auto;
                max-width: 1230px;
                padding: 40px 15px 1050px;
                position: relative;
            }
        }
        @media (min-width:801px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */

        }
        @media (min-width:1025px) { /* big landscape tablets, laptops, and desktops */

        }
        @media (min-width:1281px) { /* hi-res laptops and desktops */

        }




        @media (min-width: 760px) {
            .footer-content {
                margin-left: auto;
                margin-right: auto;
                max-width: 1230px;
                padding: 40px 15px 450px;
                position: relative;
            }

            .footer-wave-svg {
                height: 50px;
            }

            .footer-content-column {
                width: 24.99%;
            }
        }
        @media (min-width: 568px) {
            /* .footer-content-column {
                width: 49.99%;
            } */
        }

    </style>
</head>

<body>

<main>
    <h1 style="color: red; font-family: Grand Hotel, 'cursive'">Votre message a été enregistré avec succès ! </h1>
    <p> Cliquez sur le bouton <strong>copier</strong> pour copier le lien !</p>
    <p style="color: darkred; font-family: Grand Hotel, 'cursive'; font-size: 20px;"> Partagez-le sur vos réseaux sociaux !</p>
    <p style="color: green; font-family: Grand Hotel, 'cursive'; font-size: 20px;">Partagez-le avec vos amis ! </p>
    <div class="link-container">
        <div class="link-box" id="linkBox">{{ $currentProtocol }}{{ request()->getHttpHost()  }}/messages/{{ $message->link }}</div>
        <button id="copyLinkButton" onclick="copyToClipboard()">Copier</button>
    </div>


    <form id="news">
        <h2 style="text-align: center; color: red; font-family: Grand Hotel, 'cursive'">Abonnez-vous à notre newsletter pour des nouveautés !</h2>
        <input type="email" id="email" name="email" placeholder="Entrer votre email" required style="font-family: Grand Hotel, 'serif'">
        <button id="submit" style="font-family: Grand Hotel, 'serif'">S'abonner</button>
    </form>
    <div id="thankYouBlock" style="display: none;">
        <div style="font-family: Grand Hotel, 'serif'">
            <!-- Message de remerciements -->
            <h1 style="font-family: Grand Hotel, 'cursive'; color: green; ">Merci de vous être abonné !</h1>
            <p class="lead">Vous êtes maintenant abonné à notre newsletter. Restez à l'écoute pour les dernières mises à jour.</p>
        </div>
    </div>
</main>

{{-- --}}
<div class="pg-footer">
    <footer class="footer">
        <svg class="footer-wave-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 100"
             preserveAspectRatio="none">
            <path class="footer-wave-path"
                  d="M851.8,100c125,0,288.3-45,348.2-64V0H0v44c3.7-1,7.3-1.9,11-2.9C80.7,22,151.7,10.8,223.5,6.3C276.7,2.9,330,4,383,9.8 c52.2,5.7,103.3,16.2,153.4,32.8C623.9,71.3,726.8,100,851.8,100z"></path>
        </svg>
        <div class="footer-content">
            <div class="footer-content-column">
                <div class="footer-logo">
                    <a class="footer-logo-link" href="#">
                        <span class="hidden-link-text">LOGO</span>
                        <h1>LOGO</h1>
                    </a>
                </div>
                <div class="footer-menu">
                    <h2 class="footer-menu-name"> Get Started</h2>
                    <ul id="menu-get-started" class="footer-menu-list">
                        <li class="menu-item menu-item-type-post_type menu-item-object-product">
                            <a href="#">Start</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-product">
                            <a href="#">Documentation</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-product">
                            <a href="#">Installation</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-content-column">
                <div class="footer-menu">
                    <h2 class="footer-menu-name"> Company</h2>
                    <ul id="menu-company" class="footer-menu-list">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="#">Contact</a>
                        </li>
                        <li class="menu-item menu-item-type-taxonomy menu-item-object-category">
                            <a href="#">News</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="#">Careers</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-menu">
                    <h2 class="footer-menu-name"> Legal</h2>
                    <ul id="menu-legal" class="footer-menu-list">
                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-170434">
                            <a href="#">Privacy Notice</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-content-column">
                <div class="footer-menu">
                    <h2 class="footer-menu-name"> Quick Links</h2>
                    <ul id="menu-quick-links" class="footer-menu-list">
                        <li class="menu-item menu-item-type-custom menu-item-object-custom">
                            <a target="_blank" rel="noopener noreferrer" href="#">Support Center</a>
                        </li>
                        <li class="menu-item menu-item-type-custom menu-item-object-custom">
                            <a target="_blank" rel="noopener noreferrer" href="#">Service Status</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="#">Security</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="#">Blog</a>
                        </li>
                        <li class="menu-item menu-item-type-post_type_archive menu-item-object-customer">
                            <a href="#">Customers</a></li>
                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                            <a href="#">Reviews</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-content-column">
                <!--<div class="footer-call-to-action">
                    <h2 class="footer-call-to-action-title"> Let's Chat</h2>
                    <p class="footer-call-to-action-description"> Have a support question?</p>
                    <a class="footer-call-to-action-button button" href="#" target="_self"> Get in Touch </a>
                </div>-->
                <div class="footer-call-to-action">
                    <h2 class="footer-call-to-action-title"> Appelez-nous !</h2>
                    <p class="footer-call-to-action-link-wrapper"><a class="footer-call-to-action-link"
                                                                     href="tel:0124-64XXXX" target="_self"> +229
                            68947612 </a></p>
                </div>
            </div>
            <div class="footer-social-links">
                <svg class="footer-social-amoeba-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 236 54">
                    <path class="footer-social-amoeba-path"
                          d="M223.06,43.32c-.77-7.2,1.87-28.47-20-32.53C187.78,8,180.41,18,178.32,20.7s-5.63,10.1-4.07,16.7-.13,15.23-4.06,15.91-8.75-2.9-6.89-7S167.41,36,167.15,33a18.93,18.93,0,0,0-2.64-8.53c-3.44-5.5-8-11.19-19.12-11.19a21.64,21.64,0,0,0-18.31,9.18c-2.08,2.7-5.66,9.6-4.07,16.69s.64,14.32-6.11,13.9S108.35,46.5,112,36.54s-1.89-21.24-4-23.94S96.34,0,85.23,0,57.46,8.84,56.49,24.56s6.92,20.79,7,24.59c.07,2.75-6.43,4.16-12.92,2.38s-4-10.75-3.46-12.38c1.85-6.6-2-14-4.08-16.69a21.62,21.62,0,0,0-18.3-9.18C13.62,13.28,9.06,19,5.62,24.47A18.81,18.81,0,0,0,3,33a21.85,21.85,0,0,0,1.58,9.08,16.58,16.58,0,0,1,1.06,5A6.75,6.75,0,0,1,0,54H236C235.47,54,223.83,50.52,223.06,43.32Z"></path>
                </svg>
                <a class="footer-social-link linkedin" href="https://www.linkedin.com/in/arnaud-fifonsi-lokonon"
                   target="_blank">
                    <span class="hidden-link-text">Linkedin</span>
                    <svg class="footer-social-icon-svg" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 30 30">
                        <path class="footer-social-icon-path"
                              d="M9,25H4V10h5V25z M6.501,8C5.118,8,4,6.879,4,5.499S5.12,3,6.501,3C7.879,3,9,4.121,9,5.499C9,6.879,7.879,8,6.501,8z M27,25h-4.807v-7.3c0-1.741-0.033-3.98-2.499-3.98c-2.503,0-2.888,1.896-2.888,3.854V25H12V9.989h4.614v2.051h0.065 c0.642-1.18,2.211-2.424,4.551-2.424c4.87,0,5.77,3.109,5.77,7.151C27,16.767,27,25,27,25z"></path>
                    </svg>
                </a>
                <a class="footer-social-link twitter" href="#" target="_blank">
                    <span class="hidden-link-text">Twitter</span>
                    <svg class="footer-social-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26">
                        <path class="footer-social-icon-path"
                              d="M 25.855469 5.574219 C 24.914063 5.992188 23.902344 6.273438 22.839844 6.402344 C 23.921875 5.75 24.757813 4.722656 25.148438 3.496094 C 24.132813 4.097656 23.007813 4.535156 21.8125 4.769531 C 20.855469 3.75 19.492188 3.113281 17.980469 3.113281 C 15.082031 3.113281 12.730469 5.464844 12.730469 8.363281 C 12.730469 8.773438 12.777344 9.175781 12.867188 9.558594 C 8.503906 9.339844 4.636719 7.246094 2.046875 4.070313 C 1.59375 4.847656 1.335938 5.75 1.335938 6.714844 C 1.335938 8.535156 2.261719 10.140625 3.671875 11.082031 C 2.808594 11.054688 2 10.820313 1.292969 10.425781 C 1.292969 10.449219 1.292969 10.46875 1.292969 10.492188 C 1.292969 13.035156 3.101563 15.15625 5.503906 15.640625 C 5.0625 15.761719 4.601563 15.824219 4.121094 15.824219 C 3.78125 15.824219 3.453125 15.792969 3.132813 15.730469 C 3.800781 17.8125 5.738281 19.335938 8.035156 19.375 C 6.242188 20.785156 3.976563 21.621094 1.515625 21.621094 C 1.089844 21.621094 0.675781 21.597656 0.265625 21.550781 C 2.585938 23.039063 5.347656 23.90625 8.3125 23.90625 C 17.96875 23.90625 23.25 15.90625 23.25 8.972656 C 23.25 8.742188 23.246094 8.515625 23.234375 8.289063 C 24.261719 7.554688 25.152344 6.628906 25.855469 5.574219 "></path>
                    </svg>
                </a>
                <a class="footer-social-link youtube" href="#" target="_blank">
                    <span class="hidden-link-text">Youtube</span>
                    <svg class="footer-social-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
                        <path class="footer-social-icon-path"
                              d="M 15 4 C 10.814 4 5.3808594 5.0488281 5.3808594 5.0488281 L 5.3671875 5.0644531 C 3.4606632 5.3693645 2 7.0076245 2 9 L 2 15 L 2 15.001953 L 2 21 L 2 21.001953 A 4 4 0 0 0 5.3769531 24.945312 L 5.3808594 24.951172 C 5.3808594 24.951172 10.814 26.001953 15 26.001953 C 19.186 26.001953 24.619141 24.951172 24.619141 24.951172 L 24.621094 24.949219 A 4 4 0 0 0 28 21.001953 L 28 21 L 28 15.001953 L 28 15 L 28 9 A 4 4 0 0 0 24.623047 5.0546875 L 24.619141 5.0488281 C 24.619141 5.0488281 19.186 4 15 4 z M 12 10.398438 L 20 15 L 12 19.601562 L 12 10.398438 z"></path>
                    </svg>
                </a>
                <a class="footer-social-link github" href="https://github.com/fiflokonon" target="_blank">
                    <span class="hidden-link-text">Github</span>
                    <svg class="footer-social-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                        <path class="footer-social-icon-path"
                              d="M 16 4 C 9.371094 4 4 9.371094 4 16 C 4 21.300781 7.4375 25.800781 12.207031 27.386719 C 12.808594 27.496094 13.027344 27.128906 13.027344 26.808594 C 13.027344 26.523438 13.015625 25.769531 13.011719 24.769531 C 9.671875 25.492188 8.96875 23.160156 8.96875 23.160156 C 8.421875 21.773438 7.636719 21.402344 7.636719 21.402344 C 6.546875 20.660156 7.71875 20.675781 7.71875 20.675781 C 8.921875 20.761719 9.554688 21.910156 9.554688 21.910156 C 10.625 23.746094 12.363281 23.214844 13.046875 22.910156 C 13.15625 22.132813 13.46875 21.605469 13.808594 21.304688 C 11.144531 21.003906 8.34375 19.972656 8.34375 15.375 C 8.34375 14.0625 8.8125 12.992188 9.578125 12.152344 C 9.457031 11.851563 9.042969 10.628906 9.695313 8.976563 C 9.695313 8.976563 10.703125 8.65625 12.996094 10.207031 C 13.953125 9.941406 14.980469 9.808594 16 9.804688 C 17.019531 9.808594 18.046875 9.941406 19.003906 10.207031 C 21.296875 8.65625 22.300781 8.976563 22.300781 8.976563 C 22.957031 10.628906 22.546875 11.851563 22.421875 12.152344 C 23.191406 12.992188 23.652344 14.0625 23.652344 15.375 C 23.652344 19.984375 20.847656 20.996094 18.175781 21.296875 C 18.605469 21.664063 18.988281 22.398438 18.988281 23.515625 C 18.988281 25.121094 18.976563 26.414063 18.976563 26.808594 C 18.976563 27.128906 19.191406 27.503906 19.800781 27.386719 C 24.566406 25.796875 28 21.300781 28 16 C 28 9.371094 22.628906 4 16 4 Z "></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="footer-copyright-wrapper">
                <p class="footer-copyright-text">
                    <a class="footer-copyright-link" href="#" target="_self"> ©2023. | All rights reserved. </a>
                </p>
            </div>
        </div>
    </footer>
</div>

<script>
    function copyToClipboard() {
        var copyText = document.getElementById("linkBox");
        navigator.clipboard.writeText(copyText.innerText).then(function () {
            alert("Lien copié avec succès !");
        }).catch(function (err) {
            console.error('Erreur lors de la copie du lien : ', err);
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function(){
            $('#submit').click(function(e){
                e.preventDefault();
                const formData = {
                    email: $('#email').val(),
                };
                $.ajax({
                    type: 'POST',
                    url: '/newsletter/subscription',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: formData.email
                    },
                    success: function(response){
                        if (response.success) {
                            $('#news').hide();
                            showThankYouBlock();
                        }
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
            });
            function showThankYouBlock() {
                var thb = document.getElementById('thankYouBlock');
                thb.style.display = 'flex';
            }
        });
    });
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>

</body>

</html>
