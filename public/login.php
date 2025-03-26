<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="/assets/css/pages/login.css"> <!-- SCSS přeložené do CSS -->
</head>
<body>

<section id="login">
    <div class="container">
        <div class="login-box">
            <h2>Přihlášení</h2>
            <form id="loginForm">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Heslo</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn">Přihlásit se</button>
            </form>
            <p>Nemáte účet? <a href="register.php">Zaregistrujte se</a></p>
            <p id="loginMessage"></p>
        </div>
    </div>
</section>

<script>
    document.getElementById("loginForm").addEventListener("submit", async function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch("/routes/login.php", {
                method: "POST",
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP chyba: ${response.status}`);
            }

            const data = await response.json();

            const messageBox = document.getElementById("loginMessage");
            messageBox.innerText = data.message;
            messageBox.style.color = data.success ? "green" : "red";

            if (data.success) {
                setTimeout(() => {
                    window.location.href = "dashboard.php"; // Přesměrování po úspěšném loginu
                }, 1000);
            }

        } catch (error) {
            document.getElementById("loginMessage").innerText = "Chyba připojení k serveru.";
            console.error("Login error:", error);
        }
    });
</script>

</body>
</html>
