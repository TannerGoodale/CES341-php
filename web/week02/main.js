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

// Jquery solution

$(function(){
var $color = $('#color').val();
$('#colorbutton').click(function(){
    $('#colordiv').css('color', $color);
})
})