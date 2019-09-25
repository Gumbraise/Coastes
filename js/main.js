var after = document.getElementById('after');
after.style = "opacity: 0;";
function coast(find) {
    var coast = document.getElementsByClassName('cst');
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = "@-webkit-keyframes Check{ 0% {opacity: 1} 100% {opacity: 0}}@-webkit-keyframes Checks{ 50% {opacity: 0} 100% {opacity: 1}}";
    document.body.appendChild(css);
    var css2 = document.createElement("style");
    css2.type = "text/css";
    css2.innerHTML = "button.coast {-webkit-animation: Check 1s ease;-moz-animation: Check 1s ease;animation: Check 1s ease;}.after {-webkit-animation: Checks 2s ease;-moz-animation: Checks 2s ease;animation: Checks 2s ease;}";
    document.body.appendChild(css2);
    var button = document.getElementsByClassName('citiz');
    button.style = "opacity: 0;";
    button.disabled = "0";
    coast[0].disabled = "0";coast[1].disabled = "0";coast[2].disabled = "0";

    const request = new XMLHttpRequest();

    request.open('POST', '?action=coast', true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send('find='+ find);
}
