<main class="app-content">
    <div class="app-title mb-3">
        <div>
            <h1><i class="fa fa-th-list"></i> MENU</h1>
            <p>Quản lý menu</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Menu</li>
        </ul>
    </div>

    <div class="body-message">
        <?php echo $this->flashSession->output(); ?>
    </div>

    <div class="row">
        <div class="col-md-12 p-0">
            <div class="tile">
                <div class="col-12 p-0 mb-2 ">
                    <div class="row">
                        <div class="col-md-6">
                            <select id="menuLocationId" class="form-control" name="menu_location_id">
                                <option value="">Chọn vị trí menu</option>
                                {%for location in menu_location %} <option value="{{location.id}}">{{location.name}}</option> {%endfor%}
                            </select>
                        </div>
                        <div class="col-md-6 text-right">
                            <a id="addMenu" href="{{ config.application.backendUri }}/menu/update" title="Tạo" class="btn btn-success fa fa-plus"></a>
                        </div>
                    </div>
                </div>
                <div class="tile-body">
                    <table id="menus" class="table table-bordered table-hover">
                        <thead>
                            <tr class="bg-primary">
                                <th class="align-middle text-center text-white">Tên</th>
                                <th class="align-middle text-center text-white">Link</th>
                                <th class="align-middle text-center text-white">Trạng thái</th>
                                <th class="align-middle text-center text-white">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>