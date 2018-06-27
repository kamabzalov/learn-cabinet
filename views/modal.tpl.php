<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Редактирование новости</h4>
    </div>
    <div class="modal-body">
        <form>
        <input type="hidden" data-ng-model="newsId" name="newsId">
            <div class="form-group">
                <input type="text" data-ng-model="newsTitle" name="newsTitle" class="form-control">
            </div>
            <div class="form-group">
                <textarea data-ng-model="newsDescription" name="newsDescription" class="form-control"></textarea>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" data-ng-click="close();">Закрыть</button>
        <button type="button" class="btn btn-primary" data-ng-click="save()">Сохранить</button>
    </div>
</div>