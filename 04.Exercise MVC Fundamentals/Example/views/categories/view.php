<?php /**
 * @var \SoftUni\Core\ViewInterface $this
 * @var \SoftUni\Models\DB\Category[] $model
 */
?>
<div class="container">
    <div class="row">
        <div class="col-xs-6">№</div>
        <div class="col-xs-6">Name</div>
    </div>
    <hr/>
    <?php foreach ($model as $category): ?>
        <div class="row">
            <div class="col-xs-6"><?= htmlentities($category->getId());?></div>
            <div class="col-xs-6">
                <a href="<?=$this->url("categories", "topics", [$category->getId()]);?>">
                    <?= htmlentities($category->getName());?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
