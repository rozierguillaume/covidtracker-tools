<style>
div[shadow] {
    border: 0px solid black;
    padding: 10px 20px;
    border-radius: 7px;
    text-align: center;
    box-shadow: 6px 4px 25px #d6d6d6;
}

button {
    border: 1px solid;
    margin: 10px;
    padding: 15px;
    font-size : 16px;
    transition-duration: 0.4s;
    background-color: #ffffff;
    border-radius: 15px;

}

card {
    border: 1px solid;
    margin: 10px;
    padding: 15px;
    font-size : 16px;
    transition-duration: 0.4s;
    background-color: #ffffff;
    border-radius: 15px;

}

/* the flex container without mediaquerie */

div[class_perso] {
    display: flex;
    min-height: 12vh;
    flex-wrap: wrap;


    /* needed to stack children once to big */
}

div[class_perso] div {
    flex: 1;
    min-width: 200px;
    min-height: 7vh;
    /* 2 children + margin and borders makes a break point at around 620px */
    /*background: lightblue;*/

}

/*div div {*/
/*    !*border: solid;*!*/
/*    margin: 3px;*/
    /*background: tomato;*/
/*}*/

.videoWrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
}
.videoWrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* remove the grid system at about 620px */

@media screen and (max-width: 621px) {
    div[class_persos] {
        min-height: 30vh;
        /* has a meaning with a grid system */
    }

}
</style>
