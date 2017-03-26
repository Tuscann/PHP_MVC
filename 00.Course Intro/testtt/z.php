<!DOCTYPE html>
<html>
<body>

<h1>test drive on JavaScript</h1>

<button onclick="myFunction()">Click me to display Date and Time.</button>

<p id="demo"></p>

<script>

    function myFunction() {

        document.getElementById("demo").innerHTML = "Hello World";
        document.getElementById('demo').innerHTML = Date()
    }

</script>

</body>
</html>