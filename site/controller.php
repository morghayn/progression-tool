<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolController
 *
 * Main component controller for the component's front-end.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.0.1
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolController extends JControllerLegacy
{
    /**
     * Generates HTML for a newly activated project so that it can be updated without a redirect.
     *
     * @since 0.5.0
     */
    public function getProjectTemplate()
    {
        if (!JSession::checkToken('get'))
        {
            echo new JResponseJson(null, JText::_('JINVALID_TOKEN'), true);
        }
        else
        {
            parent::display();
        }
    }
}
