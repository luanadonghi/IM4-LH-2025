console.log ("protected.js geladen");


fetch("api/protected.php")
.then((response) => { response.json() })
.then((data) => {
  console.log("Antwort vom Server:\n" + data);
  alert(data);
})
.catch((error) => {
  console.error("Fehler beim Senden:", error);
});
