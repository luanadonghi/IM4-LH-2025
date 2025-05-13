console.log ("protected.js geladen");


fetch("api/protected.php")
.then((response) => { response.json() })
.then((data) => {
  console.log(data);
 
if (data.status === "error") {
    window.location.href = "login.html";
} else {
    document.getElementById("welcome-message"). 
    innerHTML = 
    "Willkommen " + data.username; 
}

})
.catch((error) => {
  console.error("Fehler beim Senden:", error);
});
