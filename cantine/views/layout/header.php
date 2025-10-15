<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Carnet MVC (Bootstrap – Convention – PHP5)</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-4">
  <header class="bg-primary text-white text-center p-3 rounded shadow-sm mb-4">
    <h1>Carnet d'adresses</h1>
    <p><?php echo $_SESSION['login']?></p>
   
  </header>
