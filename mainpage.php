<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Main Page</title>
        <link rel="stylesheet" href="mainpagestyle.css">
    </head>

    <body>
    <div class="wrapper">
        <h1>Password Manager</h1><br/>
        <h2>Enter the length of the password you want to add</h2>
        <div class="input-box">
            <input type="text" id="length" placeholder="Type length here">
        </div>

        <input id="calcbutton" type="button" class="btn" value="Calculate" onclick="validate()"/>

        <p id="result"></p>

    </div>        
    </body>
</html>

<script>
    function validate() {
        // get the value entered in the text box
        var length = document.getElementById('length').value;

        // checks if value entered in the text box is empty
        if (length === "") { 
            alert("You have not entered a length. Please enter a number into the box.");
        } else {
            // converts the length value to an integer
            var lengthInt = parseInt(length);
            
            // heck if the entered value is a valid number
            if (isNaN(lengthInt) || lengthInt <= 0) {
                alert("Please enter a valid positive number.");
            } else {
                // generate and display password
                var password = generatePassword(lengthInt);
                document.getElementById('result').innerText = "Generated Password: " + password;
            }
        }
    }

    function generatePassword(length) {
        var characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!#'; // the characters that can be randomly chosen
        var password = '';
        for (var i = 0; i < length; i++) { // for loop to repeat the process for as long as the user input allows it
            var randomIndex = Math.floor(Math.random() * characters.length);
            password += characters[randomIndex];
        }
        return password;
    }
</script>