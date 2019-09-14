<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;

class Protocol extends Model
{
    public static function e2p($inp) {
        $out = str_replace('0', '۰', $inp);
        $out = str_replace('1', '۱', $out);
        $out = str_replace('2', '۲', $out);
        $out = str_replace('3', '۳', $out);
        $out = str_replace('4', '۴', $out);
        $out = str_replace('5', '۵', $out);
        $out = str_replace('6', '۶', $out);
        $out = str_replace('7', '۷', $out);
        $out = str_replace('8', '۸', $out);
        $out = str_replace('9', '۹', $out);
        return $out;
    }

    public static function twoDigit($inp) {
        $out = (int)$inp;
        if($out<10) {
            $out = '0' . $out;
        }else {
            $out = "$out";
        }
        return $out;
    }

    public static function g2j($inp) {
        $dateTmp = explode(' ', $inp);
        $dateTmp = explode('-', $dateTmp[0]);
        $dateTmp = CalendarUtils::toJalali((int)$dateTmp[0], (int)$dateTmp[1], (int)$dateTmp[2]);
        return self::e2p($dateTmp[0] . '/' . self::twoDigit($dateTmp[1]) . '/' . self::twoDigit($dateTmp[2]));
    }

    public function getStartDateAttribute($value) {
        if($value) {
            return self::g2j($value);
        }else {
            return $value;
        }
    }

    public function getEndDateAttribute($value) {
        if($value) {
            return self::g2j($value);
        }else {
            return $value;
        }
    }

    public function getRegisterDateAttribute($value) {
        if($value) {
            return self::g2j($value);
        }else {
            return $value;
        }
    }

    public function getNotifyDateAttribute($value) {
        if($value) {
            return self::g2j($value);
        }else {
            return $value;
        }
    }

    public function getCreatedAtAttribute($value) {
        if($value) {
            return self::g2j($value);
        }else {
            return $value;
        }
    }

    public function getUpdatedAtAttribute($value) {
        if($value) {
            return self::g2j($value);
        }else {
            return $value;
        }
    }

    public function service() {
        return $this->belongsTo('App\Service', 'services_id');
    }

    public function service_desc() {
        return $this->belongsTo('App\ServicesDesc', 'services_descs_id');
    }

    public function giving_unit() {
        return $this->belongsTo('App\Unit', 'giving_units_id');
    }

    public function winner_select_way() {
        return $this->belongsTo('App\WinnerSelectWay', 'winner_select_ways_id');
    }

    public function employer_agent() {
        return $this->belongsTo('App\Agent', 'employer_id');
    }

    public function contractor_agent() {
        return $this->belongsTo('App\Agent', 'contractor_id');
    }

    public function employer() {
        return $this->belongsTo('App\Company', 'employer_company_id');
    }

    public function contractor() {
        return $this->belongsTo('App\Company', 'contractor_company_id');
    }

    public function docs() {
        return $this->hasMany('App\ProtocolDoc', 'protocols_id');
    }

    public function type() {
        return $this->belongsTo('App\ProtocolType', 'protocol_types_id');
    }
}
