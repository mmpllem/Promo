<?php

namespace App\Shared\Application\Enum;
/**
 * 1000 - API
 * 2000 - Validate
 * 3000 -
 */
enum ErrorEnum: int
{
    case E_1000 = 1000;
    case E_1001 = 1001;
    case E_1002 = 1002;
    case E_2000 = 2000;
    case E_2001 = 2001;
    case E_2002 = 2002;
    case E_2003 = 2003;
    case E_2004 = 2004;
    case E_2005 = 2005;
    case E_3000 = 3000;

    public function getMessage(): string
    {
        return match ($this) {
            self::E_1000 => "Oops, что-то пошло не так",
            self::E_1001 => "Некорректный формат запроса",
            self::E_1002 => "Элемент не найден",
            self::E_2000 => "Ошибка валидации",
            self::E_2001 => "Не передан параметр",
            self::E_2002 => "Это поле не ожидалось",
            self::E_2003 => "Неверный формат телефона",
            self::E_2004 => "Неверный формат оценки",
            self::E_2005 => "Не верный формат почты",
            self::E_3000 => "test3",
        };
    }
}
