<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Adriaan Knapen <a.d.knapen@protonmail.com>
 * @date 6-2-2017
 */

class TransactionsPage extends PageFrame
{

    public function getViews(): array
    {
        return [
            'transactions-header',
        ];
    }

    public function hasAccess(): bool
    {
        return isLoggedInAndHasRole($this->ci, Role::ROLE_USER);
    }

    protected function getFormValidationRules()
    {
        return false;
    }

    /**
     * Function which is called after construction and before the views are rendered.
     */
    public function beforeView()
    {
        $loginId = getLoggedInLoginId($this->ci->session);

        $limit = $this->getDataKey('subpage') ?? 100;
        if (!(int) $limit  || $limit <= 0) {
            $limit = null;
        }
        $this->setData('limit', $limit);

        $transactions['subject'] = $this->ci->User_Transaction->getAllForSubjectId($loginId, $limit);
        $transactions['author'] = $this->ci->User_Transaction->getAllForAuthorId($loginId, $limit);
        $this->setData('transactions', $transactions);

        $fields = [
            'author' => 'author_name',
            'subject' => 'subject_name',
            'amount' => Consumption::FIELD_AMOUNT,
            'delta' => Transaction::FIELD_DELTA,
            'time' => Transaction::FIELD_TIME,
            'time_unix' => Transaction::FIELD_TIME.'_unix',
        ];
        $this->setData('fields', $fields);

        $sumDeltaByWeek = $this->ci->Transaction->getSumDeltaSubjectIdByWeek($loginId);

        $this->ci->load->library('Graph');
        /** @var Graph $graphLibrary */
        $graphLibrary = $this->ci->graph;
        $this->addScript($graphLibrary->includeJsLibrary());
        $this->addScript($graphLibrary->getGraphForTransactions($sumDeltaByWeek));

        $this->addScript(
    "<script>
            $(document).ready(function() {
                $(\"input[type=radio\").change(function() {
                    $(this).parents('ul').children('.active').removeClass('active');
                    $(this).parents('li').addClass('active');
                });
    
                $(\".pagination.horizontal-radio\").click(function() {
                    $(this).find('input[type=radio]').attr('checked', true);
                });
            });
        </script>"
        );
    }

    /**
     * Defines which models should be loaded.
     *
     * @return array;
     */
    protected function getModels(): array
    {
        return [
            Role::class,
            User_Transaction::class,
        ];
    }

    /**
     * Defines which libraries should be loaded.
     *
     * @return array;
     */
    protected function getLibraries(): array
    {
        return [];
    }

    /**
     * Defines which helpers should be loaded.
     *
     * @return array;
     */
    protected function getHelpers(): array
    {
        return [];
    }
}