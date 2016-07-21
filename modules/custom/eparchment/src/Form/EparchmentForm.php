<?php

/**
 * @file
 * Contains \Drupal\eparchment\Form\EparchmentForm.
 */

namespace Drupal\eparchment\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class is referenced in the "*.routing.yml" file.
 */
class EparchmentForm extends ConfigFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'eparchment_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor
    $form = parent::buildForm($form, $form_state);

    // Default settings
    $config = $this->config('eparchment.settings');

    // Page title field
    $form['page_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Eparchment generator page title:'),
      '#default_value' => $config->get('eparchment.page_title'),
      '#description' => $this->t('Give your Eparchment generator page a title.'),
    );

    // Recipient's email field
    $form['recipient_email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Friend\'s email:'),
      '#description' => $this->t('Enter the email address of the Eparchment recipient.'),
      '#required' => TRUE,
    );

    // From email field
    $form['from_email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Your email:'),
      '#description' => $this->t('Enter your email address in case your friend wants to reply.'),
      '#required' => TRUE,
    );

    // Subject text field
    $form['subject_text'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Eparchment subject:'),
      '#default_value' => $config->get('eparchment.subject_text'),
      '#description' => $this->t('Enter the Eparchment subject that will show up in your friend\'s mailbox.'),
      '#size' => 60,
      '#maxlength' => 120,
      '#required' => TRUE,
    );

    // Subject text field
    $form['message_text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Personal message:'),
      '#default_value' => $config->get('eparchment.message_text'),
      '#description' => $this->t('Enter a message to your friend that will accompany your Eparchment.'),
      '#rows' => 4,
      '#cols' => 60,
      '#resizable' => 'vertical',  // "none", "vertical", "horizontal", or "both" (defaults to "vertical")
      '#required' => TRUE,
    );

    // From email field
    $form['from_email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Your email:'),
      '#description' => $this->t('Enter your email address in case your friend wants to reply.'),
      '#required' => TRUE,
    );

    return $form;
  }

  /**
   * {@inheritdoc}.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('eparchment.settings');
    $config->set('eparchment.subject_text', $form_state->getValue('subject_text'));
    $config->set('eparchment.page_title', $form_state->getValue('page_title'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}.
   */
  protected function getEditableConfigNames() {
    return [
      'eparchment.settings',
    ];
  }

}