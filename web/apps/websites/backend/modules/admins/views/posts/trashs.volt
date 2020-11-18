<main class="app-content">
    <div class="app-title mb-3">
        <div>
            <h1><i class="fa fa-th-list"></i> BÀI VIẾT</h1>
            <p>Quản lý bài viết đã xoá</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><a class="link" href="{{ config.application.backenduri }}"><i class="fa fa-home fa-lg"></i></a></li>
            <li class="breadcrumb-item">Bài viết đã xoá</li>
        </ul>
    </div>

    <div class="body-message">
        <?php echo $this->flashSession->output(); ?>
    </div>

    <div class="row">
        <div class="col-md-12 p-0">
            <div class="tile">
                <div class="col-12 p-0 mb-2">
                    <a href="{{ config.application.backendUri }}/posts" title="Danh sách bài viết" class="btn btn-info fa fa-list-alt pull-right"></a>
                </div>
                <div class="tile-body">
                    <table id="posts_trash" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="align-middle text-center text-white w-20-px">#</th>
                                <th class="align-middle text-center text-white w-70-px">Hình</th>
                                <th class="align-middle text-center text-white">Tiêu đề</th>
                                <th class="align-middle text-center text-white">Danh mục</th>
                                <th class="align-middle text-center text-white">Tác giả</th>
                                <th class="align-middle text-center text-white">Ngày đăng</th>
                                <th class="align-middle text-center text-white w-70-px">Thao tác</th>
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