<?php
/**
 * @author FYB Romania
 * @copyright Copyright (c) FYB Romania (https://fyb.ro)
 * @package Notification Bar for Magento 2
 */

namespace Fyb\NotificationBar\Block\Adminhtml\System\Config;

use Magento\Backend\Block\Template\Context;
use Magento\Cms\Model\Wysiwyg\Config as WysiwygConfig;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Editor extends Field
{
    /**
     * @var WysiwygConfig
     */
    protected $wysiwygConfig;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        WysiwygConfig $wysiwygConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->wysiwygConfig = $wysiwygConfig;
    }

    /**
     * @inheritdoc
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $element->setWysiwyg(true);
        $config = $this->wysiwygConfig->getConfig($element);

        $config->setData('add_variables', false)
            ->setData('add_widgets', false)
            ->setData('plugins', [])
            ->setData('add_images', false)
            ->setData('no_display', false)
            ->setData('use_container', false);

        $tinyMce = $config->getData('tinymce4');
        $tinyMce['toolbar'] = 'styleselect | fontsizeselect | lineheightselect | bold italic underline | link';
        $tinyMce['plugins'] = 'advlist autolink lists link charmap media noneditable table contextmenu paste code help table textcolor image colorpicker lineheight autoresize';
        $tinyMce['menubar'] = '';
        $config->setData('tinymce4', $tinyMce);

        $element->setConfig($config);

        return parent::_getElementHtml($element);
    }
}
