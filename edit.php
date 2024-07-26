<?php
session_start();

include 'includes/_config.php';
include 'includes/_functions.php';
include 'includes/_database.php';
include 'includes/_template.php';

generateToken();

if (!isset($_GET['id_transaction']) || !is_numeric($_GET['id_transaction'])) {
    addError('invalid_id');
    redirectTo('index.php');
}

$id_transaction = intval($_GET['id_transaction']);

$query = $dbCo->prepare("SELECT * FROM transaction WHERE id_transaction = :id_transaction");
$query->execute(['id_transaction' => $id_transaction]);
$transaction = $query->fetch();

if (!$transaction) {
    addError('transaction_not_found');
    redirectTo('index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une opération - Mes Comptes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <?php include 'header.php'; ?>
    </div>
    <div class="container">
        <?php
        echo getHtmlErrors($errors);
        echo getHtmlMessages($messages);
        ?>
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Modifier l'opération</h1>
            </div>
            <form action="edit_update.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'opération *</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($transaction['name']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date_transaction" class="form-label">Date *</label>
                    <input type="date" class="form-control" name="date_transaction" id="date_transaction" value="<?php echo htmlspecialchars($transaction['date_transaction']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant *</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="amount" id="amount" value="<?php echo htmlspecialchars($transaction['amount']); ?>" required>
                        <span class="input-group-text">€</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="id_category" class="form-label">Catégorie</label>
                    <select class="form-select" name="id_category" id="id_category">
                        <option value="" <?php echo $transaction['id_category'] == null ? 'selected' : ''; ?>>Aucune catégorie</option>
                        <option value="1" <?php echo $transaction['id_category'] == 1 ? 'selected' : ''; ?>>Nourriture</option>
                        <option value="2" <?php echo $transaction['id_category'] == 2 ? 'selected' : ''; ?>>Loisir</option>
                        <option value="3" <?php echo $transaction['id_category'] == 3 ? 'selected' : ''; ?>>Travail</option>
                        <option value="4" <?php echo $transaction['id_category'] == 4 ? 'selected' : ''; ?>>Voyage</option>
                        <option value="5" <?php echo $transaction['id_category'] == 5 ? 'selected' : ''; ?>>Sport</option>
                        <option value="6" <?php echo $transaction['id_category'] == 6 ? 'selected' : ''; ?>>Habitat</option>
                        <option value="7" <?php echo $transaction['id_category'] == 7 ? 'selected' : ''; ?>>Cadeaux</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Modifier</button>
                </div>
                <input type="hidden" name="id_transaction" value="<?php echo $transaction['id_transaction']; ?>">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
            </form>
        </section>
    </div>
    <div class="position-fixed bottom-0 end-0 m-3">
        <a href="add.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>