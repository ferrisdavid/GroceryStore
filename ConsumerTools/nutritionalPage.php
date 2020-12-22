<?php session_start(); //starting the session for cart access?>
<!--Picture is from: https://www.clipartmax.com/middle/m2i8H7i8N4H7d3H7_vegetables-clip-art-free-download-transparent-background-vegetables-clipart/-->
<!DOCTYPE html>

<html>

    <head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap scripts-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!--jQuery CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" > <!--font-awesome icons CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <!--bootstrap CDN-->
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet"> <!--linking google font-->
    <link rel="stylesheet" href="../footer/muhammad.css"> <!--linking footer css-->
    <link rel="stylesheet" href="nutritionPageStyleSheet.css"> <!--linking nutrition page css-->
    <style>
        /* additional footer styling */
        .footer .footer-content h2 {
            padding-top: 30px;
            padding-bottom: 20px;
        }
    </style>
    </head>
    <body>
        <?php 
            require_once("../ShoppingCart/components/header.php"); //import the header
        ?>
        <br>
        <form method = "POST">
            <div id="form">
                <h1>Nutrition Facts!</h1>
                <h3>Please enter a food item and click Get Facts for nutritional information</h3>
                <h5>*Make sure the item is in all lower case*</h5>
                <h5>e.g. chicken</h5>
                <input type="text" id = "text" name="inputFoodItem"/>
                <br>
                <input type="button" class = "Submitbutton" id = "button" value="Get Facts!">
                <br>
                <p id="printHere"></p>
            </div>
        </form>
            <script type="text/javascript">
                $(document).ready(function(){
                
                    $('#button').click(function(){
                        var x = document.getElementById("text").value;
                        const settings = {
                            "async": true,
                            "crossDomain": true,
                            "url": "https://edamam-food-and-grocery-database.p.rapidapi.com/parser?ingr="+x,
                            "method": "GET",
                            "headers": {
                                "x-rapidapi-key": "f50e2d2cfbmsha5d0d1db71eb69cp137a18jsnb4c4d4031b4f",
                                "x-rapidapi-host": "edamam-food-and-grocery-database.p.rapidapi.com"
                            }
                        };

                        $.ajax(settings).done(function (response) {                            
                        
                            var displayString = "";
                            for (var i = 0; i < response['hints'].length; i++){
                                
                                
                                s = (JSON.stringify(response['hints'][i]['food']['label']));
                                s2= s.slice(1,s.length-1);
                                
                                if (s2 === x) {
                                
                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('ENERC_KCAL')){
                                        displayString+="Calories: ";
                                        displayString += response['hints'][i]['food']['nutrients']['ENERC_KCAL'];
                                        displayString+=" kcal";
                                        displayString+="<br></br>";
                                        
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('CA')){
                                        displayString+="Calcium: "
                                        displayString += response['hints'][i]['food']['nutrients']['CA']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('CHOCDF')){
                                        displayString+="Carbs: "
                                        displayString += response['hints'][i]['food']['nutrients']['CHOCDF']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('CHOLE')){
                                        displayString+="Cholesterol: "
                                        displayString += response['hints'][i]['food']['nutrients']['CHOLE']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FAMS')){
                                        displayString+="Monounsaturated: "
                                        displayString += response['hints'][i]['food']['nutrients']['FAMS']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FAPU')){
                                        displayString+="Polyunsaturated: "
                                        displayString += response['hints'][i]['food']['nutrients']['FAPU']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FASAT')){
                                        displayString+="Saturated: "
                                        displayString += response['hints'][i]['food']['nutrients']['FASAT']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FAT')){
                                        displayString+="Fat: "
                                        displayString += response['hints'][i]['food']['nutrients']['FAT']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FATRN')){
                                        displayString+="Trans: "
                                        displayString += response['hints'][i]['food']['nutrients']['FATRN']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FE')){
                                        displayString+="Iron: "
                                        displayString += response['hints'][i]['food']['nutrients']['FE']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FIBTG')){
                                        displayString+="Fiber: "
                                        displayString += response['hints'][i]['food']['nutrients']['FIBTG']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('FOLDFE')){
                                        displayString+="Folate(Equivalent): "
                                        displayString += response['hints'][i]['food']['nutrients']['FOLDFE']
                                        displayString+=" aeg"
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('K')){
                                        displayString+="Potassium: "
                                        displayString += response['hints'][i]['food']['nutrients']['K']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('MG')){
                                        displayString+="Magnesium: "
                                        displayString += response['hints'][i]['food']['nutrients']['MG']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }

                                    
                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('NA')){
                                        displayString+="Sodium: "
                                        displayString += response['hints'][i]['food']['nutrients']['NA']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('NIA')){
                                        displayString+="Niacin(B3): "
                                        displayString += response['hints'][i]['food']['nutrients']['NIA']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('P')){
                                        displayString+="Phosphorus: "
                                        displayString += response['hints'][i]['food']['nutrients']['P']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('PROCNT')){
                                        displayString+="Protein: "
                                        displayString += response['hints'][i]['food']['nutrients']['PROCNT']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('RIBF')){
                                        displayString+="Riboflavin(B2): "
                                        displayString += response['hints'][i]['food']['nutrients']['RIBF']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('SUGAR')){
                                        displayString+="Sugars: "
                                        displayString += response['hints'][i]['food']['nutrients']['SUGAR']
                                        displayString+=" g"
                                        displayString+="<br></br>";
                                        
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('THIA')){
                                        displayString+="Thiamin(B1): "
                                        displayString += response['hints'][i]['food']['nutrients']['THIA']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('TOPCHA')){
                                        displayString+="Vitamin E: "
                                        displayString += response['hints'][i]['food']['nutrients']['TOPCHA']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('VITA_RAE')){
                                        displayString+="Vitamin A: "
                                        displayString += response['hints'][i]['food']['nutrients']['VITA_RAE']
                                        displayString+=" aeg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('VITB12')){
                                        displayString+="Vitamin B12: "
                                        displayString += response['hints'][i]['food']['nutrients']['VITB12']
                                        displayString+=" aeg"
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('VITB6A')){
                                        displayString+="Vitamin B6: "
                                        displayString += response['hints'][i]['food']['nutrients']['VITB6A']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('VITC')){
                                        displayString+="Vitamin C: "
                                        displayString += response['hints'][i]['food']['nutrients']['VITC']
                                        displayString+=" mg"
                                        displayString+="<br></br>";
                                    }


                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('VITD')){
                                        displayString+="Vitamin D: "
                                        displayString += response['hints'][i]['food']['nutrients']['VITD']
                                        displayString+=" aeg"
                                        displayString+="<br></br>";
                                    }
                                    
                                    if (response['hints'][i]['food']['nutrients'].hasOwnProperty('VITK1')){
                                        displayString+="Vitamin K: "
                                        displayString += response['hints'][i]['food']['nutrients']['VITK1']
                                        displayString+=" aeg"
                                        displayString+="<br></br>";
                                    }
  
                                    //check if the name has the search item
                                }
                                document.getElementById("printHere").innerHTML = displayString;
                                if(displayString==""){
                                    document.getElementById("printHere").innerHTML = "Sorry it looks like we couldn't find that item. Try another!";
                                }
                                break;
                        }
                        });
                    });
                });
            </script>
    <main>
    <img src="clipart437129.png" id="fruit">
    </main>
    <?php require_once("../footer/footer-bootstrap.php"); //import the footer ?>
    </body>
</html>