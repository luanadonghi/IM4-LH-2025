console.log("hello from login.js");

document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const loginInfo = document.querySelector("#username-email").value. trim();
    const password = document.querySelector("#password").value;

    console.log("loginInfo ist:", loginInfo);
    console.log("passwort ist:", password); 
});