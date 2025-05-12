console.log("hello from register.js");

document.getElementById("registerForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    let username = document.querySelector("#username").value;
    let email = document.querySelector("#email").value;
    let password = document.querySelector("#password").value;

    console.log(username, email, password);

    try {
        const response = await fetch("api/register.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ username, email, password })
        });

        const result = await response.json();
        console.log(result);
        alert(result.message);
    } catch (err) {
        console.error("Error:", err);
        alert("Something went wrong!");
    }
});
