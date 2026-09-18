<?php
require_once 'header.php';

$imageFiles = glob(ROOT . '/src/images/*.{png,jpg,jpeg,gif,webp}', GLOB_BRACE);
sort($imageFiles, SORT_NATURAL | SORT_FLAG_CASE);

$artistImages = [];
$groupImages = [];
$popularAlbumImages = [];

foreach ($imageFiles as $index => $imageFile) {
    switch ($index % 3) {
        case 0:
            $artistImages[] = $imageFile;
            break;
        case 1:
            $groupImages[] = $imageFile;
            break;
        default:
            $popularAlbumImages[] = $imageFile;
    }
}

function home_image_card(string $imageFile, string $type): void
{
    $imageName = basename($imageFile);
    $label = ucfirst(str_replace(['-', '_'], ' ', pathinfo($imageName, PATHINFO_FILENAME)));
    ?>
    <article class="home-card">
        <div class="home-card-image">
            <img src="<?= ROOT_URL ?>/src/images/<?= rawurlencode($imageName) ?>" alt="<?= htmlspecialchars($label) ?>">
        </div>
        <h3><?= htmlspecialchars($label) ?></h3>
        <p><?= htmlspecialchars($type) ?></p>
    </article>
    <?php
}
?>

<main class="home-page">
    <?php if (isset($_SESSION['user'])): ?>
        <div class="favorite-heading">Vos favoris</div>
    <?php endif; ?>

    <div class="home-layout">
        <div class="home-main-column">
            <form class="home-search" role="search">
                <input type="search" placeholder="Chercher votre artiste préféré" aria-label="Rechercher">
                <button type="submit" aria-label="Rechercher">⌕</button>
            </form>

            <div class="home-hero" aria-hidden="true"></div>

            <section class="home-section-block" aria-labelledby="popular-title">
                <div class="section-heading">
                    <h1 id="popular-title">Albums populaires</h1>
                    <a href="#albums-populaires">Tout voir</a>
                </div>
                <div class="home-card-grid" id="albums-populaires">
                    <?php foreach (array_slice($popularAlbumImages, 0, 4) as $imageFile): ?>
                        <?php home_image_card($imageFile, 'Album') ?>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="home-section-block" aria-labelledby="artists-title">
                <div class="section-heading">
                    <h2 id="artists-title">Artistes</h2>
                    <a href="#artistes">Tout voir</a>
                </div>
                <div class="home-card-grid" id="artistes">
                    <?php foreach (array_slice($artistImages, 0, 4) as $imageFile): ?>
                        <?php home_image_card($imageFile, 'Artiste') ?>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="home-section-block" aria-labelledby="groups-title">
                <div class="section-heading">
                    <h2 id="groups-title">Groupes</h2>
                    <a href="#groupes">Tout voir</a>
                </div>
                <div class="home-card-grid" id="groupes">
                    <?php foreach (array_slice($groupImages, 0, 4) as $imageFile): ?>
                        <?php home_image_card($imageFile, 'Groupe') ?>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

        <aside class="home-sidebar">
            <?php if (isset($_SESSION['user'])): ?>
                <section class="sidebar-block favorites-panel">
                    <h2>Vos favoris</h2>
                    <div class="sidebar-placeholder"></div>
                </section>
            <?php endif; ?>

            <section class="sidebar-block">
                <h2>Nouveaux artistes</h2>
                <div class="artist-list">
                    <?php foreach (array_slice($artistImages, 0, 3) as $imageFile): ?>
                        <?php $imageName = basename($imageFile); ?>
                        <div class="artist-list-item">
                            <img src="<?= ROOT_URL ?>/src/images/<?= rawurlencode($imageName) ?>" alt="">
                            <span>Nouvel artiste</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </aside>
    </div>
</main>

<?php require_once 'footer.php'; ?>