<!DOCTYPE html>

<html>

<body>

<form>

<input type="text" id="clock" size="35" />

<script>

var int=self.setInterval("clock()",50)

function clock(){var t=new Date()

document.getElementById("clock").value=t

}

</script>

</form>

<div id="clock"></div>

<button onclick="int=window.clearInterval(int)">Stop interval</button>

</body>

</html>