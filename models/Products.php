<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "products".
 *
 * @property int $ID
 * @property string $productName
 * @property string|null $category
 * @property float|null $price
 * @property int|null $stock_quantity
 * @property string|null $date_added
 * @property string|null $image
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productName', 'category', 'price', 'stock_quantity', 'date_added'], 'required'],
            [['price'], 'number'],
            [['stock_quantity'], 'integer'],
            [['date_added'], 'safe'],
            [['productName'], 'string', 'max' => 100],
            [['category'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'productName' => 'Product Name',
            'category' => 'Category',
            'price' => 'Price',
            'stock_quantity' => 'Stock Quantity',
            'date_added' => 'Date Added',
            'image' => 'Image',
        ];
    }
    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         $image = UploadedFile::getInstance($this, 'image');
    //         if ($image) {
    //             $imagePath = 'uploads/' . $image->baseName . '.' . $image->extension;
    //             $image->saveAs($imagePath);
    //             $this->image = $imagePath;
    //         }
    //         return true;
    //     }
    //     return false;
    // }
}
