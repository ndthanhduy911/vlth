<?php
namespace Backend\Modules\Admins\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\StringLength as StringLength;
use Phalcon\Validation\Validator\PresenceOf;
class PagesForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $slug = new Text('slug');
        $slug->setAttributes(array(
            'class' => 'form-control',
            'placeholder' => 'Slug',
            'maxlength' => "200",
        ));
        $slug->addValidators(array(
            new StringLength([
                "max" => 200,
                "messageMaximum" => "Slug không được dài quá 255 ký tự",
            ]),
        ));
        $this->add($slug);

        $status = new Select('status', [
            1 => "Hoạt động",
            0 => "Khóa",
        ], [
            'useEmpty' => true,
            'emptyText' => 'Chọn trạng thái',
            'emptyValue' => '',
            'class' => 'form-control pull-right w-100',
            'required' => '',
            'data-required-error' => 'Vui lòng điền đầy đủ thông tin.',
        ]);
        $status->addValidators(array(
            new PresenceOf(array(
                'message' => 'Trạng thái không được để trống.',
            )),
        ));
        $this->add($status);

        $attribute_id = new Select('attribute_id', Attributes::find(), [
            'using' => array('id', 'name'),
            'useEmpty' => true,
            'emptyText' => 'Mặc định',
            'emptyValue' => '',
            'class' => 'form-control pull-right w-100',
        ]);
        $this->add($attribute_id);

        $featured_image = new Hidden('featured_image');
        $this->add($featured_image);

        $background_image = new Hidden('background_image');
        $this->add($background_image);

        $deleted = new Hidden('deleted');
        $this->add($deleted);
    }
}