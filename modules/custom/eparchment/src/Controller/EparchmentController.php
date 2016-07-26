<?php

/**
 * @file
 * Contains \Drupal\eparchment\Controller\EparchmentController
 */

namespace Drupal\eparchment\Controller;

# use Drupal\Core\Url;
// Change following https://www.drupal.org/node/2457593
use Drupal\Component\Utility\SafeMarkup;

/**
 * Controller routines for Eparchment pages.
 */
class EparchmentController {

  /**
   * Constructs Eparchment text with arguments.
   * This callback is mapped to the path
   * 'eparchment/generate/'.
   */
  // public function generate($paragraphs, $phrases) {
  public function generate() {
    // Default settings (gets module settings and stores them for later use):
    $config = \Drupal::config('eparchment.settings');
    // Page title (set in \eparchment\config\install\eparchment.settings.yml):
    $page_title = $config->get('eparchment.page_title');
    // Subject text (set in \eparchment\config\install\eparchment.settings.yml):
    $subject_text = $config->get('eparchment.subject_text');

    $element['#subject_text'] = array();

    $words = preg_split( "/[\s,]+/", $subject_text );
    $reverse = array_reverse( $words );
    $newSubject = implode( " ", $reverse );
    $element['#subject_text'][] = SafeMarkup::checkPlain($newSubject);
    
    $element['#title'] = SafeMarkup::checkPlain($page_title);

    // Theme function
    $element['#theme'] = 'eparchment';

    return $element;
  }
}
