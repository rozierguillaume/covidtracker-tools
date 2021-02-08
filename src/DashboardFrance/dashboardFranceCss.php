<style>
    * {margin: 0; padding: 0;}
    #container {height: 100%; width:100%; font-size: 0;}
    #left, #middle, #right {display: inline-block; *display: inline; zoom: 1; vertical-align: top; font-size: 12px;}
    #left {width: 33%;}
    #middle {width: 33%;}
    #right {width: 33%;}

    div[shadow] {

    }

    div[class_perso] {
        display: flex;
        min-height: 12vh;
        flex-wrap: wrap;
        border: 0px solid black;
        padding: 10px 20px;
        border-radius: 7px;
        text-align: center;
        box-shadow: 6px 4px 25px #d6d6d6;

        /* needed to stack children once to big */
    }

    div[class_perso] div {
        flex: 1;
        min-width: 200px;
        min-height: 7vh;
        /* 2 children + margin and borders makes a break point at around 620px */
        /*background: lightblue;*/
    }


    .nav-tabs > li > a {
        margin-right: 0px !important;
        line-height: 1.42857143 !important;
        border: 1px solid #ececec !important;
        border-radius: 0px 0px 0 0 !important;
        background-color: #fbfbfb  !important;
        color: #000000 !important;
        padding: 15px 18px 15px 18px !important;
        text-decoration: none !important;
        font-size: 14px !important;
        text-align: center !important;
        font-family: Open Sans !important;
    }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
        color: #000000 !important;
        cursor: default;
        background-color: #e5e5e5 !important;
        border: 1px solid #cccccc !important;
    }

    .tab-content {
        padding: 20px;
        border: 1px solid #e6e6e6 !important;
        margin-top: 0px;
        background-color: #ffffff !important;
        color: #000000 !important;
        font-size: 16px !important;
        font-family: Open Sans !important;
        border: 1px solid #e6e6e6 !important;
    }

    #echelleResume>div{
        display: inline-block;
        white-space: nowrap;
    }

    @media screen and (max-width:767px){
        .nav-tabs > li {width:100%;}
    }

    /* remove the grid system at about 620px */

    @media screen and (max-width: 621px) {
        div[class_persos] {
            min-height: 30vh;
            /* has a meaning with a grid system */
        }

        #echelleResume>div{
            display: block;
        }

    }


</style>