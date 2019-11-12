<?php

class SiteController
{
    public function actionIndex()
    {
        $commentList = array();
        $commentList = Comment::getCommentList();

        require_once(ROOT . '/views/site/index.php');

        return true;
    }
}
