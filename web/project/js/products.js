'use strict' 
 
 // Get a list of products based on the categoryId 
 let catList = document.querySelector("#categoryList"); 
 catList.addEventListener("change", function () { 
  let categoryId = catList.value; 
  console.log(`categoryId is: ${categoryId}`); 
  let catIdURL = "/project/products/index.php?action=getInventoryItems&categoryId=" + categoryId; 
  fetch(catIdURL) 
  .then(function (response) { 
   if (response.ok) { 
    return response.json(); 
   } 
   throw Error("Network response was not OK"); 
  }) 
  .then(function (data) { 
   console.log(data); 
   buildProductList(data); 
  }) 
  .catch(function (error) { 
   console.log('There was a problem: ', error.message) 
  }) 
 })

 // Build products into HTML table components and inject into DOM 
function buildProductList(data) { 
    let productsDisplay = document.getElementById("productsDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all products and put each in a row 
    data.forEach(function (element) { 
     console.log(element.invid + ", " + element.invname); 
     dataTable += `<tr><td>${element.invname}</td>`; 
     dataTable += `<td><a href='/project/products?action=mod&id=${element.invid}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/project/products?action=del&id=${element.invid}' title='Click to delete'>Delete</a></td></tr>`; 
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Product Management view 
    productsDisplay.innerHTML = dataTable; 
   }