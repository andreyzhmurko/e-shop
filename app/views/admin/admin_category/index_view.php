<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление категориями</li>
                </ol>
            </div>

            <a href="/admin/create_category" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить категорию</a>
            
            <h4>Список категорий</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID категории</th>
                    <th>Название категории</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
                <?php foreach ($this->categoriesList as $category): ?>
                    <tr>
                        <td><?=$category['id']; ?></td>
                        <td><?=$category['name']; ?></td>
                        <td><a href="/admin/update_category/<?= $category['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/delete_category/<?= $category['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>