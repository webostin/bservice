<?php


namespace App\Validators;


class ImageUrlValidator implements CustomValidatorInterface
{
    private $stream;
    private $url;
    private $meta;

    public function isValid($attribute, $value, $parameters, $validator){
        $this->url = $value;

        if($this->setStream()){
            $reposnse = stream_get_meta_data($this->stream);
            if(isset($reposnse)){
                $this->meta = $reposnse['wrapper_data'];
                if($this->checkContentType()){
                    return true;
                }
            }

            $this->unsetStream();

        }

        return false;
    }

    protected function checkContentType(){
        if(!empty($this->meta)){
            foreach($this->meta as $meta){
                if(strpos($meta, 'Content-Type: image')!==false){
                    return true;
                }
            }
        }
        return false;
    }

    protected function setStream(){
        try{
            if (!$this->stream = fopen($this->url, 'r')) {
                return false;
            }
            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    protected function unsetStream(){
        fclose($this->stream);
    }
}