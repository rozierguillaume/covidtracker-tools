
<style>
button {
    border: 1px solid;
    margin: 10px;
    padding: 15px;
    font-size : 16px;
    transition-duration: 0.4s;
    background-color: #ffffff;
    border-radius: 15px;

}

.shadow-btn {
    color: black;
    border: 0px solid black;
    padding: 12px;
    font-size: 100%;
    border-radius: 7px;
    margin-right: 5px;
    margin-bottom: 5px;
    margin-top: 2px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 6px 4px 25px #d6d6d6;
    max-width: 350px;
    background: #ffffff;
    min-height:170px;
}

.shadow-btn-green {
    color: black;
    border: 2.5px solid rgba(139, 201, 170, 0.7);
    padding: 12px;
    font-size: 100%;
    border-radius: 7px;
    margin-right: 5px;
    margin-bottom: 5px;
    margin-top: 2px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 2px 2px 10px #d6d6d6;
    max-width: 350px;
    background: rgba(242, 255, 242, 0.3);
    min-height:130px;
    max-height:130px;


}

.shadow-btn-green:hover {
    border: 2.5px solid rgba(139, 201, 170, 1);

}

.shadow-btn-red {
    color: black;
    border: 2.5px solid rgba(201, 139, 139, 0.7);
    padding: 12px;
    font-size: 100%;
    border-radius: 7px;
    margin-right: 5px;
    margin-bottom: 5px;
    margin-top: 2px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 2px 2px 10px #d6d6d6;
    max-width: 350px;
    background: rgba(255, 242, 243, 0.3);
    min-height:130px;
    min-height:130px;
}

.shadow-btn-red:hover {
    border: 2.5px solid rgba(201, 139, 139, 1);

}

.shadow-btn-black {
    color: black;
    border: 2px solid rgba(0, 0, 0, 0.3);
    padding: 12px;
    font-size: 100%;
    border-radius: 7px;
    margin-right: 5px;
    margin-bottom: 5px;
    margin-top: 2px;
    text-align: left;
    box-shadow: 0 0 0 transparent, 0 0 0 transparent, 2px 2px 10px #d6d6d6;
    max-width: 350px;
    background: rgba(237, 237, 237, 0.3);
    min-height:100px;
    max-height: 100px;
}

.shadow-btn-black:hover {
    border: 2.5px solid rgba(0, 0, 0, 0.5);

}

/* ==== JE SAIS C'EST MOCHE MAIS POUR L'INSTANT ÇA M'AIDE A M'Y RETROUVER ==== */

#rdv {
  font-family: Roboto, Ubuntu, monospace;
}


.dpt-select {
    background: #FFFFFF;
    border: 3px solid #629CEA;
    border-radius: 6px;
    box-sizing: border-box;
    box-shadow: 0px 5px 3px rgba(173, 173, 173, 0.25);
    display: block;
    color: #44516B;
    font-size:1.3rem;
    font-weight: 500;
    margin: 1.6rem auto 2.1rem auto;
    padding: 1rem 0.5rem 1rem;
    width:299px;

    /* select arrow-down customization */
    background: url(./arrow-down-circle.svg) no-repeat right #FFFFFF;
    background-image: url("data:image/svg+xml,%0A%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='28' viewBox='0 0 24 24' fill='none' stroke='%232F80ED' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-arrow-down-circle'%3E%3Ccircle cx='12' cy='12' r='10'%3E%3C/circle%3E%3Cpolyline points='8 12 12 16 16 12'%3E%3C/polyline%3E%3Cline x1='12' y1='8' x2='12' y2='16'%3E%3C/line%3E%3C/svg%3E");
    font-family: Roboto, Ubuntu, monospace;
    -webkit-appearance: none;
    background-position-x: 256px;
}

.dpt-select:hover, .dpt-select option {
    cursor:pointer;
}


/* ---- SELECTED DPT TITLE & INFO ---- */

.dpt-selected {
    color: #44516B;
    font-size: 1.875rem;
    margin-bottom: 1rem;
    text-align: center;
}

.last-update-info {
    color: #636363;
    display: block;
    text-align: center;
}

.last-update-info span {
    color:#44516B;
    font-weight: 600;
}


/* ---- SECTION: RESULTS (GOOD or BAD) ---- */

#rdv .results {
    display:flex;
    padding: 0;
    flex-direction:column;
    align-items: center;
}


/* ---- VACCINATION CARD ----
*  Those properties are applying in priority on the small-width screens.
*  There is a media query later on for screens wider than 767px
*/

.linking-container /* link is all over the card, prevent the underline on all text inside the card */
{ text-decoration: none;}

.card {
    background-color: white;
    border: 1px solid rgba(224, 224, 224, 1);
    border-radius: 6px;
    box-shadow: 0px 1px 1px rgba(44, 44, 44, 0.17);
    display:block;
    margin:1rem;
    padding: 1rem;
    width:290px;
    text-decoration: none;
    transition-duration: 280ms;
}

.card:hover {
    box-shadow: 0px 6px 5px rgba(201, 205, 211, 0.719);
    cursor:pointer;
}

.card__info {
    margin: 0.5rem 0px 0.5rem 0px;
    text-align: center;
}

.card__date {
    font-weight:700;
    color: #113669;
    font-size: 1.18rem;
}

.card__location {
    color:rgb(39, 39, 39);
}

.card__booking-area {
    display:grid;
    place-content: center;
    margin-top:1rem;
}

.card__btn {
    background: #2F80ED;
    border:none;
    border-radius: 5px;
    outline:none;

    color:white;
    font-size: 1rem;
    text-align: center;
    text-transform: uppercase;

    margin:0.4rem;
    padding: 0.6rem 0.8rem 0.6rem;
    width:auto;

    transition-duration: 270ms;
}

.card__btn:hover {
    background: #1c6ad1;
    cursor:pointer;
}

.card__booking-engine {
    color:#328bff;
    font-size: 0.88rem;
    margin:0px;
    text-align: center;
}

.card__booking-engine:hover {
    color: #14488E;
}



@media only screen and (min-width: 1000px)
{

    .card {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;

        min-width: 760px;
        box-shadow: 0px 1px 1px rgba(44, 44, 44, 0.17);
    }

    .card__info-area {
        display:flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .card__info {
        text-align: left;
    }

    .card__booking-area {
        display:flex;
        flex-direction: column;
    }

    .active-btn {
        display:block;
        background: #2F80ED;
        border-radius: 5px;
        box-shadow: 0px 5px 0px #14488E;

        color:white;
        text-align: center;
        text-transform: uppercase;
        text-decoration: none;

        padding: 0.8rem 2rem 0.8rem;
        margin-bottom:1rem;

        transition-duration: 270ms;
    }

    .card__btn:active {
        box-shadow: 0px 2px 0px #14488E;
    }

}

/*---- VACCINATION CENTERS WITH NO KNOWN AVAILABILITIES ----*/

.inactive-center {
    background: #dddddd;
    border:1px solid rgba(0, 0, 0, 0);
    box-shadow: none;

    transition-duration: 250ms;
}

.inactive-btn {
    background-color: #5F6D88;

    margin-bottom:1rem;
    min-width: 220px;
    padding: 0.8rem 2rem 0.8rem;

    transition-duration: 270ms;
}

.inactive-btn:hover {
    background-color: #44516B;
}

.inactive-color{
    color: #5F6D88;
}

.inactive-color:hover {
    color: #44516B;
}






.div-doses{
    border: 2px solid rgba(222, 222, 222, 1);
    padding: 30px;
    border-radius: 7px;
    background: rgb(245, 245, 245, 0.8);
}

.div-doses label[for=dpt-select] {
  display: block;
  text-align: center;
  font-size: 1em;
  margin: 2em;
  cursor: pointer;
}

#rdv.loading {
  min-height: 30em;
  display: flex;
  justify-content: center;
  align-items: center;
}
#rdv.loading svg {
  height: 3em;
  width: 3em;
  display: inline-block;
  margin-left: 1em;
  position: relative;
  top: 1em;
}
#rdv.loaded {
  animation: fade-in 200ms ease-in-out 200ms;
  animation-fill-mode: backwards;
  opacity: 1;
}
@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}


p {
    font-size: 120% !important;
}

</style>
