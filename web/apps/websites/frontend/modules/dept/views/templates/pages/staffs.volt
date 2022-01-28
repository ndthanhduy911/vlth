<?php
    if($dept->id == 1){
        $regencyStaffs = $this->modelsManager->createBuilder()
        ->columns(array(
            's.id',
            's.slug',
            's.image',
            's.regency',
            's.deptposition',
            's.email',
            's.deptid',
            'sl.title',
            'sl.content'
        ))
        ->from(['s'=>'Staffs'])
        ->leftJoin("StaffsLang", "sl.staffid = s.id AND sl.langid = $langid",'sl')
        ->where("s.status = 1 AND (s.regency = 1 OR s.regency = 2)")
        ->orderBy("s.sort ASC, s.regency ASC")
        ->limit(3)
        ->getQuery()
        ->execute();
        
        $otherStaffs = $this->modelsManager->createBuilder()
        ->columns(array(
            's.id',
            's.slug',
            's.image',
            's.regency',
            's.deptposition',
            's.email',
            's.deptid',
            'sl.title title',
            'sl.content content'
        ))
        ->from(['s'=>'Staffs'])
        ->leftJoin("StaffsLang", "sl.staffid = s.id AND sl.langid = {$langid}",'sl')
        ->where("s.status = 1")
        ->inWhere("s.deptposition", [1,2])
        ->orderBy("s.deptid ASC, s.deptposition ASC, s.sort ASC")
        ->getQuery()
        ->execute();
    }else{
        $mainStaffs = $this->modelsManager->createBuilder()
        ->columns(array(
            's.id',
            's.slug',
            's.image',
            's.regency',
            's.deptposition',
            's.email',
            's.deptid',
            'sl.title title',
            'sl.content content'
        ))
        ->from(['s'=>'Staffs'])
        ->where("s.deleted = 0 AND s.status = 1 AND s.deptposition != 5 AND s.deptid = $dept->id")
        ->leftJoin("StaffsLang", "sl.staffid = s.id AND sl.langid = $langid",'sl')
        ->orderBy("s.dsort ASC,s.deptposition ASC")
        ->getQuery()
        ->execute();
        
        $employStaff = $this->modelsManager->createBuilder()
        ->columns(array(
            's.id',
            's.slug',
            's.image',
            's.regency',
            's.deptposition',
            's.email',
            's.deptid',
            'sl.title title',
            'sl.content content'
        ))
        ->from(['s'=>'Staffs'])
        ->where("s.deleted = 0 AND s.status = 1 AND s.deptposition = 5 AND s.deptid = $dept->id")
        ->leftJoin("StaffsLang", "sl.staffid = s.id AND sl.langid = $langid",'sl')
        ->orderBy("s.dsort ASC,s.deptposition ASC")
        ->getQuery()
        ->execute();
    } 
?>

{{ partial('breadcrumb') }}

<div class="banner dark-translucent-bg fixed-bg"style="background-image:url('{{helper.getLinkImage(items.bgimage, '/img/banner-page.jpg') }}'); background-position: 50% 27%;">
    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-lg-8 text-center pv-20">
                <h1 class="title"><span class="text-white text-uppercase">{{ title }}</span></h1>
                {% if itemslang.excerpt %}
                <div class="separator mt-10">
                </div>
                <p class="text-center">{{ itemslang.excerpt }}</p>
                {% endif %}
            </div>
        </div>
    </div>
</div>

<section class="main-container pt-4">
    <div class="container">
        <div class="row">
            <div class="main col-md-9">
                {% if dept.id == 1 %}
                    <h3 class="text-primary">{{ ml._ml('main_staff', 'BAN CHỦ NHIỆM') }}</h3>
                    <div class="separator-2"></div>
                    <div class="row grid-space-10">
                        {% for key,staff in regencyStaffs %}
                        <div class="col-md-4 pl-1 pr-1 mt-3">
                            <div class="team-member image-box style-2 dark-bg text-center">
                                <div class="overlay-container overlay-visible">
                                    <img class="grow" src="{{ helper.getLinkImage(staff.image,'/img/default3.jpg') }}" alt="{{ staff.title }}" width="100%">
                                </div>
                                <div class="body">
                                    <h5 class="margin-clear text-uppercase"><a href="<?= \Staffs::getUrl($dept,$staff) ?>" title="{{ staff.title }}">{{ staff.title }}</a></h5>
                                    <small class="text-uppercase"><?= \Staffs::getDean($staff->regency) ?></small>
                                    <div class="separator mt-10"></div>
                                    {% if staff.email %}
                                    <a href="mailto:{{ staff.email }}" class="margin-clear btn btn-md-link link-light"><i class="pr-10 fa fa-envelope-o"></i>{{ staff.email }}</a>
                                    {% endif %}
                                </div>
                            </div>
                        </div>
                        {% endfor %}
                    </div>
                    <br>
                    <br>

                    {% set dept_o_id = 0 %}
                    {% for key, staff in otherStaffs %}
                        {% if dept_o_id != staff.deptid %}
                            <h3 class="text-primary text-uppercase">{{ ml._ml('subject', 'Bộ môn') }} <?= Depts::getTitleById($staff->deptid, $langid) ?></h3>
                            <div class="separator-2"></div>
                            <div class="w-100">
                        {% endif %}
                            <div class="image-box team-member style-3-b">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <div class="overlay-container overlay-visible">
                                            <img class="grow" src="{{ helper.getLinkImage(staff.image,'/img/default3.jpg') }}" alt="{{staff.title}}" width="100%">
                                        </div>
                                    </div>
                                    <div class="col-md-9 p-sm-0">
                                        <div class="body mt-3">
                                            <h5 class="title margin-clear"><a href="<?= \Staffs::getUrl($dept, $staff) ?>" title="{{ staff.title }}">{{ staff.title }}</a></h5>
                                            <div class="separator-2 mt-2"></div>
                                            <h5 class="m-0 text-uppercase"><?= \Staffs::getPosition($staff->deptposition) ?></h5>
                                            {% if staff.email %}
                                            <a href="mailto:{{staff.email}}" class="btn btn-link pl-0 text-left"><i class="pr-10 margin-clear fa fa-envelope-o"></i>{{staff.email}}</a>
                                            {% endif %}
                                            <div class="w-100">
                                                <a href="<?= \Staffs::getUrl($dept, $staff) ?>" class="btn btn-default btn-sm btn-animated radius-50">{{ ml._ml('more', 'Xem thêm') }} <i class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {% if dept_o_id != staff.deptid %}
                            {% set dept_o_id = staff.deptid %}
                            </div>
                        {% endif %}
                    {% endfor %}
                {% else %}
                    <h2 class="page-title">{{ ml._ml('main_staff', 'Cán bộ cơ hữu') }}</h2>
                    <div class="separator-2"></div>
                    {% for staff in mainStaffs %}
                    <div class="image-box team-member style-3-b">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="overlay-container overlay-visible">
                                    <img class="grow" width="100%" src="{{ helper.getLinkImage(staff.image,'/img/default3.jpg') }}" alt="{{ staff.title }}">
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-9">
                                <div class="body">
                                <h3 class="title margin-clear">{{ staff.title }} - <small><?= \Staffs::getPosition($staff->deptposition) ?></small></h3>
                                <div class="separator-2 mt-10"></div>
                                {#{ helper.getExcerpt(staff.content,0,400) }#}
                                {% if staff.email %}
                                <h4 class="title mt-3">{{ ml._ml('contact', 'Liên hệ') }}</h4>
                                <ul class="list-icons">
                                    <li><a href="mailto:{{ staff.email }}" class="text-info"><i class="fa fa-envelope-o pr-10"></i>{{ staff.email }}</a></li>
                                {% endif %}
                                <div class="w-100">
                                    <a href="<?= \Staffs::getUrl($dept, $staff) ?>" class="btn btn-default btn-sm btn-animated radius-50">{{ ml._ml('more', 'Xem thêm') }} <i class="fa fa-arrow-right"></i></a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {% endfor %}

                    <h2 class="page-title">{{ ml._ml('employ_staff', 'Cán bộ thỉnh giảng') }}</h2>
                    <div class="separator-2"></div>
                    {% for staff in employStaff %}
                    <div class="image-box team-member style-3-b">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <div class="overlay-container overlay-visible">
                                    <img class="grow" width="100%" src="{{ helper.getLinkImage(staff.image,'/img/default3.jpg') }}" alt="{{ staff.title }}">
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-9">
                                <div class="body">
                                    <h3 class="title margin-clear">{{ staff.title }}</small></h3>
                                    <div class="separator-2 mt-10"></div>
                                    {#{ helper.getExcerpt(staff.content,0,400) }#}
                                    {% if staff.email %}
                                    <h4 class="title mt-3">{{ ml._ml('contact', 'Liên hệ') }}</h4>
                                    <ul class="list-icons">
                                        <li><a href="mailto:{{ staff.email }}" class="text-info"><i class="fa fa-envelope-o pr-10"></i>{{ staff.email }}</a></li>
                                    </ul>
                                    {% endif %}
                                    <div class="w-100">
                                        <a href="<?= \Staffs::getUrl($dept, $staff) ?>" class="btn btn-default btn-sm btn-animated radius-50">{{ ml._ml('more', 'Xem thêm') }} <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {% endfor %}
                {% endif %}
            </div>
            <div class="col-md-3">
                {{ partial('sidebar') }}
            </div>
        </div>
    </div>
</section>