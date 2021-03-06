<?php
/**
 * Phanbook : Delightfully simple forum software
 *
 * Licensed under The GNU License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */
namespace Phanbook\Backend\Controllers;

use Phalcon\Mvc\View;
use Phanbook\Forms\PagesForm;
use Phanbook\Models\Pages;
use Phanbook\Google\Analytic;
use Phanbook\Backend\Forms\DashboardForm;

/**
 * Class TestsController
 *
 * @package Phanbook\Blog\Controllers
 */
class DashboardController extends ControllerBase
{
    /**
     * indexAction function.
     *
     * @return string
     */
    public function indexAction()
    {
        $analytic = new Analytic();
        $this->view->isLogged = false;
        // We check if user authorization
        if ($analytic->checkAccessToken()) {
            $this->view->isLogged = true;
            $listGA = [
                "ga:visits",
                "ga:pageviews",
                "ga:timeOnPage"
            ];
            $this->view->analyticData = $analytic->getAnalyticData($listGA, 30);
        }
        $this->tag->setTitle(t('Dashboard'));
        $this->view->form = new DashboardForm();
    }
}
