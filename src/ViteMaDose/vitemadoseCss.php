
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

.div-doses{
    border: 2px solid rgba(222, 222, 222, 1);
    padding: 30px;
    border-radius: 7px;
    background: rgb(245, 245, 245, 0.8);
}

.div-doses label[for=dep-select] {
  display: block;
  text-align: center;
  font-size: 2em;
  cursor: pointer;
}
#rdv h2 {
  margin-top: 30px;
}
#rdv h3 {
  margin-top: 40px;
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
