<form class="form-horizontal" method="post" data-ng-show="isShowEditForm" data-ng-submit="updateUserData()">
    <input type="hidden" data-ng-model="userId">
    <fieldset>
        <div class="form-group">
            <label class="col-md-4 control-label" for="fullName">ФИО</label>
            <div class="col-md-4">
                <input id="fullName" name="fullName" data-ng-model="userFullName" class="form-control input-md" required="true" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="login">Логин</label>
            <div class="col-md-4">
                <input id="login" name="login" data-ng-model="userLogin" class="form-control input-md" required="true" type="text">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="email">Email</label>
            <div class="col-md-4">
                <input id="email" name="email" data-ng-model="userEmail" class="form-control input-md" required="true" type="email">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="role">Роль</label>
            <div class="col-md-4">
                <select name="role" id="role" class="form-control" ng-options="option.name for option in roles track by option.id" data-ng-model="newRole">
                    <option value="{{role.id}}" data-ng-repeat="role in roles">{{role.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
                <button class="btn btn-success">Сохранить</button>
                <button class="btn btn-danger" type="button" data-ng-click="deleteUser(userId)">Удалить</button>
            </div>
        </div>
    </fieldset>
</form>