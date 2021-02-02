<?php
namespace Backend\Modules\Admins\Controllers;

class MajorsController  extends \AdminsLangCore {
    public $title = "Ngành học";

    public $cler = "majors";

    public $className = \Majors::class;

    public $classNameLang = \MajorsLang::class;

    public $itemsForm = \Backend\Modules\Admins\Forms\MajorsForm::class;

    public $itemsLangFrom = \Backend\Modules\Admins\Forms\MajorsLangForm::class;

    public $fTables = ['image','title','content','createdby','createdat','slug','status'];

    public $fFilters = ['title','status','createdat'];

    public $searchForm = \Backend\Modules\Admins\Forms\SearchMajorsForm::class;

    public $jS = WEB_URI.'/assets/backend/js/modules/admins/majors.js';

    public $itemsid = 'majorid' ;

    public function updateC($items,$itemsLangs){
        $languages = \Language::find(['status = 1']);
        $pTitle = $this->request->getPost('title',['string','trim']);
        $pContent = $this->request->getPost('content',['trim']);
        $pStdout = $this->request->getPost('stdout',['trim']);
        $pCurriculum = $this->request->getPost('curriculum',['trim']);
        $pProspects = $this->request->getPost('prospects',['trim']);
        $pFee = $this->request->getPost('fee',['trim']);
        $pResearches = $this->request->getPost('researches',['trim']);
        $pStudents = $this->request->getPost('students',['trim']);
        $pAlumni = $this->request->getPost('alumni',['trim']);
        $pRpartners = $this->request->getPost('rpartners',['trim']);

        foreach ($languages as $key => $lang) {
            if(empty($items->id) || !$itemsLang = \MajorsLang::findFirst(["majorid = :id: AND langid = :langid:",'bind' => ['id' => (!empty($items->id) ? $items->id : 0),'langid' => $lang->id]])){
                $itemsLang = new \MajorsLang();
            }
            if($key == 0){
                $lId = $lang->id;
            }
            $itemsLang->title = !empty($pTitle[$lang->id]) ? $pTitle[$lang->id] : $pTitle[$lId];
            $itemsLang->content = !empty($pContent[$lang->id]) ? $pContent[$lang->id] : $pContent[$lId];
            $itemsLang->stdout = !empty($pStdout[$lang->id]) ? $pStdout[$lang->id] : $pStdout[$lId];
            $itemsLang->curriculum = !empty($pCurriculum[$lang->id]) ? $pCurriculum[$lang->id] : $pCurriculum[$lId];
            $itemsLang->prospects = !empty($pProspects[$lang->id]) ? $pProspects[$lang->id] : $pProspects[$lId];
            $itemsLang->fee = !empty($pFee[$lang->id]) ? $pFee[$lang->id] : $pFee[$lId];
            $itemsLang->researches = !empty($pResearches[$lang->id]) ? $pResearches[$lang->id] : $pResearches[$lId];
            $itemsLang->students = !empty($pStudents[$lang->id]) ? $pStudents[$lang->id] : $pStudents[$lId];
            $itemsLang->alumni = !empty($pAlumni[$lang->id]) ? $pAlumni[$lang->id] : $pAlumni[$lId];
            $itemsLang->rpartners = !empty($pRpartners[$lang->id]) ? $pRpartners[$lang->id] : $pRpartners[$lId];
            $itemsLang->langid = $lang->id;
            array_push($itemsLangs,$itemsLang);
        }

        $plug = $this->request->getPost('slug',['string','trim']);
        $items->status = $this->request->getPost('status',['int']);
        $items->slug = $plug ? $this->helper->slugify($plug) : $this->helper->slugify($pTitle[1]);
        $items->image = $this->request->getPost('image',['trim','string']);
        if($this->className::findFirst(['slug = :slug: AND id != :id:','bind' => ['slug' => $items->slug,'id' => (!empty($items->id) ? $items->id : 0)]])){
            $items->slug .= strtotime('now');
        }

        return [$items, $itemsLangs];
    }

    public function ajaxgetdataAction(){
        if (!$this->request->isAjax() || !$perL = $this->master::checkPermissionDepted($this->cler, 'index')) {
            $this->helper->responseJson($this, ["error" => "Truy cập không được phép"]);
        }
        $columns = [
            'p.id',
            'p.slug',
            'p.status',
            'p.deptid',
            'p.image',
            'p.createdat',
            'pl.title',
            'pl.content',
            'u.fullname createdby',
            'd.slug dslug',
            '(SELECT dl.title FROM DeptsLang AS dl WHERE dl.deptid = p.deptid AND dl.langid = 1) AS deptname',
        ];

        $data = $this->modelsManager->createBuilder()
        ->columns($columns)
        ->from(['p' => "Majors"])
        ->where("p.deleted = 0")
        ->leftJoin('User', 'u.id = p.createdby','u')
        ->leftJoin('MajorsLang', 'pl.majorid = p.id AND pl.langid = 1','pl')
        ->leftJoin('Depts', 'd.id = p.deptid','d')
        ->orderBy('p.deptid ASC, p.id DESC');

        $data = $this->master::builderPermission($data,$perL,'p');
        $data = \FilterSetting::getDataOrder($this,$data,($this->className)::findFirst(),'p',['pl'=>'title']);
        $data = \FilterSetting::getDataFilter($this,$data,($this->className)::arrayFilter(),['p',['pl'=>['title']]]);

        $arrayRow = [
            'u' => $this->master::checkPermission($this->cler, 'update', 1)
        ];

        $search = '';
        $this->helper->responseJson($this, $this->ssp->dataOutput($this, $data,$search, $arrayRow));
    }
}