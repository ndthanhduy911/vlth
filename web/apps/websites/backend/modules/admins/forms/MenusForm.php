<?php
namespace Backend\Modules\Admins\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Form;
class MenusForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        //title
        $title = new Text('title');
        $title->setLabel('Tiêu đề');
        $title->setAttributes(array(
            'class' => 'form-control form-control-sm',
            'placeholder' => 'Ví du: Tin tức',
            'maxlength' => "200",
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ",
        ));
        $this->add($title);

        $deptid = isset($_SESSION['deptid']) ? $_SESSION['deptid'] : 0;
        $menus = [];
        //parentid
        $parentid = new Select('parentid', $menus, [
            'useEmpty' => true,
            'emptyText' => 'Không',
            'emptyValue' => 0,
            'class' => 'form-control form-control-sm',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $parentid->setLabel('Trực thuộc');
        $this->add($parentid);

        //type
        $type = new Select('type', [
            1 => "Bài viết",
            2 => "Trang",
            3 => "Chuyên mục",
            4 => "Bộ môn",
            5 => "Link",
            6 => "Ngành học"
        ], [
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'required' => '',
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $type->setLabel('Loại menus');
        $this->add($type);

        //postid
        $posts = \Posts::find(["deleted = 0 AND status = 1 AND deptid = {$deptid}","columns" => "id, (SELECT pl.title FROM PostsLang AS pl WHERE pl.postid = Posts.id AND pl.langid = 1) AS title"]);
        $postid = new Select('postid', $posts, [
            'using' => ['id','title'],
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'disabled' => "",
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $postid->setLabel('Bài viết');
        $this->add($postid);

        //pageid
        $pages = \Pages::find(["deleted = 0 AND status = 1 AND deptid = {$deptid}","columns" => "id, (SELECT pl.title FROM PagesLang AS pl WHERE pl.pageid = Pages.id AND pl.langid = 1) AS title"]);
        $pageid = new Select('pageid', $pages, [
            'using' => ['id','title'],
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'disabled' => "",
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $pageid->setLabel('Trang thông tin');
        $this->add($pageid);

        //catid
        $cats = \Categories::find(["deleted = 0 AND status = 1 AND deptid = {$deptid}","columns" => "id, (SELECT pl.title FROM CategoriesLang AS pl WHERE pl.catid = Categories.id AND pl.langid = 1) AS title"]);
        $catid = new Select('catid', $cats, [
            'using' => ['id','title'],
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'disabled' => "",
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $catid->setLabel('Chuyên mục');
        $this->add($catid);

        //dept
        $depts = \Depts::find(["deleted = 0 AND status = 1 AND id > 1","columns" => "id, (SELECT pl.title FROM DeptsLang AS pl WHERE pl.deptid = Depts.id AND pl.langid = 1) AS title"]);
        $dept = new Select('dept', $depts, [
            'using' => ['id','title'],
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'disabled' => "",
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $dept->setLabel('Bộ môn');
        $this->add($dept);

        //majorid
        $majors = \Majors::find(["deleted = 0 AND status = 1 AND deptid = {$deptid}","columns" => "id, (SELECT pl.title FROM MajorsLang AS pl WHERE pl.majorid = Majors.id AND pl.langid = 1) AS title"]);
        $majorid = new Select('majorid', $majors, [
            'using' => ['id','title'],
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'disabled' => "",
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $majorid->setLabel('Ngành học');
        $this->add($majorid);

        //links
        $links = new Text('links');
        $links->setLabel('Links');
        $links->setAttributes(array(
            'class' => 'form-control form-control-sm',
            'placeholder' => 'Ví du: https://phys.hcmus.edu.vn',
            'maxlength' => "200",
            'disabled' => "",
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ));
        $this->add($links);

        //status
        $status = new Select('status', [
            1 => "Hoạt động",
            0 => "Khóa",
        ], [
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $status->setLabel('Trạng thái');
        $this->add($status);

        //icon
        $icon = new Select('icon', [], [
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'class' => 'form-control form-control-sm',
            'data-required-error' => 'Vui lòng nhập thông tin',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $icon->setLabel('Biểu tượng');
        $this->add($icon);

        //target
        $target = new Select('target', [
            0 => "Mặc định",
            1 => "Mở Tab mới"
        ], [
            'useEmpty' => true,
            'emptyText' => 'Chọn',
            'emptyValue' => '',
            'class' => 'form-control form-control-sm',
            'data-error' => "Thông tin chưa hợp lệ"
        ]);
        $target->setLabel('Mở liên kết');
        $this->add($target);

        //sort
        $sort = new Numeric('sort');
        $sort->setLabel('Sắp xếp');
        $sort->setAttributes(array(
            'class' => 'form-control form-control-sm',
            'placeholder' => 'Sắp xếp',
            'max' => '999'
        ));
        $this->add($sort);
    }
}
