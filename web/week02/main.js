//Primary javascrip file for the week 2 team activity

function alertClick(){
    alert("Clicked!");
}

/* Javascrip solution...

function changeColor(){
    let newColor = document.getElementById("color").value;
    document.getElementById("colordiv").style.color = newColor;
}

*/

// Jquerry solution

function changeColor(){
    var color = $('#color').val;
    $("colordiv").css("color", color);
}