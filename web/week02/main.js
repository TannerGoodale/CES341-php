//Primary javascrip file for the week 2 team activity

function alertClick(){
    alert("Clicked!");
}

function changeColor(){
    let newColor = document.getElementById("color").value;
    document.getElementById("colordiv").style.color = newColor;
}