<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of message_server
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class message_server implements \SplSubject{
    private $name;
    private $observers = array();
    private $content;

    public function __construct($name) {
        $this->name = $name;
    }

    //add observer
    public function attach(\SplObserver $observer) {
        $this->observers[] = $observer;
    }

    //remove observer
    public function detach(\SplObserver $observer) {

        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    //set breakouts news
    public function message($event,$retry,$content) {
	//event: userconnect , userlogaut,draw
	//data: {"username": "bobby", "time": "02:33:48"}
	//retry
        $this->content = "event:$event".PHP_EOL."data:$data".PHP_EOL."retry:$retry";
        $this->notify();
    }

    public function getContent() {
        return $this->content." {$this->name}";
    }

    //notify observers(or some of them)
    public function notify() {
        foreach ($this->observers as $value) {
            $value->update($this);
        }
    }
}

?>
