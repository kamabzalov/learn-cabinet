<form class="form-horizontal" name="productInfo" data-ng-submit="saveProduct()">
    <input type="hidden" id="productId" data-ng-model="productId">
    <legend>Редактирование товара</legend>
    <div class="form-group">
        <label for="productName" class="col-sm-3">Наименование товара</label>
        <div class="col-sm-9">
            <input type="text" data-ng-model="productName" id="productName" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="productPrice" class="col-sm-3">Стоимость товара</label>
        <div class="col-sm-9">
            <input type="text" data-ng-model="productPrice" id="productPrice" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button class="btn btn-default">Сохранить</button>
            <button class="btn btn-danger" type="button" data-ng-click="deleteProduct(productId)">Удалить</button>
        </div>
    </div>
</form>
