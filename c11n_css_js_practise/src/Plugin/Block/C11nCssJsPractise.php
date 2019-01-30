<?php

namespace Drupal\c11n_css_js_practise\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Header' Block.
 *
 * @Block(
 *   id = "c11n_css_js_practise",
 *   admin_label = @Translation("c11n css js practise"),
 *   category = @Translation("c11n css js practise"),
 * )
 */

class C11nCssJsPractise extends BlockBase implements BlockPluginInterface {
  /**
   * {@inheritdoc}
   */
	
	
	// function c11n_css_js_practise_preprocess_html(&$variables) {
	// 	$variables['page']['#attached']['library'][] = 'c11n_css_js_practise\c11n_css_js_practise';
	// }
	
  /**
   * {@inheritdoc}
   */
  public function build() {
	$config = $this->getConfiguration();
	  
    if (!empty($config['c11n_css_js_practise_title']) && ($config['c11n_css_js_practise_text'])) {
      $title = $config['c11n_css_js_practise_title'];
	  $descp = $config['c11n_css_js_practise_text'];
    }
    else {
      $title = $this->t('<div>Atención! Titulo no configurado!</div> </p>');
	  $descp = $this->t('<div>Atención! Descripción no configurada!</div>');
    }
    $block = array
		(
			'title' => array
			(
			 '#prefix' => '<div class="title"><p>', /* HERE I ADD THE CSS TAGS */
			 '#suffix' => '</p></div>',
			 '#markup' => t('@title', array('@title' => $title,)),
			),
			'description' => array
			(
			 '#prefix' => '<div class="descp"><p>', /* HERE I ADD THE CSS TAGS */
			 '#suffix' => '</p></div>',
			 '#markup' => t('@descp', array('@descp' => $descp,))
			),
		);
	return $block;	
	
  }

  
/**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['c11n_css_js_practise_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Titulo del Bloque'),
      '#description' => $this->t('Titulo del Bloque'),
      '#default_value' => isset($config['c11n_css_js_practise_title']) ? $config['c11n_css_js_practise_title'] : '',
    );
	
    $form['c11n_css_js_practise_text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Descripción'),
      '#description' => $this->t('Descripción del bloque'),
      '#default_value' => isset($config['c11n_css_js_practise_text']) ? $config['c11n_css_js_practise_text'] : '',
    );

    return $form;
  }
  
  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['c11n_css_js_practise_title'] = $values['c11n_css_js_practise_title'];
	$this->configuration['c11n_css_js_practise_text'] = $values['c11n_css_js_practise_text'];
	$this->configuration['c11n_css_js_practise_title'] = $form_state->getValue('c11n_css_js_practise_title');
	$this->configuration['c11n_css_js_practise_text'] = $form_state->getValue('c11n_css_js_practise_text');
  }
}