<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
    <link rel="stylesheet" href="/assets/css/pages/register.css"> <!-- SCSS přeložené do CSS -->
</head>
<body>

<section id="register">
    <div class="container">
        <div class="register-box">
            <h2>Registrace</h2>
            <form id="registerForm">
                <label for="name">Jméno</label>
                <input type="text" id="name" name="name" required>

                <label for="surname">Příjmení</label>
                <input type="text" id="surname" name="surname" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Heslo</label>
                <input type="password" id="password" name="password" required>

                <label for="phone">Telefon</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="address">Adresa</label>
                <input type="text" id="address" name="address" required>

                <label for="birthdate">Datum narození</label>
                <input type="date" id="birthdate" name="birthdate" required>

                <label for="insurance">Pojišťovna</label>
                <input type="text" id="insurance" name="insurance" required>

                <label for="nationality">Státní příslušnost</label>
                <input type="text" id="nationality" name="nationality" required>

                <button type="submit" class="btn">Registrovat se</button>
            </form>
            <p>Už máte účet? <a href="login.php">Přihlaste se</a></p>
            <p id="registerMessage"></p>
        </div>
    </div>
</section>

<script>
    document.getElementById("registerForm").addEventListener("submit", async function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch("/routes/register.php", { // ZDE ZŮSTÁVÁ API ROUTA!
                method: "POST",
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP chyba: ${response.status}`);
            }

            const data = await response.json();

            const messageBox = document.getElementById("registerMessage");
            messageBox.innerText = data.message;
            messageBox.style.color = data.success ? "green" : "red";

            if (data.success) {
                setTimeout(() => {
                    window.location.href = "login.php"; // Přesměrování po úspěšné registraci
                }, 1000);
            }

        } catch (error) {
            document.getElementById("registerMessage").innerText = "Chyba připojení k serveru.";
            console.error("Register error:", error);
        }
    });
</script>

</body>
</html>
