<?php
/**
 * Представление для главной страницы
 */
?>
<div class="row">
    <main role="main" class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                Добавить запись
            </div>
            <div class="card-body">
                <div class="row " id="addpay">
                    <div class="col-12">
                        <form name="addpay" class="form-inline form-row d-flex justify-content-center" method="GET" action="">
                            <div class="col-auto">
                                <label class="sr-only" for="adddate">Дата </label>
                                <input type="date" class="form-control" name="adddate" id="adddate" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="col-auto">
                                <label class="sr-only" for="addnapravlenie">Направление </label>
                                <select name="addnapravlenie" class="custom-select" id="addnapravlenie" onchange="displaychangeforadd('add');">
                                    <option value="1" selected>Доход</option>
                                    <option value="0">Расход</option>
                                </select>
                            </div>
                            <?php foreach ($data['category_and_subcategory_array']['category_list'] as $type => $value): ?>
                                <div class="col-auto col-md-2 d-none" id="addblockcategory<?= $type ?>">
                                    <label class="sr-only" for="addcategory<?= $type ?>">Категория </label>
                                    <select name="addcategory<?= $type ?>" class="custom-select" id="addcategory<?= $type ?>" onchange="displaychangeforadd('add');">
                                        <?php foreach ($value as $key => $category): ?>
                                            <option value="<?= $key ?>"><?= $category ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endforeach; ?>
                            <?php foreach ($data['category_and_subcategory_array']['subcategory_list'] as $type => $value): ?>
                                <div class="col-auto col-md-3 d-none" id="addblocksubcategory<?= $type ?>">
                                    <label class="sr-only" for="addsubcategory<?= $type ?>">Подкатегория </label>
                                    <select name="addsubcategory<?= $type ?>" class="custom-select" id="addsubcategory<?= $type ?>" onchange="displaychangeforadd('add');">
                                        <?php foreach ($value as $key => $category): ?>
                                            <option value="<?= $key ?>"><?= $category ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endforeach; ?>
                            <script>
                                displaychangeforadd('add');
                            </script>
                            <div class="col-auto">
                                <label class="sr-only"  for="addmoney">Сумма </label>
                                <input type="number" placeholder="Сумма" class="form-control" name="addmoney" id="addmoney">
                            </div>
                            <div class="col-auto">
                                <div class="form-control btn btn-primary" name="addsubmit" onclick="addpayment();" id="addsubmit">Добавить</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <h3>Финансы</h3>
            </div>
            <div class="col-sm-9">
                <form class="form-inline form-row d-flex justify-content-end" method="GET" action="">
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">C</div>
                            </div>
                            <input type="date" class="form-control" onchange="updatemainlog()" name="datestart" id="datestart">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">По</div>
                            </div>
                            <input hidden type="number" value="1" id="page" name="page">
                            <input type="date" class="form-control" onchange="updatemainlog()" name="dateend" id="dateend">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Тип</div>
                            </div>
                            <select name="napravlenie" class="custom-select" onchange="updatemainlog()" id="napravlenie">
                                <option value="all" selected>Все</option>
                                <option value="1">Доход</option>
                                <option value="0">Расход</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" id="mainlog">
            <?php include 'app/controllers/controllerMainlog.php'; ?>
        </div>
    </main>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
                                feather.replace()
</script>