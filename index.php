<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Job Portal</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:linear-gradient(
    135deg,
    #1e3c72,
    #2a5298
    );

    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;
}

.box{
    background:white;
    padding:30px;
    width:380px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h1{
    text-align:center;
    margin-bottom:20px;
}

input,
select,
button{
    width:100%;
    padding:12px;
    margin-top:10px;
    border-radius:10px;
    border:1px solid #ccc;
}

button{
    background:#2563eb;
    color:white;
    border:none;
    cursor:pointer;
}

button:hover{
    background:#1d4ed8;
}

.hidden{
    display:none;
}

.switch{
    display:flex;
    gap:10px;
}

</style>

</head>

<body>

<div class="box">

<h1>Job Portal</h1>

<div class="switch">
<button onclick="showForm('login')">
Login
</button>

<button onclick="showForm('register')">
Register
</button>
</div>

<!-- LOGIN -->

<form id="login"
action="login.php"
method="POST">

<input type="email"
name="email"
placeholder="Email"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button type="submit">
Login
</button>

</form>

<!-- REGISTER -->

<form id="register"
class="hidden"
action="register.php"
method="POST">

<input type="text"
name="nom"
placeholder="Nom"
required>

<input type="email"
name="email"
placeholder="Email"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<select name="role">

<option value="student">
Student
</option>

<option value="entreprise">
Entreprise
</option>

</select>

<button type="submit">
Register
</button>

</form>

</div>

<script>

function showForm(form){

document.getElementById("login")
.classList.add("hidden");

document.getElementById("register")
.classList.add("hidden");

document.getElementById(form)
.classList.remove("hidden");

}

</script>

</body>
</html>