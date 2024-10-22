<?php

namespace TypechoPlugin\SlidesBullet;

use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Checkbox;
use Typecho\Widget\Helper\Form\Element\Textarea;
use Widget\Archive;
use Widget\Options;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Slides Bullet
 *
 * @package SlidesBullet
 * @author Mr.Chip
 * @version 0.0.1
 * @link https://www.xtigerkin.com
 */

class Plugin implements PluginInterface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     */
    public static function activate()
    {
        \Typecho\Plugin::factory('Widget_Archive')->afterRender = __CLASS__ . '::render';
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @param Form $form 配置面板
     */
    public static function config(Form $form)
    {
        $contents = new Textarea('contents', null, '', _t('Contents in json'));
        $form->addInput($contents);
    }

    /**
     * 个人用户的配置面板
     *
     * @param Form $form
     */
    public static function personalConfig(Form $form)
    {
    }

    /**
     * 插件实现方法
     *
     * @access public
     * @return void
     */
    public static function render(...$args)
    {
        $contents = Options::alloc()->plugin('SlidesBullet')->contents;
        if (is_null($contents)) {
            return;
        }


        $contents = json_decode($contents, true);
        if (!is_array($contents)) {
            return;
        }
        // echo data to html injection
        require_once 'Slides.php';

    }
}

