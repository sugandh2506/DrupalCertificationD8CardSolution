<?php

namespace Drupal\c11n_plugin_sytem_demo\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;
use Drupal\Core\Form\FormStateInterface;
/**
 *  @Filter(
 *    id = "11npluginsystemdemo",
 *    title = @Translation("C11n Plugin System Demo"),
 *    description = @Translation("Help this text format celebrate good times!"),
 *    type = Drupal\filter\Plugin\FilterInterface::TYPE_HTML_RESTRICTOR,
 *   settings = {
 *     "celebrate_invitation" = "drupal,wordpress,joomla",
 *   },
 *    )
 */

class C11nPluginSystemDemo extends FilterBase {
  public function process($text, $langcode) {
  	$invitation = $this->settings['celebrate_invitation'] ? $this->settings['celebrate_invitation'] : '';

  	$lookingForDelimiter = explode(',', $invitation);

  	foreach ($lookingForDelimiter as $key => $value) {
  		if (strpos($text, $value) == true) {
  			$replace = strtoupper($value);
  			$newtext = str_replace($value, $replace, $text);
  			
  		}
  	}
    return new FilterProcessResult($newtext);
  }

  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['celebrate_invitation'] = [
      '#type' => 'textarea',
      '#description' => $this->t('Enter list of words in small case, which should be capitalised. Separate multiple words with comma(,)'),
      '#title' => $this->t('Words to Capitalize'),
      '#default_value' => $this->settings['celebrate_invitation'],
    ];
    return $form;
  }
}