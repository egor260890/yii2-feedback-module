<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.02.2018
 * Time: 13:36
 */

namespace egor260890\feedback\services;

use egor260890\feedback\entities\FeedbackInterface;
use egor260890\feedback\listeners\ObservableInterface;
use egor260890\feedback\listeners\FeedbackObserverInterface;
use egor260890\feedback\repositories\FeedbackRepository;
use egor260890\feedback\forms\FeedbackForm;
use egor260890\feedback\entities\Feedback;
use egor260890\feedback\managers\TransactionManager;

class FeedbackManageService implements ObservableInterface
{

    private $feedbacks;
    private $transaction;

    private $feedbackObservables=[];

    public function __construct(FeedbackRepository $feedbacks,TransactionManager $transaction)
    {
        $this->transaction=$transaction;
        $this->feedbacks=$feedbacks;
    }

    public function create(FeedbackForm $form):Feedback
    {
        $feedback=Feedback::create(
            $form->getName(),
            $form->getTel(),
            $form->getEmail(),
            $form->getMessage(),
            $form->getCompany_name()
        );
        $this->feedbacks->save($feedback);
        $this->notify($feedback);

        return $feedback;
    }

    public function remove($id){
        $feedback=$this->feedbacks->get($id);
        $this->feedbacks->remove($feedback);
    }

    public function removeMultiple(Array $keys){
        $this->transaction->wrap(function()use($keys){
            foreach ($keys as $id){
                $feedback=$this->feedbacks->get($id);
                $this->feedbacks->remove($feedback);
            }
        });
    }

    public function viewedMultiple(Array $keys){
        $this->transaction->wrap(function ()use($keys){
            foreach ($keys as $id){
                $this->viewed($id);
            }
        });
    }

    public function unreviewedMultiple(Array $key){
        $this->transaction->wrap(function () use ($key){
            foreach ($key as $id){
                $this->unreviewed($id);
            }
        });
    }

    public function viewed($id)
    {
        $feedback = $this->feedbacks->get($id);
        $feedback->viewed();
        $this->feedbacks->save($feedback);
    }

    public function unreviewed($id)
    {
        $feedback = $this->feedbacks->get($id);
        $feedback->unreviewed();
        $this->feedbacks->save($feedback);
    }

    public function findModel($id){
        return $this->feedbacks->get($id);
    }

    public function attachMany($observers){
        if (!$observers){
            return false;
        }
        if ($observers instanceof \Closure){
            $this->attachMany(call_user_func($observers));
        }else if (is_array($observers)){
            foreach ($observers as $observer){
                if ($observer instanceof \Closure){
                    $this->attachMany(call_user_func($observer));
                    continue;
                }
                $this->attach(is_object($observer)?$observer:$this->createInstance($observer));
            }
        }else if(is_subclass_of($observers,FeedbackObserverInterface::class)){
            $this->attach(is_object($observers)?$observers:$this->createInstance($observers));
        } else{
            throw new \RuntimeException('observer not implement FeedbackObserverInterface');
        }
    }

    public function attach(FeedbackObserverInterface $observer): bool
    {
        array_push($this->feedbackObservables,$observer);
        return true;
    }

    public function detach(FeedbackObserverInterface $observer,bool $compareByClassName=false)
    {
        array_walk($this->feedbackObservables,function($element,$key) use ($observer,$compareByClassName){
            if ($compareByClassName?$element==$observer:$element===$observer){
                unset($this->feedbackObservables[$key]);
                $this->detach($observer,$compareByClassName);
                return;
            }
        });
    }

    public function notify(FeedbackInterface $feedback)
    {
        foreach ($this->feedbackObservables as $observable){
            $observable->update($feedback);
        }
    }

    private function createInstance(string $classname)
    {
        try {
            $class = new \ReflectionClass($classname);
        }catch (\ReflectionException $exception){
            throw new \RuntimeException('observer not implement FeedbackObserverInterface');
        }
        return $class->newInstance();
    }

}