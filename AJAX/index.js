var xhttp = new XMLHttpRequest();
var params;
var spinner = document.getElementById("spinner");
var getOptSelectedID = function (inputID, datalistID) {
    var input = document.getElementById(inputID);
    var elements = document.getElementById(datalistID);
    for (var index = 0; index < elements.options.length; index++) {
        if (elements.options[index].value === input.value) {
            return elements.options[index].getAttribute("id");
        }
    }
    return "";
};
var getCity = function () {
    params = getOptSelectedID("province", "provinceData");
    spinner.style.display = "inline";
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === xhttp.DONE) {
            var element = document.getElementById("cityData");
            element.innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "server.php?city=" + params);
    xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhttp.send();
};
var getDistrict = function () {
    params = getOptSelectedID("district", "districtData");
    spinner.style.display = "inline";
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === xhttp.DONE) {
            var element = document.getElementById("districtData");
            element.innerHTML = xhttp.responseText;
            spinner.style.display = "none";
        }
    };
    xhttp.open("GET", "server.php?district=" + params);
    xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhttp.send();
};
var getResident = function () {
    params = getOptSelectedID("resident", "residentData");
    spinner.style.display = "inline";
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === xhttp.DONE) {
            var element = document.getElementById("residentData");
            element.innerHTML = xhttp.responseText;
            spinner.style.display = "none";
        }
    };
    xhttp.open("GET", "server.php?resident=" + params);
    xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhttp.send();
};
