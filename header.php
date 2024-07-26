<header class="row flex-wrap justify-content-between align-items-center p-3 mb-4 border-bottom">
    <a href="index.html" class="col-1">
        <i class="bi bi-piggy-bank-fill text-primary fs-1"></i>
    </a>
    <nav class="col-11 col-md-7">
        <ul class="nav">
            <li class="nav-item">
                <a href="index.php" class="nav-link link-secondary" aria-current="page">Opérations</a>
            </li>
            <li class="nav-item">
                <a href="summary.php" class="nav-link link-body-emphasis">Synthèses</a>
            </li>
            <li class="nav-item">
                <a href="categories.php" class="nav-link link-body-emphasis">Catégories</a>
            </li>
            <li class="nav-item">
                <a href="import.php" class="nav-link link-body-emphasis">Importer</a>
            </li>
        </ul>
    </nav>
    <form action="seek.php" class="col-12 col-md-4" role="search" method="GET">
        <div class="input-group">
            <input type="search" name="terme" class="form-control" placeholder="Rechercher..."
                aria-describedby="button-search">
            <button class="btn btn-primary" type="submit" name="s" value="Rechercher" id="button-search">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
</header>