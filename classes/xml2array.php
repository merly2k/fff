<?php
/**
 * Функции для работы с xml (xml2array) в cp1251
 *
 * @author	DYPA <dypa-freelance@bk.ru> 2007
 * @link	http://weblancer.net/users/e1it3/
 * @version 1.0
 * @license	no
*/

// array_merge_recursive which override value with next value.
// tnx 2 http://php.net/array_merge_recursive#71647

function array_merge_recursive_unique($array0, $array1)
{
    $arrays = func_get_args();
    $remains = $arrays;
    $result = array();
    foreach ($arrays as $array)
    {
        array_shift($remains);
        if (is_array ($array))
        {
            foreach($array as $key => $value)
            {
                if (is_array ($value))
                {
                    $args = array();
                    foreach ($remains as $remain)
                    {
                        if (array_key_exists($key, $remain))
                        {
                            array_push($args, $remain[$key]);
                        }
                    }
                    if (count ($args) > 2)
                    {
                        $result[$key] = call_user_func_array(__FUNCTION__, $args);
                    }
                    else
                    {
                        $result[$key] = $value;
                    }
                }
                else
                {
                    $result[$key] = $value;
                }
            }
        }
    }
    return $result;
}

/**
 * Xml 2 array parser поддерживающий cp1251
 *
 * @param string $String текст xml документа
 * @param int $Level текущий уровень вложенности
 * @return array массив с данными
 * 
 */
function xml_to_array_old($String, $Level = 0)
{
    $String = trim($String);
    $cursor_position = 0;
    $Level++;
    if ($Level == 1 && strpos($String, '<?xml', $cursor_position) !== FALSE)
    {
        $cursor_position = strpos($String, '?>', $cursor_position) + 2;
    }
    $stop_parser = FALSE;

    while (TRUE)
    {
        if ($stop_parser === TRUE)
        {
            break;
        }

        while (strpos($String, '<!--', $cursor_position) !== FALSE && strpos($String, '<', $cursor_position) == strpos($String, '<!--', $cursor_position))
        {
            $cursor_position = strpos($String, '-->', $cursor_position) + 3;
        }

        $open_tag_start = strpos($String, '<', $cursor_position);
        if ($open_tag_start === FALSE)
        {
            break;
        }
        $open_tag_start++;
        $open_tag_end = strpos($String, '>', $open_tag_start);
        if ($open_tag_end === FALSE)
        {
            break;
        }

        $tag = substr($String, $open_tag_start, $open_tag_end - $open_tag_start);
        $cursor_position = $open_tag_end;
        $empty_tag = substr($tag, strlen($tag) - 1) == '/' ? TRUE : FALSE;
        if ($empty_tag === TRUE)
        {
            $key_string = $tag;
        }
        else
        {
            $key_string = strpos($tag, '/') === FALSE ? $tag : '';
        }
        //парсит <x x="x"> но значения пока не юзает
        $key_array = explode(' ', $key_string);
        $key = $key_array[0];
        unset($key_array[0]);
        foreach ($key_array as $attribute)
        {
            $attribute = str_replace(array('"', "'"), '', $attribute);
            $attribute = explode('=', $attribute);
            if (isset($attribute[0]) && isset($attribute[1]))
            $attributes[$attribute[0]] = $attribute[1];
        }
        $attributes = isset($attributes) && is_array($attributes) ? $attributes : array();
        //print_r($Attributes);

        if ($empty_tag === FALSE)
        {
            if ($close_tag_start = strpos($String, "</$key>", $open_tag_end))
            {
                $cursor_position = $close_tag_start + 3 + strlen($key);
                $value = substr($String, $open_tag_end + 1, $close_tag_start - $open_tag_end - 1);
                $i = 0;
                while ((substr_count($value, "<$key_string>") - substr_count($value, "</$key>")) != 0)
                {
                    $i++;
                    $value = substr($String, $open_tag_end + 1, $close_tag_start - $open_tag_end - 1 + $i);
                }
                $return = xml_to_array($value, $Level);
                if (!isset($array))
                {
                    $array = array();
                }
                if ($return != '')
                {
                    if (isset($array[$key]) && is_array($array[$key]))
                    {
                        $array[$key] = array_merge_recursive_unique($array[$key], $return);
                    }
                    else
                    {
                        $array[$key] = $return;
                    }
                }
                if (!isset($array[$key]))
                {
                    $now = 0;
                    while ($now < strlen($value))
                    {
                        $str_len = strlen($value);
                        $comment_start = strpos($value, "<!--", $now);
                        $comment_end = strpos($value, "-->", $now);
                        $CDATA_start = strpos($value, "<![CDATA[", $now);
                        $CDATA_end = strpos($value, "]]>", $now);
                        if ($comment_start === FALSE && $CDATA_start === FALSE)
                        {
                            break;
                        }

                        if (($comment_start !== FALSE && $CDATA_start === FALSE) || $comment_start < $CDATA_start)
                        {
                            $value = substr($value, 0, $comment_start).substr($value, $comment_end + 3, strlen($value) - $comment_end);
                            $now = strlen(substr($value, 0, $comment_start));
                        }
                        elseif (($comment_start === FALSE && $CDATA_start !== FALSE) || $comment_start > $CDATA_start)
                        {
                            $value = substr($value, 0, $CDATA_start).substr($value, $CDATA_start + 9, $CDATA_end - $CDATA_start - 9).substr($value, $CDATA_end + 3, strlen($value) - $CDATA_end);
                            $now = $CDATA_end - 9;
                        }
                    }
                    //действие trim  не испытанно
                    $array[$key] = trim($value);
                }
                // ??? помему следующее не надо, оставил тк влом разбираться
                /*elseif (!is_array($Array[$Key]))
                {
                $Array[$Key] = $Value;
                }*/
            }
        }
        else
        {
            $array[$key] = array();
        }
        if ($Level == 1)
        {
            $stop_parser = TRUE;
        }
        unset($attributes);
    }
    if (isset($array))
    {
        return $array;
    }
}

?>
