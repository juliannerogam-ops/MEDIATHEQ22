<?php
require_once 'header.php';

$imageFiles = glob(ROOT . '/src/images/*.{png,jpg,jpeg,gif,webp}', GLOB_BRACE);
sort($imageFiles, SORT_NATURAL | SORT_FLAG_CASE);

$artistImages = [];
$groupImages = [];

foreach ($imageFiles as $index => $imageFile) {
	if ($index % 2 === 0) {
		$artistImages[] = $imageFile;
	} else {
		$groupImages[] = $imageFile;
	}
}
?>

<main class="home-section">
	<section class="image-category" aria-labelledby="artists-title">
		<h1 id="artists-title">Artistes</h1>
		<div class="image-grid">
			<?php foreach ($artistImages as $imageFile): ?>
				<?php $imageName = basename($imageFile); ?>
				<figure class="image-card">
					<img src="<?= ROOT_URL ?>/src/images/<?= rawurlencode($imageName) ?>" alt="<?= htmlspecialchars(pathinfo($imageName, PATHINFO_FILENAME)) ?>">
				</figure>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="image-category" aria-labelledby="groups-title">
		<h2 id="groups-title">Groupes</h2>
		<div class="image-grid">
			<?php foreach ($groupImages as $imageFile): ?>
				<?php $imageName = basename($imageFile); ?>
				<figure class="image-card">
					<img src="<?= ROOT_URL ?>/src/images/<?= rawurlencode($imageName) ?>" alt="<?= htmlspecialchars(pathinfo($imageName, PATHINFO_FILENAME)) ?>">
				</figure>
			<?php endforeach; ?>
		</div>
	</section>
</main>

<?php require_once 'footer.php'; ?>