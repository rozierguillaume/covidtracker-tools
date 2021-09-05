<style>

.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
    background-color: white;
    color: black;
    border: 1px solid darkgrey;
    border-radius: 7px;
}

.nav>li>a{
    color: black;
}

.nav>li>:hover{
    border: 1px solid darkgrey;
    border-radius: 7px;
    color: black;
}

.boxshadow{
    border: 1px solid black;
    padding: 6px;
    border-radius: 5px;
    color:black;
}

.btn-actif{
    padding: 6px;
    border: 1px solid grey;
}

.btn-inactif{
    border: 1px solid white;
    padding: 6px;
    color:black;
}

.btn-inactif:hover{
    border: 1px solid grey;
    background-color: grey;
    padding: 6px;
    color:white;
}

.shadow {
    border: 0px solid black;
    padding: 12px;
    border-radius: 7px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    background: #ffffff;
    margin-top: 10px;
    }

p {
    font-size: 17px;
}

.wrap {
    display: flex;
    margin-top: 0px;
    flex-wrap: wrap;
    }

.wrap>* {
    flex: 1 1 180px;
}

.boxshadow {
    border: 0px solid black;
    margin-top: 18px;
    padding: 10px 10px 10px 10px;
    border-radius: 7px;
    margin-right: 15px;
    max-width: 500px;
    text-align: left;
    /*box-shadow: 6px 4px 25px #c3d19d;*/
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    width: 100%;
    background: #ffffff;
    }

.boxshadow-wide {
    border: 0px solid black;
    margin-top: 18px;
    padding: 10px 10px 10px 10px;
    border-radius: 7px;
    margin-right: 15px;
    max-width: 800px;
    text-align: left;
    /*box-shadow: 6px 4px 25px #c3d19d;*/
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    width: 100%;
    background: #ffffff;
}

.title_h2 {
    margin-top: 30px;
    margin-bottom: 10px;
}

.title {
    margin-top: 100px;
    font-size: 28px;
    margin-bottom: 20px;
}

.custom_picker{
    background-color: #f7f7f7 !important;
    box-shadow: none !important;
}

.disable_link {
    pointer-events:none;
}

.selectors {

    border:2px solid lightgray;
    border-radius:10px;
    padding:6px;
    width:45%;
}

.emphasis {
    font-weight:bold;
    //color:#e76f51;
}

.slider:before{
content : '';
}

.slider { 
    -webkit-appearance: none;
    position: relative;
    overflow: hidden;
    height: 20px;
    width: 600px;
    cursor: pointer;
    border-radius: 7px; /* iOS */
}

::-webkit-slider-runnable-track {
    background: #ededed;
}

/*
 * 1. Set to 0 width and remove border for a slider without a thumb
 */
::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 20px; /* 1 */
    height: 20px;
    background: #fff;
    border-radius: 7px !important;
    box-shadow: -100vw 0 0 99vw lightgrey;
    border: 2px solid #999; /* 1 */
}


::-moz-range-track {
    height: 20px;
    background: #ededed;
}

::-moz-range-thumb {
    background: #fff;
    height: 20px;
    width: 20px;
    border: 2px solid #999;
    border-radius: 7px !important;
    box-shadow: -100vw 0 0 99vw lightgrey;
    box-sizing: border-box;
}

::-ms-fill-lower { 
    background: dodgerblue;
}

::-ms-thumb { 
    background: #fff;
    border: 2px solid #999;
    height: 40px;
    width: 20px;
    box-sizing: border-box;
}

::-ms-ticks-after { 
    display: none; 
}

::-ms-ticks-before { 
    display: none; 
}

::-ms-track { 
    background: #ededed;
    color: transparent;
    height: 40px;
    border: none;
}

::-ms-tooltip { 
    display: none;
}
</style>