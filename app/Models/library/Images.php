<?php

namespace App\Models\library;

/**
 ** Обработка и хранение загруженного изображения
 * Images::image(300, 300, 'avatar', '../public/img/avatars/');
 * 1 - ширина
 * 2 - высота
 * 3 - путь до дирректории хранения изображения
 * Возвращает имя полученного файла
 */
class Images
{
    /**
     ** Представительствующий метод
     * $scale_x - ширина конечного изображения
     * $scale_y - высота конечного изображения
     * $path    - путь до дирректории хранения изображения
     */
    static function image($scale_x, $scale_y, $fieldname, $path)
    {
        $image = '';

        switch ($_FILES[$fieldname]['type']) {
            case 'image/jpeg';
                $image = imagecreatefromjpeg($_FILES[$fieldname]['tmp_name']);
                return self::transformations($image, $scale_x, $scale_y, $path);
                break;
            case 'image/png';
                $image = imagecreatefrompng($_FILES[$fieldname]['tmp_name']);
                return self::transformations($image, $scale_x, $scale_y, $path);
                break;
        }
    }

    /**
     ** Работаобразующий метод
     * Преобразование изображения
     */
    static function transformations($image, $scale_x, $scale_y, $path)
    {
        // ширина изображения
        $x = imagesx($image);
        // высота изображения
        $y = imagesy($image);

        // выбор наименьшей стороны
        $min = min($x, $y);

        // определение координат начала кропа
        $crop_x = $x - $min;
        $crop_y = $y - $min;

        // преобразование координаты длинной стороны, таким образом, чтобы кроп случился по центру
        if ($crop_x > 0) {
            $crop_x = round($crop_x / 2);
        }
        if ($crop_y > 0) {
            $crop_y = round($crop_y / 2);
        }

        // кроп изображения
        $image = imagecrop($image, ['x' => $crop_x, 'y' => $crop_y, 'width' => $min, 'height' => $min]);

        // масштабирование изображения
        $image = imagescale($image, $scale_x, $scale_y);

        // генерация хеш-кода
        $hash = 'qwertyuiopasdfghjklzxcvbnm';
        $hash = str_shuffle($hash);
        $hash = mb_strimwidth($hash, 0, 5);

        // генерация адреса файла
        $file_name = date('Y_m_d__h_i_s') . '__' . $hash . image_type_to_extension(IMAGETYPE_JPEG);
        $adress = $path . $file_name;

        // сохранение изображения
        imagejpeg($image, $adress);

        // уничтожение объекта GD
        imagedestroy($image);

        return $file_name;
    }
}
