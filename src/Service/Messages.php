<?php

namespace App\Service;

use Symfony\Component\Mime\Encoder\EncoderInterface;

class Messages {
	function getPositive(): \stdClass{
		$resp = new \stdClass();
		$resp->title = 'Makalöst jobbat!';
		$resp->message = 'För din möda har du blivit belönad med poäng';
		$path = __DIR__ . '/../Texts/Positive.json';
		if (!is_file($path)) {
			return $resp;
		}

		$content = json_decode(file_get_contents($path));
		$key = array_rand($content);
		return $content[$key];
	}

	function getNegative(){
		$resp = new \stdClass();
		$resp->title = 'Du har förlorat poäng!';
		$resp->message = 'Någon har inte uppskattat dina fasoner';
		$path = __DIR__ . '/../Texts/Negative.json';
		if (!is_file($path)) {
			return $resp;
		}

		$content = json_decode(file_get_contents($path));
		$key = array_rand($content);
		return $content[$key];
	}
}