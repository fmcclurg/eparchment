<?php

namespace Drupal\eparchment\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a Eparchment block with which you can generate eparchment messages.
 *
 * @Block(
 *   id = "eparchment_block",
 *   admin_label = @Translation("Eparchment block"),
 * )
 */

class EparchmentBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Return the form @ Form/EparchmentBlockForm.php
    return \Drupal::formBuilder()->getForm('Drupal\eparchment\Form\EparchmentBlockForm');
  }

  /**
   * {@inheritdoc}
   * 
   * Handles access control.
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'generate eparchment');
  }

  /**
   * {@inheritdoc}
   * 
   * Handles Block administration screen.
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   * 
   * This is a submit handler.
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('eparchment_block_settings', $form_state->getValue('eparchment_block_settings'));
  } 

}
