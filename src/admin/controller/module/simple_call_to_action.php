<?php
namespace Opencart\Admin\Controller\Extension\SimpleCallToAction\Module;
/**
 * Class Category
 *
 * @package Opencart\Admin\Controller\Extension\SimpleCallToAction\Module
 */
class SimpleCallToAction extends \Opencart\System\Engine\Controller {
	/**
	 * @return void
	 */
	public function index(): void {
		$this->load->language('extension/simple_call_to_action/module/simple_call_to_action');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
		$this->document->addScript('view/javascript/ckeditor/adapters/jquery.js');
		
		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module')
		];

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/simple_call_to_action/module/simple_call_to_action', 'user_token=' . $this->session->data['user_token'])
			];
		} else {
			$data['breadcrumbs'][] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/simple_call_to_action/module/simple_call_to_action', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'])
			];
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['save'] = $this->url->link('extension/simple_call_to_action/module/simple_call_to_action|save', 'user_token=' . $this->session->data['user_token']);
		} else {
			$data['save'] = $this->url->link('extension/simple_call_to_action/module/simple_call_to_action|save', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id']);
		}

		$data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');
		
		if (isset($this->request->get['module_id'])) {
			$this->load->model('setting/module');
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($module_info['name'])) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($module_info['title'])) {
			$data['title'] = $module_info['title'];
		} else {
			$data['title'] = '';
		}

		if (isset($module_info['subtitle'])) {
			$data['subtitle'] = $module_info['subtitle'];
		} else {
			$data['subtitle'] = '';
		}
		
		if (isset($module_info['link'])) {
			$data['link'] = $module_info['link'];
		} else {
			$data['link'] = '';
		}
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($module_info['module_description'])) {
			$data['module_description'] = $module_info['module_description'];
		} else {
			$data['module_description'] = [];
		}
		
		if (isset($module_info['twig_name'])) {
			$data['twig_name'] = $module_info['twig_name'];
		} else {
			$data['twig_name'] = '';
		}
		
		if (isset($module_info['status'])) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		if (isset($module_info['content'])) {
			$data['content'] = $module_info['content'];
		} else {
			$data['content'] = [];
		}

		$this->load->model('tool/image');
		
		foreach ($data['languages'] as $lang) {
            $image = $data['content'][$lang['language_id']]['image'] ?? '';
        
            $data['content'][$lang['language_id']]['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        
            if ($image && is_file(DIR_IMAGE . html_entity_decode($image, ENT_QUOTES, 'UTF-8'))) {
                $data['content'][$lang['language_id']]['thumb'] = $this->model_tool_image->resize(html_entity_decode($image, ENT_QUOTES, 'UTF-8'), 100, 100);
            } else {
                $data['content'][$lang['language_id']]['thumb'] = $data['content'][$lang['language_id']]['placeholder'];
            }
        }
		
		if (isset($this->request->get['module_id'])) {
			$data['module_id'] = (int)$this->request->get['module_id'];
		} else {
			$data['module_id'] = 0;
		}
		
		$data['user_token'] = $this->session->data['user_token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('extension/simple_call_to_action/module/simple_call_to_action', $data));
	}

	/**
	 * @return void
	 */
	public function save(): void {
		$this->load->language('extension/simple_call_to_action/module/simple_call_to_action');

		$json = [];

		if (!$this->user->hasPermission('modify', 'extension/simple_call_to_action/module/simple_call_to_action')) {
			$json['error']['warning'] = $this->language->get('error_permission');
		}
		
		if ((oc_strlen($this->request->post['name']) < 3) || (oc_strlen($this->request->post['name']) > 64)) {
			$json['error']['name'] = $this->language->get('error_name');
		}
		
		if (!$json) {
			$this->load->model('setting/module');
			
			if (!$this->request->post['module_id']) {
				$json['module_id'] = $this->model_setting_module->addModule('simple_call_to_action.simple_call_to_action', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->post['module_id'], $this->request->post);
			}
			
			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
