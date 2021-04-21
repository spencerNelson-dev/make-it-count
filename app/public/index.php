<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css" />
    <script type="text/javascript" src="jquery.js"></script>
    <script src="countString.js"></script>
    <!-- js required for our charts -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <title>Make it Count!</title>
</head>
<body>
        <h1>Make it Count!</h1>

        <div class="instructions">
            Enter text and hit count!
        </div>

        <!-- Form -->
        <div>
            <form id="input-form" method="POST">

                <textarea id="inputString" name="inputString" rows="10"></textarea>

                <!-- Dispaly total character count -->
                <div id="count">Total Characters: 0</div>

                <label>
                    <input type="checkbox" id="isSeperateCase" name="isSeperateCase" />
                    Count Lowercase and Uppercase seperately
                </label>

                <label>
                    <input type="checkbox" id="countOtherChars" name="countOtherChars"/>
                    Count Other Characters (space, numbers, and others)
                </label>

                <label>
                    <input type="checkbox" id="excludeCharacter" name="excludeCharacter"/>
                    Exclude Character
                </label>

                <label id="characterTextBox">

                </label>


                <input type="submit" value="Count!">
            </form>
        </div>

        <!-- Dispaly Counting Results -->
        <div class="results-wrapper">
            <div id="result">
            </div>    
            <div id="charts">
            </div>
        </div>

        <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
