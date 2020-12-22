//retrieving all the required elements from the html
let addItemButton = document.getElementById('addButton'); //retrieve add button to set up event listener
let inputInfo = document.getElementById('iteminput'); //retrieve text box input to get the item to add to list
let groceryList = document.getElementById('listcontainer'); //retrieve the div to place the items into
let quantity = document.getElementById('quantity'); //retrieve the input quantity of the item to be added
//set up click event listener for the add item button
addItemButton.addEventListener('click', ()=>{
    let paragraph = document.createElement('p'); //create a p element, this will be used to place the specified item and quantity into the grocery list div
    paragraph.innerText = inputInfo.value + "  (Quantity: "+ quantity.value + ")"; //update the inner text of the p element to have the inputted item and quantity
    paragraph.classList.add('groceryitem'); //add the groceryitem class that is defined in style.css
    groceryList.appendChild(paragraph); //insert the p element into the grocery list div as a child of the div
    inputInfo.value=""; //reset the input values
    quantity.value= 1;
    paragraph.addEventListener('click', ()=>{ //add a click event listener on the paragraph element
        if(paragraph.style.textDecoration === "line-through"){ //if the item is clicked then place a line through the line or remove the line through the item
            paragraph.style.textDecoration ="";                // this symbolizes that the item has been found
        }
        else{
            paragraph.style.textDecoration = "line-through";
        }
    })
    paragraph.addEventListener('dblclick', ()=>{ //add a double click event listener on the paragraph element and remove the item if it is double clicked
        groceryList.removeChild(paragraph);
    })
})

