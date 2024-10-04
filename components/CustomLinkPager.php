<?php

namespace app\components;

use yii\helpers\Html;
use yii\widgets\LinkPager;

class CustomLinkPager extends LinkPager
{
    public function run()
    {
        $this->registerLinkTags();

        if ($this->pagination->getPageCount() > 1) {
            // Parent div with margin to create space between table and pagination
            echo Html::beginTag('div', ['class' => 'pagination-container', 'style' => 'margin-top: 20px;']);

            echo Html::beginTag('div', ['class' => 'd-flex justify-content-between align-items-center mx-2']);

            // Pagination info
            echo Html::beginTag('div', ['class' => 'dataTables_info', 'id' => 'DataTables_Table_0_info', 'role' => 'status', 'aria-live' => 'polite']);
            echo 'Showing ' . ($this->pagination->getPage() * $this->pagination->pageSize + 1) . ' to ' . (($this->pagination->getPage() + 1) * $this->pagination->pageSize > $this->pagination->totalCount ? $this->pagination->totalCount : ($this->pagination->getPage() + 1) * $this->pagination->pageSize) . ' of ' . $this->pagination->totalCount . ' entries';
            echo Html::endTag('div');

            // Pagination controls
            echo Html::beginTag('div', ['class' => 'dataTables_paginate paging_simple_numbers', 'id' => 'DataTables_Table_0_paginate']);
            echo $this->renderPageButtons();
            echo Html::endTag('div');

            echo Html::endTag('div');

            echo Html::endTag('div'); // End of parent div
        }
    }

    protected function renderPageButtons()
    {
        $buttons = [];

        $currentPage = $this->pagination->getPage();
        $pageCount = $this->pagination->getPageCount();

        // Previous button
        $buttons[] = $this->renderPageButton('Previous', $currentPage - 1, 'paginate_button page-item previous', $currentPage <= 0, false);

        // Calculate the range of page buttons to display
        $startPage = max(0, $currentPage - 4);
        $endPage = min($pageCount - 1, $currentPage + 5);

        for ($i = $startPage; $i <= $endPage; $i++) {
            $buttons[] = $this->renderPageButton($i + 1, $i, 'paginate_button page-item' . ($i == $currentPage ? ' active' : ''), false, $i == $currentPage);
        }

        // Next button
        $buttons[] = $this->renderPageButton('Next', $currentPage + 1, 'paginate_button page-item next', $currentPage >= $pageCount - 1, false);

        return Html::tag('ul', implode("\n", $buttons), ['class' => 'pagination']);
    }

    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => $class . ($disabled ? ' disabled' : '')];
        $linkOptions = ['class' => 'page-link'];
        if ($disabled) {
            $linkOptions['aria-disabled'] = 'true';
            $linkOptions['tabindex'] = '-1';
        } else {
            $linkOptions['data-dt-idx'] = $page;
            $linkOptions['href'] = $this->pagination->createUrl($page);
        }
        if ($active) {
            $linkOptions['aria-current'] = 'page';
        }

        return Html::tag('li', Html::a($label, null, $linkOptions), $options);
    }
}
