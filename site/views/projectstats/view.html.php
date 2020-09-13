<?php defined('_JEXEC') or die;

/**
 * (Site) Class ProgressToolViewProjectStats
 *
 * View for front-end project stats functionality.
 *
 * @package ProgressTool
 * @subpackage site
 * @since 0.3.0
 *
 * @author  Morgan Nolan <morgan.nolan@hotmail.com>
 * @link    https://github.com/morghayn
 */
class ProgressToolViewProjectStats extends JViewLegacy
{
    /**
     * @var
     */
    private $user;

    /**
     * @var
     * @var
     * @var
     * @var
     */
    protected $project, $tasks, $categories, $totals;

    /**
     * Renders view.
     *
     * @param null $tpl use default template.
     * @since 0.3.0
     */
    function display($tpl = null)
    {
        $model = parent::getModel();
        $input = JFactory::getApplication()->input;
        $projectID = $input->getInt('projectID', 0);

        JLoader::register('Authenticator',  JPATH_BASE . '/components/com_progresstool/helpers/authenticator.php');
        Authenticator::authenticate($projectID);

        JLoader::register('getCountry',  JPATH_BASE . '/components/com_progresstool/helpers/getCountry.php');
        $countryID = getCountry::getCountryID();

        $this->user = JFactory::getUser();
        $this->tasks = $model->getTasks($countryID, $projectID);
        $this->categories = $model->getCategories($countryID);
        $this->totals = $model->getTotals($countryID, $projectID);
        $this->test = $model->getTest($countryID, $projectID);
        var_dump($this->test);
        var_dump($this->categories);
        var_dump($this->totals);
        //var_dump($this->tasks);

        parent::display($tpl);
        $this->prepareDocument();
    }

    /**
     * Prepares document by adding stylesheets and scripts.
     *
     * @since 0.5.0
     */
    private function prepareDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/masterchest.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/projectstats.css");
        $document->addStyleSheet(JURI::root() . "media/com_progresstool/css/introductory.css");
        $document->addScript(JURI::root() . "media/com_progresstool/js/projectstats.js");
    }
}