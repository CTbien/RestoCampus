<?php 
require_once "models/CommandeModel.php";

class CommandeController {
    private $model;

    public function __construct() {
        $this->model = new CommandeModel();
    }

    public function reserver() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'etudiant') {
            header("Location: index.php?action=login");
            exit;
        }

        $disponibilites = $this->model->getDisponibilitesOuvertes();
        $message = $_SESSION['message'] ?? null;
        unset($_SESSION['message']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idDispo = isset($_POST['idDispo']) ? (int)$_POST['idDispo'] : 0;
            $quantite = isset($_POST['quantite']) ? (int)$_POST['quantite'] : 0;
            $idUtilisateur = $_SESSION['idUtilisateur'] ?? null;

            if ($idDispo <= 0 || $quantite <= 0 || !$idUtilisateur) {
                $message = "Sélectionnez un article et une quantité valide.";
            } else {
                $creneau = $this->model->isCreneauOuvert($idDispo);
                if (!$creneau) {
                    $message = "Le créneau n'est plus ouvert.";
                } else {
                    $dispoRestante = $this->model->quantiteDisponible($idDispo);
                    if ($quantite > $dispoRestante) {
                        $message = "Quantité insuffisante (reste $dispoRestante).";
                    } else {
                        $result = $this->model->reserver($idDispo, $idUtilisateur, $quantite);
                        if ($result['success']) {
                            $_SESSION['message'] = $result['message'];
                            header("Location: index.php?action=mesCommandes");
                            exit;
                        } else {
                            $message = $result['message'] ?? 'Erreur lors de la réservation.';
                        }
                    }
                }
            }
        }

        require "views/commande/list.php";
    }

    public function mesCommandes() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'etudiant') {
            header("Location: index.php?action=login");
            exit;
        }

        $idUtilisateur = $_SESSION['idUtilisateur'] ?? null;
        if (!$idUtilisateur) {
            header("Location: index.php?action=login");
            exit;
        }

        $commandes = $this->model->getMesCommandes($idUtilisateur);
        require "views/commande/myorders.php";
    }

    public function annuler() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'etudiant') {
        header("Location: index.php?action=login");
        exit;
    }

    $idCommande = $_POST['idCommande'] ?? $_GET['id'] ?? null;
    $idUtilisateur = $_SESSION['idUtilisateur'] ?? null;

    if (!$idCommande || !$idUtilisateur) {
        $_SESSION['message'] = "Impossible d’annuler cette commande.";
        header("Location: index.php?action=mesCommandes");
        exit;
    }

    if ($this->model->annuler($idCommande, $idUtilisateur)) {
        $_SESSION['message'] = "Commande annulée avec succès.";
    } else {
        $_SESSION['message'] = "Erreur : impossible d’annuler cette commande.";
    }

    header("Location: index.php?action=mesCommandes");
    exit;
}

    public function dashboardAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        $commandesToday = $this->model->getCommandesDuJour(); 

        $totauxParArticle = $this->model->countReservationsByArticle();
        $totalCommandes = array_sum(array_column($totauxParArticle, 'total'));

        require "views/admin/dashboard.php";
    }

    public function marquerRecuperee() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }

        $idCommande = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($idCommande) {
            $success = $this->model->marquerRecuperee($idCommande);
            $_SESSION['message_admin'] = $success ? "Commande $idCommande marquée récupérée." : "Erreur pour la commande $idCommande.";
        }

        header("Location: index.php?action=dashboardAdmin");
        exit;
    }
}

