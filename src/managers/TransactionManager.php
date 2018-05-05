<?php

namespace egor260890\feedback\managers;


class TransactionManager
{


    public function wrap(callable $function)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $function();
            if ($transaction->getIsActive()) {
                $transaction->commit();
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}