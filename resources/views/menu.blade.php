<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
      }
/* Style the tab */
.tab {
  overflow: hidden;
  background-color: #4235f3;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  border-radius: 15%;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
  border-radius: 15%;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: white;
  color: black;
}

/* Style the tab content */
.tabcontent {
  display: none;
}
</style>
</head>
<body>
<div>
<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'London')"></span>Home</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>
</div>

<div id="London" class="tabcontent">
    <iframe src="marchandises.displayM" frameborder="0"></iframe>
</div>

<div id="Paris" class="tabcontent">
   @include('marchandises.create')
</div>

<div id="Tokyo" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>
<main class="py-4">
    @yield('content')
</main>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
$(document).ready(function() {
    // Charge la vue dans le div avec l'identifiant 'zoneDeChargement'
    $('#London').load('{{ route('marchandises.displayM') }}');
});
</script>

</body>
</html>
