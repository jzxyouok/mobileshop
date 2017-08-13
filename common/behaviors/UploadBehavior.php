<?php 
namespace common\behaviors;

use  yii\base\Behavior;
use yii\web\UploadedFile;
use yii\web\BadRequestHttpExceptionW;
use yii\helpers\FileHelper;

class UploadBehavior extends Behavior
{
    /** @var string  */
    public $saveDir = '';

    public $imageFile;
	
	public $galleryFile;

    public $file;

    public static function getErrorMsg($error){
        $errorMap = [
            1=>'File Is Too Big Beyond "upload_max_filesize" In php.ini Config Document '.ini_get('upload_max_filesize'),
            2=>'File Is Too Big Beyond HTML Form MAX_FILE_SIZE Value',
            3=>'File Did Upload A Part',
            4=>'File Did Not Upload',
            6=>'Not Found Temporary Folder',
            7=>'File Write Error',
        ];
        return isset($errorMap[$error])?$errorMap[$error]:'Unknow Upload Error';
    }

    /**
     * 上传图片
     * @return bool|string
     * @throws BadRequestHttpException
     */
    public function uploadImgFile()
    {
        /** @var UploadedFile imageFile */
        $this->imageFile = UploadedFile::getInstance($this->owner, 'imageFile');
        if(empty($this->imageFile)){
            return '';
        }
        if($this->imageFile->hasError){
            throw new BadRequestHttpException(self::getErrorMsg($this->imageFile->error));
        }
        $fileName = $this->createUploadFilePath() . uniqid('img_') . '.' . $this->imageFile->extension;
        if($this->imageFile->saveAs(\Yii::getAlias('@webroot').$fileName)){
            return str_replace('/uploads',\Yii::getAlias('@imgUrl'),$fileName);
        }
        return '';
    }
	
    /**
     * 上传多张图片
     * @return bool|string
     * @throws BadRequestHttpException
     */
    public function uploadGalleryFile()
    {
        /** @var UploadedFile imageFile */
        $this->galleryFile = UploadedFile::getInstances($this->owner, 'galleryFile');
        if(empty($this->galleryFile)){
            return '';
        }
		$aFileName = [];
		foreach($this->galleryFile as $file){
			if($file->hasError){
				throw new BadRequestHttpException(self::getErrorMsg($file->error));
			}	
			$fileName = $this->createUploadFilePath() . uniqid('img_') . '.' . $file->extension;
			if($file->saveAs(\Yii::getAlias('@webroot').$fileName)){
				array_push($aFileName, str_replace('/uploads',\Yii::getAlias('@imgUrl'),$fileName));
			}
		}
		return $aFileName;
    }

    /**
     * 上传文件
     * @return string
     * @throws BadRequestHttpException
     */
    public function uploadFile()
    {
        /** @var UploadedFile file */
        $this->file = UploadedFile::getInstance($this->owner, 'file');
        if(empty($this->file)){
            return '';
        }
        if($this->file->hasError){
            throw new BadRequestHttpException(self::getErrorMsg($this->file->error));
        }
        $fileName = $this->createUploadFilePath() . uniqid('yiicms') . '.' . $this->file->extension;
        if ($this->file->saveAs(\Yii::getAlias('@webroot') . $fileName)) {
            return $fileName;
        }

        return '';
    }
    /**
     * 创建文件夹
     * @return string
     */
    public function createUploadFilePath()
    {
        $rootPath = \Yii::getAlias('@webroot');
        $path = rtrim('/uploads/'.$this->saveDir, '/').'/';
        if(!is_dir($rootPath.$path)){
            FileHelper::createDirectory($rootPath.$path, 0777);
        }
        return $path;
    }
}