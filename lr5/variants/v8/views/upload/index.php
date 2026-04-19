<?php
$images = $images ?? [];
$message = $message ?? '';
$error = $error ?? '';
?>

<h1>Завантаження зображень</h1>
<p>Завантажте зображення (JPEG, PNG, GIF, WebP, до 5 МБ). Файли зберігаються у <code>data/uploads/</code>.</p>

<?php if ($message !== ''): ?>
    <div class="alert alert--success"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if ($error !== ''): ?>
    <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="index.php?route=upload/index" enctype="multipart/form-data" class="form">
    <div class="form__group">
        <label for="upload_image" class="form__label">Оберіть зображення <span class="required">*</span></label>
        <input type="file" id="upload_image" name="image" class="form__input" accept="image/*">
    </div>

    <div class="form__actions">
        <button type="submit" class="btn">Завантажити</button>
    </div>
</form>

<h2>Галерея (<?= count($images) ?>)</h2>

<?php if (empty($images)): ?>
    <p class="text-muted">Зображень ще немає.</p>
<?php else: ?>
    <div class="gallery">
        <?php foreach ($images as $img): ?>
            <div class="gallery__item">
                <img src="<?= htmlspecialchars($img['url']) ?>"
                     alt="<?= htmlspecialchars($img['name']) ?>"
                     class="gallery__img"
                     data-title="<?= htmlspecialchars($img['name']) ?>"
                     data-meta="<?= htmlspecialchars($img['date']) ?> • <?= round($img['size'] / 1024) ?> КБ">
                <div class="gallery__info">
                    <span class="gallery__name"><?= htmlspecialchars($img['name']) ?></span>
                    <span class="gallery__meta"><?= htmlspecialchars($img['date']) ?> &middot; <?= round($img['size'] / 1024) ?> КБ</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="modal" id="imageModal" aria-hidden="true">
        <div class="modal__backdrop" data-modal-close></div>
        <div class="modal__content" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <button type="button" class="modal__close" data-modal-close aria-label="Закрити">×</button>
            <img src="" alt="" class="modal__img">
            <div class="modal__caption">
                <h3 id="modalTitle" class="gallery__name"></h3>
                <p class="gallery__meta"></p>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const modal = document.getElementById('imageModal');
            const modalImg = modal.querySelector('.modal__img');
            const modalTitle = modal.querySelector('.gallery__name');
            const modalMeta = modal.querySelector('.gallery__meta');
            const closeButtons = modal.querySelectorAll('[data-modal-close]');

            document.querySelectorAll('.gallery__img').forEach(img => {
                img.addEventListener('click', () => {
                    modalImg.src = img.src;
                    modalImg.alt = img.alt;
                    modalTitle.textContent = img.dataset.title;
                    modalMeta.textContent = img.dataset.meta;
                    modal.classList.add('modal--open');
                    modal.setAttribute('aria-hidden', 'false');
                });
            });

            closeButtons.forEach(el => {
                el.addEventListener('click', () => {
                    modal.classList.remove('modal--open');
                    modal.setAttribute('aria-hidden', 'true');
                });
            });

            document.addEventListener('keydown', event => {
                if (event.key === 'Escape' && modal.classList.contains('modal--open')) {
                    modal.classList.remove('modal--open');
                    modal.setAttribute('aria-hidden', 'true');
                }
            });
        })();
    </script>
<?php endif; ?>
