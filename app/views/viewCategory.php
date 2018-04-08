<?php
/**
 * Представление страницы категорий
 */
?>
<div class="row">
    <main role="main" class="col-12">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            Доходы
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($data['category_and_subcategory_array']['category_list']['1'] as $key_dohod => $value_dohod): ?>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><?= $value_dohod ?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($data['category_and_subcategory_array']['subcategory_list'][$key_dohod] as $key => $value): ?>
                                        <li class="list-group-item"> <?= $value ?></li>
                                    <?php endforeach; ?>
                                    <li class="list-group-item"><div class="input-group"><input type="text" id="subcategory<?= $key_dohod ?>" class="form-control" placeholder="Добавить новую статью в <?= $value_dohod ?>" aria-label="Добавить новую статью в <?= $value_dohod ?> - введите название"><div class="input-group-append"><div class="btn btn-outline-secondary" onclick="addsubcategory(<?= $key_dohod ?>)">Добавить</div></div></div></li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="input-group"><input type="text" class="form-control" id="category1" placeholder="Добавить новую категорию в Доходы" aria-label="Добавить новую категорию в Доходы - введите название"><div class="input-group-append"><div class="btn btn-outline-secondary"  onclick="addcategory(1)">Добавить</div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            Расходы
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($data['category_and_subcategory_array']['category_list']['0'] as $key_dohod => $value_dohod): ?>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><?= $value_dohod ?></h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($data['category_and_subcategory_array']['subcategory_list'][$key_dohod] as $key => $value): ?>
                                        <li class="list-group-item"> <?= $value ?></li>
                                    <?php endforeach; ?>
                                    <li class="list-group-item"><div class="input-group"><input type="text" id="subcategory<?= $key_dohod ?>" class="form-control" placeholder="Добавить новую статью в <?= $value_dohod ?>" aria-label="Добавить новую статью в <?= $value_dohod ?> - введите название"><div class="input-group-append"><div class="btn btn-outline-secondary" onclick="addsubcategory(<?= $key_dohod ?>)">Добавить</div></div></div></li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="input-group"><input type="text" class="form-control" id="category0" placeholder="Добавить новую категорию в Расходы" aria-label="Добавить новую категорию в Расходы - введите название"><div class="input-group-append"><div class="btn btn-outline-secondary"  onclick="addcategory(0)">Добавить</div></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
