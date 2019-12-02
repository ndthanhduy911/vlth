<?php

namespace Backend\Modules\Setting\Controllers;
use Phalcon\Mvc\View;

use Models\Menus;
use Models\MenusLang;
use Models\MenuLocation;

use Backend\Modules\Setting\Forms\MenusForm;
use Backend\Modules\Setting\Forms\MenusLangForm;
use Backend\Modules\Setting\Forms\MenuLocationForm;

class MenusController  extends \BackendController
{
    public function indexAction(){
        $this->get_js_css();
        $this->view->menu_location = MenuLocation::find();
    }

    public function locationAction(){
        $this->get_js_css();
        // $this->view->form = new UserForm();
    }

    public function updateAction($id = 0){
        $forms_lang = [];
        $cats_lang = [];
        $languages = Language::find(['status = 1']);
        if($id){
            if(!$category = Categories::findFirstId($id)){
                echo 'Không tìm thấy dữ liệu'; die;
            }
            $category->updated_at = date('Y-m-d H:i:s');
            $title = 'Cập nhật';
            foreach ($languages as $key => $lang) {
                $cat_lang = CategoriesLang::findFirst(['cat_id = :id: AND lang_id = :lang_id:','bind' => ['id' => $category->id, 'lang_id' => $lang->id]]);
                if($cat_lang){
                    $form_lang = new CategoriesLangForm($cat_lang);
                    $cats_lang[$lang->id] = $cat_lang;
                    $forms_lang[$lang->id] = $form_lang;
                }else{
                    echo 'Nội dung không phù hợp'; die;
                }
            }
            $form_cat = new CategoriesForm($category);   
        }else{
            $category = new Categories();
            $category->author = $this->session->get('user_id');
            $category->dept_id = $this->session->get('dept_id');
            $category->created_at = date('Y-m-d H:i:s');
            $category->updated_at = $category->created_at;
            $title = 'Thêm mới';
            foreach ($languages as $key => $lang) {
                $forms_lang[$lang->id] = new CategoriesLangForm();
                $cats_lang[$lang->id] = new CategoriesLang();
            }
            $form_cat = new CategoriesForm($category);
        }
        if ($this->request->isPost()) {
            // if ($this->security->checkToken()) {
                // $data['token'] = ['key' => $this->security->getTokenKey(), 'value' => $this->security->getToken()];
                $error = [];
                $c_name = $this->request->getPost('name');
                $c_slug = $this->request->getPost('slug');
                $c_description = $this->request->getPost('description');
                $req_cat = [
                    'slug' => $c_slug ? $c_slug : $this->helper->slugify($c_name[1]),
                    'featured_image' => $this->request->getPost('featured_image'),
                    'status' => $this->request->getPost('status'),
                ];
                
                $form_cat->bind($req_cat, $category);
                if (!$form_cat->isValid()) {
                    foreach ($form_cat->getMessages() as $message) {
                        array_push($error, $message->getMessage());
                    }
                }

                $check_slug = Categories::findFirst([
                    "slug = :slug: AND id != :id:",
                    "bind" => [
                        "slug" => $req_cat['slug'],
                        'id'    => $id,
                    ]
                ]);

                if($check_slug){
                    $req_cat['slug'] = $req_cat['slug'] .'-'. strtotime('now'); 
                }

                foreach ($languages as $key => $lang) {
                    $req_cat_lang[$lang->id] = [
                        'name' => $c_name[$lang->id],
                        'description' => $c_description[$lang->id],
                        'lang_id' => $lang->id,
                    ];
                    $forms_lang[$lang->id]->bind($req_cat_lang[$lang->id], $cats_lang[$lang->id]);
                    if (!$forms_lang[$lang->id]->isValid()) {
                        foreach ($forms_lang[$lang->id]->getMessages() as $message) {
                            array_push($error, $message->getMessage());
                        }
                    }
                }

                if (!count($error)) {
                    if (!$category->save()) {
                        foreach ($category->getMessages() as $message) {
                            $this->flashSession->error($message);
                        }
                    } else {
                        foreach ($languages as $key => $lang) {
                            $cats_lang[$lang->id]->cat_id = $category->id;
                            $cats_lang[$lang->id]->save();
                        }
                        $this->flashSession->success($title." thành công");
                        return $this->response->redirect(BACKEND_URL.'/categories');
                    }
                }else{
                    foreach ($error as $value) {
                        $this->flashSession->error($value . ". ");
                    }
                }
            // }else{
            //     $this->flashSession->error("Token không chính xác");
            // }
        }
        $this->view->languages = $languages;
        $this->view->forms_lang = $forms_lang;
        $this->view->form_cat = $form_cat;
        $this->view->cats_lang = $cats_lang;
        $this->view->title = $title;
        $this->assets->addJs('/elfinder/js/require.min.js');
        $this->get_js_css();
    }
    
    public function updatelocationAction($id = 0){
        if($id){
            if(!$menu_location = MenuLocation::findFirstId($id)){
                echo 'Không tìm thấy dữ liệu'; die;
            }
            $menu_location->updated_at = date('Y-m-d H:i:s');
            $title = 'Cập nhật';
            $form = new MenuLocationForm($menu_location);   
        }else{
            $menu_location = new MenuLocation();
            $menu_location->dept_id = $this->session->get('dept_id');
            $menu_location->created_at = date('Y-m-d H:i:s');
            $menu_location->updated_at = $menu_location->created_at;
            $title = 'Thêm mới';
            $form = new MenuLocationForm($menu_location);
        }
        if ($this->request->isPost()) {
            if ($this->security->checkToken()) {
                $data['token'] = ['key' => $this->security->getTokenKey(), 'value' => $this->security->getToken()];
                $error = [];
                $req = [
                    'name' => $this->request->getPost('name'),
                    'description' => $this->request->getPost('description'),
                    'status' => $this->request->getPost('status'),
                ];
                
                $form->bind($req, $menu_location);
                if (!$form->isValid()) {
                    foreach ($form->getMessages() as $message) {
                        array_push($error, $message->getMessage());
                    }
                }

                if (!count($error)) {
                    if (!$menu_location->save()) {
                        foreach ($menu_location->getMessages() as $message) {
                            $this->flashSession->error($message);
                        }
                    } else {
                        $this->flashSession->success($title." thành công");
                        return $this->response->redirect(BACKEND_URL.'/menu');
                    }
                }else{
                    foreach ($error as $value) {
                        $this->flashSession->error($value . ". ");
                    }
                }
            }else{
                $this->flashSession->error("Token không chính xác");
            }
        }
        $this->view->form = $form;
        $this->view->title = $title;
        $this->get_js_css();
    }

    public function deleteAction($id = null){
        
        if ($cat = Categories::findFirstId($id) && !in_array((int)$id, [1,2,3,4,5])) {
            $cat->status = 4;
            if (!$cat->save()) {
                if ($this->request->isAjax()) {
                    foreach ($cat->getMessages() as $message) {
                        array_push($error, $message->getMessage());
                    }
                    $data['error'] = $error;
                    $this->response->setStatusCode(400, 'error');
                    $this->response->setJsonContent($data);
                    return $this->response->send();
                } else {
                    foreach ($cat->getMessages() as $message) {
                        $this->flashSession->error($message);
                    }
                    return $this->response->redirect(BACKEND_URL.'/trashs');
                }
            }else{
                if ($this->request->isAjax()) {
                    $data['data'] = $cat->toArray();
                    $this->response->setStatusCode(200, 'OK');
                    $this->response->setJsonContent($data);
                    return $this->response->send();
                } else {
                    // $this->logs->write_log(3, 1, 'Xóa trang', json_encode($save),$this->session->get("user_id"));
                    $this->flashSession->success("Chuyển bài viết đến thùng rác thành công");
                    return $this->response->redirect(BACKEND_URL.'/posts');
                }
            }
        }else{
            if ($this->request->isAjax()) {
                $data['error'] = 'Không tìm thấy bài viết';
                $this->response->setStatusCode(404, 'Not found');
                $this->response->setJsonContent($data);
                return $this->response->send();
            } else {
                // $this->logs->write_log(3, 1, 'Xóa trang', json_encode($save),$this->session->get("user_id"));
                $this->flashSession->error("Không tìm thấy bài viết");
                return $this->response->redirect(BACKEND_URL.'/posts');
            }
        }
        
    }

    // =================================
    // API
    // =================================
    public function getdataAction($menu_location_id = 0){
        if($this->request->isAjax()){
            $npMenu = Menus::getNamepace();
            $data = $this->modelsManager->createBuilder()
            ->columns(array(
                $npMenu.'.id',
                $npMenu.'.parent_id',
                $npMenu.'.param_id',
                $npMenu.'.link',
                $npMenu.'.status',
                $npMenu.'.module',
                $npMenu.'.controller',
                $npMenu.'.action',
                'ML.name menu_name',
            ))
            ->from($npMenu)
            ->join('Models\MenusLang', 'ML.menu_id = '.$npMenu.'.id AND ML.lang_id = 1','ML')
            ->orderBy($npMenu.'.parent_id DESC, '.$npMenu.'.sort_other ASC, ML.name ASC')
            ->where($npMenu.'.deleted = 0 AND '.$npMenu.'.menu_location_id = '.$menu_location_id);
            if($this->session->get('role') !== 1){
                $data = $data->andWhere($npMenu.".dept_id IN (".implode(',',$this->session->get('dept_mg')).")");
            }
    
            $search = false;
            $this->response->setStatusCode(200, 'OK');
            $this->response->setJsonContent($this->ssp->data_output($this->request->get(), $data,$search));
            return $this->response->send();
        }else{
            $this->response->setStatusCode(403, 'Failed');
            $this->response->setJsonContent(['Truy cập không được phép']);
            return $this->response->send();
        }
    }

    public function getdatalocationAction(){
        if($this->request->isAjax()){
            $npMenu = MenuLocation::getNamepace();
            $data = $this->modelsManager->createBuilder()
            ->columns(array(
                $npMenu.'.id',
                $npMenu.'.name',
                $npMenu.'.description',
                $npMenu.'.status',
                $npMenu.'.created_at'
            ))
            ->from($npMenu)
            ->orderBy($npMenu.'.dept_id ASC, '.$npMenu.'.name ASC')
            ->where("1 = 1");
            if($this->session->get('role') !== 1){
                $data = $data->andWhere("$npMenu.dept_id = :dept_id:",['dept_id' => $this->session->get('dept_id')]);
            }
    
            $search = $npMenu.'.name LIKE :search:';
            $this->response->setStatusCode(200, 'OK');
            $this->response->setJsonContent($this->ssp->data_output($this->request->get(), $data,$search));
            return $this->response->send();
        }else{
            $this->response->setStatusCode(403, 'Failed');
            $this->response->setJsonContent(['Truy cập không được phép']);
            return $this->response->send();
        }
    }


    // =================================
    // FUNCTION
    // =================================
    private function get_js_css (){
        $this->assets->addJs($this->config->application->baseUri.'/assets/backend/js/modules/menus.js');
    }
}