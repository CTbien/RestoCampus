<nav class="mb-4">
  <ul class="nav nav-pills justify-content-center">
    <li class="nav-item">
      <a class="nav-link <?php echo ($action==='lister')?'active':''; ?>" href="index.php?controleur=contact&action=lister">Liste</a>
    </li>
    <li class="nav-item">
      <?php
      if($_SESSION['role']=='admin'){?>
      <a class="nav-link <?php echo ($action==='ajouter')?'active':''; ?>" href="index.php?controleur=contact&action=ajouter">Ajouter</a>
      <?php }?>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($action==='chercher')?'active':''; ?>" href="index.php?controleur=contact&action=chercher">chercher</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo ($action==='logout')?'active':''; ?>" href="index.php?controleur=user&action=logout">déconnecter</a>
    </li>
  </ul>
</nav>