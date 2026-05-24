<?php

session_start();

include("config.php");

if(!isset($_SESSION['user'])){
header("Location:index.php");
exit();
}

# AJOUT OFFRE

if(isset($_POST['add'])){

$titre=$_POST['titre'];

$description=$_POST['description'];

$conn->query("
INSERT INTO offres(
titre,
description
)

VALUES(
'$titre',
'$description'
)
");

}

# AJOUT ETUDIANT

if(isset($_POST['add_student'])){

$nom=$_POST['nom'];

$specialite=$_POST['specialite'];

$cv=$_POST['cv'];

$conn->query("
INSERT INTO etudiants(
nom,
specialite,
cv
)

VALUES(
'$nom',
'$specialite',
'$cv'
)
");

}

# DELETE

if(isset($_GET['delete'])){

$id=$_GET['delete'];

$conn->query("
DELETE FROM offres
WHERE id=$id
");

}

# UPDATE

if(isset($_POST['update'])){

$id=$_POST['id'];

$titre=$_POST['titre'];

$description=$_POST['description'];

$conn->query("
UPDATE offres SET
titre='$titre',
description='$description'
WHERE id=$id
");

}

$res=$conn->query("
SELECT * FROM offres
");

?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
background:#f1f5f9;
}

.navbar{
width:100%;
background:#0f172a;
color:white;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;
}

.logout{
background:red;
color:white;
padding:10px 20px;
border-radius:10px;
text-decoration:none;
}

.container{
width:90%;
margin:auto;
margin-top:30px;
}

.card{
background:white;
padding:20px;
border-radius:15px;
margin-bottom:20px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.card:hover{
transform:translateY(-5px);
transition:0.3s;
}

.title{
margin-bottom:15px;
color:#0f172a;
}

input,
textarea,
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

.actions{
margin-top:15px;
display:flex;
gap:10px;
}

.actions a{
text-decoration:none;
padding:10px 15px;
border-radius:8px;
color:white;
}

.edit{
background:orange;
}

.delete{
background:red;
}

.badge{
display:inline-block;
margin-top:15px;
background:#2563eb;
color:white;
padding:5px 10px;
border-radius:20px;
font-size:12px;
}

</style>

</head>

<body>

<div class="navbar">

<h1>
Bienvenue
<?php echo $_SESSION['user']['nom']; ?>
👋
</h1>

<a class="logout"
href="logout.php">
Logout
</a>

</div>

<div class="container">

<?php if($_SESSION['user']['role']=="entreprise"): ?>

<!-- AJOUT OFFRE -->

<div class="card">

<h2 class="title">
Ajouter Offre
</h2>

<form method="POST">

<input type="text"
name="titre"
placeholder="Titre"
required>

<textarea
name="description"
placeholder="Description"
required></textarea>

<button name="add">
Publier
</button>

</form>

</div>

<!-- OFFRES -->

<h2 class="title">
Vos Offres
</h2>

<?php while($o=$res->fetch_assoc()): ?>

<div class="card">

<?php if(
isset($_GET['edit'])
&& $_GET['edit']==$o['id']
): ?>

<form method="POST">

<input type="hidden"
name="id"
value="<?php echo $o['id']; ?>">

<input type="text"
name="titre"
value="<?php echo $o['titre']; ?>">

<textarea
name="description"><?php echo $o['description']; ?></textarea>

<button name="update">
Modifier
</button>

</form>

<?php else: ?>

<h2>
<?php echo $o['titre']; ?>
</h2>

<p style="margin-top:10px;">
<?php echo $o['description']; ?>
</p>

<div class="actions">

<a class="edit"
href="?edit=<?php echo $o['id']; ?>">
Modifier
</a>

<a class="delete"
href="?delete=<?php echo $o['id']; ?>">
Supprimer
</a>

</div>

<?php endif; ?>

</div>

<?php endwhile; ?>

<!-- ETUDIANTS -->

<h2 class="title">
Étudiants Disponibles
</h2>

<?php

$et=$conn->query("
SELECT * FROM etudiants
");

while($e=$et->fetch_assoc()):

?>

<div class="card">

<h2>
<?php echo $e['nom']; ?>
</h2>

<p style="margin-top:10px;">
<b>Spécialité:</b>
<?php echo $e['specialite']; ?>
</p>

<p style="margin-top:10px;">
<?php echo $e['cv']; ?>
</p>

<span class="badge">
Disponible
</span>

</div>

<?php endwhile; ?>

<?php else: ?>

<!-- PROFIL ETUDIANT -->

<div class="card">

<h2 class="title">
Créer Profil
</h2>

<form method="POST">

<input type="text"
name="nom"
placeholder="Nom"
required>

<input type="text"
name="specialite"
placeholder="Spécialité"
required>

<textarea
name="cv"
placeholder="Parlez de vous"></textarea>

<button name="add_student">
Publier Profil
</button>

</form>

</div>

<!-- OFFRES -->

<h2 class="title">
Offres Disponibles
</h2>

<?php while($o=$res->fetch_assoc()): ?>

<div class="card">

<h2>
<?php echo $o['titre']; ?>
</h2>

<p style="margin-top:10px;">
<?php echo $o['description']; ?>
</p>

<span class="badge">
Offre Disponible
</span>

</div>

<?php endwhile; ?>

<?php endif; ?>

</div>

</body>
</html>