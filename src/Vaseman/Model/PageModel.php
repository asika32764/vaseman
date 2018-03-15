<?php
/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Vaseman\Model;

use Vaseman\Asset\Asset;
use Vaseman\Entry\Page;
use Vaseman\View\Page\PageHtmlView;
use Windwalker\Core\Model\Model;
use Windwalker\Filesystem\File;

/**
 * The Page class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PageModel extends Model
{
    /**
     * generateEntries
     *
     * @param   Asset[] $entries
     *
     * @return  Page[]
     */
    public function generateEntries($entries)
    {
        $results = [];

        foreach ($entries as $entry) {
            $results[] = $this->generateEntry($entry);
        }

        return $results;
    }

    /**
     * generateEntry
     *
     * @param   Asset $entry
     *
     * @return  Page
     */
    public function generateEntry(Asset $entry)
    {
        $view = new PageHtmlView;

        $layout = File::stripExtension($entry->getPath());

        $html = $view->setLayout($layout)->render();

        $file = $layout . '.html';

        return new Page($file, $html);
    }
}
