<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <meta charset="utf-8" />

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>SysCoop</title>

    <meta name="description" content="" />
    
     <!-- Mobile viewport optimized: j.mp/bplateviewport -->
 	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link href="style.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold" rel="stylesheet" /> <!-- Load Droid Serif from Google Fonts -->
    <style>
                        /* Reset.css */
                html, body, div, span, object, iframe,
                h1, h2, h3, h4, h5, h6, p, blockquote, pre,
                abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp,
                small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li,
                fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td,
                article, aside, canvas, details, figcaption, figure,
                footer, header, hgroup, menu, nav, section, summary,
                time, mark, audio, video {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 100%;
                vertical-align: baseline;
                }
                article, aside, details, figcaption, figure,
                footer, header, hgroup, menu, nav, section {
                display: block;
                }
                blockquote, q { quotes: none; }
                blockquote:before, blockquote:after,
                q:before, q:after { content: ""; content: none; }
                .clearfix:before, .clearfix:after { content: ""; display: table; }
                .clearfix:after { clear: both; }
                .clearfix { zoom: 1; }
                /* End reset */


                /**
                * Styles start here
                */

                body { 
                        color: #333;
                        font: 16px/28px Georgia, 'Times New Roman', Times, serif;

                        /* CSS3 gradient background pattern @credits http://leaverou.me/demos/css3-patterns.html */
                        background-color: #eee; /* Change this to change both stribe colors */

                        background-image: -webkit-gradient(linear, 0 100%, 100% 0,
                                                                        color-stop(.25, rgba(255, 255, 255, .2)), color-stop(.25, transparent),
                                                                        color-stop(.5, transparent), color-stop(.5, rgba(255, 255, 255, .2)),
                                                                        color-stop(.75, rgba(255, 255, 255, .2)), color-stop(.75, transparent),
                                                                        to(transparent)); /* Old webkit syntax */
                        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
                                                                        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
                                                                        transparent 75%, transparent); /* New webkit syntax */					
                        background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
                                                                        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
                                                                        transparent 75%, transparent); /* Firefox */
                        background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
                                                                        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
                                                                        transparent 75%, transparent); /* Opera */
                        background-image: linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
                                                                        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
                                                                        transparent 75%, transparent); /* WC3 */
                        background-size: 16px 16px;
                }

                        /* Browsers who don't support gradients */
                        .no-cssgradients body {
                                background-image: url(images/bg.png);
                                background-repeat: repeat;
                                background-attachment: fixed;
                        }

                /* Always force a scrollbar in non-IE 
                        Remove iOS text size adjust without disabling user zoom: www.456bereastreet.com/archive/201012/controlling_text_size_in_safari_for_ios_without_disabling_user_zoom/ */
                html { overflow-y: scroll; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }

                #wrapper {
                        width: 1000px;
                        margin: 0 auto;
                }

                /**
                * Typography and default HTML elements
                */

                a {
                        color: #F71570;
                        text-decoration: none;
                        -webkit-transition: all 100ms linear;
                        /*-moz-transition: all 100ms linear;*/
                        transition: all 100ms linear;
                }

                a:hover {
                        color: #AC0649;
                        text-shadow: 0 1px 0 #fff;
                }

                a:active { outline: none; }

                p, dl, hr, h1, h2, h3,
                ol, ul, dd, pre, table, fieldset {
                        margin-bottom: 20px;
                }

                /* Headings */
                h1, h2, h3, h4, h5, h6 {
                        font-family: 'Droid Serif', sans-serif;
                        text-shadow: 0 1px 0 #fff;
                }

                h1 {
                        font-size: 32px;
                }

                h2 {
                        font-size: 28px;
                }

                h3 {
                        font-size: 26px;
                        letter-spacing: -1px;
                }

                .post h3 {
                        margin: 30px 0 20px;
                }

                h4 {
                        font-size: 21px;
                        margin-bottom: 15px;
                }

                h5 {
                        font-size: 18px;
                }

                h6 {
                        font-weight: normal;
                        font-size: 16px;
                }

                /* Lists */
                ol, ul {
                        margin-left: 40px;	
                }

                ol {
                        list-style: decimal;
                }

                ul {
                        list-style: square;
                }

                ol ol {
                        list-style: upper-alpha;
                }
                ol ol ol {
                        list-style: lower-roman;
                }
                ol ol ol ol {
                        list-style: lower-alpha;
                }

                ul ul, ol ol, ul ol, ol ul {
                        margin-bottom: 0;
                }

                dl {
                        margin: 0 20px;
                }

                dt {
                        font-weight: bold;
                }

                        /* Remove margins for navigation lists */
                        nav ul, nav li { margin: 0; list-style: none; list-style-image: none; }

                /* Code */
                pre, code, kbd, samp { font-family: monospace, sans-serif; }

                pre {
                        background: #464646;
                        border: solid #121212;
                        border-width: 2px 0 2px 0;
                        border-radius: 5px;
                        color: #fff;
                        padding: 20px;
                        white-space: pre; white-space: pre-wrap; word-wrap: break-word;
                        /*position: relative;*/
                        /*text-shadow: 0px 1px 0px #333;*/

                }

                        /* This is removed for now because of a strange Chrome bug with text-shadow and position: relative; */
                        /* Usage: <pre rel="CSS">...</pre>, <pre rel="PHP">...</pre> */
                        /*pre:after {
                                content: attr(rel);
                                color: #F83D87;
                                font: bold 16px 'Droid Serif', Georgia, serif;
                                position: absolute;
                                bottom: 10px; right: 15px;
                        }*/

                code {
                        background: #f6dde7;
                        font-size: 14px;
                        padding: 3px;
                        border-radius: 3px;
                }

                pre code {
                        background: none;
                        font-size: 16px;
                }

                /* Quotes */
                blockquote {
                        background: url(images/quote.png) no-repeat left top;
                        color: #424242;
                        font: italic 18px/32px 'Droid Serif', Georgia, serif;
                        padding: 33px 30px 0;
                        margin: 40px 20px 20px;
                        text-shadow: 0 1px 0 #fff;
                }

                blockquote p { margin: 0; }

                q { font-style: italic; }

                        /* Cite after <blockquote> */
                        blockquote + p {
                                margin-left: 20px;	
                        }

                        blockquote + p,
                        blockquote + cite,
                        blockquote + p cite {
                                font: 18px Garamond, 'Droid Serif', Georgia, serif;
                        }

                /* Tables */
                table {
                        border: 1px solid #e7e7e7;
                        border-collapse: collapse; border-spacing: 0;
                        font-size: 14px;
                        width: 100%;
                        text-align: left;
                }

                        /* th */
                        tr th,
                        thead th {
                                background: #f3f9fc;
                                border-left: 1px solid #e9f2f7;
                                color: #444;
                                font-size: 15px;
                                font-weight: bold;
                                padding: 9px 24px;
                                -webkit-box-shadow: inset 0 0 10px rgba(0, 0, 0, .04);
                                -moz-box-shadow: inset 0 0 10px rgba(0, 0, 0, .04);
                                box-shadow: inset 0 0 10px rgba(0, 0, 0, .04);
                        }

                        /* td */
                        tr td {
                                background: #fafafa;
                                border: 1px solid #e7e7e7;
                                padding: 6px 24px;
                        }

                        td { vertical-align: top; }

                        tr:nth-child(2n) td {
                                background: #f7f7f7;
                        }

                        tr:hover td {
                                background: #fff;
                        }

                        td, td img { vertical-align: top; }

                        /* tfoot */
                        tfoot td {
                                color: #777;
                                font-size: 11px;
                                text-transform: uppercase;	
                        }

                        tfoot th {
                                color: #444;
                                font-size: 12px;
                                text-transform: uppercase;	
                        }

                        /* Table caption */
                        table caption {
                                background: #ffffee;
                                border: 1px solid #ffffc6;
                                font-size: 16px;
                                margin-bottom: 5px;
                                padding: 10px;
                                border-radius: 5px;
                        }

                /* Other elements */
                sub, sup { font-size: 75%; line-height: 0; position: relative; }
                sup { top: -0.5em; }
                sub { bottom: -0.25em; }

                small { font-size: 85%; }
                b, strong, th { font-weight: bold; }

                ins { background-color: #ff9; color: #000; text-decoration: none; }
                mark { background-color: #ff9; color: #000; font-style: italic; font-weight: bold; }
                del { text-decoration: line-through; }
                abbr[title], dfn[title] { border-bottom: 1px dotted; cursor: help; }

                hr {
                        display: block;
                        height: 0px;
                        border: 0;
                        border-top: 1px solid #ccc;
                        border-bottom: 1px solid rgba(255, 255, 255, 0.6);
                        margin: 20px 0;
                        padding: 0;
                }

                /* These selection declarations have to be separate
                Also: hot pink! */
                ::-moz-selection{ background: #FF5E99; color: #fff; text-shadow: none; }
                ::selection { background: #FF5E99; color: #fff; text-shadow: none; }

                /**
                * Header
                */

                #header {
                        padding: 5px 2px 5px;
                }

                #site-title a {
                        color: #1e1e1e;
                        font: bold 40px 'Droid Serif', sans-serif;
                        float: left;
                        letter-spacing: -3px;
                        text-shadow: 0 1px 0 #fff;
                        -webkit-transition: all 200ms linear;
                        -moz-transition: all 200ms linear;
                        transition: all 200ms linear;

                        /* Gain the benefits from GPU acceleration */
                        -webkit-transform: translateZ(0);
                        /*-moz-transform: translateZ(0);*/
                        transform: translateZ(0);
                }

                #site-title a:hover {
                        background: none;
                        text-shadow: 0 1px 0 #fff;

                        /* Scale the site title on hover */
                        -webkit-transform: scale(1.1) translateZ(0);
                        /*-moz-transform: scale(1.1) translateZ(0);*/
                        transform: scale(1.1) translateZ(0);
                }

                #site-description {
                        font: normal 18px 'Droid Serif', sans-serif;
                        float: right;
                        padding-top: 32px;
                }

                /**
                * Content
                */

                #main { 
                        background: rgba(204, 204, 204, .4);
                        border-radius: 5px 5px 10px 10px;
                        width: 960px;
                        padding: 50px 20px 50px 20px;
                        -webkit-box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.4), 0px 0px 15px rgba(204, 204, 204, 0.5);
                        -moz-box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.4), 0px 0px 15px rgba(204, 204, 204, 0.5);
                        box-shadow: 0px 0px 0px 1px rgba(255, 255, 255, 0.4), 0px 0px 15px rgba(204, 204, 204, 0.5);
                }

                        /* No support for rgba */
                        .no-rgba #main {
                                background: url(images/content_bg.png) repeat;
                        }

                #content {
                        float: left;
                        width: 620px;
                }

                #sidebar {
                        float: right;
                        width: 300px;
                }

                /**
                * Navigation
                */

                #menu{
                        width: 100%;
                        margin: 0;
                        padding: 10px 0 0 0;
                        list-style: none;  
                        background: #111;
                        background: -moz-linear-gradient(#444, #111); 
                        background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #111),color-stop(1, #444));	
                        background: -webkit-linear-gradient(#444, #111);	
                        background: -o-linear-gradient(#444, #111);
                        background: -ms-linear-gradient(#444, #111);
                        background: linear-gradient(#444, #111);
                        -moz-border-radius: 50px;
                        border-radius: 50px;
                        -moz-box-shadow: 0 2px 1px #9c9c9c;
                        -webkit-box-shadow: 0 2px 1px #9c9c9c;
                        font: 14px 'Droid Serif', sans-serif;
                        box-shadow: 0 2px 1px #9c9c9c;
                }

                #menu li{
                        float: left;
                        padding: 0 0 10px 0;
                        position: relative;
                }

                #menu a{
                        float: left;
                        height: 25px;
                        padding: 0 25px;
                        color: #999;
                        text-transform: uppercase;
                        font: bold 12px/25px Arial, Helvetica;
                        text-decoration: none;
                        text-shadow: 0 1px 0 #000;
                }

                #menu li:hover > a{
                        color: #fafafa;
                }

                *html #menu li a:hover{ /* IE6 */
                        color: #fafafa;
                }

                #menu li:hover > ul{
                        display: block;
                }

                /* Sub-menu */

                #menu ul{
                    list-style: none;
                    margin: 0;
                    padding: 0;    
                    display: none;
                    position: absolute;
                    top: 35px;
                    left: 0;
                    z-index: 99999;    
                    background: #444;
                    background: -moz-linear-gradient(#444, #111);
                    background: -webkit-gradient(linear,left bottom,left top,color-stop(0, #111),color-stop(1, #444));
                    background: -webkit-linear-gradient(#444, #111);    
                    background: -o-linear-gradient(#444, #111);	
                    background: -ms-linear-gradient(#444, #111);	
                    background: linear-gradient(#444, #111);	
                    -moz-border-radius: 5px;
                    border-radius: 5px;
                }

                #menu ul li{
                    float: none;
                    margin: 0;
                    padding: 0;
                    display: block;  
                    -moz-box-shadow: 0 1px 0 #111111, 0 2px 0 #777777;
                    -webkit-box-shadow: 0 1px 0 #111111, 0 2px 0 #777777;
                    box-shadow: 0 1px 0 #111111, 0 2px 0 #777777;
                }

                #menu ul li:last-child{   
                    -moz-box-shadow: none;
                    -webkit-box-shadow: none;
                    box-shadow: none;    
                }

                #menu ul a{    
                    padding: 10px;
                    height: auto;
                    line-height: 1;
                    display: block;
                    white-space: nowrap;
                    float: none;
                    text-transform: none;
                }

                *html #menu ul a{ /* IE6 */   
                        height: 10px;
                        width: 150px;
                }

                *:first-child+html #menu ul a{ /* IE7 */    
                        height: 10px;
                        width: 150px;
                }

                #menu ul a:hover{
                        background: #0186ba;
                        background: -moz-linear-gradient(#04acec,  #0186ba);	
                        background: -webkit-gradient(linear, left top, left bottom, from(#04acec), to(#0186ba));
                        background: -webkit-linear-gradient(#04acec,  #0186ba);
                        background: -o-linear-gradient(#04acec,  #0186ba);
                        background: -ms-linear-gradient(#04acec,  #0186ba);
                        background: linear-gradient(#04acec,  #0186ba);
                }

                #menu ul li:first-child a{
                    -moz-border-radius: 5px 5px 0 0;
                    -webkit-border-radius: 5px 5px 0 0;
                    border-radius: 5px 5px 0 0;
                }

                #menu ul li:first-child a:after{
                    content: '';
                    position: absolute;
                    left: 30px;
                    top: -8px;
                    width: 0;
                    height: 0;
                    border-left: 5px solid transparent;
                    border-right: 5px solid transparent;
                    border-bottom: 8px solid #444;
                }

                #menu ul li:first-child a:hover:after{
                    border-bottom-color: #04acec; 
                }

                #menu ul li:last-child a{
                    -moz-border-radius: 0 0 5px 5px;
                    -webkit-border-radius: 0 0 5px 5px;
                    border-radius: 0 0 5px 5px;
                }

                /* Clear floated elements */
                #menu:after{
                        visibility: hidden;
                        display: block;
                        font-size: 0;
                        content: " ";
                        clear: both;
                        height: 0;
                }

                * html #menu             { zoom: 1; } /* IE6 */
                *:first-child+html #menu { zoom: 1; } /* IE7 
                /**
                * Post
                */

                .post {
                        padding: 20px 0 40px;
                        /*position: relative;*/
                }

                .post:first-of-type {
                        padding-top: 0;	
                }

                /* Post title */
                .post .entry-title {
                        margin-bottom: 40px;
                }

                .post .entry-title a {
                        color: #333;
                        display: block;
                        font-size: 38px;
                        font-weight: bold;
                        letter-spacing: -1px;
                        -webkit-transition: color 150ms ease-in-out;
                        /*-moz-transition: color 150ms ease-in-out;*/
                        transition: color 150ms ease-in-out;
                }

                .post .entry-title a:hover { 
                        color: #ac0649;
                }

                /* Post meta */
                .post-meta {
                        font: 14px 'Droid Serif', sans-serif;
                        margin: 40px 0 -20px;

                        /* CSS3 Flexible Box Model */
                        display: -webkit-box;
                        display: -moz-box;
                        display: box;
                        -webkit-box-orient: horizontal;
                        -moz-box-orient: horizontal;
                        box-orient: horizontal;
                }

                .post-meta p {
                        background: #f3f3f3; /* Fallback */
                        background: -moz-linear-gradient(top, #f3f3f3 0%, #ececec 100%); /* FF 3.6+ */
                        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f3f3f3), color-stop(100%,#ececec)); /* Chrome, Safari 4+ */
                        background: -webkit-linear-gradient(top, #f3f3f3 0%,#ececec 100%); /* Chrome 10+, Safari 5.1+ */
                        background: -o-linear-gradient(top, #f3f3f3 0%,#ececec 100%); /* Opera 11.10+ */
                        background: -ms-linear-gradient(top, #f3f3f3 0%,#ececec 100%); /* IE10+ */
                        background: linear-gradient(top, #f3f3f3 0%,#ececec 100%); /* W3C */

                        border: 1px solid;
                        border-color: #fff #c9c9c9 #c9c9c9 #fff;
                        border-radius: 5px;
                        line-height: 1.8;
                        margin: 0;
                        padding: 14px 10px;
                        text-shadow: 0 1px 0 #fff;

                        /* 2:1 ratio */
                        -webkit-box-flex: 2;
                        -moz-box-flex: 2;
                        box-flex: 2;
                }

                .more-link {
                        display: inline-block;
                        padding: 16px 12px;
                        margin-left: 40px;

                        /* 2:1 ratio */
                        -webkit-box-flex: 1;
                        -moz-box-flex: 1;
                        box-flex: 1;
                }

                .more-link:hover {
                        color: #fff;
                        text-shadow: none;
                }

                        /* No support for CSS3 Flexible Box Model */
                        .no-flexbox .post-meta p {
                                display: inline-block;
                                max-width: 480px;
                        }

                        .no-flexbox .more-link {
                                float: right;
                        }

                /* Post thumbnail and images */
                figure { 
                        background: #f4f4f4;
                        border: 2px solid #cecdcd;
                        border-radius: 3px 5px 5px 5px;
                        float: left;
                        padding: 10px;
                        text-align: center;
                        -webkit-transition: border 200ms ease;
                        /*-moz-transition: border 200ms ease;*/
                        transition: border 200ms ease;
                }

                figure:hover {
                        border: 2px solid #F83D87;
                }

                figure,
                figure.alignleft  {
                        margin: 0 20px 20px 0;
                }

                figure.alignright {
                        margin: 0 0 20px 20px;
                }

                figure {
                        margin-left: -40px;	
                }

                figcaption {
                        margin: 10px 0;
                        font: 14px 'Droid Serif', Georgia, serif;
                        color: #555;
                        text-align: center;
                        text-shadow: 0 1px 0 #fff;
                }

                        /* Thumbnail rotation */
                        /*.thumbnail,
                        .post:nth-of-type(2n) .thumbnail:hover {
                                -webkit-transform: rotate(0.45deg); 
                                -moz-transform: rotate(0.45deg); 
                                transform: rotate(0.45deg); 
                        }

                        .thumbnail:hover,
                        .post:nth-of-type(2n) .thumbnail {
                                -webkit-transform: rotate(-0.45deg);
                                -moz-transform: rotate(-0.45deg);
                                transform: rotate(-0.45deg);
                        }*/

                /**
                * Sidebar
                */

                #sidebar {}

                .widget {
                        border-top: 1px solid rgba(255, 255, 255, 0.6);
                        border-bottom: 1px solid #ccc;
                        padding: 30px 0;
                }

                .widget:first-child {
                        border-top: none;
                        padding-top: 0;
                }

                .widget:last-child {
                        border-bottom: none;
                }

                        /* Lists in widgets */
                        .widget li {
                                line-height: 35px;
                        }

                        .widget li a { 
                                color: #333;
                                -webkit-transition: margin-left 300ms linear;
                                /*-moz-transition: margin-left 300ms linear;*/
                                transition: margin-left 300ms linear;
                        }

                        .widget li a:hover {
                                color: #AC0649;
                                margin-left: 10px;
                        }

                /*
                * Footer
                */

                #footer {
                        color: #555;
                        padding: 40px 20px;
                        text-shadow: 1px 1px 0px #fff;
                }

                #footer a {
                        font: 14px 'Droid Serif', Georgia, serif;
                }

                /**
                * Forms
                */

                        /* 1) Make inputs and buttons play nice in IE: www.viget.com/inspire/styling-the-button-element-in-internet-explorer/
                        2) WebKit browsers add a 2px margin outside the chrome of form elements. 
                                Firefox adds a 1px margin above and below textareas 
                        3) Align to baseline */
                        button, input, select, textarea { width: auto; overflow: visible; margin: 0; vertical-align: baseline; outline: none; }

                        /* 1) Remove default scrollbar in IE: www.sitepoint.com/blogs/2010/08/20/ie-remove-textarea-scrollbars/
                        2) Align to text-top */
                        textarea { overflow: auto; vertical-align: text-top; }

                        /* Hand cursor on clickable input elements */
                        label[for], input[type="button"], input[type="submit"], input[type="image"], button { cursor: pointer; }

                        /* Remove extra padding and inner border in Firefox */
                        input::-moz-focus-inner,
                        button::-moz-focus-inner { border: 0; padding: 0; }

                        input[type="button"],
                        input[type="checkbox"],
                        input[type="radio"],
                        input[type="submit"],
                        select {
                                -moz-box-sizing: border-box;
                                -webkit-box-sizing: border-box;
                                box-sizing: border-box;
                        }

                        input[type="text"],
                        input[type="password"],
                        textarea {
                                -webkit-appearance: textfield;
                                -moz-box-sizing: content-box;
                                -webkit-box-sizing: content-box;
                                box-sizing: content-box;
                        }

                button, input, select, textarea, label {
                        font: 14px 'Droid Serif', Georgia, serif;	
                }

                label {
                        display: block;
                        font-weight: bold;
                        margin: 0 0 7px 10px;
                }

                fieldset {
                        background: rgba(204, 204, 204, 0.2);
                        border: 1px solid #c9c9c9;
                        border-radius: 5px;
                        padding: 20px;
                        -webkit-box-shadow: inset 0px 0px 1px 1px rgba(255, 255, 255, 0.7);
                        -moz-box-shadow: inset 0px 0px 1px 1px rgba(255, 255, 255, 0.7);
                        box-shadow: inset 0px 0px 1px 1px rgba(255, 255, 255, 0.7);
                }

                legend {
                        font: bold 14px 'Droid Serif', Georgia, serif;
                        padding: 10px 12px;	
                }

                /* Input fields */
                input,
                textarea {
                        background: #fff;
                        border: none;
                        border-radius: 20px;
                        color: #777;
                        padding: 10px 15px;
                        -webkit-box-shadow: 0px 1px 1px #bbb;
                        -moz-box-shadow: 0px 1px 1px #bbb;
                        box-shadow: 0px 1px 1px #bbb;
                }

                input:hover,
                input:focus,
                textarea:hover,
                textarea:focus {
                        color: #333;
                        -webkit-box-shadow: 0px 1px 1px #ccc, inset 1px 2px 1px rgba(250, 79, 170, 0.3);
                        -moz-box-shadow: 0px 1px 1px #ccc, inset 1px 2px 1px rgba(250, 79, 170, 0.3);
                        box-shadow: 0px 1px 1px #ccc, inset 1px 2px 1px rgba(250, 79, 170, 0.3);
                }

                textarea {
                        border-radius: 10px;
                }

                input[type="checkbox"],
                input[type="radio"],
                select {
                        margin-left: 10px;
                }

                /* Submit */
                input[type="submit"] {
                        color: #fff;
                }

                input[type="submit"]:hover {
                        text-shadow: 0 1px 0 #AC0649;
                }

                /* Search inputs */
                input[type="search"] {
                        background: #fff url(images/search.png) no-repeat 10px center;
                        padding-left: 25px;
                        -webkit-appearance: none;
                }

                input[type="search"]::-webkit-search-results-button {
                        -webkit-appearance: none;
                }

                .searchform input[type="search"] {
                        padding-right: 0;
                        max-width: 200px;
                }

                .searchform input[type="submit"] {
                        padding: 10px 12px;
                        float: right;
                }

                /**
                * Misc
                */

                .alignleft { float: left; }
                .alignright { float: right; }
                .clear { clear: both; }
                .sep { padding: 0 5px; }

                .hide { display: none; }

                .success {
                        background: url(images/accepted.png) no-repeat 10px center;
                        background-color: rgb(231, 247, 211);
                        background-color: rgba(231, 247, 211, 0.5);
                        border: 1px solid #6c3;
                        border-radius: 5px;
                        padding: 20px 0 20px 80px;
                }

                .error {
                        background: url(images/cancel.png) no-repeat 10px center;
                        background-color: rgb(255, 235, 232);
                        background-color: rgba(255, 235, 232, 0.5);
                        border: 1px solid #C00;
                        border-radius: 5px;
                        color: #C00;
                        padding: 20px 0 20px 80px;
                }

                .warning {
                        background: #fffbbc;
                        border: 1px solid #E6DB55;
                        padding: 20px;
                        border-radius: 5px;
                }

                div.warning { margin-bottom: 20px; }

                /**
                * Media queries for responsive design.
                * These follow after, and will override, the primary styles
                * The closing /mediaquery comment is required by respond.js min/max-width Media Query polyfill
                */

                @media only screen and (max-width: 1024px) {

                        /* Style adjustments for viewports 1024px and under go here */
                        #wrapper { width: 100%; }
                        #site-title a, #site-description { float: none; margin-bottom: 0; }
                        #main { width: 100%; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; }
                        #content { float: none; width: 100%; }
                        #sidebar { float: none; margin-top: 20px; }
                        figure { margin-left: 0; }

                }/*/mediaquery*/    
    </style>    
    <!-- All JavaScript at the bottom, except for Modernizr and Respond.
    	Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries -->
    
    <script src="js/modernizr-1.7.min.js"></script>
    <script src="js/respond.min.js"></script>
</head>

<body>

<div id="wrapper">

    <header id="header" class="clearfix" role="banner">
    
        <hgroup>
            <h5 id="site-title"><a href="index.html">SysCoop</a></h5>
            <h2 id="site-description">Bienvenido!!!!</h2>
        </hgroup>
    </header> <!-- #header -->
    <ul id="menu">
	<li>
        <a href="#">Ingreso</a>
		 <ul>
            <li><a href="http://localhost/cuerpo/index.php/person/principalinicio">Cuotas</a></li>
            <li><a href="#">Alquileres</a></li>
            <li><a href="#">Radio</a></li>
			<li><a href="#">Estampillas</a></li>
			<li><a href="#">Reintegro de Anticipos</a></li>
            <li><a href="#">Servicios a Terceros</a></li>
			
            
        </ul>
    </li>
	<li>
		<a href="#">Egreso</a>
		 <ul>
                    <li><a href="#">Publicidad</a></li>
                    <li><a href="#">Becas</a></li>
					<li><a href="#">Entrega de Anticipos</a></li>
                    <li><a href="#">Servicios</a></li>
                    <li><a href="#">Viaticos</a></li>
					<li><a href="#">Honorarios de sueldos</a></li>
					
					

                </ul>
	</li>
		<li>
		<a href="#"></a>
		 <ul>
                    
                </ul>
	</li>
        <li>
                <!-- <a href="#">Liquidación de sueldos</a> -->
        </li>
        <li>
                <!--<a href="http://localhost/SysCoop/index.php/pages/estampillas">Estampillas</a>-->
               
        </li>
        <li>
                <!-- <a href="#">Anticipos</a>-->
        </li>
    <!-- <li>
            <a href="#">Menu Item 5</a>
        </li>
        <li>
            <a href="http://google.com.ar/ig">Google!</a>
        </li>       --> 
	
</ul>


<div id="main" class="clearfix">

	<!-- Navigation -->
    
    
</div> <!-- #main -->
    
    <footer id="footer">
        <!-- You're free to remove the credit link to Jayj.dk in the footer, but please, please leave it there :) -->
        <p>
            Fecha Creacion: 2012 <a href="#" target="_blank">Sistema Administracion de Caja</a>
            <span class="sep">|</span>
        Diseñado por: <a href="" Diseñado por:="" target="_blank"> Grupo1</a> 
						
        </p>
    </footer> <!-- #footer -->
    
    <div class="clear"></div>

</div> <!-- #wrapper -->

	<!-- JavaScript at the bottom for fast page loading -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>