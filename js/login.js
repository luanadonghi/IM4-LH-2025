console.log("Hello from login.js");

document.getElementById("loginForm").addEventListener("submit", async (e) => {
  e.preventDefault(); // Formular‑Reload verhindern

  // ► Eingabewerte aus den Feldern holen
  const loginInfo = document.querySelector("#username-email").value.trim();
  const password = document.querySelector("#password").value;

  console.log("loginInfo ist:", loginInfo);
  console.log("passwort ist:", password);

  // FormData füllt PHPs $_POST automatisch
  const formData = new FormData();
  formData.append("loginInfo", loginInfo);
  formData.append("password", password);

  // Fetch
  try {
    const res = await fetch("/api/login.php", {
      method: "POST",
      body: formData,
    });
    const reply = await res.text(); // login.php schickt nur Klartext zurück
    console.log("Antwort vom Server:\n" + reply);
    alert(reply);
  } catch (err) {
    console.error("Fehler beim Senden:", err);
  }
});