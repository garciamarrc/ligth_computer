<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= APP_URL ?>home/index">Ligth Agency Computer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= APP_URL ?>home/index">Home</a>
                </li>
            </ul>
            <form class="d-flex" role="search" method="POST" action="<?= APP_URL ?>product/search">
                <input name="param" class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" required>
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>