<?php
namespace Opencart\Catalog\Controller\Extension\SimpleCallToAction\Module;
/**
 * Class SimpleCallToAction
 *
 * @package
 */
class SimpleCallToAction extends \Opencart\System\Engine\Controller {
    /**
     * @return string
     */
    public function index(array $setting): string {
        $this->load->language("extension/simple_call_to_action/module/simple_call_to_action");

        $this->load->model("tool/image");
        
        $data = [];
        
        $data['module_name'] = html_entity_decode($setting['name'], ENT_QUOTES, 'UTF-8');
        
        $data['title'] = html_entity_decode($setting['content'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
        
        $data['subtitle'] = html_entity_decode($setting['content'][$this->config->get('config_language_id')]['subtitle'], ENT_QUOTES, 'UTF-8');
        
        $data['link'] = html_entity_decode($setting['content'][$this->config->get('config_language_id')]['link'], ENT_QUOTES, 'UTF-8');
        
        $lang_id = $this->config->get("config_language_id");
        
		if (is_file(DIR_IMAGE . html_entity_decode($setting['content'][$lang_id]['image'], ENT_QUOTES, 'UTF-8'))) {
        	$data['thumb'] = $this->model_tool_image->resize(html_entity_decode($setting['content'][$lang_id]['image'], ENT_QUOTES, 'UTF-8'), -1, -1);
        } else {
        	$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        }

        $data['description'] = html_entity_decode($setting['content'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');

        $route = "extension/simple_call_to_action/module/";

        if ( !empty($setting["twig_name"]) && is_file( DIR_EXTENSION . "/simple_call_to_action/catalog/view/template/module/" . $setting["twig_name"] . ".twig" ) ) {
            $route .= $setting["twig_name"];
        } else {
            $route .= "simple_call_to_action";
        }

        return $this->load->view($route, $data);
    }
}
